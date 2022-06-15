<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

	protected $table = 'licenses';
	public $timestamps = false;
	protected $fillable = [
		'series',
		'number',
		'view',
		'prev_license',
		'status',
		'license_area',
		'receiving_date',
		'cancellation_date',
		'expiration_date',
		'federal_licensing_authority',
	];

	public function prev_license() {
		return $this->hasOne(License::class);
	}

	public function license_area() {
		return $this->hasOne(LicenseArea::class);
	}

	public function federal_licensing_authority() {
		return $this->hasOne(FederalAuthority::class);
	}

	static function rules(): array {
		return [
			'series' => 'required|string',
			'number' => 'required|string',
			'view' => 'required|string',
			'prev_license' => 'nullable|integer|exists:licenses,id',
			'status' => 'required|string',
			'license_area' => 'required|integer|exists:license_areas,id',
			'receiving_date' => 'required|date',
			'cancellation_date' => 'nullable|date',
			'expiration_date' => 'required|date',
			'federal_licensing_authority' => 'nullable|integer|exists:federal_authorities,id',
		];
	}
}
