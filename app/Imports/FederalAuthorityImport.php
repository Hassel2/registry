<?php

namespace App\Imports;

use App\Models\FederalAuthority;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class FederalAuthorityImport implements WithMultipleSheets, WithProgressBar {
	use Importable;

	public function sheets(): array {
        return [
           'Лицензия' => new FederalAuthorityMakeImport(),
        ];
    }

}

class FederalAuthorityMakeImport implements ToCollection, WithProgressBar {
	use Importable;

	public function collection(Collection $rows) {
		
		$isFisrt = true;

		foreach ($rows as $row) {
			if ($isFisrt) {
				$isFisrt = false; # To skip the heading row
				continue;
			}	

			$creationArray = [
				'name' => trim($row[13])
			];

			$validator = Validator::make($creationArray, FederalAuthority::rules());

			if ($validator->fails()) {
				continue;
			}

			FederalAuthority::create($creationArray);
		}
	}
}
