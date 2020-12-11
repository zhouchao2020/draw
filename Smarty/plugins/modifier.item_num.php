<?php

function smarty_modifier_item_num($intNum){
    $arrMap = array(
        1 => '①',
        2 => '②',
        3 => '③',
        4 => '④',
        5 => '⑤',
        6 => '⑥',
        7 => '⑦',
        8 => '⑧',
        9 => '⑨',
        10 => '⑩',
        11 => '⑪',
        12 => '⑫',
        13 => '⑬',
        14 => '⑭',
        15 => '⑮',
        16 => '⑯',
        17 => '⑰',
        18 => '⑱',
        19 => '⑲',
        20 => '⑳',
    );
    if (isset($arrMap[$intNum])){
        return $arrMap[$intNum];
    }

    return "";
}
