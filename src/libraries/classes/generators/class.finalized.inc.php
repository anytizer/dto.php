<?php
namespace generators;

/**
 * Class finalized
 * Purpose: Do NOT allow to read or write properties other than those defined explicitly.
 *
 * @package generators
 */
class finalized
{
    public function __construct()
    {
    }

    public function __get(string $name="")
    {
        return null;
    }

    public function __set(string $name="", $value="")
    {
        // TODO: Implement __set() method. Raise exceptions.
    }

    public function __call($name, $arguments=[])
    {
        // TODO: Implement __call() method. Raise exceptions.
    }
}