<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class BlogInitMigration extends AbstractMigration
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
        $table = $this->table('blogs');
        $table = $table->addColumn('title', 'string')
            ->addColumn('user_id', 'integer')
            ->addColumn('slug', 'string')
            ->addColumn('content', 'text')
            ->addColumn('thumbnail', 'uuid')
            ->addColumn('state', 'char')
            ->addForeignKey("user_id", 'users', 'id', [
                'delete' => 'CASCADE', 'update' => 'RESTRICT'
            ])
            ->addTimestampsWithTimezone()
            ->addIndex("user_id")
            ->create();
    }
}
