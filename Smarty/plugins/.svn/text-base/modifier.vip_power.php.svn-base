<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty vip_powe modifier plugin
 *
 * Type:     modifier<br>
 * Name:     用户vip权限检测<br>
 * Date:     2014-09-14
 * Example:  {# $uid|vip_power:'vip_power_comm':0 #}
 * @author   haoran <haoran@staff.sina.com.cn>
 * @version  1.0
 * @param    int    $intUid 用户id
 * @param    string $strBiz 权限业务标识 [参见conf.ini vip]
 * @param    int    $style  返回值处理方式  
 * @param array  $arrPowerInfo 用户权限。 批量用户信息中已经有， 可以传过来噢
 * 
 * @return   string
 */
function smarty_modifier_vip_power($intUid, $strBiz = 'vip_power_comm', $style = 0, $arrPowerInfo = false)
{
    return Tool_VipPower::checkVipPower($intUid, $strBiz, $style, $arrPowerInfo);
}
?>
