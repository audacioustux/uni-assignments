<?php

namespace App\Core;

use JsonSchema\Validator;

class Changeset
{
    const DEFINITIONS = <<<'JSON'
    {
        "wholeInt": {
            "type": "integer",
            "minimum": 0
        },
        "naturalInt": {
            "type": "integer",
            "minimum": 1
        }
    }
    JSON;

    private $schema;
    private $data;
    private $options;
    private $definitions;

    public function __construct(
        object $schema,
        object $data = null,
        array $options = []
    ) {
        $this->schema = $schema;
        $this->data = $data;
        $this->options = $options;
        $this->definitions = [
            json_decode(self::DEFINITIONS)
        ];
    }

    public function set_option($name, $value)
    {
        $this->options[$name] = $value;
        return $this;
    }

    public function required(...$fields)
    {
        $this->set_option("required", $fields);
        return $this;
    }

    public function add_definition(object $definition)
    {
        array_push($this->definitions, $definition);
        return $this;
    }

    public function get_json_schema()
    {
        // TODO: refactor, array of definitions(object) to accumulated definition(object/array)
        $definitions = [];
        foreach ($this->definitions as $def) {
            $definitions = array_merge($definitions, (array) $def);
        }
        $jsonSchema = [
            "properties" => $this->schema,
            "definitions" => $definitions
        ];
        return array_merge($jsonSchema, $this->options);
    }

    public function validate()
    {
        $validator = new Validator();

        $validator->validate($this->data, $this->get_json_schema());

        return $validator;
    }
}
