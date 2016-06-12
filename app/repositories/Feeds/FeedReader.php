<?php
/**
 * Project: ehousing-3.0
 * Date: 6/12/16
 * Time: 05:48
 */

namespace Repositories\Feeds;


class FeedReader
{
    protected $listFeed = array();

    public function setUrl(array $uri)
    {
        foreach ($uri as $item) {
            array_push($this->listFeed, $item);

        }
    }

    public function generate()
    {
        $feed = new \SimplePie();
        $feed->set_feed_url($this->listFeed);
        $feed->enable_cache(true);
        $feed->set_cache_location(storage_path().'/cache');
        $feed->set_cache_duration(60*60*12);
        $feed->set_output_encoding('utf-8');
        //$feed->enable_order_by_date();
        $feed->init();
        // $feed->handle_content_type();

        return $feed;
    }

    /**
     * http://stackoverflow.com/questions/1363925/check-whether-image-exists-on-remote-url
     *
     * @param $url
     * @return bool
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public static function fileUrlExist($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // don't download content
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if(curl_exec($ch)!==FALSE)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}