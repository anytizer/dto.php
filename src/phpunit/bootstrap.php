<?php
declare(strict_types=1);

//namespace tests;

require_once("../libraries/inc.config.php");

/**
 * Auto include class files
 */
#use anytizer\includer;
#spl_autoload_register(array(new includer(__LIBRARIES_DIR__."/classes"), "namespaced_inc_dot"));
