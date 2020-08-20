<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class BlogReactsInitMigration extends AbstractMigration
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
        $table = $this->table('blog_reacts');
        $table = $table
            ->addColumn('blog_id', 'integer')
            ->addColumn('user_id', 'integer')
            ->addColumn('react', 'char')
            ->addTimestampsWithTimezone()
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE', 'update' => 'RESTRICT'
            ])
            ->addForeignKey('blog_id', 'blogs', 'id', [
                'delete' => 'CASCADE', 'update' => 'RESTRICT'
            ])
            ->addIndex('blog_id')
            ->addIndex('user_id')
            ->addIndex(['blog_id', 'user_id'])
            ->addIndex(['react', 'user_id'], ['unique' => true])
            ->create();
    }
}
