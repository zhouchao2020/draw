<?php
function smarty_modifier_leters_exits($str) {
    if(strlen($str) <= 0){
        return false;
    }
    $str = preg_replace('/<.*>/', '', $str);
    $intExits = preg_match('/[a-zA-Z]+/', $str, $matches);

    return $intExits;
}
