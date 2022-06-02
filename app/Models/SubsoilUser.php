<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubsoilUser extends Model
{
    use HasFactory;

	protected $table = 'subsoil_users';
	public $timestamps = false;

	public function management_company() {
		return $this->hasOne(SubsoilUser::class);
	}
}
