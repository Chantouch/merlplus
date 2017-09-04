<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/23/2017
 * Time: 7:37 AM
 */

namespace App\Helpers;


class Helper
{
	public static function active($value)
	{
		switch ($value) {
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
}