<?php

use Scraper\Models\Extractor;
use Scraper\Models\SimpleHttpClient;
use Scraper\Models\Scraper;

require "vendor/autoload.php";

$sitemapUrl = $argv[1] ?? exit;

$scraper = new Scraper($sitemapUrl, new SimpleHttpClient(), new Extractor());

$json = json_encode($scraper->fetch(), JSON_UNESCAPED_UNICODE);

if (file_put_contents("exports/" . date("Y-m-d h:i") . ".json", $json)) {
    echo "JSON file created successfully.";
}
