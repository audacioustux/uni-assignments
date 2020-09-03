<?php


use Phinx\Seed\AbstractSeed;

use App\Core\Helpers\Queries;

class BlogReactsSeeder extends AbstractSeed
{
    public function run()
    {
        $faker = Faker\Factory::create();

        $blog_ids = Queries::get_ids($this, "blogs");
        $user_ids = Queries::get_ids($this, "users");

        $data = [];

        for ($i = 0; $i < 5; $i++) {
            $blog_id = $blog_ids[$faker->numberBetween(0, count($blog_ids) - 1)];
            $user_id = $user_ids[$faker->numberBetween(0, count($user_ids) - 1)];

            $data[] = [
                "blog_id" => $blog_id,
                "user_id" => $user_id,
                "is_liked" => [true, false][$faker->numberBetween(0, 1)],
            ];
        }

        $this->table('blog_reacts')
        ->insert($data)
        ->saveData();
    }
}
