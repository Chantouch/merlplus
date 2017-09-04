<?php
/**
 * Created by PhpStorm.
 * User: Chantouch Sek
 * Date: 8/31/2017
 * Time: 1:08 PM
 */

/**
 * @param $value
 * @return string
 */
function status($value): string
{
	switch ($value) {
		case '2':
			return '<span class="label label-warning">Draft</span>';
			break;
		case '1':
			return '<span class="label label-primary">Active</span>';
			break;
		case '0':
			return '<span class="label label-default">InActive</span>';
			break;
		default:
			break;
	}
	return $value;
}