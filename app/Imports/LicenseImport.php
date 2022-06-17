<?php

namespace App\Imports;

use App\Models\License;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class LicenseImport implements WithMultipleSheets, WithProgressBar {
	use Importable;

	public function sheets(): array {
        return [
           'Лицензия' => new LicenseMakeImport(),
        ];
    }

}

class LicenseMakeImport implements ToCollection, WithProgressBar {
	use Importable;

	public function collection(Collection $rows) {
		
		$isFirst = true;

		foreach ($rows as $row) {
			break;
			if ($isFirst) {
				$isFirst = false; # To skip the heading row
				continue;
			}

			/* echo gettype($row[10]).PHP_EOL; */
			/* echo $row[10].PHP_EOL; */
			/* echo Date::excelToDateTimeObject($row[10])->format('Y-m-d').PHP_EOL; */
			/* continue; */

			$license_area = DB::table('license_areas')
				->select('id')
				->where('name', '=', trim($row[1]))
				->get();//[0]->id;

			if (count($license_area) > 0) $license_area = $license_area[0]->id;
			else $license_area = null;

			$federal_authority = DB::table('federal_authorities')
				->select('id')
				->where('name', '=', trim($row[13]))
				->get();//[0]->id;

			if (count($federal_authority) > 0) $federal_authority = $federal_authority[0]->id;
			else $federal_authority = null;

			$creationArray = [
				'series' => trim($row[2]),
				'number' => trim($row[3]),
				'view' => trim($row[4]),
				'status' => trim($row[8]),
				'license_area' => $license_area, 
				'receiving_date' => Date::excelToDateTimeObject($row[10])->format('Y-m-d'), #Y-m-d
				'cancellation_date' => Date::excelToDateTimeObject($row[12])->format('Y-m-d'),
				'expiration_date' => Date::excelToDateTimeObject($row[11])->format('Y-m-d'),
				'federal_licensing_authority' => $federal_authority,
			];

			$validator = Validator::make($creationArray, License::rules());

			if ($validator->fails()) {
				continue;
			}

			License::create($creationArray);
		}

		$isFirst = true;

		foreach ($rows as $row) {
			if ($isFirst) {
				$isFirst = false; # To skip the heading row
				continue;
			}

			$prev_license = DB::table('licenses') 
				->select('id')
				->where(DB::raw('CONCAT(series, number, view)'), '=', $row[5])
				->get();

			if (count($prev_license) == 0) continue;
			$prev_license = $prev_license[0]->id;

			License::where('series', '=', trim($row[2]))
				->where('number', '=', trim($row[3]))
				->where('view', '=', trim($row[4]))
				->update(['prev_license' => $prev_license]);	
		}
	}
}
