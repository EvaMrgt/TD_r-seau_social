<?php
class LoginController extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = UserRepository::getUserByName($username);
            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                header("Location: /");
                die();
            } else {
                $error = "Nom d'utilisateur ou mot de passe incorrect.";
            }
        }
        include_once __DIR__."/../../../views/login.php";
    }
}
