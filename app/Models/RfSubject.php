<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfSubject extends Model
{
    use HasFactory;

	protected $table = 'rf_subjects';
	public $timestamps = false;
	protected $fillable = [
		'name',
		'short_name',
		'federal_district'
	];

	public function federal_district() {
		return $this->hasOne(FederalDistrict::class);
	}

	static function rules(): array {
		return [
			'name' => 'required|string|unique:rf_subjects,name',
			'short_name' => 'required|string|unique:rf_subjects,short_name',
		];
	}
}
