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
		Schema::create('fields', function(Blueprint $table) {
			$table->id();
			$table->foreignId('rf_subject')->constrained('rf_subjects');
			$table->string('name', 200);
			$table->foreignId('development_degree')->constrained('development_degree');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('fields');
    }
};
