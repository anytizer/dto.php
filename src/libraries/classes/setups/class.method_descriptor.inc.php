<?php
namespace setups;

class method_descriptor
{
    /**
     * @var string Function name
     */
    public $method_name;

    /**
     * @var string Description or Title
     */
    public $description;

    /**
     * @var array
     */
    public $parameters;

    /**
     * @var string Accessor
     */
    public $accessor;

    /**
     * @var string Return Type
     */
    public $return_type;

    /**
     * @var string Raw Name - Original method definition
     */
    public $raw_name;
}