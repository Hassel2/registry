<?php

namespace App\Imports;

use App\Models\LicenseArea;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class LicenseAreaImport implements WithMultipleSheets, WithProgressBar {
	use Importable;

	public function sheets(): array {
        return [
           'Лицензия' => new LicenseAreaMakeImport(),
        ];
    }

}

class LicenseAreaMakeImport implements ToCollection, WithProgressBar {
	use Importable;

	public function collection(Collection $rows) {
		
		$isFisrt = true;
		$counter = 0;

		foreach ($rows as $row) {
			if ($isFisrt) {
				$isFisrt = false; # To skip the heading row
				continue;
			}	

			$subsoil_user = DB::table('subsoil_users')
				->select('id')
				->where('company', '=', trim($row[0]))
				->get();//[0]
				//->id;
			
			if (count($subsoil_user) == 0) {  
				$counter += 1;
				continue; 
			}
			
			$subsoil_user = $subsoil_user[0]->id;

			$creationArray = [
				'name' => trim($row[1]),
				'subsoil_user' => $subsoil_user
			];

			$validator = Validator::make($creationArray, LicenseArea::rules());

			if ($validator->fails()) {
				continue;
			}

			LicenseArea::create($creationArray);
		}

		echo "Number of unknown companies: ".$counter.PHP_EOL;
	}
}
