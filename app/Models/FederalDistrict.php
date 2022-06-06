<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FederalDistrict extends Model
{
    use HasFactory;

	protected $table = 'federal_districts';
	public $timestamps = false;

	protected $fillable = ['name'];

	static function rules(): array {
		return [
			'name' => 'required|string|unique:federal_districts,name',
		];
	}
}
