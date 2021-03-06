<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

use App\Core\Enums\BlogStateEnum;

final class BlogInitMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('blogs');
        $table = $table
            ->addColumn('title', 'string', ['limit' => 80])
            ->addColumn('user_id', 'integer')
            ->addColumn('slug', 'string', ["null" => true])
            ->addColumn('content', 'text')
            ->addColumn('thumbnail', 'uuid', ['null' => true])
            ->addColumn('read_time', 'integer', ['null' => true])
            ->addColumn('state', 'char', [
                'limit' => 1,
                'default' => BlogStateEnum::DRAFT()->getValue(),
            ])
            ->addColumn('published_at', 'datetime', [
                'timezone' => true,
                'null' => true,
            ])
            ->addForeignKey("user_id", 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'RESTRICT',
            ])
            ->addTimestampsWithTimezone()
            ->addIndex("user_id")
            ->create();

        $this->execute('CREATE FULLTEXT INDEX blog_text ON blogs(title, content)');
    }
}
