<?php
namespace generators;

/**
 * Allows to use a kind of standard naming convention for method names
 *
 * Class caser - Snake Case or PS4 Camel Case
 *
 * @package generators
 */
class caser
{
    /**
     * eg. zend_mail()
     *
     * @param string $descriptive_name
     * @return string
     */
    public function snake_case(string $descriptive_name): string
    {
        $name = strtolower($descriptive_name);
        $name = preg_replace("/[^a-z0-9]+/is", "_", $name);

        return $name;
    }

    /**
     * eg ZendMail()
     *
     * @param string $descriptive_name
     * @return string
     */
    public function psr4(string $descriptive_name): string
    {
        $name = strtolower($descriptive_name);

        $names = preg_split("/[^a-z0-9]+/is", $name);
        $names = array_map("ucfirst", $names);

        $name = implode("", $names);
        return $name;
    }

    /**
     * @todo psr0
     * @todo Underscore separated, eg. Zend_Mail()
     *
     * @param string $descriptive_name
     * @return string
     * @throws \Exception
     */
    public function psr0(string $descriptive_name): string
    {
        throw new \Exception("Not implemented");
    }

    public function wordify($title="")
    {
        $words = preg_split("/[^a-z0-9]/is", $title);
        $words = array_map("trim", $words);
        $words = array_map("ucfirst", $words);

        return implode(" ", $words);
    }
}