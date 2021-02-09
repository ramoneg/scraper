<?php

namespace Scraper\Models;

class Client {
        
    /**
     * get
     *
     * @param  mixed $url
     * @return void
     */
    static function get(String $url): String
    {
        return file_get_contents($url);
    }
}