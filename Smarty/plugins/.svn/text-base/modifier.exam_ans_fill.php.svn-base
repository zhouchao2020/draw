<?php


function smarty_modifier_exam_ans_fill(
    $strContent, 
    $arrUserAns,
    $arrAns
){
    //file_put_contents("/tmp/sdfkdskf", var_export($arrUserAns, true));
    $strPattern = "/<input [^>]*>/Usi";
    $arrMatchs = array();
    $res = preg_match_all($strPattern, $strContent, $arrMatchs, PREG_PATTERN_ORDER|PREG_OFFSET_CAPTURE);
    if (empty($arrMatchs)){
        return $strContent;
    }

    $strContentFormat = "";
    $intLastPos = 0;
    foreach($arrMatchs[0] as $intIndex => $arrMatch){
        $strReplace = "";
        if ($arrUserAns[$intIndex]['text'] == $arrAns[$intIndex]){
            //正确答案
            $strReplace = "<span class=\"green_tit\">{$arrUserAns[$intIndex]['text']}</span>";
        }
        else{
            //错误答案
            $strReplace = "<span class=\"red_tit\">{$arrUserAns[$intIndex]['text']} <b>（正确答案:</b><em class=\"green\">{$arrAns[$intIndex]}</em><b>）</b></span>";
        }

        $intLen = $arrMatch[1] - $intLastPos;
        $strContentFormat .= substr($strContent, $intLastPos, $intLen);
        $strContentFormat .= $strReplace;
        $intLastPos = $arrMatch[1] + strlen($arrMatch[0]);
    }
    $strContentFormat  .= substr($strContent, $intLastPos);

    return $strContentFormat;
}

/*
$str = "1212121<input >sdfksdkfk<input >";
$arrUserAns = array(
    'A',
    'C',
);

$arrAns = array(
    'B',
    'C'
);

var_dump(smarty_modifier_exam_ans_fill($str, $arrUserAns, $arrAns));
 */
