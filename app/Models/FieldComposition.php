<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldComposition extends Model
{
    use HasFactory;

	protected $table = 'field_composition';
	public $timestamps = false;
	protected $fillable = [
		'field',
		'license_area'
	];

	public function field() {
		return $this->hasOne(Field::class);
	}

	public function license_area() {
		return $this->hasOne(LicenseArea::class);
	}

	static function rules(): array {
		return [
			'field' => 'required|integer|exists:fields,id',
			'license_area' => 'required|integer|exists:license_areas,id',
		];
	}
}
