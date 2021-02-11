<?php

namespace Scraper\Models;

use DOMDocument;
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
        $this->html = new DOMDocument();
        @ $this->html->loadHTML($html);
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
     * getContentByHtmlElements
     *
     * @param  mixed $elements
     * @return void
     */
    public function getContentByHtmlElements()
    {
        $data = [];

        foreach ($this->elements as $element) {
            $elementData = $this->html->getElementsByTagName($element);
            if (count($elementData) > 0) {
                $data[$element] = [];
                foreach ($elementData as $value) {
                    $data[$element][] = $value->textContent;
                }
            }
        }

        return $data;
    }
}
