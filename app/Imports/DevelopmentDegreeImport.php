<?php

namespace App\Imports;

use App\Models\DevelopmentDegree;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class DevelopmentDegreeImport implements WithMultipleSheets, WithProgressBar {
	use Importable;

	public function sheets(): array {
        return [
           'Месторождение' => new DevelopmentDegreeMakeImport(),
        ];
    }

}

class DevelopmentDegreeMakeImport implements ToCollection, WithProgressBar {
	use Importable;

	public function collection(Collection $rows) {
		
		$isFisrt = true;

		foreach ($rows as $row) {
			if ($isFisrt) {
				$isFisrt = false; # To skip the heading row
				continue;
			}	

			$creationArray = [
				'degree' => trim($row[2])
			];

			$validator = Validator::make($creationArray, DevelopmentDegree::rules());

			if ($validator->fails()) {
				continue;
			}

			DevelopmentDegree::create($creationArray);
		}
	}
}
