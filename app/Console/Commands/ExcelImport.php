<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\FederalDistrictImport;
use App\Imports\RfSubjectImport;
use App\Imports\DevelopmentDegreeImport;
use App\Imports\FederalAuthorityImport;
use App\Imports\FieldCompositionImport;
use App\Imports\FieldImport;
use App\Imports\FieldPositionImport;
use App\Imports\LicenseAreaImport;
use App\Imports\LicenseImport;
use App\Imports\SubsoilUserImport;

class ExcelImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:excel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill database with data from excel file in the root';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
		$this->output->title('Starting import');
		(new FederalDistrictImport)->withOutput($this->output)->import('data.xlsx');
		(new RfSubjectImport)->withOutput($this->output)->import('data.xlsx');
		(new DevelopmentDegreeImport)->withOutput($this->output)->import('data.xlsx');
		(new FieldImport)->withOutput($this->output)->import('data.xlsx');
		(new FieldPositionImport)->withOutput($this->output)->import('data.xlsx');
		(new SubsoilUserImport)->withOutput($this->output)->import('data.xlsx');
		(new LicenseAreaImport)->withOutput($this->output)->import('data.xlsx');
		(new FederalAuthorityImport)->withOutput($this->output)->import('data.xlsx');
		(new LicenseImport)->withOutput($this->output)->import('data.xlsx');
		(new FieldCompositionImport)->withOutput($this->output)->import('data.xlsx');
		$this->output->success('Import successful');
        return 0;
    }
}
