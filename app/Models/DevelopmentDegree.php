<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevelopmentDegree extends Model
{
    use HasFactory;

	protected $table = 'development_degree';
	public $timestamps = false;
	protected $fillable = ['degree'];

	static function rules(): array {
		return [
			'degree' => 'required|string|unique:development_degree,degree',
		];
	}
}
