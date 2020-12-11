<?php
/**
* @file Abstract.php
* @brief 公共类
* @author zc<zhouchao@126.com>
* @version 1.0
* @date 2020-12-09
 */
include dirname(__FILE__) . '/Smarty.ini.php';//引用smarty
include dirname(__FILE__) . '/lib/Redis.php';//引用redis
include dirname(__FILE__) . '/lib/MysqlDao.php';//引用mysql
class AbstractAction{

    /**
        * @brief 获取db实例
        *
        * @param $alias 配置别名
        *
        * @return $obj
     */
    public function getDb($alias='db'){
        return Lib_MysqlDao::getDb($alias);
    }   

    /**
        * @brief 获取redis实例
        *
        * @return $obj
     */
    public function getRedis(){
        return Lib_Redis::getInstance();
    }
    /**
        * @brief ajax返回值
        *
        * @param $strTage SUCCESS , FAIL
        * @param $arrParams
        *
        * @return 
     */
    public function ajaxReturn($strTag="SUCCESS", $arrParams = []){
        $strTag = strtoupper($strTag);
        if($strTag == 'SUCCESS'){
            $strTag = 0;
        }else if($strTag == 'FAIL'){
            $strTag = 1;
        }else{
            $strTag = 1;
        }

        $arrReturn = [
            'status' => $strTag,
            'data' => $arrParams,
        ];

        header('Content-Type:application/json; charset=utf-8');
        exit(json_encode($arrReturn));
    }

    /**
        * @brief 渲染页面
        *
        * @return 
     */
    public function renderPage($page){
        global $_smarty;
        $_smarty->display($page);
    }

    public function setCookies($tel){
        setCookie("tel", $tel, time()+3600*24);
    }

    public function assign($strKey, $mixValue) {
        global $_smarty;
		$_smarty->assign($strKey, $mixValue);
	}
}
