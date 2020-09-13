<?php

use Phinx\Seed\AbstractSeed;

use App\Core\Helpers\QueryHelpers;
use App\Core\Enums\BlogStateEnum;

class BlogSeeder extends AbstractSeed
{
    public function getDependencies()
    {
        return ['UserSeeder'];
    }
    public function run()
    {
        $faker = Faker\Factory::create();
        $word_per_minute = 275;

        $data = [];

        $user_ids = QueryHelpers::get_ids($this, "users");

        $states = [
            BlogStateEnum::DRAFT(),
            BlogStateEnum::LISTED(),
            BlogStateEnum::NON_LISTED(),
        ];

        for ($i = 0; $i < 50; $i++) {
            $content_len = $faker->numberBetween(512, 4096);
            $content = $faker->text($content_len);
            $read_time = ceil(str_word_count($content) / $word_per_minute);

            $state = $states[$faker->numberBetween(0, count($states) - 1)]->getValue();

            $data[] = [
                'title' => $faker->sentence(6, true),
                'user_id' =>
                $user_ids[$faker->numberBetween(0, count($user_ids) - 1)],
                'content' => $content,
                'read_time' => $read_time,
                'state' => $state,
            ];
        }

        $this->table('blogs')
            ->insert($data)
            ->saveData();
    }
}
