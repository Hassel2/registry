<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubsoilUser extends Model
{
    use HasFactory;

	protected $table = 'subsoil_users';
	public $timestamps = false;
	protected $fillable = [
		'company',
		'address',
		'INN',
		'OKPO',
		'OKATO',
		'OGRN',
		'comments',
		'status',
		'management_company',
	];

	public function management_company() {
		return $this->hasOne(SubsoilUser::class);
	}

	static function rules(): array {
		return [
			'company' => 'required|string|unique:subsoil_users,company',
			'address' => 'string|nullable',
			'INN' => 'string|nullable',	
			'OKPO' => 'string|nullable',
			'OKATO' => 'string|nullable',
			'OGRN' => 'string|nullable',
			'comments' => 'string|nullable',
			'status' => 'string|nullable',
			'management_company' => 'integer:exists:subsoil_users,id|nullable',
		];
	}
}
