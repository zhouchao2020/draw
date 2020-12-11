<?php
function smarty_modifier_item_roman($num)
{
	$units = array(
		'0' => '', '1' => 'I', '2'=> 'II', '3'=>'III', '4' => 'IV', '5' => 'V',
		'6' => 'VI', '7' => 'VII', '8' => 'VIII', '9' => 'IX', '10' => 'X'
	);

	if($num > 50) {
		$num = "";
	}
	else {
		$g = $num % 10;
		$s = floor($num / 10);
		$num = "";
		for($i = 0; $i < $s; $i++) {
			$num .= $units[10];
		}
		$num .= $units[$g];
	}

	return $num;
}
