<?php
/**
 * Project: ehousing-3.0
 * Date: 6/14/16
 * Time: 22:09
 */

namespace BackOffice;


class AdminController extends \BaseController
{
    protected $identifier = 'ehousing';

    public function __construct()
    {
        parent::__construct();

        \View::share('identifier', $this->identifier);

        if(\Auth::check()) {
            if(strtolower(\Auth::user()->Region) == strtolower('Nasional'))
                \View::share('isNasional', true);
            else
                \View::share('isNasional', false);
        }
        else
            \View::share('isNasional', null);
    }
}