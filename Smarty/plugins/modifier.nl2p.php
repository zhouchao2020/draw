<?php

function smarty_modifier_nl2p($str, $strPattern="\n"){
    $str = ltrim($str, "\n");
    $str = str_replace("\n", "</p><p>", $str);
    $str = "<p>{$str}</p>";
    return $str;
}
