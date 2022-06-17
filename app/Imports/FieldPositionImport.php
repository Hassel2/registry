<?php

namespace App\Imports;

use App\Models\FieldPosition;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class FieldPositionImport implements WithMultipleSheets, WithProgressBar {
	use Importable;

	public function sheets(): array {
        return [
           'Месторождение' => new FieldPositionMakeImport(),
        ];
    }

}

class FieldPositionMakeImport implements ToCollection, WithProgressBar {
	use Importable;

	public function collection(Collection $rows) {
		
		$isFirst = true;

		foreach ($rows as $row) {
			if ($isFirst) {
				$isFirst = false; # To skip the heading row
				continue;
			}

			$subject_name = trim($row[1]);
			if ($subject_name == 'Субъект не указан') continue;

			$subject = DB::table('rf_subjects')
				->select('id')
				->where('short_name', '=', $subject_name)
				->get()[0]->id;

			$field = DB::table('fields')
				->select('id')
				->where('name', '=', rtrim(explode('(', $row[3])[0]))
				->get()[0]->id;

			$creationArray = [
				'field' => $field,
				'subject' => $subject,
			];

			$validator = Validator::make($creationArray, FieldPosition::rules());

			if ($validator->fails()) {
				continue;
			}

			FieldPosition::create($creationArray);
		}
	}
}
