<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        $faker = Faker\Factory::create();

        $data = [];

        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'username' => $faker->username(),
                'password' => password_hash($faker->password(), PASSWORD_DEFAULT),
                'email' => $faker->email(),
            ];
        }

        $this->table('users')
        ->insert($data)
        ->saveData();
    }
}
