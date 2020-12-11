<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty user_icon modifier plugin
 *
 * Type:     modifier<br>
 * Name:     用户vip权限检测<br>
 * Date:     2016-05-25
 * Example:  {# $uid|user_icon:$arrVipPower:1 #}
 * @author   haoran <haoran@staff.sina.com.cn>
 * @version  1.0
 * @param    int    $intUid 用户id
 * @param    array  $arrPowerInfo 用户权限信息 
 * @param    boolean $style    返回值处理方式  
 * @param    boolean $intShow  是否展示B端VIP图标
 * 
 * @return   string
 */
function smarty_modifier_user_icon($intUid, $arrPowerInfo = array(), $intIconStyle = 1, $intShow=1) {
     $html = Ekw_UserIcon::smarty_icon($intUid, $arrPowerInfo, $intIconStyle, $intShow);
    return $html;
}
?>
