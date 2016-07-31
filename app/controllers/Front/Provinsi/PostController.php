<?php
/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 15:56
 */

namespace Front\Provinsi;


use Repositories\DataProvider\Provinsi as ProvinsiDataProvider;

class PostController extends \BaseController
{
    public function show($provinsiSlug, $postSlug)
    {
        $post = \Post::slug($postSlug)->first();

        if($post)
            return \View::make('front.post.show', compact('post'));

        \App::abort(404);
    }

    public function getProgram($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);

        $data = new ProvinsiDataProvider($provinsi->id);
        $posts = $data->setLimit(12)->getPrograms();

        return \View::make('front.post.grid', compact('posts','provinsi'))
            ->with('postTitle', 'Program dan Kegiatan');
    }


    public function getBerita($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);

        $data = new ProvinsiDataProvider($provinsi->id);
        $posts = $data->setLimit(12)->getNews();

        return \View::make('front.post.grid', compact('posts','provinsi'))
            ->with('postTitle', 'Berita dan Aktifitas');
    }

    public function getInformasi($provinsiSlug)
    {
        $provinsi = \Provinsi::slug($provinsiSlug)->first();

        if(is_null($provinsi))
            \App::abort(404);

        $data = new ProvinsiDataProvider($provinsi->id);
        $posts = $data->setLimit(12)->getInformasi();

        return \View::make('front.post.grid', compact('posts','provinsi'))
            ->with('postTitle', 'Teknologi Rancang Bangun');
    }
}