<?php
session_start();

//DataBase
require_once '../_db/Db.php';
//Router
require_once '../core/Router.php';
//repository
require_once '../src/repository/UserRepository.php';
require_once '../src/repository/PostRepository.php';
require_once '../src/repository/LikeRepository.php';
require_once '../src/repository/CommentRepository.php';
//controllers
require_once '../src/controllers/Controller.php';
require_once '../src/controllers/MainController.php';
//user_controller
require_once '../src/controllers/user_controller/LoginController.php';
require_once '../src/controllers/user_controller/RegisterController.php';
require_once '../src/controllers/user_controller/LogoutController.php';
//post_controller
require_once '../src/controllers/post_controller/AddPostController.php';
require_once '../src/controllers/post_controller/DeletePostController.php';
require_once '../src/controllers/post_controller/EditPostController.php';
//like_controller
require_once '../src/controllers/like_controller/AddLikeController.php';
require_once '../src/controllers/like_controller/DeleteLikeController.php';
require_once '../src/controllers/like_controller/ToggleLikeController.php';
//comment_controller
require_once '../src/controllers/comment_controller/AddCommentController.php';
require_once '../src/controllers/comment_controller/DeleteCommentController.php';
require_once '../src/controllers/comment_controller/EditCommentController.php';
//models
require_once '../src/models/User.php';
require_once '../src/models/Post.php';
require_once '../src/models/Comment.php';


$router = new Router();
$router->run();