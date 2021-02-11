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
        @$this->html->loadHTML($html);
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
     * setMetaTags
     *
     * @param  mixed $metaTags
     * @return void
     */
    public function setMetaTags(array $metaTags)
    {
        $this->metaTags = $metaTags;
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

    /**
     * getContentByMetaTags
     *
     * @return void
     */
    public function getContentByMetaTags()
    {
        $pageMetaTags = $this->html->getElementsByTagName('meta');

        $data = [];

        foreach ($this->metaTags as $userInputMetaTag) {
            foreach ($pageMetaTags as $pageMetaTag) {
                if ($pageMetaTag->getAttribute('name') == $userInputMetaTag) {
                    $data[$userInputMetaTag] = $pageMetaTag->getAttribute('content');
                }
            }
        }

        return $data;
    }

    
    /**
     * getPageTitle
     *
     * @return void
     */
    public function getPageTitle()
    {
        $data = $this->html->getElementsByTagName('title');
        if (count($data) > 0) {
            $data = $data[0]->textContent;
        } else {
            $data = '-';
        }

        return $data;
    }
}
