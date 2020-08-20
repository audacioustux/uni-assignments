<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $data = [
            [
                'username' => $faker->username(),
                'avatar' => $faker->uuid(),
                'password' => password_hash($faker->password(), PASSWORD_DEFAULT),
                'email' => $faker->email(),
            ]
        ];

        $posts = $this->table('users');
        $posts->insert($data)
            ->saveData();
    }
}
