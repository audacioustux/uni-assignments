<?php

declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';

use Phinx\Migration\AbstractMigration;

use App\Core\Enums\UserRoleEnum;
use App\Core\Enums\UserStateEnum;

final class UserInitMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('users');
        $table->addColumn('username', 'string', ['limit' => 24])
            ->addColumn('avatar', 'uuid', ['null' => true])
            ->addColumn('password', 'string')
            ->addColumn('email', 'string')
            ->addColumn('role', 'char', ['limit' => 1, 'default' => UserRoleEnum::REGULAR()->getValue()])
            ->addColumn('state', 'char', ['limit' => 1, 'default' => UserStateEnum::ACTIVE()->getValue()])
            ->addTimestampsWithTimezone()
            ->addIndex(['username'], ['unique' => true])
            ->addIndex(['email'], ['unique' => true])
            ->addIndex('state')
            ->addIndex('role')
            ->create();

        if ($this->isMigratingUp()) {
            $table->insert(
                [[
                    'username' => getenv('SUPERUSER_USERNAME'),
                    'password' => password_hash(getenv('SUPERUSER_PWD'), PASSWORD_DEFAULT),
                    'email' => getenv('SUPERUSER_EMAIL'),
                    'role' => UserRoleEnum::SUPERUSER()
                ]]
            )->save();
        }
    }
}
