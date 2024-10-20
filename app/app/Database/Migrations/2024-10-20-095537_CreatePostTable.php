<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePostTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "auto_increment" => true,
                "unsigned" => true
            ],
            "title" => [
                "type" => "VARCHAR",
                "constraint" => "255",
                "null" => false,
            ],
            "slug" => [
                "type" => "VARCHAR",
                "constraint" => "255",
                "unique" => true,
                "null" => false
            ],
            "body" => [
                "type" => "VARCHAR",
                "constraint" => "255",
                "null" => false
            ],
            "author_id" => [
                "type" => "INT",
                "null" => false,
                "unsigned" => true
            ],
            "created_at timestamp default current_timestamp",
            "updated_at timestamp default current_timestamp on update current_timestamp"
        ]);

        $this->forge->addKey("id", true);
        $this->forge->addForeignKey("author_id", "users", "id", 'CASCADE', 'CASCADE');
        $this->forge->createTable("posts");
    }

    public function down()
    {
        $this->forge->dropTable("posts");
    }
}
