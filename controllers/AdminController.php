<?php 
    namespace Controllers;

use Model\AdminDate;
use MVC\Router;

    class AdminController{
        public static function index(Router $router){
            isAdmin();

            $day = $_GET['date'] ?? date('Y-m-d');
            
            $days = explode('-', $day);

            if(!checkdate($days[1], $days[2], $days[0])){
                header('Location: /404');
            }

            //Consultar la base de datos
            $query = "SELECT dates.id, dates.time, CONCAT(users.name, ' ', users.surname) AS client, users.email, users.tel, services.name AS service, services.price FROM dates LEFT OUTER JOIN users ON dates.userId=users.id LEFT OUTER JOIN datesservices ON datesservices.dateId = dates.id LEFT OUTER JOIN services ON services.id = datesservices.serviceId WHERE date = '${day}'";// 

            $dates = AdminDate::SQL($query);

            $router->render('admin/index', [
                'name' => $_SESSION['name'],
                'dates' => $dates,
                'day' => $day
            ]);
        }
    }
?>