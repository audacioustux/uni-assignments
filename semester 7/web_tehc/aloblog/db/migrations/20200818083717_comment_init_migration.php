<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CommentInitMigration extends AbstractMigration
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
        $table = $this->table('comments');
        $table = $table
            ->addColumn('blog_id', 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('content', 'text')
            ->addColumn('state', 'char', ['limit' => 1])
            ->addTimestampsWithTimezone()
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE', 'update' => 'RESTRICT'
            ])
            ->addForeignKey('blog_id', 'users', 'id', [
                'delete' => 'CASCADE', 'update' => 'RESTRICT'
            ])
            ->addIndex("user_id")
            ->addIndex("blog_id")
            ->create();
    }
}
