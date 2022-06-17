<?php

namespace App\Imports;

use App\Models\SubsoilUser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class SubsoilUserImport implements WithMultipleSheets, WithProgressBar {
	use Importable;

	public function sheets(): array {
        return [
           'Недропользователь (компания)' => new SubsoilUserMakeImport(),
        ];
    }

}

class SubsoilUserMakeImport implements ToCollection, WithProgressBar {
	use Importable;

	public function collection(Collection $rows) {
		
		$isFirst = true;

		foreach ($rows as $row) {
			if ($isFirst) {
				$isFirst = false; # To skip the heading row
				continue;
			}

			$creationArray = [
				'company' => trim($row[0]),
				'address' => $row[1],
				'INN' => $row[2],
				'OKPO' => $row[3],
				'OKATO' => $row[4],
				'OGRN' => $row[7],
				'comments' => $row[8],
				'status' => $row[9],
			];

			$validator = Validator::make($creationArray, SubsoilUser::rules());

			if ($validator->fails()) {
				continue;
			}

			SubsoilUser::create($creationArray);
		}

		$isFirst = true;

		foreach ($rows as $row) {
			if ($isFirst) {
				$isFirst = false; # To skip the heading row
				continue;
			}

			if (trim($row[10]) == 'Самостоятельные' || 
				trim($row[10]) == '') continue;

			/* $subsoil_user = DB::table('subsoil_users') */
				/* ->where('company', '=', trim($row[0])) */
				/* ->first(); */

			$management_company = DB::table('subsoil_users')
				->select('id')
				->where('company', '=', trim($row[10]))
				->get()[0]
				->id;

			SubsoilUser::where('company', '=', trim($row[0]))->update(['management_company' => $management_company]);
			
			/* $subsoil_user->management_company = $management_company; */
			/* $subsoil_user->save(); */
			/* $subsoil_user->update(['management_company' => $management_company]); */
			
		}
	}
}
