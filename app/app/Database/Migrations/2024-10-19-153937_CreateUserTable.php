<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "unsigned" => true,
                "auto_increment" => true
            ],
            "name" => [
                "type" => "VARCHAR",
                "constraint" => "255",
                "null" => false
            ],
            "email" => [
                "type" => "VARCHAR",
                "constraint" => "255",
                "null" => false,
                "unique" => true
            ],
            "password" => [
                "type" => "VARCHAR",
                "constraint" => "255",
                "null" => false
            ],
            "profile_pic" => [
                "type" => "VARCHAR",
                "constraint" => "255",
                "null" => true,
            ],
            "role" => [
                'type' => 'ENUM("USER","ADMIN")',
                "default" => "USER",
                "null" => false
            ],
            "email_verified" => [
                "type" => "TIMESTAMP",
                "null" => true,
            ],
            "admin_blocked_email" => [
                "type" => "TIMESTAMP",
                "null" => true,
            ],
            "created_at timestamp default current_timestamp",
            "updated_at timestamp default current_timestamp on update current_timestamp",
        ]);

        $this->forge->addKey("id", true);
        $this->forge->createTable("users");
    }

    public function down()
    {
        $this->forge->dropTable("users", true);
    }
}
