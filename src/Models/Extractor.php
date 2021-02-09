<?php

namespace Scraper\Models;

class Extractor
{

    protected $html;

    /**
     * __construct
     *
     * @param  mixed $html
     * @return void
     */
    public function __construct(String $html)
    {
        $this->html = $html;
    }

    /**
     * getByElement
     *
     * @param  mixed $element
     * @return String
     */
    public function getByElement(String $element): ?String
    {
        $startPosition = stripos($this->html, "<$element");
        $endPosition = stripos($this->html, "</$element", $startPosition);
        $length = $endPosition - $startPosition;

        $value = strip_tags(substr($this->html, $startPosition, $length)) ?: null;

        return $value;
    }

    /**
     * getByElements
     *
     * @param  mixed $elements
     * @return void
     */
    public function getByElements(array $elements = ['h1', 'h2', 'h3', 'h4', 'title', 'p'])
    {
        $data = [];

        foreach ($elements as $e) {
            $elementData = $this->getByElement($e);
            if ($elementData) {
                $data[$e] = $elementData;
            }
        }

        return $data;
    }
}
