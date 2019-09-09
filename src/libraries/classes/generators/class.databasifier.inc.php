<?php

namespace generators;

use method_descriptor;

class databasifer implements bodyfier
{
    public function generate(): string
    {
        $this->databasify();
    }

    /**
     * Database wrapper
     *
     * @param method_descriptor $method
     * @return string
     */
    private function databasify(method_descriptor $method): string
    {
        $description = $method->description;
        $method_name = $method->method_name;
        $parameters = $method->parameters;

        $method_body = "
    /**
     * {$description}
     */
    public function {$method_name}({$parameters}): bool
    {
        // INSERT, SELECT, UPDATE, DELETE, FLAG?

        #\$#__MODEL_NAME__ = new #__MODEL_NAME__();
        #\$#__MODEL_NAME__->id = \"\";
        #\$#__MODEL_NAME__->save();
        
        return true;
    }
";
        return $method_body;
    }
}