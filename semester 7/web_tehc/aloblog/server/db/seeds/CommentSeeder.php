<?php

use Phinx\Seed\AbstractSeed;

use App\Core\Helpers\QueryHelpers;

class CommentSeeder extends AbstractSeed
{
    public function getDependencies()
    {
        return ['BlogSeeder', 'UserSeeder'];
    }
    public function run()
    {
        $faker = Faker\Factory::create();

        $blog_ids = QueryHelpers::get_ids($this, "blogs");
        $user_ids = QueryHelpers::get_ids($this, "users");

        // insert comments

        $data = [];

        for ($i = 0; $i < 5; $i++) {
            $blog_id =
                $blog_ids[$faker->numberBetween(0, count($blog_ids) - 1)];
            for ($j = 0; $j < $faker->numberBetween(0, 5); $j++) {
                $user_id =
                    $user_ids[$faker->numberBetween(0, count($user_ids) - 1)];

                $data[] = [
                    "blog_id" => $blog_id,
                    "user_id" => $user_id,
                    "content" => $faker->text(256),
                ];
            }
        }

        $this->table('comments')
            ->insert($data)
            ->saveData();

        // insert replies

        $data = [];

        $comments = $this->fetchAll("select blog_id, id from comments");

        for ($i = 0; $i < 5; $i++) {
            $comment =
                $comments[$faker->numberBetween(0, count($comments) - 1)];
            $user_id =
                $user_ids[$faker->numberBetween(0, count($user_ids) - 1)];

            $data[] = [
                "blog_id" => $comment["blog_id"],
                "user_id" => $user_id,
                "content" => $faker->text(256),
                "replied_to" => $comment["id"],
            ];
        }

        $this->table('comments')
            ->insert($data)
            ->saveData();
    }
}
