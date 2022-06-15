<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FederalAuthority extends Model
{
    use HasFactory;

	protected $table = 'federal_authorities';
	public $timestamps = false;
	protected $fillable = [
		'name'
	];

	static function rules(): array {
		return [
			'name' => 'string|required|unique:federal_authorities,name',
		];
	}
}
