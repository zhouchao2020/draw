<?php
/**
* @file sendArticle.php
* @brief 接收用户传过来的文章
* @author zc<lyzhouchao@126.com>
* @version 1.0
* @date 2020-12-10
 */
include dirname(__FILE__) . "/Abstract.php";
class SendArticle extends AbstractAction{
    
    public function run(){
        $strTel = $_POST['tel'];//手机号
        $strArticle = $_POST['article'];//文章内容
        $intCode = $_POST['code'];//验证码
        //这个到时候放到公共方法中
        $partten = "/^((13[0-9])|(14[0-9])|(15[0-9])|(17[0-9])|(18[0-9]))[0-9]{8}$/";

        if(!preg_match($partten, $strTel)){//手机号不正确，返回
            $res['errno'] = '1001';
            $res['result'] = '手机号输入不合法';
            $this->ajaxReturn("FAIL", $res);
        }
        //验证验证码是否正常
        //判断验证码是否已经存在？
        $objRedis = $this->getRedis();
        $intRedisCode = $objRedis->get($strTel."_code");
        if(empty($intCode) || $intRedisCode != $intCode){
            $res['errno'] = "1002";
            $res['result'] = '验证码错误';
            $this->ajaxReturn("FAIL", $res);  
        }

        //验证text是否超过长度限制
        //中文utf-8下面字符串长度为3
        if(strlen($strArticle) > 1500){
            $res['errno'] = "1003";
            $res['result'] = '最多输入500个汉字';
            $this->ajaxReturn("FAIL", $res);
            
        }
        //验证手机号是否已经注册过
        $objDb = $this->getDb();
        $sql = "select tel from `draw_article` where tel = ?";
        $arrResult = $objDb->getOne($sql, [$strTel]);
        if(!empty($arrResult)){
            //设置cookie
            $this->setCookies($strTel);
            $res['errno'] = "1000";
            $res['result'] = '该手机号已注册';
            $this->ajaxReturn("FAIL", $res);
        }

        //插入数据库中
        $strInsertSql = "insert into `draw_article` (`tel`, `article`, `addtimes`) VALUES ( ? ,? ,? )";
        $bolResult = $objDb->insert($strInsertSql, [$strTel, $strArticle, time()]);
        if(!$bolResult){
            $res['errno'] = '1004';
            $res['result'] = "未知错误，请重试";
            $this->ajaxReturn("FAIL", $res);
        }
    
        $this->setCookies($strTel);
        $res['errno'] = 0;
        $res['result'] = "提交成功";
        $this->ajaxReturn("SUCCESS", $res);
    
    }

}

$obj = new SendArticle();
$obj->run();
