<?php 
    require_once __DIR__ . '/../includes/app.php';

    use Controllers\AdminController;
    use Controllers\APIController;
    use Controllers\DateController;
    use Controllers\LoginController;
    use Controllers\ServiceController;
    use MVC\Router;
    
    $router = new Router();

    //iniciar sesion
    $router->get('/', [LoginController::class, 'login']);
    $router->post('/', [LoginController::class, 'login']);
    //Cerrar sesion
    $router->get('/logout', [LoginController::class, 'logout']);

    //Recuperar password
    $router->get('/forgot', [LoginController::class, 'forgot']);
    $router->post('/forgot', [LoginController::class, 'forgot']);
    $router->get('/recover', [LoginController::class, 'recover']);
    $router->post('/recover', [LoginController::class, 'recover']);

    //Crear cuenta
    $router->get('/create-account', [LoginController::class, 'create']);
    $router->post('/create-account', [LoginController::class, 'create']);

    //Confirmar cuenta
    $router->get('/confirm-account', [LoginController::class, 'confirm']);
    $router->get('/message', [LoginController::class, 'message']);

    //Area privada
    $router->get('/date', [DateController::class, 'index']);
    $router->get('/admin', [AdminController::class, 'index']);

    //API de Citas
    $router->get('/api/services', [APIController::class, 'index']);
    $router->post('/api/dates', [APIController::class, 'save']);
    $router->post('/api/delete', [APIController::class, 'delete']);

    //CRUD servicios
    $router->get('/services', [ServiceController::class, 'index']);
    $router->get('/services/create', [ServiceController::class, 'create']);
    $router->post('/services/create', [ServiceController::class, 'create']);
    $router->get('/services/update', [ServiceController::class, 'update']);
    $router->post('/services/update', [ServiceController::class, 'update']);
    $router->post('/services/delete', [ServiceController::class, 'delete']);


    // Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
    $router->comprobarRutas();
?>