<?php
function smarty_modifier_formate_seconds($s)
{
	$m = floor($s / 60);
	$s = $s % 60;
	$times = "";
	if($m != 0 && $s != 0) {
		$times = $m . '分' . $s . '秒';
	}
	else if($m != 0 && $s == 0) {
		$times = $m . '分';
	}
	else {
		$times = $s . '秒';
	}

	return $times;
}
