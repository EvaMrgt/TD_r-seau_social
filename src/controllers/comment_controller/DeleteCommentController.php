<?php

class DeleteCommentController extends Controller
{
    public function index()
    {
        $id = $_POST['id'] ?? $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (CommentRepository::isUserAuthor($id, $_SESSION['user_id'])) {
                $result = CommentRepository::softDeleteComment($id);
                if ($result > 0) {
                    $_SESSION['message'] = "Commentaire supprimé avec succès.";
                } else {
                    $_SESSION['error'] = "Erreur lors de la suppression du commentaire.";
                }
            } else {
                $_SESSION['error'] = "Vous n'êtes pas autorisé à supprimer ce commentaire.";
            }
        }
        // header("Location: /post?id=" . $_POST['post_id']);
        header("Location:/");
        die;
    }
}