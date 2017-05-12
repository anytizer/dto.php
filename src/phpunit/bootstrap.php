<?php
declare(strict_types=1);

namespace tests;

require_once("../libraries/inc.config.php");

use backend\spl_include;

spl_autoload_register(array(new spl_include(__LIBRARIES_DIR__."/classes"), "namespaced_inc_dot"));
