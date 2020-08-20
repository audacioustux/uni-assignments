<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Util\Literal;

final class FlagsInitMigration extends AbstractMigration
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
        $table = $this->table('flags');
        $table = $table
            ->addColumn('user_id', 'integer')
            ->addColumn('link', 'text')
            ->addColumn('message', 'string')
            ->addColumn('flagType', 'char')
            ->addColumn('action', 'char')
            ->addColumn('created', 'datetime', [
                'timezone' => true,
                'default' => Literal::from('now()')
            ])
            ->addColumn('updated', 'datetime', [
                'timezone' => true,
                'null' => true
            ])
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE', 'update' => 'RESTRICT'
            ])
            ->addIndex('user_id')
            ->create();
    }
}
