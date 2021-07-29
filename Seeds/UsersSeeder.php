<?php

namespace Seeds;

use Faker\Generator;
use Models\User;

class UsersSeeder
{
    /** @var int */
    public $order = 1;

    /** @var Generator */
    public $faker;

    /** @var int */
    public $count = 2000;

    /** @var string */
    public $model = User::class;

    /**
     * @var string
     */
    private $password;

    public function __construct()
    {
        $this->password = password_hash( 'password', PASSWORD_DEFAULT );
    }

    public function data() : array
    {
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->email,
            'password' => $this->password,
            'type' => $this->faker->randomElement( [ 'admin', 'subscriber' ] ),
            'status' => 'active'
        ];
    }
}