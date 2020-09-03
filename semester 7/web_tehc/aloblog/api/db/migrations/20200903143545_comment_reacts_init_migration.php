<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Migrations\Helpers\ReactsSchema;

final class CommentReactsInitMigration extends AbstractMigration
{
    private $table = "comments";
    private $name = "comment";

    use ReactsSchema;

    public function change() {
        $this->get_schema()->create();
    }
}
