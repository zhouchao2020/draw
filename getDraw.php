<?php
/**
* @file getDraw.php
* @brief 抽奖规则
* @author zc<lyzhouchao.126.com>
* @version 1.0
* @date 2020-12-10
 */

require dirname(__FILE__) . "/Abstract.php";
class GetDraw extends AbstractAction{
    public function run(){
        //获取手机号
        $strTel = $_COOKIE['tel'];
        if(empty($strTel)){
            $this->ajaxReturn("FAIL", ['errno' => 2000, 'result'=> "请重新登录哦"]);
        }
        //获取抽奖记录
        $objRedis = $this->getRedis();
        //1. 今日是否抽奖 2. 二等奖获取情况
        $date = date("Ymd");
        $arrField = [$date, "secondDraw"];
        $arrResult = $objRedis->hMGet($strTel, $arrField);
        if(isset($arrResult[$date]) && $arrResult[$date] == 1){
            $this->ajaxReturn("FAIL", ['errno' => 2001, 'result'=> "今日已经抽过奖了，每天只能抽一次"]);
        }
        //判断当日抽奖结果
        $arrDrawResult = $objRedis->hGetAll($date);

        $floatFirstRate = "0.01";
        $floatSecondRate = "0.05";
        $floatThirdRate = "0.94";
        if(isset($arrDrawResult['firstDraw']) && $arrDrawResult['firstDraw'] == 1){
            //如果当天一等奖已经抽完了，计算概率就不会想着一等奖了
            $intMaxFirstNum = 0;
        }else{
            $intMaxFirstNum = 1;
        }

        if(isset($arrDrawResult['secondDraw']) && $arrDrawResult['secondDraw'] > 20){//
            //为了保证二等奖的平性，每天给20个, 计算概率就不用管了
            $intMaxSecondNum = 0;
        }elseif(isset($arrDrawResult['secondDraw'])){
            $intMaxSecondNum = ceil(($floatSecondRate/20) * (20-$arrDrawResult['secondDraw']) * 100);
        }else{
            $intMaxSecondNum = ceil($floatSecondRate*100);
        }
        //开始抽奖算法
        //随机1-100， 当一等奖概率为0.01 时。则随机到1时获得一等奖
        //二等奖的计算就更二等奖概率做计算，实时计算(当前剩余数+一等奖数)
        //三等奖 为二等奖最大值-100

        $intRand = mt_rand(1,100);
        $intRand = 2;
        $intDraw =3;
        $strDraw = 'thirdDraw';
        $strDrawDes = "三等奖";
        if($intRand == $intMaxFirstNum){//如果随机数等于一等奖，则为一等奖
            $intDraw = 1;
            $strDraw = "firstDraw";
            $strDrawDes = "一等奖";
        }else if($intRand > $intMaxFirstNum && $intRand <= $intMaxSecondNum){
            $intDraw = 2;
            $strDraw = "secondDraw";
            $strDrawDes = "二等奖";
            
        }
        //抽完将之后记录到redis中和 mysql中
        $objDb = $this->getDb();
        //查询手机id
        $strSql = "select id from `draw_article` where `tel` = ? ";
        $intId = $objDb->getOne($strSql, [$strTel]);
        if(empty($intId)){
            $res['errno'] = "2001";
            $res['result'] = "该手机号暂未注册"; 
            $this->renderAjax("FAIL", $res);
        }

        //开启事务记录数据
        //中奖记录
        $objDb->trans("BEGIN");
        //一等奖剩余数
        //二等奖剩余数
        //当天1,2等奖的获得数
        $strInsertSql = "insert into `draw_list` (`tel_id`, `drawType`, `addtimes`) values (?, ?, ? )";
        $bolRes = $objDb->insert($strInsertSql, [ $intId, $intDraw, time() ]);
        if(!$bolRes){
            $objDb->trans("ROLLBACK");
        }
        if($strDraw != 'thirdDraw'){
            //更新每日记录表
            if($strDraw == 'secondDraw'){
                $arrData = [$date, 1, 19];
            }elseif($strDraw == 'firstDraw'){
                $arrData = [$date, 0, 20];
            }
            $strUpdate = "insert into `award_date_rest` (`drawDate`, `firstDraw`, `secondDraw`) values (? , ? ,?)  ON DUPLICATE KEY UPDATE `{$strDraw}` = `{$strDraw}` - 1";
            $res = $objDb->insert($strUpdate, [$date, 1, 20]);
            if(!$res){
                $objDb->trans("ROLLBACK");
                $this->renderDbFail();
            }
            //更新总的剩余记录
            $strUpdateTotal = "update `award_rest` set `{$strDraw}` = `{$strDraw}` - 1 where id = 1";
            $res = $objDb->update($strUpdateTotal);
            if(!$res){
                $objDb->trans("ROLLBACK");
                $this->renderDbFail();
            }
        }
        //更新redis数据
        $bolRedis = $objRedis->hincrby($date, $strDraw, 1);
        if(!$bolRedis){
            $objDb->trans("ROLLBACK");
            $this->renderDbFail();
        }
        
        $objDb->trans("COMMIT");
        //如果是二等奖，更新二等奖次数
        if($strDraw == 'secondDraw'){
            $objRedis->hincrby($strTel, "secondDraw", 1);
        }
        //更新用户的当日数据
        $objRedis->hincrby($strTel, $date, 1);
        $res = [];
        $res['errno'] = 0;
        $res['result'] = $intDraw;

        $this->ajaxReturn("SUCCESS", $res);
    }

    private function renderDbFail(){
        $this->ajaxReturn("FAIL", ['errno'=> 2002, 'result'=> '抽奖失败，请重试']);
    }
}

$obj = new GetDraw();
$obj->run();
