<?php
/**
* @file MysqlDao.php
* @brief mysql 连接以及请求
* @author zc<lyzhouchao@126.com>
* @version 1.0
* @date 2020-12-09
 */
include dirname(__FILE__) . "/PDO/Mysql.php";
class Lib_MysqlDao{


    private static $_pools = [];//连接池
    private static $_strAlias = null;
    public static function getDb($alias='db'){
        self::$_strAlias = $alias;
        if(!isset(self::$_pools[$alias])){//如果连接池不存在，进行连接
            $arrConf = self::_getConfByAlias($alias);
            if(!$arrConf){//获取配置失败
                return false;
            }
            self::$_pools[$alias] = new Pdo_Mysql($arrConf, $alias);
        }
        $db = self::$_pools[$alias];
        return $db;
    }

    private static function _getConfByAlias($alias){
        $strDbPath = dirname(dirname(__FILE__)) . "/conf/db.ini";
        try{
            $arrConf = parse_ini_file($strDbPath,true);
            if(isset($arrConf[self::$_strAlias])){
                $arrConf = $arrConf[self::$_strAlias];
            }else{
                return false;
            }
        }catch(Exception $e){
            //@TODO 需要加log日志
            echo $e->getMessage();
            return false;
        }
        
        $arrHost = [];
        //host黑名单问题暂时不考虑
        foreach($arrConf['hosts'] as $arrHosts){
            $arrHostPort = explode(":", $arrHosts);
            $strHost = $arrHostPort[0];//host
            $intPort = $arrHostPort[1];//port
            $arrHost[] = ['ip'=> $strHost, 'port' => $intPort];
        }

        return [
            'dbname' => $arrConf['db_name'],
            'uname' => $arrConf['uname'],
            'pass' => $arrConf['password'],
            'charset' => 'utf8',
            'retry_times' => isset($arrConf['retry_times']) ? $arrConf['retry_times'] : 3,
            'connect_timeout_s' => isset($arrConf['connect_timeout_s']) ? $arrConf['connect_timeout_s'] : 1,
            'read_timeout_s' => isset($arrConf['read_timeout_s']) ? $arrConf['read_timeout_s'] : 1,
            'write_timeout_s' => isset($arrConf['write_timeout_s']) ? $arrConf['write_timeout_s'] : 1,
            'hosts' => $arrHost, 
        ];

    }

}
