<?php 
    namespace Controllers;

    use Model\Date;
use Model\DateService;
use Model\Service;

    class APIController{
        public static function index(){
            $services = Service::all();

            echo json_encode($services);
        }

        public static function save(){
            //almacena la cita y devuelve el id
            $date = new Date($_POST);
            $result = $date->guardar();

            $dateId = $result['id'];

            //Almacena la cita y o los servicio
            $servicesId = explode(',', $_POST['services']);

            foreach($servicesId as $serviceId){
                $args = [
                    'dateId' => $dateId,
                    'serviceId' => $serviceId
                ];

                $dateService = new DateService($args);
                $dateService->guardar();
            }

            //retornamos una respuesta
            echo json_encode(['result' => $result]);
        }

        public static function delete(){
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $date = Date::find($_POST['id']);

                $date->eliminar();

                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }
?>