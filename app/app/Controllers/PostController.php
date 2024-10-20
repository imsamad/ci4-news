<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Auth;
use App\Models\PostModel as Post;

class PostController extends BaseController
{
    protected $helpers = ["url", "form"];

    public function index()
    {
        $author_id = Auth::getId();
        $post = new Post();
        $posts = $post->select("*")->where("posts.author_id", $author_id)->findAll();
        return  view("/pages/me/PostsTable", ["posts" => $posts, "pageTitle" => "User Panel"]);
    }

    public function createPostPage()
    {
        return view("pages/me/PostForm", ["pageTitle" => "Create Post"]);
    }

    public function createPostHandler()
    {
        $slug = url_title($this->request->getPost('title'), '-', true);
        $uniqueId = bin2hex(random_bytes(4));
        $slug .= '-' . $uniqueId;
        // Prepare data for the new post

        $data = [
            'title'     => $this->request->getPost('title'),
            'slug'      => $slug,
            'body'      => $this->request->getPost('body'),
            'author_id' => Auth::getId(),
        ];

        $post = new Post();

        if ($newPost = $post->insert($data)) {
            session()->setFlashdata('success', 'Post created successfully');
            log_message("info", $newPost);
            return redirect()->route("rt.profilepage");
        }

        session()->setFlashdata('fail', 'Failed to create post');
        return redirect()->back()->withInput();
    }

    public function deletePost($postId)
    {
        $author_id = Auth::getId();

        $post = new Post();

        $conds = ["id" => $postId];

        if (!Auth::isAdmin())
            $conds["author_id"] = $author_id;

        $deletedPost = $post->delete($conds);

        if ($deletedPost) {
            if ($this->request->isAJAX())
                return $this->response->setJSON(["message" => "Post deleted successfully"]);
            $posts = $post->where("author_id", $author_id)->findAll();
            return  view("/pages/me/PostsTable", ["posts" => $posts]);
        }
        return $this->response->setJSON(["message" => "Post not found"], 400);
    }

    public function editPostPage($postId)
    {
        $author_id = Auth::getId();

        $conds = ["id" => $postId];

        if (!Auth::isAdmin())
            $conds["author_id"] = $author_id;

        $post = (new Post())->where($conds)->first();

        if (!$post) {
            return "Resource not found!";
        }

        return view("pages/me/PostForm", ["post" => $post, "pageTitle" => "Edit Post"]);
    }

    public function editPostHandler($postId)
    {
        $author_id = Auth::getId();

        $conds = ["id" => $postId];
        if (!Auth::isAdmin())
            $conds["author_id"] = $author_id;

        $post = (new Post())->where($conds)->first();

        if (!$post) {
            return "Resource not found!";
        }

        $data = [
            'title'     => $this->request->getPost('title'),
            'body'      => $this->request->getPost('body'),
        ];

        if ((new Post())->update($postId, $data)) {
            session()->setFlashdata('success', 'Post updated successfully');
            return redirect()->to(route_to('rt.editPostPage', $postId));
        } else {
            session()->setFlashdata('fail', 'Failed to update post');
            return redirect()->back()->withInput();
        }
    }
}
