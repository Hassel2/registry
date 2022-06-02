<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

	protected $table = 'licenses';
	public $timestamps = false;

	public function prev_license() {
		return $this->hasOne(License::class);
	}

	public function license_area() {
		return $this->hasOne(LicenseArea::class);
	}

	public function federal_licensing_authority() {
		return $this->hasOne(FederalAuthority::class);
	}
}
