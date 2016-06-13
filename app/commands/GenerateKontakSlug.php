<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateKontakSlug extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'ehousing:kontak:slug';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate kontak slug.';

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
		Kontak::chunk(10, function($kontak){
			foreach ($kontak as $item) {
				$model = Kontak::find($item->id);
				$model->Nama = $model->Nama; // agak aneh yang penting jalan

				if($model->save())
				{
					$this->info("({$model->id}) {$model->Nama} = {$model->slug}");
				}
			}
		});
	}
}
