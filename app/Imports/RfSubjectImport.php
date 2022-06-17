<?php
namespace App\Imports;

use App\Models\RfSubject;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class RfSubjectImport implements WithMultipleSheets, WithProgressBar {
	use Importable;

	public function sheets(): array {
        return [
           'Субъект РФ' => new RfSubjectMakeImport(),
        ];
    }

}

class RfSubjectMakeImport implements ToCollection, WithProgressBar {
	use Importable;

	public function collection(Collection $rows) {
		
		$isFirst = true;

		foreach ($rows as $row) {
			if ($isFirst) {
				$isFirst = false; # To skip the heading row
				continue;
			}

			$federalDistrict = DB::table('federal_districts')
								->select('id')
								->where('name', '=', trim($row[2]))
								->get()[0]->id;

			$creationArray = [
				'name' => trim($row[0]),
				'short_name' => trim($row[1]),
				'federal_district' => $federalDistrict,
			];

			$validator = Validator::make($creationArray, RfSubject::rules());

			if ($validator->fails()) {
				continue;
			}

			RfSubject::create($creationArray);
		}
	}
}
