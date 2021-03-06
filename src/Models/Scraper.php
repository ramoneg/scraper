<?php

namespace Scraper\Models;

use Scraper\Interfaces\HtmlElementExtractorInterface;
use Scraper\Interfaces\HttpGetClientInterface;
use Scraper\Services\Client;
use SimpleXMLElement;

class Scraper
{

    protected $sitemap;
    protected HtmlElementExtractorInterface $extractor;
    protected $urls = [];
    protected HttpGetClientInterface $client;

    /**
     * __construct
     *
     * @param  mixed $sitemapUrl
     * @return void
     */
    public function __construct(String $sitemapUrl, HttpGetClientInterface $client = null, HtmlElementExtractorInterface $extractor = null)
    {
        $this->sitemap = new SimpleXMLElement($sitemapUrl, null, true);
        $this->getXmlUrls($this->sitemap);
        $this->client = $client ?: new Client();
        $this->extractor = $extractor ?: new Extractor();
    }

    /**
     * exclude
     *
     * @param  mixed $excludes
     * @return void
     */
    public function exclude(array $excludes): void
    {
        
        if (count($excludes) > 0) {
            foreach ($excludes as $exclude) {
                $this->urls = preg_grep("/" . str_replace('/', '\/', $exclude) . "/i", $this->urls, PREG_GREP_INVERT);
            }
        }
    }

    /**
     * fetch
     *
     * @return void
     */
    public function fetch()
    {
        $data = [];

        foreach ($this->urls as $url) {
            $data[(string) $url] = $this->scrapeHtmlByUrl($url);
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
     * scrapeHtmlByUrl
     *
     * @param  mixed $url
     * @return void
     */
    public function scrapeHtmlByUrl(String $url)
    {
        $html = $this->client->get($url);
        $this->extractor->setHtml($html);

        $data = [];
        $data['title'] = $this->extractor->getPageTitle();
        $data['elements'] = $this->extractor->getContentByHtmlElements();
        $data['metaTags'] = $this->extractor->getContentByMetaTags();

        return $data;
    }
}
