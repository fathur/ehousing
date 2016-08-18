<?php
/**
 * Created by PhpStorm.
 * User: akung
 * Date: 8/18/16
 * Time: 21:05
 */

namespace Front\Nasional;


use BackOffice\AdminController;

class DekonController extends \BaseController
{
    public function provinsi()
    {
        $data = array(
        );

        return \View::make('front.dekon.empty', compact('data'))
            ->with('dekonTitle', 'Dekon Nasional');
    }

    public function kabupaten()
    {
        $data = array(
        );
        
        return \View::make('front.dekon.empty', compact('data'))
            ->with('dekonTitle', 'Dekon Nasional');


    }
}