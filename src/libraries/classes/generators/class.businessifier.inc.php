<?php
namespace generators;
use setups\method_descriptor;

class businessifier implements  bodyfier
{
    public function generate(): string
    {
        return "";
    }

    /**
     * Business entities
     *
     * @param method_descriptor $method
     * @return string
     */
    public function businessify(method_descriptor $method): string
    {
        $description = $method->description;
        $method_name = $method->method_name;
        $parameters = $method->parameters;

        /**
         * @todo Load ORM fields dynamically
         */
        $method_body = "
    /**
     * {$description}
     */
    public function {$method_name}({$parameters}): bool
    {
        \$#__ORM_NAME__ = new #__ORM_NAME__();
        
        #\$#__ORM_NAME__->name = \$parameters->name;
        #\$#__ORM_NAME__->value = \$parameters->value;
        #\$#__ORM_NAME__->others = \$parameters->others;
        
        \$success = \$#__ORM_NAME__->save();
        return \$success;
    }
";
        return $method_body;
    }
}