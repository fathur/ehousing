<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GeneratePostSlug extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'ehousing:post:slug';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate post slug.';

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
		Post::chunk(10, function($posts)
		{
			foreach ($posts as $post) {
				$article = Post::find($post->id);
				$article->Judul = $article->Judul; // agak aneh yang penting jalan

				if($article->save())
				{
					$this->info("({$post->id}) {$article->Judul} = {$article->slug}");
				}
			}
		});
	}



}
