<?php
namespace setups;
use generators\namifier;

use generators\bodyfier;

class business_entity
{
    private $module;
    private $table_name;
    private $class_name;

    /**
     * @var method_descriptor[]
     */
    private $methods;

    /**
     * @var array User roles permitted
     */
    private $users;

    public function __construct()
    {
    }

    /**
     * Setup interactions - chain-able methods returning itself
     * Eases business entities setup
     */

    /**
     * @todo The added business has to be unique
     *
     * @param string $module_name
     * @param string $table_name
     * @return business_entity
     */
    public function business(string $module_name, string $table_name): business_entity
    {
        $namifier = new namifier();

        $this->table_name = $table_name;
        $this->module = $namifier->module_name($module_name);
        $this->class_name = $namifier->class_name($module_name);

        return $this;
    }

    /**
     * @param roles $role
     * @return business_entity
     */
    public function user(roles $role): business_entity
    {
        $this->users[] = $role;

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

        return $this;
    }

    /**
     * @todo Import feature
     */
    /**
     * @param $module
     * @return business_entity
     */
    public function import($module): business_entity
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
    public function class_name(): string
    {
        return $this->class_name;
    }

    /**
     * @return method_descriptor[]
     */
    public function methods_list(): array
    {
        return $this->methods;
    }
}