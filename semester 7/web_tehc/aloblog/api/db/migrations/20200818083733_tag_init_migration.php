<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TagInitMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('tags');
        $table = $table
            ->addColumn('name', 'string', ['limit' => 48])
            ->addColumn('description', 'text')
            ->addColumn('guidline', 'text')
            ->addTimestampsWithTimezone()
            ->addIndex(['name'], ['unique' => true])
            ->create();
    }
}
