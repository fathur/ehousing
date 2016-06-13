<?php

class BaseController extends Controller {

	protected $title;

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}

		if (! is_null($this->title)) $title = ' - ' . $this->title;
		else $title = '';

		View::share('title', $title);
		View::share('sidemenu', \Repositories\Navigasi\Builder::render());

	}

}
