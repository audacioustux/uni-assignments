<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Util\Literal;

final class SessionsInitMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('sids', ['id' => false, 'primary_key' => ['sid']]);
        $table = $table
            ->addColumn('sid', 'uuid')
            ->addColumn('user_id', 'integer')
            ->addColumn('created', 'datetime', [
                'timezone' => true,
                'default' => Literal::from('now()')
            ])
            ->addColumn('agent', 'string')
            ->addColumn('ip', 'string', ['limit' => 45])
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE', 'update' => 'RESTRICT'
            ])
            ->create();
    }
}
