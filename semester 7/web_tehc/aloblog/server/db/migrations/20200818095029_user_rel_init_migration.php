<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UserRelInitMigration extends AbstractMigration {
    public function change(): void {
        $table = $this->table('user_rels');
        $table = $table
            ->addColumn('from_id', 'integer')
            ->addColumn('to_id', 'integer')
            ->addColumn('state', 'char', ['limit' => 1])
            ->addTimestampsWithTimezone()
            ->addForeignKey('from_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'RESTRICT',
            ])
            ->addForeignKey('to_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'RESTRICT',
            ])
            ->addIndex('from_id')
            ->addIndex('to_id')
            ->addIndex(['from_id', 'to_id'], ['unique' => true])
            ->create();
    }
}
