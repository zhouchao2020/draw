<?php
//引用公共类
include dirname(__FILE__) . "/Abstract.php";
//验证手机号格式是否错误
//验证手机号是否已经注册过
//判断redis中是否有数据，如果有的话，直接返回（应该方法为空，所以先直接用redis数据，要不然就是调用第三方，然后更新redis数据以及存入数据库）
//生成验证码，存入redis中，然后返回数据， 验证码有限期设置成15分钟
class getCode extends AbstractAction{

    public function run(){

        $strTel = $_POST['tel'];
        


        //查询手机号是否已经注册过了
        $objDb = $this->getDb("db");
        $sql = "select tel from `draw_article` where tel = ?";
        $arrResult = $objDb->getOne($sql, [$strTel]);
        if(!empty($arrResult)){
            $this->setCookies($strTel);
            $res['errno'] = "1000";
            $res['result'] = '该手机号已注册';
            $this->ajaxReturn("FAIL", $res);
        }
        //判断验证码是否已经存在？
        $objRedis = $this->getRedis();
        $intCode = $objRedis->get($strTel."_code");
        if(empty($intCode)){
            //生成随机的code
            $intCode = rand(1000, 9999);
            //存入redis中
            $objRedis->setex($strTel."_code", 15*60 ,$intCode);
        }
        $this->ajaxReturn("SUCCESS", ['errno'=> 0, 'code'=> $intCode]);
    
    }
}

$obj = new getCode();
$obj->run();
