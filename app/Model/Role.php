<?php

namespace App\Model;

use Illuminate\Support\Facades\Request;
use Laratrust\Models\LaratrustRole as Roles;

class Role extends Roles
{
	const ROLE_SUPER_ADMIN = 'superadministrator';
	const ROLE_ADMIN = 'administrator';
	const ROLE_EDITOR = 'editor';
	const ROLE_SUPPORTER = 'supporter';

	protected $fillable = [
		'name', 'description', 'display_name'
	];

	/**
	 * @param $id == null
	 * @return array
	 */
	public static function rule($id = null)
	{

		switch (Request::method()) {
			case 'GET':
			case 'DELETE': {
				return [];
			}
			case 'POST': {
				return [
					'display_name' => 'required|max:255',
					'name'         => 'required|max:255|alphadash|unique:roles,name',
					'description'  => 'sometimes|max:255'
				];
			}
			case 'PUT':
			case 'PATCH': {
				return [
					'display_name' => 'required|max:255',
					'description'  => 'sometimes|max:255'

				];
			}
			default:
				break;
		}
		return self::rule($id);
	}

	public static function messages()
	{
		return [
			'name.required' => 'Please input your name',
			'password.min'  => 'លេខសំងាត់ត្រូវធំជាង​ ឬស្មើរ ៦ខ្ទង់។',
		];
	}
}
