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
		Schema::create('rf_subjects', function(Blueprint $table) {
			$table->id();
			$table->string('name', 200);
			$table->string('short_name', 200);
			$table->foreignId('federal_district')->constrained('federal_districts');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('rf_sujects');
    }
};
