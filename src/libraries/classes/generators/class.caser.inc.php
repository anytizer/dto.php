<?php

namespace generators;

/**
 * Allows to use a kind of standard naming convention for method names
 *
 * Class caser - Snake Case or PS4 Camel Case
 *
 * @package generators
 */
class caser {

    /**
     * All lower case, joined with underscore
     *
     * eg. zend_mail()
     * @example a_quick_brown_fox
     *
     * @param string $descriptive_name
     * @return string
     */
    public function snake_case(string $descriptive_name): string {
        $name = strtolower($descriptive_name);
        $name = preg_replace("/[^a-z0-9]+/is", "_", $name);

        return $name;
    }
    

    /**
     * All capitals, joined together
     *
     * @example ZendMail()
     * @example AQuickBrownFox
     *
     * @param string $descriptive_name
     * @return string
     */
    public function psr4(string $descriptive_name): string {
        $name = strtolower($descriptive_name);

        $names = preg_split("/[^a-z0-9]+/is", $name);
        $names = array_map("ucfirst", $names);

        $name_output = implode("", $names);
        return $name_output;
    }

    /**
     * @example A_Quick_Brown_Fox
     * @todo psr0
     * @todo Underscore separated, eg. Zend_Mail()
     *
     * @param string $descriptive_name
     * @return string
     * @throws \Exception
     */
    public function psr0(string $descriptive_name): string {
        $name = $this->wordify($descriptive_name); // works
        $words = explode(" ", $name); // works

        $name_output = implode("_", $words);
        return $name_output;
    }

    /**
     * @example A Quick Brown Fox
     *
     * @param string $title
     * @return string
     */
    public function wordify($title = "") {
        #$title = strtolower($title);

        $words = preg_split("/[^a-z0-9]+/is", $title);
        $words = array_map("trim", $words);
        $words = array_map("ucfirst", $words);
        $words = array_filter($words);

        $name_output = implode(" ", $words);
        return $name_output;
    }

    /**
     * Converts a word into a property name for PHP Class
     * @todo Remove the usage and replace with one of the method earlier.
     *
     * @param string $name
     * @param bool $remove_prefix
     * @param bool $ucfirst
     * @param string $glue
     * @return string
     */
    public function namify(string $name, bool $remove_prefix, bool $ucfirst, string $glue): string {
        $words = preg_split("/[\\s|\\_]/is", strtolower($name));
        if (count($words) >= 2) {
            if ($remove_prefix === true) {
                unset($words[0]);
            }

            if ($ucfirst === true) {
                $words = array_map("ucfirst", $words); // UpperCasedName
            }
        }

        $name_output = implode($glue, $words);
        return $name_output;
    }

}
