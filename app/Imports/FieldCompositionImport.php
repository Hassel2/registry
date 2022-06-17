<?php

namespace App\Imports;

use App\Models\FieldComposition;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class FieldCompositionImport implements WithMultipleSheets, WithProgressBar {
	use Importable;

	public function sheets(): array {
        return [
           'Месторождение' => new FieldCompositionMakeImport(),
        ];
    }

}

class FieldCompositionMakeImport implements ToCollection, WithProgressBar {
	use Importable;

	public function collection(Collection $rows) {
		
		$isFisrt = true;

		foreach ($rows as $row) {
			if ($isFisrt) {
				$isFisrt = false; # To skip the heading row
				continue;
			}

			$field_id = DB::table('fields')
				->select('id')
				->where('name', '=', rtrim(explode('(', $row[3])[0]))
				->get()[0]
				->id;

			foreach(explode('\n', $row[4]) as $license_area) {
				if ($license_area = '') break;

				$license_area = rtrim(explode('(', $license_area)[0]);
				
				$license_area_id = DB::table('license_areas')
					->select('id')
					->where('name', '=', trim($license_area))
					->get();
				
				if (count($license_area_id) == 0) continue;
				$license_area_id = $license_area_id[0]->id;	

				$creationArray = [
					'license_area' => $license_area_id,
					'field' => $field_id,
				];

				$validator = Validator::make($creationArray, FieldComposition::rules());

				if ($validator->fails()) {
					continue;
				}

				FieldComposition::create($creationArray);
			
			}
		}
	}
}
