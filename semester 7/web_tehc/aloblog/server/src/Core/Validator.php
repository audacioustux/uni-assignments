<?php

namespace App\Core;

use JsonSchema\SchemaStorage;
use JsonSchema\Validator as JsonValidator;
use JsonSchema\Constraints\Factory;

class Validator
{
    const CORE_DEFS = <<<'JSON'
    {
        "definitions": {
            "naturalInt" : {
                "type": "integer",
                "minimum" : 1
            },
            "wholeInt" : {
                "type": "integer",
                "minimum" : 0
            }
        }
    }
    JSON;

    public $schemaStorage;

    public function __constructor()
    {
        $schemaStorage = new SchemaStorage();
        $core_defs = json_decode(self::CORE_DEFS);

        $schemaStorage = new SchemaStorage();

        $schemaStorage->addSchema('file://core', $core_defs);

        $this->schemaStorage = $schemaStorage;
    }

    public function validate(object $jsonObj, object $schemaObj)
    {
        $validator = new JsonValidator(new Factory($this->schemaStorage));
        $validator->validate($jsonObj, $schemaObj);

        return $validator;
    }
}
