<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class SessionsInitMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('sessions', [
            'id' => false,
            'primary_key' => ['sid'],
        ]);
        $table = $table
            ->addColumn('sid', 'uuid')
            ->addColumn('user_id', 'integer')
            ->addColumn('created', 'datetime', [
                'timezone' => true,
                'default' => 'CURRENT_TIMESTAMP',
            ])
            // ->addColumn('agent', 'string')
            // ->addColumn('ip', 'string', ['limit' => 45])
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'RESTRICT',
            ])
            ->create();
    }
}
