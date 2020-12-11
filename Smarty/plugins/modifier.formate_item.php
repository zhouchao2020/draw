<?php

function smarty_modifier_formate_item($string)
{
	return chr(65 + intval($string));
}
