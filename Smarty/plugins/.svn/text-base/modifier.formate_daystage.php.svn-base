<?php

function smarty_modifier_formate_daystage()
{
	$nowT = date('H');
	if(in_array($nowT, array('00', '01', '02', '03', '04', '05', '06', '07'))){
		return '早上好！';
	}
	elseif(in_array($nowT, array('08', '09', '10', '11', '12'))){
		return '上午好！';
	}
	elseif(in_array($nowT, array('13', '14', '15', '16', '17', '18'))){
		return '下午好！';
	}else{
		return '晚上好！';
	}
}
