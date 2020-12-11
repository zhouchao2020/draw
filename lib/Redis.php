<?php
/**
* @file Redis.php
* @brief redis连接以及一些操作
* @author zc<lyzhouchao@126.com>
* @version 1.0
* @date 2020-12-09
 */
class Lib_Redis{
    
    /**
        * @brief 私有化构造方法， redis 连接走单例模式
        *
        * @return 
     */
    private static $_strAlias = null;//别名
    private static $_objInstance = null;//单例实例
    private $_objConn = null;//连接实例
    private $_redis = null; //redis实例
    /**
        * @brief 连接redis -- 基本连接，未使用中间件
        *
        * @return 
     */
    private function __construct(){
        $this->_redis = new Redis();
        $this->_conn();
    }

    /**
        * @brief 禁止clone
        *
        * @return 
     */
    private function __clone(){}


    public static function getInstance($strAlias='redis'){
        
        self::$_strAlias = $strAlias;
        if( !(self::$_objInstance[$strAlias] instanceof self) || !self::$_objInstance[$strAlias]->getConnction()){
            self::$_objInstance[$strAlias]  = new self();
        }
        //如果redis连接失败，返回false
        if(is_null(self::$_objInstance[$strAlias]->getConnction())){
            return false;
        }

        return self::$_objInstance[$strAlias];
    }


    /**
        * @brief 连接redis
        *
        * @return 
     */
    private function _conn(){
        $arrConf = $this->_getRedisConf();
        if(!$arrConf){
            return false;
        }
        //获取到conf信息后进行连接
        $floTimeSection = $arrConf['connect_timeout_ms'] / 1000;
        //验证auth
        for($i=0; $i< $arrConf['retry_times'] ; $i++){//多次重试
            try{
                $this->_objConn = $this->_redis->connect($arrConf['host'], $arrConf['port'], $floTimeSection);
                $bolAuth = $this->_redis->auth($arrConf['password']);
                break;
            }catch(RedisException $e){
                echo json_encode($e->getMessage());
                $this->_objConn = null;
                $i++;
            }
        
        }
        return $this->_objConn;
        
    }
    private function _getRedisConf(){
        $strRedisPath = dirname(dirname(__FILE__)) . "/conf/redis.ini";
        //解析数据
        try{
            $arrConf = parse_ini_file($strRedisPath, true);
            if(isset($arrConf[self::$_strAlias])){
                return $arrConf[self::$_strAlias];
            }

            return false;
        }catch(Exception $e){
            //记录日志 @TODO 待完善
            echo json_encode($e->getMessage());
        }

    }
    
    private  function getConnction(){
        return $this->_objConn;
    }
    /**
        * @brief  call 方法
        *
        * @param $strMethod 方法名称
        * @param $arrParams 参数
        *
        * @return 
     */
    public function __call($strMethod, $arrParams){
         try{
             $arrResult = call_user_func_array( array($this->_redis, $strMethod), $arrParams);
         }catch(RedisException $e){
             //echo json_encode($e->getMessage());
             //TODO 记录日志
             $arrResult = false;
         }
         return $arrResult;
    }

}

