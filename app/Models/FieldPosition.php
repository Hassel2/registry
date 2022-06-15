<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldPosition extends Model
{
    use HasFactory;

	protected $table = 'field_position';
	public $timestamps = false;
	protected $fillable = [
		'field',
		'subject',
	];

	public function field() {
		return $this->hasOne(Field::class);
	}

	public function rf_subject() {
		return $this->hasOne(RfSubject::class);
	}

	static function rules(): array {
		return [
			'field' => 'required|integer|exists:fields,id',
			'subject' => 'required|integer|exists:rf_subjects,id'
		];
	}
}
