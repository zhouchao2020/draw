<?php
/**
* @file admin.php
* @brief 后台页面（提供两个按钮， 一个导出文字数据， 一个导出所有的获奖数据）
* @author zc<lyzhouchao@126.com>
* @version 1.0
* @date 2020-12-10
 */

//引用公共类
include dirname(__FILE__) . "/Abstract.php";
class Admin extends  AbstractAction{
    public function run(){
        $this->renderPage("admin.html");
    }

}

$obj = new Admin();
$obj->run();
