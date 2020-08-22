<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class OrdersInitMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('orders', ['id' => false, 'primary_key' => ['order_id']]);
        $table->addColumn('order_id', 'integer', ['identity' => true])
            ->addColumn('price', 'integer')
            ->addColumn('created', 'datetime', [
                'timezone' => true,
                'default' => 'CURRENT_TIMESTAMP'
            ])
            ->addIndex('order_id', ['unique' => true])
            ->create();
    }
}
