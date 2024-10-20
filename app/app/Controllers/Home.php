<?php

namespace App\Controllers;

use App\Models\PostModel;

class Home extends BaseController
{
    public function index(): string
    {
        $posts = (new PostModel())->select("posts.*, users.name")->join("users", "posts.author_id=users.id")->findAll();
        return view('pages/HomePage', ["posts" => $posts, "pageTitle" => "Teapost - Home"]);
    }
}
