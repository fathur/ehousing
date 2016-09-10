<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateKonfigurasisitusAddPendataanColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('konfigurasisitus', function(Blueprint $table)
		{
			$table->text('pendataan')->nullable();
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
			$table->dropColumn('pendataan');
		});
	}

}
