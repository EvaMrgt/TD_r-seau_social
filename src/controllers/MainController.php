<?php
class MainController extends Controller {
    public function index(){
        $postDb = Post::getPost();
        $posts = [];
        foreach ($postDb as $post){
            $objectPost = new Post($post['id'], $post['title'], $post['content'], $post['user_id']);
            array_push($posts, $objectPost);
        }
        if(!isset($_SESSION['user_id'])) {
            header("Location: /login");
            die();
        }
        require_once(__DIR__.'/../../views/main.php');
    }
}