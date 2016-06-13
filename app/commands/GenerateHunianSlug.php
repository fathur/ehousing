<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateHunianSlug extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'ehousing:hunian:slug';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate hunian slug.';

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
		Hunian::chunk(10, function($hunian){
			foreach ($hunian as $item) {
				$model = Hunian::find($item->id);
				$model->NamaHunian = $model->NamaHunian; // agak aneh yang penting jalan

				if($model->save())
				{
					$this->info("({$model->id}) {$model->NamaHunian} = {$model->slug}");
				}
			}
		});
	}



}
