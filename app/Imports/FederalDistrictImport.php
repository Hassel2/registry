<?php

namespace App\Imports;

use App\Models\FederalDistrict;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class FederalDistrictImport implements WithMultipleSheets, WithProgressBar {
	use Importable;

	public function sheets(): array {
        return [
           'Субъект РФ' => new FederalDistrictMakeImport(),
        ];
    }

}

class FederalDistrictMakeImport implements ToCollection, WithProgressBar {
	use Importable;

	public function collection(Collection $rows) {
		
		$isFisrt = true;

		foreach ($rows as $row) {
			if ($isFisrt) {
				$isFisrt = false; # To skip the heading row
				continue;
			}	

			$creationArray = [
				'name' => trim($row[2])
			];

			$validator = Validator::make($creationArray, FederalDistrict::rules());

			if ($validator->fails()) {
				continue;
			}

			FederalDistrict::create($creationArray);
		}
	}
}
