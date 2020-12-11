<?php
/**
* @file draw.php
* @brief 抽奖页面
* @author zc<lyzhouchao@126.com>
* @version 1.0
* @date 2020-12-10
 */

include dirname(__FILE__) . "/Abstract.php";
class DrawAction extends AbstractAction{
    public function run(){
        //判断当日是否已经抽过奖， 如果抽过了，则没有抽奖机会
        $intRest = 1;//今日剩余1次机会
        //获取token
        $strTel = $_COOKIE['tel'];
        if(empty($strTel)){
            header("Location: index.php");exit;
        }
        //判断手机号是否注册过
        $objDb = $this->getDb("db");
        $sql = "select tel from `draw_article` where tel = ?";
        $arrResult = $objDb->getOne($sql, [$strTel]);
        if(empty($arrResult)){
            SetCookie($strTel, '');
            header("Location: index.php");exit;
        }
        //判断手机号今日是否抽过奖
        $objRedis = $this->getRedis();
        $result = $objRedis->hGet("$strTel", date("Ymd"));
        if($result){
            $intRest = 0;
        }
        $this->assign("rest", $intRest);
        $this->assign("tel", $strTel);
        $this->renderPage("drawPage.html");
    }
}

$obj = new DrawAction();
$obj->run();
