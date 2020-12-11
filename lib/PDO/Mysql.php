<?php
/**
* @file Mysql.php
* @brief  Pdo 的mysql连接
* @author zc<lyzhouchao@126.com>
* @version 1.0
* @date 2020-12-09
 */

class Pdo_Mysql{
    private $_hosts    = NULL;
    private $_dbname  = NULL;
    private $_uname   = NULL;
    private $_pass    = NULL; 
    private $_retry_times;
    private $_connect_timeout_s;

    private $_objPdo = NULL;
    private $_transBegin = false;
    public $closeInnerTrans = false;

    public function __construct($arrDbConf){
        $this->_hosts    = $arrDbConf['hosts'];
        $this->_dbname  = $arrDbConf['dbname'];
        $this->_uname   = $arrDbConf['uname'];
        $this->_pass    = $arrDbConf['pass'];
        $this->_charset = $arrDbConf['charset'];
        $this->_retry_times = $arrDbConf['retry_times'];
        $this->_connect_timeout_s = $arrDbConf['connect_timeout_s'];
        $this->_conn();
    }

    private  function _conn(){
        $arrOption = [
            \PDO::ATTR_TIMEOUT => $this->_connect_timeout_s,
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$this->_charset}",
        
        ];
        shuffle($this->_hosts);
        //开始进行连接
        try{
            foreach($this->_hosts as $arrHostPort){
                $strIp = $arrHostPort['ip'];
                $intPort = $arrHostPort['port'];
                for($i=0; $i<$this->_retry_times; $i++){
                    $this->_objPdo = new \PDO("mysql:host={$strIp}; port={$intPort}; dbname={$this->_dbname}", $this->_uname, $this->_pass,$arrOption);
                    if($this->_objPdo){
                        $this->_objPdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, true);//是否使用预处理
                        return $this->_objPdo;
                    }
                
                }
            }
        }catch(Exception $e){
            echo json_encode($e->getMessage());
        }

        if(!$this->_objPdo){
            return false;
        }
    }

    /**
     * @brief execute 执行sql返回 PDOStatement
     *
     * @param $sql
     * @param $data
     *
     * @return PDOStatement
     */
    public function execute($sql, $data = NULL){
        $pdoStatement = $this->_prepare($sql);
        try {
            if ($data) {
                $result = $pdoStatement->execute($data);
            }
            else {
                $result = $pdoStatement->execute();
            }
        }
        catch (\Exception $e) {
            echo json_encode($e->getMessage());
        }
        if (!$result) {
            $error = $pdoStatement->errorInfo();
            if (is_array($error)) {
                $error = implode(',', $error);
            }
            else {
                $error = strval($error);
            }
            throw new Exception($error);
            return $error;
        }
        return $pdoStatement;
    }
    /**
     * @brief _prepare 重构PDO->prepare
     *
     * @param $sql
     *
     * @return PDOStatement
     */
    private function _prepare($sql) {
        try {
            $pdoStatement = $this->_objPdo->prepare($sql);
            if ($pdoStatement === false) {
                return false;
            }
        }
        catch (\Exception $e) {
            echo json_encode($e->getMessage());
            return false;
        }

        return $pdoStatement;
    }


    public function select($sql, $data = NULL, $fetchModel = \PDO::FETCH_ASSOC) {
        if ('select' !== $this->_getSQLVerb($sql)) {
            return false;
        }
        $pdoStatement = $this->execute($sql, $data);

        $rs = $pdoStatement->fetchAll($fetchModel);

        if (empty($rs)) {
            return array();
        }

        return $rs;
    }

    public function getRow($sql, $data = NULL, $fetchModel = \PDO::FETCH_ASSOC) {
        if ('select' !== $this->_getSQLVerb($sql)) {
            return false;
        }

        $pdoStatement = $this->execute($sql, $data);

        $rs = $pdoStatement->fetch($fetchModel);

        if (empty($rs)) {
            return array();
        }

        return $rs;
    }

    /**
     * 执行select语句,单条单字段
     *
     * @param string $sql
     * @return array
     */
    public function getOne($sql, $data = NULL)
    {
        if ('select' !== $this->_getSQLVerb($sql)) {
            return false;
        }

        $pdoStatement = $this->execute($sql, $data);
        
        $rs = $pdoStatement->fetch(\PDO::FETCH_NUM);
        
        if (empty($rs)) {
            return 0;
        }

        return $rs[0];
    }

    public function insert($sql, $data = NULL, $boolLastId = true) {
        if ('insert' !== $this->_getSQLVerb($sql)) {
            return false;
        }

        $pdoStatement = $this->execute($sql, $data);

        if ($boolLastId) {
            return $this->_objPdo->lastInsertId();
        }

        return $pdoStatement->rowCount();
    }

    public function update($sql, $data = NULL) {
        if ('update' !== $this->_getSQLVerb($sql)) {
            return false;
        }

        $pdoStatement = $this->execute($sql, $data);

        return $pdoStatement->rowCount();
    }
    /**
     * @brief _getSQLVerb 获取sql的动词
     *
     * @param $sql
     *
     * @return String
     */
    private function _getSQLVerb($sql) {
        $arrComponents = explode(' ', trim($sql), 2);
        return strtolower($arrComponents[0]);
    }
    public function trans($strCmd) {
        $strCmd = strtolower($strCmd);

        $strFunc = "_{$strCmd}";
        $this->$strFunc();

    }
    /**
     * @brief _begin 启动事务
     *
     * @return 
     */
    private function _begin() {
        //$_transBegin 只能开启一次
        //$usedTrans Service之外是否开启过事务
        if (!$this->_transBegin && !$this->closeInnerTrans) {
            $this->_objPdo->beginTransaction();
            $this->_transBegin = true;
        }
    }

    /**
     * @brief _rollback 回滚事务
     *
     * @return 
     */
    private function _rollback() {
        //若未开启事务，则跳过回滚
        if($this->_transBegin){
            $this->_objPdo->rollback();
            $this->_transBegin = false;
        }
    }

    /**
     * @brief _commit 提交事务[绑定在Modle的函数执行之后，一般不需要手动执行, 除非很明确知道自己在做什么，否则不要使用]
     *
     * @return 
     */
    private function _commit() {
        if ($this->_transBegin && !$this->closeInnerTrans) {
            $this->_objPdo->commit();
            $this->_transBegin = false;
        }
    }


}

