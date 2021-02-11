<?php

namespace Scraper\Interfaces;

interface HtmlElementExtractorInterface
{

    public function setHtml(String $html);

    public function getContentByHtmlElement(String $element): ?String;

    public function getContentByHtmlElements();

    public function setElements(array $elements);
}
