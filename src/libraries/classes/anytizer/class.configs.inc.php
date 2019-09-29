<?php

namespace anytizer;

/**
 * Determines which modules to generate source code for.
 */
class configs
{
    public $templates = !false;
    public $dto = !false;
    public $orm = !false;

    /**
     * https://softwareengineering.stackexchange.com/questions/234251/what-really-is-the-business-logic/234254
     * @var bool
     */
    public $business = !false;
    public $phpunit = !false;
    public $endpoints = !false;
    public $angularjs = !false;
    public $html = !false;

    // future research

    /**
     * https://taniarascia.github.io/react-hooks/
     * https://www.taniarascia.com/crud-app-in-react-with-hooks/
     * https://github.com/taniarascia/react-hooks
     *
     * @var bool
     */
    public $react = false;

    /**
     * https://angular.io/start
     * @var bool
     */
    public $angular = false;
    // api
    // apiunit
    // cs
    // laravel model
}
