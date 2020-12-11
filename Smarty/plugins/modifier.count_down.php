<?php
function smarty_modifier_count_down($s)
{
	$d = floor($s / (24 * 60 * 60));
	$s = $s % (24 * 60 * 60);
	if($d > 0) {
		$times = $d . '天';
	}
	else {
		$h = floor($s / (60 * 60));//小时
		$s = $s % (60 * 60);
		$m = floor($s / 60);//分钟
		$s = $s % 59;//秒
		$times = '';

		if($h > 0) {
			$times = $times . $h . '小时' . $m . '分钟' . $s . '秒';
		}
		else {
			if($m > 0) {
				$times = $times . $m . '分钟' . $s . '秒';
			}
			else {
				$times = $s . '秒';
			}
		}
	}

	return $times;
}
