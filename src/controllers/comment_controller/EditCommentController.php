<?php

class EditCommentController extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (CommentRepository::isUserAuthor($_POST['id'], $_SESSION['user_id'])) {
                $result = CommentRepository::updateComment($_POST['id'], $_POST['content']);
                if ($result > 0) {
                    $_SESSION['message'] = "Commentaire modifié avec succès.";
                } else {
                    $_SESSION['error'] = "Erreur lors de la modification du commentaire.";
                }
            } else {
                $_SESSION['error'] = "Vous n'êtes pas autorisé à modifier ce commentaire.";
            }
        }
        // header("Location: /post?id=" . $_POST['post_id']);
        header("Location:/");
        die;
    }
}