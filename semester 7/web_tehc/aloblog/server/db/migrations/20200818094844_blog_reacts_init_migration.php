<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Migrations\Helpers\ReactsSchema;

final class BlogReactsInitMigration extends AbstractMigration {
    private $table = "blogs";
    private $name = "blog";

    use ReactsSchema;

    public function change() {
        $this->get_schema()->create();
    }
}
