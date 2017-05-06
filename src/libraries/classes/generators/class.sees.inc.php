<?php
namespace generators;

/**
 * purpose: auto html template generation with the url links pre-defined
 */
class sees
{
        public $logo;
        public $pages = array();

        public function logo(string $logo)
        {
                $this->logo = $logo;
        }

        public function page(string $page, string $title, array $links)
        {
                /**
                 * Just to make the compiler happy on the first run
                 */
                if(!isset($this->pages[$page]))
                {
                        $this->pages[$page] = array();
                }

                #$this->pages[$page] = array_merge($this->pages[$page], array_values($links));
                $this->pages[$page] = $links;
        }

        public function index()
        {
                $this->index = array();
                foreach($this->pages as $index => $page)
                {
                        $this->index[] = $index;
                }
        }

        public function get(string $index): array
        {
                $menus = $this->pages[$index];
                $menus = array_map(array($this, "_link"), $menus);
                return $menus;
        }

        private function _link(anchor $object)
        {
            $html = $object->html();
            return $html;
        }
        
        private function li(string $link)
        {
            $html = "<li>{$link}</li>";
            return $html;
        }

        private function _html()
        {
                $dashboard = array_map(array($this, "_link"), $this->pages);
                #return implode("\r\n", $dashboard);
                return "<ul>" . implode("\r\n", array_map("li", $dashboard)) . "</ul>";
        }

        public function __tostring(): string
        {
                # convert to html
                $html = $this->_html();
                return "###";
        }
}