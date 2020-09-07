<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CommentInitMigration extends AbstractMigration {
    public function change(): void {
        $table = $this->table('comments');
        $table = $table
            ->addColumn('blog_id', 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('content', 'text')
            ->addColumn('replied_to', 'integer', ['null' => true])
            ->addColumn('state', 'char', ['limit' => 1, 'null' => true])
            ->addTimestampsWithTimezone()
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'RESTRICT',
            ])
            ->addForeignKey('blog_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'RESTRICT',
            ])
            ->addForeignKey(
                ['blog_id', 'replied_to'],
                'comments',
                ['blog_id', 'id'],
                [
                    'delete' => 'CASCADE',
                    'update' => 'RESTRICT',
                ],
            )
            ->addIndex("user_id")
            ->addIndex("blog_id")
            ->create();
    }
}
