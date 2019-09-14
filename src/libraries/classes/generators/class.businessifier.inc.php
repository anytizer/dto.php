<?php

namespace generators;

use setups\method_descriptor;

class businessifier implements bodyfier
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
        $accessor = $method->accessor;
        $return_type = $method->return_type;

        /**
         * @todo Load all ORM fields dynamically
         */
        $method_body = "
    /**
     * {$description}
     * @return {$return_type}
     */
    {$accessor} function {$method_name}({$parameters}): {$return_type}
    {
        #\$this->#__ORM_NAME__->name = \$parameters->name;
        #\$this->#__ORM_NAME__->value = \$parameters->value;
        #\$this->#__ORM_NAME__->others = \$parameters->others;
        
        \$success = \$this->#__ORM_NAME__->save();
        return \$success;
    }
";
        return $method_body;
    }
}
