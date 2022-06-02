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
			$table->string('address', );
			$table->string('INN', 12);
			$table->string('OKPO', 10);
			$table->string('OKATO', 11);
			$table->string('OGRN', 13);
			$table->text('comments');
			$table->string('status', 100);
			$table->foreignId('management_company')->constrained('subsoil_users');
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
