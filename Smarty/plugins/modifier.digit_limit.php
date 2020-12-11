<?php
function smarty_modifier_digit_limit($digit, $counter) {

	$intLimit = pow(10, $counter) - 1;
	if ($digit > $intLimit) {
		return $intLimit;
	}

	return $digit;
}
