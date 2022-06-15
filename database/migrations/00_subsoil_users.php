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
		Schema::create('subsoil_users', function (Blueprint $table) {
			$table->id();
			$table->string('company', 200);
			$table->string('address', 500)->nullable();
			$table->string('INN', 12)->nullable();
			$table->string('OKPO', 10)->nullable();
			$table->string('OKATO', 11)->nullable();
			$table->string('OGRN', 13)->nullable();
			$table->text('comments')->nullable();
			$table->string('status', 100)->nullable();
			$table->foreignId('management_company')->nullable()->constrained('subsoil_users');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('subsoil_users');
    }
};
