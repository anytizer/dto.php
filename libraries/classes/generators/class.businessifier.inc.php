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
        
        #\$#__CLASSNAME___orm = new #__CLASSNAME___orm();
        #\$#__CLASSNAME___orm->name = \$parameters->name;
        #\$#__CLASSNAME___orm->value = \$parameters->value;
        #\$#__CLASSNAME___orm->save();
        
        return true;
    }
";
        return $method_body;
    }
}