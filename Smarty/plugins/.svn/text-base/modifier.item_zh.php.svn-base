<?php
function smarty_modifier_item_zh($num)
{
	$units = array(
		'0' => '', '1' => '一', '2' => '二', '3' => '三', '4' => '四', '5' => '五',
		'6' => '六', '7' => '七', '8' => '八', '9' => '九', '10' => '十'
	);

	if($num <= 99) {
		$g = $units[$num % 10];
		$s = floor($num / 10);
		if($s == '1') {
			$s = '十';
        }
		elseif ($s > 1) {
			$s = $units[$s].'十';
		} else {
            $s = '';
        }
		$num = $s . $g;
		return $num;
	}

	return "";

}
