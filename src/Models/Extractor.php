<?php

namespace Scraper\Models;

use Scraper\Interfaces\HtmlElementExtractorInterface;

class Extractor implements HtmlElementExtractorInterface
{

    protected $html;
    protected $elements;
    protected $classes;
    protected $metaTags;

    /**
     * setHtml
     *
     * @param  mixed $html
     * @return void
     */
    public function setHtml(String $html)
    {
        $this->html = $html;
    }

    /**
     * setElements
     *
     * @param  mixed $html
     * @return void
     */
    public function setElements(array $elements)
    {
        $this->elements = $elements;
    }

    /**
     * getContentByHtmlElement
     *
     * @param  mixed $element
     * @return String
     */
    public function getContentByHtmlElement(String $element): ?String
    {
        $startPosition = stripos($this->html, "<$element");
        $endPosition = stripos($this->html, "</$element", $startPosition);
        $length = $endPosition - $startPosition;

        $value = strip_tags(substr($this->html, $startPosition, $length)) ?: null;

        return $value;
    }

    /**
     * getContentByHtmlElements
     *
     * @param  mixed $elements
     * @return void
     */
    public function getContentByHtmlElements()
    {
        $data = [];

        foreach ($this->elements as $e) {
            $elementData = $this->getContentByHtmlElement($e);
            if ($elementData) {
                $data[$e] = $elementData;
            }
        }

        return $data;
    }
}
