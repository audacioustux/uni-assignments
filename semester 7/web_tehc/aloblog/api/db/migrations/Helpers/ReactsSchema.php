<?php

namespace Migrations\Helpers;

trait ReactsSchema {
    public function get_schema() {
        // table name
        $table = $this->table;
        // entity name - ideally singular form of table name
        $name = $this->name;

        $schema = $this->table("{$name}_reacts");
        $schema = $schema
            ->addColumn("{$name}_id", 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('is_liked', 'boolean')
            ->addTimestampsWithTimezone()
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE', 'update' => 'RESTRICT'
            ])
            ->addForeignKey("{$name}_id", $table, 'id', [
                'delete' => 'CASCADE', 'update' => 'RESTRICT'
            ])
            ->addIndex("{$name}_id")
            ->addIndex('user_id')
            ->addIndex(["{$name}_id", 'user_id'], ['unique' => true]);

        return $schema;
    }
}