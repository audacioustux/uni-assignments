<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class FlagsInitMigration extends AbstractMigration {
    public function change(): void {
        $table = $this->table('flags');
        $table = $table
            ->addColumn('user_id', 'integer')
            ->addColumn('link', 'text')
            ->addColumn('message', 'string')
            ->addColumn('flagType', 'char', ['limit' => 1])
            ->addColumn('action', 'char', ['limit' => 1])
            ->addTimestampsWithTimezone()
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'RESTRICT',
            ])
            ->addIndex('user_id')
            ->create();
    }
}
