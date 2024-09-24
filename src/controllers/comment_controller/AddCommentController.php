<?php

class AddCommentController extends Controller{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newCommentId = CommentRepository::addComment($_POST['post_id'], $_SESSION['user_id'], $_POST['content']);
            if ($newCommentId) {
                $_SESSION['message'] = "Commentaire ajouté avec succès.";
            } else {
                $_SESSION['error'] = "Erreur lors de l'ajout du commentaire.";
            }
        }
        // header("Location: /post?id=" . $_POST['post_id']);
        header("Location : /");
        die;
    }

}