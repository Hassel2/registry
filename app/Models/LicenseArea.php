<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseArea extends Model
{
    use HasFactory;

	protected $table = 'license_areas';
	public $timestamps = false;

	public function subsoil_user() {
		return $this->hasOne(SubsoilUser::class);
	}
}
