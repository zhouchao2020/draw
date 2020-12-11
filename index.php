<?php
/**
* @file index.php
* @brief 
* @author zc<lyzhouchao@126.com>
* @version 1.0
* @date 2020-12-09
 */
require dirname(__FILE__) . "/Abstract.php";
class Index extends AbstractAction{
    
    public function run(){
        if(isset($_COOKIE['tel'])){
            $strTel = $_COOKIE['tel'];
            //判断手机号是否注册过
            $objDb = $this->getDb("db");
            $sql = "select tel from `draw_article` where tel = ?";
            $arrResult = $objDb->getOne($sql, [$strTel]);
            if(empty($arrResult)){
                $this->renderPage("index.html");exit;
            }else{
                header("Location: draw.php");exit;
            }
        }
        $this->renderPage("index.html");
    }

}

$obj = new Index();
$obj->run();
