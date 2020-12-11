<?php

function smarty_modifier_exam_content_format(
    $strContent, 
    $bolUserInput=false,
    $bolSplit=false,
    $imgMaxWidth=0, 
    $imgMaxHeight=0, 
    $imgWidth=0, 
    $imgHeight=0
){
    $arrStrPattern = array(
        'search' => array(
            '[img][/img]',
        ),
        'replace' => array(
            '',
        ),
    );

    $strContent = str_replace($arrStrPattern['search'], $arrStrPattern['replace'], $strContent);

    $strImgPattern = "/\[img\]([^\[]+)\[\/img\]/";
    $strImgReplace = '<img src="\\1" ';
    if ($imgWidth > 0){
        $strImgReplace .= "width={$imgWidth}px ";
    }
    if ($imgHeight > 0){
        $strImgReplace .= "height={$imgHeight}px ";
    }

    $strStyle = "";
    if ($imgMaxWidth > 0){
        $strStyle .= "max-width:{$imgMaxWidth}px;";
    }
    if ($imgMaxHeight > 0){
        $strStyle .= "max-height:{$imgMaxHeight}px;";
    }
    if (strlen($strStyle) > 0){
        $strImgReplace .= " style=\"{$strStyle}\" ";
    }
    $strImgReplace .= ">";
    $strContent = preg_replace($strImgPattern, $strImgReplace, $strContent);

    $strInputSearch = "/\[input\]\s*\[\/input\]/Usi";
    $strInputReplace = "<input type=\"text\" class=\"user_answer\">";
    if (!$bolUserInput){
        $strInputReplace = "<input type=\"text\">";
    }

    $strContent = preg_replace($strInputSearch, $strInputReplace, $strContent);
    //$strContent = str_replace($arrStrPattern['search'], $arrStrPattern['replace'], $strContent);

    //换行替换为p标签
    if ($bolSplit){
        $strContent = preg_replace("/((|\r)\n)+/", "<br>", $strContent);
        //$strContent = "<p>{$strContent}</p>";
    }

    return $strContent;
}
