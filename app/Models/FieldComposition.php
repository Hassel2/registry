<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldComposition extends Model
{
    use HasFactory;

	protected $table = 'field_composition';
	public $timestamps = false;

	public function field() {
		return $this->hasOne(Field::class);
	}

	public function license_area() {
		return $this->hasOne(LicenseArea::class);
	}
}
