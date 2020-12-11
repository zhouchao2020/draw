<?php
function smarty_modifier_score_seconds($s)
{
	$m = floor($s / 60);
	$s = $s % 60;
	$times = "";
	if($m != 0 && $s != 0) {
		$times = '<em>' . $m . '</em>分钟 <em>' . $s . '</em>秒';
	}
	else if($m != 0 && $s == 0) {
		$times = '<em>' . $m . '</em>分钟';
	}
	else {
		$times = '<em>' . $s . '</em>秒';
	}

	return $times;
}
