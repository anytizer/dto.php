<?php

namespace generators;

use anytizer\method_descriptor;

class ormifier // implements bodyfier
{
    /**
     * Business entities
     *
     * @param method_descriptor $method
     * @return string
     */
    public function methodify(method_descriptor $method): string
    {
        $description = $method->description;
        $accessor = $method->accessor;
        $method_name = $method->method_name;
        $parameters = $method->parameters;
        $return_type = $method->return_type;

        # Get all fields
        # write all fields with write
        # save

        $method_body = "
    /**
     * {$description}
     */
    {$accessor} function {$method_name}({$parameters}): {$return_type}
    {
        \$#__ORM_NAME__ = new #__ORM_NAME__();
        
        #\$#__ORM_NAME__->name = \$parameters->name;
        #\$#__ORM_NAME__->value = \$parameters->value;
        
        \$success = \$#__ORM_NAME__->save();
        return \$success;
    }
";
        return $method_body;
    }
}
