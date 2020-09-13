<?php

use Phinx\Seed\AbstractSeed;

use App\Core\Helpers\QueryHelpers;

class BlogReactsSeeder extends AbstractSeed
{
    public function getDependencies()
    {
        return ['UserSeeder', 'BlogSeeder'];
    }
    public function run()
    {
        $faker = Faker\Factory::create();

        $blog_ids = QueryHelpers::get_ids($this, "blogs");
        $user_ids = QueryHelpers::get_ids($this, "users");

        $data = [];

        shuffle($blog_ids);

        for ($i = 0; $i < 15; $i++) {
            shuffle($user_ids);
            for ($j = 0; $j < $faker->numberBetween(0, 5); $j++) {
                $data[] = [
                    "blog_id" => $blog_ids[$i],
                    "user_id" => $user_ids[$j],
                    "is_liked" => [true, false][$faker->numberBetween(0, 1)],
                ];
            }
        }

        $this->table('blog_reacts')
            ->insert($data)
            ->saveData();
    }
}
