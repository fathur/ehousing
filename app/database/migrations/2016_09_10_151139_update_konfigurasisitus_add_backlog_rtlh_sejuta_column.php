<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateKonfigurasisitusAddBacklogRtlhSejutaColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('konfigurasisitus', function(Blueprint $table)
		{
			$table->integer('backlog')->nullable();
			$table->integer('rtlh')->nullable();
			$table->integer('sejuta_rumah')->nullable();
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
			$table->dropColumn(['backlog','rtlh','sejuta_rumah']);
		});
	}

}
