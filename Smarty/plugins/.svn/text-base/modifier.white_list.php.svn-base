<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty white_list modifier plugin
 *
 * Type:     modifier<br>
 * Name:     白名单检测插件<br>
 * Date:     2014-12-05
 * Example:  {# if 'credit_goods'|white_list #}true{# else #}flase{# /if #}
 * @author   haoran <haoran@staff.sina.com.cn>
 * @version  1.0
 * @param    int    $intUid 用户id
 * @param    string $strBiz 权限业务标识 [参见conf.ini vip]
 * @param    int    $style  返回值处理方式  
 * @param array  $arrPowerInfo 用户权限。 批量用户信息中已经有， 可以传过来噢
 * 
 * @return   string
 */
function smarty_modifier_white_list($strBiz = 'credit_goods')
{
    return Tool_White::checkWhite($strBiz);
}
?>