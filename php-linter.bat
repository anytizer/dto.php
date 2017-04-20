@ECHO OFF

REM Create the list of PHP Files
dir /s/a/b *.php > lint-checker.bat

REM Build PHP Lint checker script
php -f php-linter.php

REM Execute the lint checker
CALL lint-checker.bat > lint-checker.log

REM Remove the temp file
php -r "unlink('lint-checker.bat');"
