<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfSubject extends Model
{
    use HasFactory;

	protected $table = 'rf_subjects';
	public $timestamps = false;

	public function federal_district() {
		return $this->hasOne(FederalDistrict::class);
	}
}
