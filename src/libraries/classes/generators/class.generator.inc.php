<?php

namespace generators;

use anytizer\caser;
use anytizer\method_descriptor;

abstract class generator
{
    protected $caser;

    public function __construct()
    {
        $this->caser = new caser();
    }

    protected abstract function methodify(method_descriptor $method): string;

    /**
     * Identifies if a method name is private
     *   - has __ prefix (double underscores)
     *   - has : prefix (colon)
     * @param $method
     * @return bool
     */
    protected function is_private($method)
    {
        return preg_match("/^[_]{2}/is", $method) || preg_match("/^\\:/is", $method);
    }
}
