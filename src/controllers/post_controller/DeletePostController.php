<?php 

class DeletePostController extends Controller {
    public function index(){
        Post::deletePost($_POST['remove']);
        header("Location: /");
    }
}