<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateProvinsiSlug extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'ehousing:provinsi:slug';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate Provinsi Slug.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		Provinsi::chunk(10, function($provinces){
			foreach ($provinces as $province) {
				$slug = Str::slug($province->NamaProvinsi);
				$prov = Provinsi::find($province->KodeProvinsi);
				$prov->slug = $slug;
				if($prov->save())
				{
					$this->info($province->NamaProvinsi . ' = ' . $slug);
				}
			}
		});
	}
}
