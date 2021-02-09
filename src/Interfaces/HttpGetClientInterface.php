<?php

namespace Scraper\Interfaces;

interface HttpGetClientInterface {

    public function get(String $url): String;

}