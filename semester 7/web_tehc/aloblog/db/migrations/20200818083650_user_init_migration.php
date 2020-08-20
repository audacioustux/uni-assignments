<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Util\Literal;

final class UserInitMigration extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('username', 'string', ['limit' => 24])
            ->addColumn('avatar', 'uuid')
            ->addColumn('password', 'string')
            ->addColumn('email', 'string')
            ->addColumn('role', 'char')
            ->addColumn('state', 'char')
            ->addColumn('created', 'datetime', [
                'timezone' => true,
                'default' => Literal::from('now()')
            ])
            ->addColumn('updated', 'datetime', [
                'timezone' => true,
                'null' => true
            ])
            ->addIndex(['username'], ['unique' => true])
            ->addIndex(['email'], ['unique' => true])
            ->addIndex('state')
            ->addIndex('role')
            ->create();
    }
}
