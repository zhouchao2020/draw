<?php
function smarty_modifier_page($intTotalRows, $intPageRows, $bolAjax=false, $intShowNum=7, $strPageParam="page"){
    $arrParams = array(
        'total_rows' => $intTotalRows,
        'show_nums' => $intShowNum,
        'per' => $intPageRows,
        'page_param' => $strPageParam,
        'is_ajax' => $bolAjax
    );

    $objPage = new Ekw_Page($arrParams);
    return $objPage->createPageLink();
}

