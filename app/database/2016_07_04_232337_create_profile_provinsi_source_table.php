<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileProvinsiSourceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profile_provinsi_sources', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('profil_provinsi_id')->nullable();
			$table->string('total_apbd_prov')->nullable();
			$table->string('total_pad_prov')->nullable();
			$table->string('lain_lain_pad_yg_sah')->nullable();
			$table->string('total_penduduk')->nullable();
			$table->string('total_pria')->nullable();
			$table->string('total_wanita')->nullable();
			$table->string('pct_pertumbuhan_penduduk')->nullable();
			$table->string('kepadatan_penduduk')->nullable();
			$table->string('total_penduduk_miskin_kota')->nullable();
			$table->string('total_penduduk_miskin_desa')->nullable();
			$table->string('pajak_daerah')->nullable();
			$table->string('retribusi_daerah')->nullable();
			$table->string('kekayaan_daerah_yg_dipisah')->nullable();
			$table->string('backlog_rumah')->nullable();
			$table->string('jumlah_rt')->nullable();
			$table->string('anggaran_kemenpera')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('profile_provinsi_sources');
	}

}
