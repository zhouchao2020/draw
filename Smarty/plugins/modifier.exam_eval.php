<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty exam_eval modifier plugin
 *
 * Type:     modifier<br>
 * Name:     评价<br>
 * Date:     2015-03-16
 * Example:  {# $eval|exam_eval: #}
 * @author   xiaojiong zhaorui@moyi365.com
 * @version  1.0
 * @param    int    $intEval 评价 int best=4 better=3 good=2 bad=1 优良中差
 * 
 * @return   string
 */
function smarty_modifier_exam_eval($intEval)
{
    $strEval = '';
    switch($intEval) {
    case 4:
            $strEval = 'A+';
            break;
    case 3:
            $strEval = 'A';
            break;
    case 2:
            $strEval = 'B';
            break;
    default:
            $strEval = 'C';
            break;
    }
    return $strEval;
}
