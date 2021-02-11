<?php

namespace Scraper\Interfaces;

interface HtmlElementExtractorInterface
{

    public function setHtml(String $html);
    public function setElements(array $elements);
    public function setInsideClass(String $insideClass);

    public function getContentByHtmlElements();
    public function getContentByMetaTags();
    public function getPageTitle();

}
