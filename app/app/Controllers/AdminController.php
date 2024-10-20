<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Auth;
use App\Models\PostModel;

class AdminController extends BaseController
{
    public function index()
    {
        $post = new PostModel();
        $posts = $post->select("posts.*, users.name as name, users.email as email, users.id as userId")->join("users", "users.id = posts.author_id")->findAll();

        return view("pages/me/PostsTable", ["posts" => $posts, "is_admin" => true, "pageTitle" => "Admin Dashboard"]);
    }
}
