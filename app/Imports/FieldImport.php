<?php

namespace App\Imports;

use App\Models\Field;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class FieldImport implements WithMultipleSheets, WithProgressBar {
	use Importable;

	public function sheets(): array {
        return [
           'Месторождение' => new FieldMakeImport(),
        ];
    }

}

class FieldMakeImport implements ToCollection, WithProgressBar {
	use Importable;

	public function collection(Collection $rows) {
		
		$isFirst = true;

		foreach ($rows as $row) {
			if ($isFirst) {
				$isFirst = false; # To skip the heading row
				continue;
			}

			$developmentDegree = DB::table('development_degree')
				->select('id')
				->where('degree', '=', $row[2])
				->get()[0]->id;

			$creationArray = [
				'name' => rtrim(explode('(', $row[3])[0]),
				'development_degree' => $developmentDegree,
			];

			$validator = Validator::make($creationArray, Field::rules());

			if ($validator->fails()) {
				continue;
			}

			Field::create($creationArray);
		}
	}
}
