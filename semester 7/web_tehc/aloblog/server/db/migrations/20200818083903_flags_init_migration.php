<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use App\Core\Enums\FlagTypeEnum;

final class FlagsInitMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('flags');
        $table = $table
            ->addColumn('user_id', 'integer')
            ->addColumn('link', 'text')
            ->addColumn('message', 'string')
            ->addColumn('flagType', 'char', [
                'limit' => 1,
                'default' => FlagTypeEnum::DRAFT()->getValue()
            ])
            ->addTimestampsWithTimezone()
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'RESTRICT',
            ])
            ->addIndex('user_id')
            ->create();
    }
}
