<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses' => 'Front\NasionalController@getDashboard','as'=>'front.nasional.dashboard'));

// Route::get('/', ['uses' => 'Front\HomeController@index', 'as' => 'front.home']);
Route::group(array('prefix' => 'back-office'), function() {

    Route::get('login', ['uses' => 'Front\AuthController@getLogin','as' => 'front.auth.login']);
    Route::post('login', ['uses' => 'Front\AuthController@postLogin','as' => 'front.auth.check']);
    Route::get('password/forgot', ['uses' => 'Front\AuthController@getLostPassword','as' => 'front.auth.forgot']);
    Route::post('password/forgot', ['uses' => 'Front\AuthController@postLostPassword','as' => 'front.auth.reset']);


    //Route::get('/', array('uses' => ''));

    Route::group(array('namespace' => 'BackOffice'), function(){
        Route::resource('hunian', 'HunianController', array('except' => array('show')));
        Route::get('hunian/data', array('uses' => 'HunianController@data', 'as' => 'back-office.hunian.data'));

        Route::resource('hunian.gallery', 'GaleriHunianController', array('only' => array('index','store','destroy')));
        Route::get('gallery/data', array('uses' => 'GaleriHunianController@data', 'as' => 'back-office.gallary.data'));

        Route::resource('kategori', 'KategoriController',array('except' => array('show')));
        Route::get('kategori/data', array('uses' => 'KategoriController@data', 'as' => 'back-office.kategori.data'));

        Route::resource('post', 'PostController',array('except' => array('show')));
        Route::get('post/data', array('uses' => 'PostController@data', 'as' => 'back-office.post.data'));

        Route::resource('kontak', 'KontakController',array('except' => array('show')));
        Route::get('kontak/data', array('uses' => 'KontakController@data', 'as' => 'back-office.kontak.data'));

        Route::get('provinsi/name', array('uses' => 'ProvinsiController@getFromName', 'as' => 'back-office.provinsi.name'));
        Route::get('kontak/name', array('uses' => 'KontakController@getFromName', 'as' => 'back-office.kontak.name'));
        Route::get('kota/name', array('uses' => 'KabupatenController@getFromName', 'as' => 'back-office.kota.name'));
        Route::get('kecamatan/name', array('uses' => 'KecamatanController@getFromName', 'as' => 'back-office.kecamatan.name'));

    });

});


Route::get('ehousing', array('uses' => 'Front\NasionalController@getEHousing','as'=>'front.nasional.ehousing'));
Route::get('profile', function(){});
Route::get('statistik', function(){});

// Kontak routes
Route::get('kontak/developer', array('uses' => 'Front\Nasional\KontakController@getDeveloper','as' => 'front.nasional.kontak.developer'));
Route::get('kontak/kontraktor', array('uses' => 'Front\Nasional\KontakController@getKontraktor','as' => 'front.nasional.kontak.kontraktor'));
Route::get('kontak/supplier', array('uses' => 'Front\Nasional\KontakController@getSupplier','as' => 'front.nasional.kontak.supplier'));
Route::get('kontak/tukang', array('uses' => 'Front\Nasional\KontakController@getTukang','as' => 'front.nasional.kontak.tukang'));
Route::get('kontak/desain-arsitek', array('uses' => 'Front\Nasional\KontakController@getArsitek','as' => 'front.nasional.kontak.arsitek'));
Route::get('kontak/data', array('uses' => 'Front\Nasional\KontakController@data', 'as' => 'front.nasional.kontak.data'));
Route::get('kontak/{kontak}', array('uses' => 'Front\Nasional\KontakController@show', 'as' => 'front.nasional.kontak.show'));

// Hunian routes
Route::get('hunian/rusun-sewa', array('uses' => 'Front\Nasional\HunianController@getRusunSewa', 'as' => 'front.nasional.hunian.rusunsewa'));
Route::get('hunian/rusunami', array('uses' => 'Front\Nasional\HunianController@getRusunami', 'as' => 'front.nasional.hunian.rusunami'));
Route::get('hunian/rusunami-subsidi', array('uses' => 'Front\Nasional\HunianController@getRusunamiSubsidi', 'as' => 'front.nasional.hunian.rusunamisubs'));
Route::get('hunian/rumah-subsidi', array('uses' => 'Front\Nasional\HunianController@getRumahSubsidi', 'as' => 'front.nasional.hunian.rumahsubs'));
Route::get('hunian/condotel', array('uses' => 'Front\Nasional\HunianController@getCondotel', 'as' => 'front.nasional.hunian.condotel'));
Route::get('hunian/apertemen', array('uses' => 'Front\Nasional\HunianController@getApartemen', 'as' => 'front.nasional.hunian.apartemen'));
Route::get('hunian/hotel', array('uses' => 'Front\Nasional\HunianController@getHotel', 'as' => 'front.nasional.hunian.hotel'));
Route::get('hunian/data', array('uses' => 'Front\Nasional\HunianController@data', 'as' => 'front.nasional.hunian.data'));
Route::get('hunian/{hunian}', array('uses' => 'Front\Nasional\HunianController@show', 'as' => 'front.nasional.hunian.show'));

