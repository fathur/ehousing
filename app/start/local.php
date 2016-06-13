<?php

View::composer('sidebar', function($view) {

    $segment = Request::segment(1);

    if(!in_array($segment, \Repositories\Navigasi\Builder::$exceptionFirstSegment))
    {
        $region = Provinsi::slug($segment)->first();
        $view->with('region', $region);
    }

    $view->with('sidemenu', \Repositories\Navigasi\Builder::render());

});

App::missing(function($exception)
{
    return Response::view('errors.404', array(), 404);
});