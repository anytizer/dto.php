<?php

namespace anytizer;

use anytizer\caser;
use anytizer\guid;
use anytizer\namifier;

/**
 * Class business_entity
 * @package anytizer
 */
class business_entity
{

    /**
     * @var bool If write a definition?
     */
    private $enabled;

    /**
     * @var string
     */
    private $package;

    /**
     * @var string
     */
    private $class_name;

    /**
     * @var string Business Name
     */
    private $business_name;

    /**
     * @var array method_descriptor[]
     */
    private $methods;

    /**
     * @var string
     */
    private $table_name;

    /**
     * @var array User roles permitted
     */
    private $users;

    /**
     * @var array User defined tests
     */
    private $features_to_test = [];

    /**
     * @var $package_id guid
     */
    private $package_id;

    /**
     * business_entity constructor.
     * @param bool $enabled
     */
    public function __construct($enabled = false)
    {
        $this->enabled = $enabled === true;

        $this->package = "";
        $this->table_name = "";
        $this->class_name = "";
        $this->methods = [];
    }

    /**
     * If we can produce the code for these business definitions
     * @return bool
     */
    public function enabled(): bool
    {
        return $this->enabled;
    }

    /**
     * Setup interactions - chain-able methods returning itself
     * Eases business entities setup
     */

    /**
     * @param string $package_name
     * @param string $class_name
     * @param string $table_name
     * @return business_entity
     * @todo The added business has to be unique
     *
     */
    public function business(string $package_name, string $class_name, string $table_name): business_entity
    {
        $namifier = new namifier();

        $this->package = $namifier->package_name($package_name);
        $this->class_name = $namifier->class_name($class_name);
        $this->business_name = $namifier->business_name($class_name);

        /**
         * @todo Check validity for table if existing
         */
        $this->table_name = $table_name;

        return $this;
    }

    /**
     * @param roles $role
     * @return business_entity
     */
    public function user(roles $role): business_entity
    {
        $this->users[] = $role;

        # Register this
        $guid = guid::NewGuid();
        $this->package_id = $guid; // @todo non-standard field
        $sql = "INSERT IGNORE INTO acl_packages VALUES ('{$guid}', '{$this->package}');\r\n";
        file_put_contents("/tmp/acl.log", $sql, FILE_APPEND);
        # SELECT UUID();

        return $this;
    }

    /**
     * @param array $methods
     * @return business_entity
     */
    public function methods(array $methods): business_entity
    {
        $namifier = new namifier();
        $this->methods = array_map(array($namifier, "method"), $methods);
        #print_r($this->methods); die();

        $g = new guid();
        $entity_guid = $g->NewGuid();

        /**
         * @todo Bring from live database or user defined configs
         */
        // SELECT * FROM pp_roles WHERE role_code='SUPERADMIN';
        $superadmin_role_code = "SUPERADMIN";
        $superadmin_role_id = "0BC7C10D-EBDF-4D77-9642-A3C8AB0B01E3";

        $acl_entities_sql = "INSERT IGNORE INTO acl_entities VALUES ('{$entity_guid}', '{$this->package_id}', '{$this->class_name}', '{$this->package}::{$this->class_name}');\r\n";
        //file_put_contents("/tmp/acl.log", $acl_entities_sql, FILE_APPEND);
        $acl_methods_sqls=[];
        $acl_permissions_sqls = [];
        # Pre-register ACL into the database at the time of creation
        foreach ($this->methods as $method) {
            #print_r($method); die();
            $method_guid = $g->NewGuid();
            $acl_methods_sql = "INSERT IGNORE INTO acl_methods VALUES ('{$method_guid}', '{$entity_guid}', '{$method->method_name}', '{$this->package}::{$this->class_name}:{$method->method_name}()');";
            $acl_methods_sqls[]=$acl_methods_sql;

            $permission_id = $g->NewGuid();
            $acl_permissions_sqls[] = "INSERT INTO acl_permissions VALUES('{$permission_id}', '{$superadmin_role_id}', '{$method_guid}', '[{$superadmin_role_code}]{$this->package}::{$this->class_name}->{$method->method_name}()');";
        }

        file_put_contents("/tmp/acl.log",  $acl_entities_sql, FILE_APPEND);
        file_put_contents("/tmp/acl.log", implode("\r\n", $acl_methods_sqls), FILE_APPEND);
        file_put_contents("/tmp/acl.log", implode("\r\n", $acl_permissions_sqls), FILE_APPEND);



        return $this;
    }

    /**
     * @param string $feature
     * @return $this
     * @todo Additional tests not covered in function calls
     * These features are NOT available for programming API calls but only for test purpose
     *
     */
    public function feature(string $feature)
    {
        /**
         * Do NOT accept blank names
         */
        if ($feature) {
            $this->features_to_test[] = $feature;
        }

        return $this;
    }

    /**
     * Dependency management
     * @param $package_name
     * @return business_entity
     * @todo Import feature
     *
     */
    public function import(string $package_name): business_entity
    {
        // setup with other modules
        return $this;
    }

    /**
     * Public interactions
     */
    public function package_name(): string
    {
        $caser = new caser();
        $package = $caser->psr4($this->package);

        return strtolower($package);
    }

    /**
     * @return string
     */
    public function table_name(): string
    {
        return $this->table_name;
    }

    /**
     * Also used in producing file names
     * Class name as appears inside PHP scripts
     * @return mixed
     */
    public function dto_name(): string
    {
        $namifier = new namifier();
        $dto_name = $namifier->dto_name($this->class_name);

        return strtolower($dto_name);
    }

    /**
     * Also used in producing file names
     * Class name as appears inside PHP scripts
     * @return mixed
     */
    public function model_name(): string
    {
        $namifier = new namifier();
        $model_name = $namifier->model_name($this->class_name);

        return strtolower($model_name);
    }

    /**
     * Also used in producing file names
     * Class name as appears inside PHP scripts
     * @return mixed
     */
    public function dto_name_cs(): string
    {
        $namifier = new namifier();
        $dto_name_cs = $namifier->dto_name_cs($this->class_name);

        return strtolower($dto_name_cs);
    }

    /**
     * Also used in producing file names
     * Class name as appears inside PHP scripts
     * @return mixed
     */
    public function business_name(): string
    {
        $business_name = $this->class_name();
        $business_name .= "_Business";

        return strtolower($business_name);
    }

    /**
     * Also used in producing file names
     * Class name as appears inside PHP scripts
     * @return mixed
     */
    public function class_name(): string
    {
        return $this->class_name;
    }

    public function orm_name(): string
    {
        $name = $this->class_name();
        $name .= "_ORM";

        return strtolower($name);
    }

    /**
     * @return method_descriptor[]
     */
    public function methods_list(): array
    {
        return $this->methods;
    }

    /**
     * Use defined features to test
     * Additional features described in one line each
     * @return array
     */
    public function features_list(): array
    {
        return $this->features_to_test;
    }

}