// Post routes
Route::get('program', array('uses' => 'Front\Nasional\PostController@getProgram','as' => 'front.nasional.program.list'));
Route::get('berita', array('uses' => 'Front\Nasional\PostController@getBerita','as' => 'front.nasional.berita.list'));
Route::get('post/{slug}', array('uses' => 'Front\Nasional\PostController@show','as' => 'front.nasional.post.show'));


// Link routes
Route::get('link/imb', array('uses' => 'Front\Nasional\LinkController@getImb', 'as' => 'front.nasional.link.imb'));
Route::get('link/pbb', array('uses' => 'Front\Nasional\LinkController@getPbb', 'as' => 'front.nasional.link.pbb'));
Route::get('link/tata-ruang', array('uses' => 'Front\Nasional\LinkController@getTataRuang', 'as' => 'front.nasional.link.tataruang'));
Route::get('link/bpn', array('uses' => 'Front\Nasional\LinkController@getBpn', 'as' => 'front.nasional.link.bpn'));
Route::get('link/data', array('uses' => 'Front\Nasional\LinkController@data', 'as' => 'front.nasional.link.data'));



// File routes
Route::get('file/kebijakan', array('uses' => 'Front\Nasional\FileController@getKebijakan', 'as' => 'front.nasional.file.kebijakan'));
Route::get('file/penelitian', array('uses' => 'Front\Nasional\FileController@getPenelitian', 'as' => 'front.nasional.file.penelitian'));
Route::get('file/informasi', array('uses' => 'Front\Nasional\FileController@getInformasi', 'as' => 'front.nasional.file.informasi'));
Route::get('file/shm', array('uses' => 'Front\Nasional\FileController@getStandarHargaMaterial', 'as' => 'front.nasional.file.shm'));
Route::get('file/data', array('uses' => 'Front\Nasional\FileController@data', 'as' => 'front.nasional.file.data'));

Route::get('file/download/{url}', array('uses' => 'Front\Nasional\FileController@download', 'as' => 'front.file.download'));
Route::get('file/{type}/{url}', array('uses' => 'Front\Nasional\FileController@show', 'as' => 'front.file.show'));


// ============================================//

// Provinsi routes
Route::get('{provinsi}', ['uses' => 'Front\ProvinsiController@getDashboard','as'=>'front.provinsi.dashboard']);
Route::get('{provinsi}/ehousing', ['uses' => 'Front\ProvinsiController@getEhousing','as'=>'front.provinsi.ehousing']);
Route::get('{provinsi}/profile', ['uses' => 'Front\ProvinsiController@getProfile','as'=>'front.provinsi.profile']);
Route::get('{provinsi}/statistik', ['uses' => 'Front\ProvinsiController@getStatistik','as'=>'front.provinsi.statistik']);


// Hunian routes
Route::get('{provinsi}/hunian/rusun-sewa', array('uses' => 'Front\Provinsi\HunianController@getRusunSewa', 'as' => 'front.provinsi.hunian.rusunsewa'));
Route::get('{provinsi}/hunian/rusunami', array('uses' => 'Front\Provinsi\HunianController@getRusunami', 'as' => 'front.provinsi.hunian.rusunami'));
Route::get('{provinsi}/hunian/rusunami-subsidi', array('uses' => 'Front\Provinsi\HunianController@getRusunamiSubsidi', 'as' => 'front.provinsi.hunian.rusunamisubs'));
Route::get('{provinsi}/hunian/rumah-subsidi', array('uses' => 'Front\Provinsi\HunianController@getRumahSubsidi', 'as' => 'front.provinsi.hunian.rumahsubs'));
Route::get('{provinsi}/hunian/condotel', array('uses' => 'Front\Provinsi\HunianController@getCondotel', 'as' => 'front.provinsi.hunian.condotel'));
Route::get('{provinsi}/hunian/apartemen', array('uses' => 'Front\Provinsi\HunianController@getApartemen', 'as' => 'front.provinsi.hunian.apartemen'));
Route::get('{provinsi}/hunian/hotel', array('uses' => 'Front\Provinsi\HunianController@getHotel', 'as' => 'front.provinsi.hunian.hotel'));
Route::get('{provinsi}/hunian/data', array('uses' => 'Front\Provinsi\HunianController@data', 'as' => 'front.provinsi.hunian.data'));
Route::get('{provinsi}/hunian/{hunian}', array('uses' => 'Front\Provinsi\HunianController@show', 'as' => 'front.provinsi.hunian.show'));

