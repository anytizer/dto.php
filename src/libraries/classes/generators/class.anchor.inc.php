<?php
namespace generators;

class anchor
{
    public $href;
    public $text;
    public $angular;

    /**
     * anchor constructor.
     * @param string $href
     * @param string $angular
     * @param string $text
     */
    public function __construct(string $href, string $angular, string $text)
    {
        $this->href = $href;
        $this->angular = $angular;
        $this->text = $text;
    }

    /**
     * From sees.html
     * @return string
     */
    public function html()
    {
        $html = "<a class=\"w3-btn w3-black\" href=\"{$this->href}\" ng-click=\"{$this->angular}\">{$this->text}</a>";
        return $html;
    }
}
