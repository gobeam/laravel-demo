<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserSeeder constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {

        $this->user = $user;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ["name" => "admin", "email" => "admin@app.com",  "password" => bcrypt("password"), "role" => "admin"],
            ["name" => "writer", "email" => "writer@app.com",  "password" => bcrypt("password"), "role" => "writer"],
            ["name" => "user", "email" => "user@app.com",  "password" => bcrypt("password"), "role" => "user"],
        ];
        DB::table('users')->insert($users);
    }
}
