<?php

namespace Scraper\Models;

use SimpleXMLElement;

class Scraper
{

    protected $sitemap;
    protected $urls = [];

    /**
     * __construct
     *
     * @param  mixed $sitemapUrl
     * @return void
     */
    public function __construct(String $sitemapUrl)
    {
        $this->sitemap = new SimpleXMLElement($sitemapUrl, null, true);
        $this->getXmlUrls($this->sitemap);
    }

    public function fetch()
    {
        $data = [];

        foreach ($this->urls as $url) {
            $data[(string) $url] = $this->fetchHtmlByUrl($url);
        }

        return $data;
    }

    /**
     * getXmlUrls
     *
     * @param  mixed $xml
     * @return void
     */
    public function getXmlUrls(SimpleXMLElement $xml)
    {
        foreach ($xml->children() as $e) {
            if ($e->getName() == 'url') {
                $this->urls[] = $e->loc;
            } else {
                $this->getXmlUrls(new SimpleXMLElement($e->children(), null, true));
            }
        }
    }

    /**
     * fetchHtmlByUrl
     *
     * @param  mixed $url
     * @return void
     */
    public function fetchHtmlByUrl(String $url)
    {
        $html = Client::get($url);
        $extractor = new Extractor($html);

        return $extractor->getByElements();
    }
}
