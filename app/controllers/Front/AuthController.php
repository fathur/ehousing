<?php

namespace Front;

use Illuminate\Http\Response;
use Validator;
use View;

class AuthController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getLogin()
	{
		return View::make('front.auth.login');
	}

	/**
	 * @return $this|\Illuminate\Http\RedirectResponse
	 * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
	public function postLogin()
	{
		$validator = \Validator::make(\Input::only(array('UserName','UserPassword')), array(
			'UserName' => 'required',
			'UserPassword' => 'required'
		));

		if($validator->fails())
			return \Redirect::route('front.auth.login')->withErrors($validator);

		$attempt = \Auth::attempt(array(
			'UserName' => \Input::get('UserName'),
			'UserPassword' => \Input::get('UserPassword')
		));

		if($attempt)
			return \Redirect::intended('hunian');

		return \Redirect::route('front.auth.login')
			->with('message','Login gagal! Username atau password tidak cocok.')
			->with('class','danger');
	}

	public function getLogout()
	{

	}

	public function getLostPassword()
	{
		return View::make('front.auth.lost_password');

	}

	public function postLostPassword()
	{
		$validator = Validator::make(\Input::only('UserEmail'), [
			'UserEmail'	=> 'required|email'
		]);

		if($validator->fails())
			return \Redirect::route('front.auth.forgot')->withErrors($validator);

		return \Redirect::route('front.auth.forgot')
			->with('message','Email tidak ditemukan!')
			->with('class','danger');;
	}

}
