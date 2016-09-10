<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLinkTableAddKecamatan extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('linkinfo', function(Blueprint $table)
		{
			$table->integer('KodeKecamatan')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('linkinfo', function(Blueprint $table)
		{
			$table->dropColumn('KodeKecamatan');
		});
	}

}
