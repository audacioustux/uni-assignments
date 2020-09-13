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

        shuffle($comment_ids);

        for ($i = 0; $i < 15; $i++) {
            shuffle($user_ids);
            for ($j = 0; $j < $faker->numberBetween(0, 5); $j++) {
                $data[] = [
                    "comment_id" => $comment_ids[$i],
                    "user_id" => $user_ids[$j],
                    "is_liked" => [true, false][$faker->numberBetween(0, 1)],
                ];
            }
        }

        $this->table('comment_reacts')
            ->insert($data)
            ->saveData();
    }
}
