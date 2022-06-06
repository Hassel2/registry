<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

	protected $table = 'fields';
	public $timestamps = false;
	protected $fillable = [
		'name',
		'development_degree',
	];

	public function development_degree() {
		return $this->hasOne(DevelopmentDegree::class);
	}

	static function rules(): array {
		return [
			'name' => 'required|string|unique:field,name',
			'development_degree' => 'required|integer|exist:development_degree,id'	
		];
	}
}
