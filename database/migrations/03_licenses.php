<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('licenses', function(Blueprint $table) {
			$table->id();
			$table->string('series', 3);
			$table->string('number', 5);
			$table->string('view', 2);
			$table->foreignId('prev_license')->nullable()->constrained('licenses');
			$table->text('status');
			$table->foreignId('license_area')->constrained('license_areas');
			$table->date('receiving_date');
			$table->date('cancellation_date')->nullable();
			$table->date('expiration_date');
			$table->foreignId('federal_licensing_authority')->nullable()->constrained('federal_authorities');
			/* $table->multiPolygon('geometry'); */
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('licenses');
    }
};
