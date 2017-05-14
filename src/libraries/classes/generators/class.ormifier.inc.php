<?php
namespace generators;
use setups\method_descriptor;

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
        $method_name = $method->method_name;
        $parameters = $method->parameters;

        # Get all fields
        # write all fields with write
        # save

        $method_body = "
    /**
     * {$description}
     */
    public function {$method_name}({$parameters}): bool
    {
        // add, edit, delete, details, list, flag
        // do other query things()
        
        #\$#__ORM_NAME__= new #__ORM_NAME__();
        #\$#__ORM_NAME__->name = \$parameters->name;
        #\$#__ORM_NAME__->value = \$parameters->value;
        
        \$success = #\$#__ORM_NAME__->save();
        
        return \$success;
    }
";
        return $method_body;
    }
}