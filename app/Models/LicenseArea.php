<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseArea extends Model
{
    use HasFactory;

	protected $table = 'license_areas';
	public $timestamps = false;
	protected $fillable = [
		'name',
		'subsoil_user',
	];

	public function subsoil_user() {
		return $this->hasOne(SubsoilUser::class);
	}

	static function rules(): array {
		return [
			'name' => 'required|string',
			'subsoil_user' => 'required|integer|exists:subsoil_users,id',
		];
	}
}
