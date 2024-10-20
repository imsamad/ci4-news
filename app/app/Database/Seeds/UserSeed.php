<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeed extends Seeder
{
    public function run()
    {
        $users = [
            [
                "name" => "admin",
                "email" => "admin@gmail.com",
                "password" => password_hash("123456", PASSWORD_BCRYPT),
                "email_verified" => date('Y-m-d H:i:s'),
                "role" => "ADMIN"
            ],
            [
                "name" => "user1",
                "email" => "user1@gmail.com",
                "password" => password_hash("123456", PASSWORD_BCRYPT),
                "email_verified" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "user2",
                "email" => "user2@gmail.com",
                "password" => password_hash("123456", PASSWORD_BCRYPT),
                "email_verified" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "user3",
                "email" => "user3@gmail.com",
                "password" => password_hash("123456", PASSWORD_BCRYPT),
                "email_verified" => date('Y-m-d H:i:s'),
            ]
        ];
        foreach ($users as $user) {

            $this->db->table("users")->insert($user);
        }
    }
}
