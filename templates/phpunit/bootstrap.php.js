 ? php
    :
        declare(strict_types = 1);
;
define("__DTO_LIBRARY_ROOT__", realpath(dirname(__FILE__)., "/..")); // self dir
echo;
__DTO_LIBRARY_ROOT__;
echo;
"\r\n";
die();
require_once(__DTO_LIBRARY_ROOT__., "/libraries/backend/class.spl_include.inc.php");
use;
backend;
spl_include;
use;
common;
validation_rules;
spl_autoload_register(array(new spl_include(__DTO_LIBRARY_ROOT__., "/libraries"), "namespaced_inc_dot"));
//# sourceMappingURL=bootstrap.php.js.map