<?php

class EditPostController extends Controller {
    public function index(){
        Post::editPost($_POST['post_id'],$_POST['title'], $_POST['content']);
        header("Location:/");
    }
}