// Kontak routes
Route::get('{provinsi}/kontak/developer', array('uses' => 'Front\Provinsi\KontakController@getDeveloper','as' => 'front.provinsi.kontak.developer'));
Route::get('{provinsi}/kontak/kontraktor', array('uses' => 'Front\Provinsi\KontakController@getKontraktor','as' => 'front.provinsi.kontak.kontraktor'));
Route::get('{provinsi}/kontak/supplier', array('uses' => 'Front\Provinsi\KontakController@getSupplier','as' => 'front.provinsi.kontak.supplier'));
Route::get('{provinsi}/kontak/tukang', array('uses' => 'Front\Provinsi\KontakController@getTukang','as' => 'front.provinsi.kontak.tukang'));
Route::get('{provinsi}/kontak/desain-arsitek', array('uses' => 'Front\Provinsi\KontakController@getArsitek','as' => 'front.provinsi.kontak.arsitek'));
Route::get('{provinsi}/kontak/data', array('uses' => 'Front\Provinsi\KontakController@data', 'as' => 'front.provinsi.kontak.data'));
Route::get('{provinsi}/kontak/{kontak}', array('uses' => 'Front\Provinsi\KontakController@show', 'as' => 'front.provinsi.kontak.show'));



// Post routes
Route::get('{provinsi}/program', array('uses' => 'Front\Provinsi\PostController@getProgram','as' => 'front.provinsi.program.list'));
Route::get('{provinsi}/berita', array('uses' => 'Front\Provinsi\PostController@getBerita','as' => 'front.provinsi.berita.list'));
Route::get('{provinsi}/informasi', array('uses' => 'Front\Provinsi\PostController@getInformasi','as' => 'front.provinsi.info.list'));

// Post routes
Route::get('{provinsi}/post/{slug}', array('uses' => 'Front\Provinsi\PostController@show','as' => 'front.provinsi.post.show'));

// Link routes
Route::get('{provinsi}/link/imb', array('uses' => 'Front\Provinsi\LinkController@getImb', 'as' => 'front.provinsi.link.imb'));
Route::get('{provinsi}/link/pbb', array('uses' => 'Front\Provinsi\LinkController@getPbb', 'as' => 'front.provinsi.link.pbb'));
Route::get('{provinsi}/link/tata-ruang', array('uses' => 'Front\Provinsi\LinkController@getTataRuang', 'as' => 'front.provinsi.link.tataruang'));
Route::get('{provinsi}/link/bpn', array('uses' => 'Front\Provinsi\LinkController@getBpn', 'as' => 'front.provinsi.link.bpn'));
Route::get('{provinsi}/link/data', array('uses' => 'Front\Provinsi\LinkController@data', 'as' => 'front.provinsi.link.data'));

// File routes
Route::get('{provinsi}/file', array('uses' => 'Front\Provinsi\FileController@getAll', 'as' => 'front.provinsi.file'));
Route::get('{provinsi}/file/kebijakan', array('uses' => 'Front\Provinsi\FileController@getKebijakan', 'as' => 'front.provinsi.file.kebijakan'));
Route::get('{provinsi}/file/penelitian', array('uses' => 'Front\Provinsi\FileController@getPenelitian', 'as' => 'front.provinsi.file.penelitian'));
Route::get('{provinsi}/file/informasi', array('uses' => 'Front\Provinsi\FileController@getInformasi', 'as' => 'front.provinsi.file.informasi'));
Route::get('{provinsi}/file/shm', array('uses' => 'Front\Provinsi\FileController@getStandarHargaMaterial', 'as' => 'front.provinsi.file.shm'));
Route::get('{provinsi}/file/data', array('uses' => 'Front\Provinsi\FileController@data', 'as' => 'front.provinsi.file.data'));

