<?php
class Router{
    public function run(){
        try{
            if($_SERVER["REQUEST_URI"] !== "/"){
                $url = ucfirst(explode("/",$_SERVER["REQUEST_URI"])[1]) . "Controller";
                if(class_exists($url)){
                    $controller = new $url();
                    if(method_exists($controller,"index"))
                        $controller->index();
                    else throw new Exception("Implémentez la fonction index !!!");
                }
                else{
                    require("../views/error_404.php");
                }
            }
            else{
                $controller = new MainController();
                $controller->index();
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }
}