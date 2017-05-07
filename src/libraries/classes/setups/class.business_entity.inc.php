<?php
namespace setups;
use generators\namifier;
use generators\caser;
use backend\guid;

class business_entity
{
    /**
     * @var string
     */
    private $package;

    /**
     * @var string
     */
    private $class_name;

    /**
     * @var method_descriptor[]
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
    private $features_to_test = array();

    public function __construct()
    {
        $this->package = "";
        $this->table_name = "";
        $this->class_name = "";
        $this->methods = array();
    }

    /**
     * Setup interactions - chain-able methods returning itself
     * Eases business entities setup
     */

    /**
     * @todo The added business has to be unique
     *
     * @param string $package_name
     * @param string $class_name
     * @param string $table_name
     * @return business_entity
     */
    public function business(string $package_name, string $class_name, string $table_name): business_entity
    {
        $namifier = new namifier();

        $this->package = $namifier->package_name($package_name);
        $this->class_name = $namifier->class_name($class_name);

        /**
         * Check validity for table existing
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
        $sql="INSERT IGNORE INTO acl_objects VALUES ('{$guid}', '{$this->package}');\r\n";
        file_put_contents("d:/acl.log", $sql, FILE_APPEND);
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

        # Pre-register ACL into the database at the time of creation
        foreach($methods as $method)
        {
            $sql="INSERT IGNORE INTO acl_objects_methods VALUES (UUID(), '', '{$method}');\r\n";
            file_put_contents("d:/acl.log", $sql, FILE_APPEND);
        }

        return $this;
    }

    /**
     * @todo Additional tests not covered in function calls
     * These features are NOT available for programming API calls but only for test purpose
     *
     * @param string $feature
     * @return $this
     */
    public function feature(string $feature)
    {
        /**
         * Do NOT accept blank names
         */
        if($feature)
        {
            $this->features_to_test[] = $feature;
        }

        return $this;
    }

    /**
     * Dependency management
     * @todo Import feature
     *
     * @param $package_name
     * @return business_entity
     */
    public function import(string $package_name): business_entity
    {
        // setup with other modules
        return $this;
    }

    /**
     * Public interactions
     */

    /**
     * @return string
     */
    public function table_name(): string
    {
        return $this->table_name;
    }

    /**
     * Also used in producing file names
     * Class name as appears inside php scripts
     * @return mixed
     */
    public function dto_name(): string
    {
        $namifier = new namifier();
        $dto_name = $namifier->dto_name($this->class_name);
        return $dto_name;
    }

    /**
     * Also used in producing file names
     * Class name as appears inside php scripts
     * @return mixed
     */
    public function class_name(): string
    {
        return $this->class_name;
    }

    public function package_name(): string
    {
        $caser = new caser();
        $package = $caser->psr4($this->package);

        return $package;
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