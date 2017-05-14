<?php
declare(strict_types=1);

namespace tests;

define("__DTO_LIBRARY_ROOT__", realpath(dirname(__FILE__)."/..")); // self dir
#echo __DTO_LIBRARY_ROOT__; echo "\r\n"; die();
require_once(__DTO_LIBRARY_ROOT__."/libraries/backend/class.spl_include.inc.php");

use backend\spl_include;
use common\validation_rules;

spl_autoload_register(array(new spl_include(__DTO_LIBRARY_ROOT__."/libraries"), "namespaced_inc_dot"));
//spl_autoload_register(array(new spl_include("D:/htdocs/angular/libraries/dto.php/output"), "namespaced_inc_dot"));
