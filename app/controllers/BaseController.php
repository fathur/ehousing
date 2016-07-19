<?php

class BaseController extends Controller {

	protected $title;

	public function __construct()
	{
		if (! is_null($this->title)) $title = ' - ' . $this->title;
		else $title = '';

		View::share('allProvinsi', Provinsi::orderBy('NamaProvinsi', 'asc')->get());
		View::share('title', $title);
	}

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


	}

}
