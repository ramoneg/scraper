<?php

namespace Scraper\Models;

use Scraper\Interfaces\HttpGetClientInterface;

class SimpleHttpClient implements HttpGetClientInterface
{
    
    /**
     * get
     *
     * @param  mixed $url
     * @return String
     */
    public function get(String $url): String
    {
        return file_get_contents($url);
    }
}
