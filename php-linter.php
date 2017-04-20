<?php
/**
 * Checks for PHP Syntaxes for all *.php files
 */
$log_sh_file = "lint-checker.bat";

$lines = file_get_contents($log_sh_file);
$replace = preg_quote(dirname(__FILE__).DIRECTORY_SEPARATOR);

$lines = preg_replace('/'.$replace.'/is', "php -l ", $lines);
file_put_contents($log_sh_file, $lines);
