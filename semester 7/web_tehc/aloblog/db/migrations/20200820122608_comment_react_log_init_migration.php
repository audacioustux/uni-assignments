<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CommentReactLogInitMigration extends AbstractMigration
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
        $table = $this->table('comment_react_log');
        $table = $table
            ->addColumn('comment_id', 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('is_liked', 'boolean')
            ->addTimestampsWithTimezone()
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE', 'update' => 'RESTRICT'
            ])
            ->addForeignKey('comment_id', 'comments', 'id', [
                'delete' => 'CASCADE', 'update' => 'RESTRICT'
            ])
            ->addIndex('comment_id')
            ->addIndex('user_id')
            ->addIndex(['user_id', 'comment_id'], ['unique' => true])
            ->create();
    }
}
