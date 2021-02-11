<?php

namespace Scraper\Interfaces;

interface HtmlElementExtractorInterface
{

    public function setHtml(String $html);

    public function getContentByHtmlElements();
    public function getContentByMetaTags();
    public function getPageTitle();

    public function setElements(array $elements);
}
