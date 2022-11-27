<?php 
    namespace Controllers;

    use Model\Service;
    use MVC\Router;

    class ServiceController{
        public static function index(Router $router){
            isAdmin();

            $services = Service::all();

            $router->render('services/index', [
                'name' => $_SESSION['name'],
                'services' => $services
            ]);
        }

        public static function create(Router $router){
            isAdmin();

            $service = new Service;

            $alerts = [];

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $service->sincronizar($_POST);

                $alerts = $service->validate();

                if(empty($alerts)){
                    $result = $service->guardar();

                    header('Location: /services');
                }
            }

            $router->render('services/create', [
                'name' => $_SESSION['name'],
                'service' => $service,
                'alerts' => $alerts
            ]);
        }

        public static function update(Router $router){
            isAdmin();

            if(!is_numeric($_GET['id'])){
                header('Location: /services');
            }

            $service = Service::find($_GET['id']);

            $alerts = [];

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $service->sincronizar($_POST);

                $alerts = $service->validate();

                if(empty($alerts)){
                    $service->guardar();

                    header('Location: /services');
                }
            }

            $router->render('services/update', [
                'name' => $_SESSION['name'],
                'service' => $service,
                'alerts' => $alerts
            ]);
        }

        public static function delete(){
            isAdmin();
            
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $id = $_POST['id'];

                $service = Service::find($id);

                $service->eliminar();

                header('Location: /services');
            }
        }
    }
?>