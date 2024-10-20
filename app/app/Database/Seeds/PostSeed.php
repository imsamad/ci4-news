<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PostSeed extends Seeder
{
    public function run()
    {
        // Fetch admin and user IDs from the users table
        $db = \Config\Database::connect();



        // Helper function to generate a URL-friendly slug
        function generateSlug($title)
        {
            return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        }

        // Check if users exist before seeding posts
        // Seed posts for both admin and user
        $users = $db->table("users")->get()->getResultArray();

        foreach ($users as $userData) {
            for ($i = 1; $i <= 20; $i++) {
                $title = ucfirst($userData['name']) . " Post " . $i;
                $slug = generateSlug($title);
                $uniqueId = bin2hex(random_bytes(4));
                $slug .= '-' . $uniqueId;

                $post = [
                    "title" => $title,
                    "slug" => $slug,
                    "body" => "This is the body of " . $title,
                    "author_id" => $userData['id'],
                    "created_at" => date('Y-m-d H:i:s'),
                    "updated_at" => date('Y-m-d H:i:s')
                ];

                // Insert the post into the 'posts' table
                $this->db->table('posts')->insert($post);
            }
        }
    }
}
