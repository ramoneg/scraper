<?php

namespace Scraper\Models;

use DOMXPath;
use DOMDocument;
use Scraper\Interfaces\HtmlElementExtractorInterface;

class Extractor implements HtmlElementExtractorInterface
{

    protected $html;
    protected $elements;
    protected $classes;
    protected $metaTags;
    protected $insideClass;
    protected $insideClassHtml;

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

        if ($this->insideClass) {

            $insideClassHtml = null;
            $finder = new DOMXPath($this->html);

            $elements = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $this->insideClass ')]");
            $insideClassDom = new DOMDocument();

            foreach ($elements as $element) {
                $insideClassDom->appendChild($insideClassDom->importNode($element, true));
            }
            $insideClassHtml .= trim($insideClassDom->saveHTML());

            $this->insideClassHtml = new DOMDocument();
            @$this->insideClassHtml->loadHTML($insideClassHtml);

        }
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
     * setMetaTags
     *
     * @param  mixed $metaTags
     * @return void
     */
    public function setInsideClass(?string $insideClass)
    {
        $this->insideClass = $insideClass;
    }

    
    /**
     * getHtml
     *
     * @return void
     */
    public function getHtml(): Object
    {
        return $this->insideClass ? $this->insideClassHtml : $this->html;
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
            $elementData = $this->getHtml()->getElementsByTagName($element);
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
