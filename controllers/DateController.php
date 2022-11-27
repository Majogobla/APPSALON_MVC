<?php 
    namespace Controllers;

    use MVC\Router;

    class DateController{
        public static function index(Router $router){
            isAuth();

            $router->render('date/index', [
                'name' => $_SESSION['name'],
                'id' => $_SESSION['id']
            ]);
        }
    }
?>