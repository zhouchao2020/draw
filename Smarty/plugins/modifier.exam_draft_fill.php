<?php


function smarty_modifier_exam_draft_fill(
    $strContent, 
    $arrDraft
){
    $arrDraft = empty($arrDraft) ? array() : $arrDraft;
    $strPattern = "/<input( [^>]*class=\"user_answer\"[^>]*)>/Usi";
    $arrMatchs = array();
    $res = preg_match_all($strPattern, $strContent, $arrMatchs, PREG_PATTERN_ORDER|PREG_OFFSET_CAPTURE);
    if (empty($arrMatchs)){
        return $strContent;
    }

    $strContentFormat = "";
    $intLastPos = 0;
    foreach($arrMatchs[0] as $intIndex => $arrMatch){
        $strReplace = "<input" . $arrMatchs[1][$intIndex][0];
        if (isset($arrDraft[$intIndex])){
            $strReplace .= " value=\"{$arrDraft[$intIndex]}\"";
        }
        $strReplace .= ">";

        $intLen = $arrMatch[1] - $intLastPos;
        $strContentFormat .= substr($strContent, $intLastPos, $intLen);
        $strContentFormat .= $strReplace;
        $intLastPos = $arrMatch[1] + strlen($arrMatch[0]);
    }
    $strContentFormat  .= substr($strContent, $intLastPos);

    return $strContentFormat;
}

/*
$str = "1212121<input >sdfksdkfk<input >sdfkk<input type=\"text\" class=\"user_answer\">sdkfkdskf";

$arrAns = array(
    'B',
    'C'
);

var_dump(smarty_modifier_exam_draft_fill($str, $arrAns));
 */



