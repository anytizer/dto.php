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
        
        #\$order = Order::first();
        #\$#__CLASS_NAME___orm = new #__CLASS_NAME___orm();
        #\$#__CLASS_NAME___orm->name = \$parameters->name;
        #\$#__CLASS_NAME___orm->value = \$parameters->value;
        #\$#__CLASS_NAME___orm->save();
        
        \$order->title = \"New title\";
        \$order->save();
        
        return true;
    }
";
        return $method_body;
    }
}