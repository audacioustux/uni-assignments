<?php

use Phinx\Seed\AbstractSeed;

use App\Core\Helpers\QueryHelpers;

class CommentReactsSeeder extends AbstractSeed
{
    public function getDependencies()
    {
        return ['UserSeeder', 'CommentSeeder'];
    }
    public function run()
    {
        $faker = Faker\Factory::create();

        $comment_ids = QueryHelpers::get_ids($this, "comments");
        $user_ids = QueryHelpers::get_ids($this, "users");

        $data = [];

        for ($i = 0; $i < 5; $i++) {
            $comment_id =
                $comment_ids[$faker->numberBetween(0, count($comment_ids) - 1)];
            $user_id =
                $user_ids[$faker->numberBetween(0, count($user_ids) - 1)];

            $data[] = [
                "comment_id" => $comment_id,
                "user_id" => $user_id,
                "is_liked" => [true, false][$faker->numberBetween(0, 1)],
            ];
        }

        $this->table('comment_reacts')
            ->insert($data)
            ->saveData();
    }
}
