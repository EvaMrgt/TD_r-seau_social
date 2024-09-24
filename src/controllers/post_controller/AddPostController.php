<?php

class AddPostController extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = new Post(0, $_POST['title'], $_POST['content'], $_SESSION['user_id']);
            Post::createPost($post->getTitle(), $post->getContent(), $post->getUserID());
        }
        header("Location: /");
        die;
    }
}