<?php

View::composer('sidebar', function($view) {

    $segment = Request::segment(1);


    // Segmen pertama adalah provinsi
    if(!is_null($segment) AND !in_array($segment, \Repositories\Navigasi\Builder::$exceptionFirstSegment))
    {
        $region = Provinsi::slug($segment)->first();

        if(is_null($region))
            $view->with('sidemenu', '');
        else
            $view->with('sidemenu', \Repositories\Navigasi\Builder::renderFront());

        $view->with('region', $region);
    }
    // Jika back office
    elseif ('back-office' == $segment)
    {
        $view->with('sidemenu', \Repositories\Navigasi\Builder::renderBack());
    }
    // Jika nasional
    else {
        $view->with('sidemenu', \Repositories\Navigasi\Builder::renderFront());
    }


});

App::missing(function($exception)
{
    return Response::view('errors.404', array(), 404);
});