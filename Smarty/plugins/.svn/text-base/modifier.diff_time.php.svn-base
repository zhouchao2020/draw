<?php

function smarty_modifier_diff_time($intTime, $intDiffTime=null){
    if (!$intDiffTime){
        $intDiffTime = time();
    }
    $intType = 1;
    $intLeftTime = $intTime - $intDiffTime;
    if ($intTime <= $intDiffTime){
        $intType = 2;
        $intLeftTime = $intDiffTime - $intTime;
    }

    $intDay = intval($intLeftTime/(3600*24));
    $intLeftTime -= $intDay*24*3600;

    $intHour = intval($intLeftTime/3600);
    $intLeftTime -= $intHour*3600;

    $intMin = intval($intLeftTime/60);
    $intSecond = $intLeftTime - $intMin*60;

    return array(
        'type' => $intType,
        'day' => $intDay,
        'hour' => $intHour,
        'min' => $intMin,
        'second' => $intSecond,
    );
}
 
