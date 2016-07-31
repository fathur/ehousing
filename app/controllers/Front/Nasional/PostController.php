<?php
/**
 * Project: ehousing-3.0
 * Date: 6/13/16
 * Time: 17:26
 */

namespace Front\Nasional;

use Repositories\DataProvider\Provinsi as ProvinsiDataProvider;

class PostController extends \BaseController
{
    public function show($slug)
    {
        $post = \Post::slug($slug)->first();

        if($post)
            return \View::make('front.post.show', compact('post'));

        \App::abort(404);
    }

    public function getProgram()
    {
        $data = new ProvinsiDataProvider();
        $posts = $data->setLimit(12)->getPrograms();

        return \View::make('front.post.grid', compact('posts'))
            ->with('postTitle', 'Program dan Kegiatan')
            ->with('type','nasional');
    }


    public function getBerita()
    {
        $data = new ProvinsiDataProvider();
        $posts = $data->setLimit(12)->getNews();

        return \View::make('front.post.grid', compact('posts','provinsi'))
            ->with('postTitle', 'Berita')
            ->with('type','nasional');
    }
}