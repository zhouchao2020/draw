<?php
function smarty_modifier_letter_score($score)
{
	$score = intval($score);

	if($score >= 90) {
		return 'A+';
	}
	else if($score >= 80) {
		return 'A';
	}
	else if($score > 60) {
		return 'B';
	}

	return 'C';
}
