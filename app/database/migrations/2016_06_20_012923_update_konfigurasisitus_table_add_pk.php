<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateKonfigurasisitusTableAddPk extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('konfigurasisitus', function(Blueprint $table)
		{
			$table->primary('KodeKonfSitus');
			$table->string('ibukota')->nullable();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('konfigurasisitus', function(Blueprint $table)
		{
			$table->dropColumn('ibukota');
		});
	}

}
