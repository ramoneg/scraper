<?php

namespace Scraper\Interfaces;

interface HtmlElementExtractorInterface
{
    public function setHtml(String $html);

    public function getByElement(String $element): ?String;

    public function getByElements(array $elements);
}
