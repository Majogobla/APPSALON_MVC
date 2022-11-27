<?php 
    namespace Controllers;

    use Classes\Email;
    use Model\User;
    use MVC\Router;

    class LoginController{
        public static function login(Router $router){
            $alerts = [];

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $auth = new User($_POST);

                $alerts = $auth -> validateLogin();

                if(empty($alerts)){
                    //Comrpobar que exista el usuario
                    $user = User::where('email', $auth->email);

                    if($user){
                        //Verificar password
                        if($user->validatePasswordAndConfirmed($auth->password)){
                            session_start();

                            $_SESSION['id'] = $user -> id;
                            $_SESSION['name'] = $user -> name . " " . $user -> surname;
                            $_SESSION['email'] = $user -> email;
                            $_SESSION['login'] = true;

                            //Redireccionamiento
                            if($user->admin === '1'){
                                $_SESSION['admin'] = $user -> admin ?? null;

                                header('Location: /admin');
                            }else{
                                header('Location: /date');
                            }
                        }
                    }else{
                        User::setAlert('error', 'Usuario no existe');
                    }
                }
            }

            $alerts = User::getAlerts();

            $router->render('auth/login', [
                'alerts' => $alerts
            ]);
        }

        public static function logout(){
            $_SESSION = [];

            header('Location: /');
        }

        public static function forgot(Router $router){
            $alerts = [];

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $auth = new User($_POST);

                $alerts = $auth->validateEmail();

                if(empty($alerts)){
                    $user = User::where('email', $auth->email);

                    if($user && $user -> confirmed === "1"){
                        //Generar un token
                        $user -> createToken();
                        $user -> guardar();
                        
                        //Enviar el email
                        $email = new Email($user->email, $user->name, $user->token);
                        $email->sendInstructions();

                        //Alerta de exito
                        User::setAlert('success', 'Revisa tu email');
                    }else{
                        User::setAlert('error', 'El usuario no esxiste o no está confirmado');
                    }
                }
            }
            $alerts = User::getAlerts();

            $router->render('auth/forgot-password', [
                'alerts' => $alerts
            ]);
        }

        public static function recover(Router $router){
            $alerts = [];

            $invalid = false;

            $token = s($_GET['token']);
            
            //Buscar usuario por su token
            $user = User::where('token', $token);
            
            if(empty($user)){
                User::setAlert('error', 'Token no Válido');
                $invalid = true;
            }

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                //Leer el nuevo password
                $password  = new User($_POST);
                
                $alerts = $password -> validateNewPassword();

                if(empty($alerts)){
                    $user->password = null;
                    $user->password = $password->password;
                    $user->hashPassword();
                    $user -> token = null;
                    $result = $user->guardar();

                    if($result){
                        header('Location: /');
                    }
                }
            }

            $alerts = User::getAlerts();

            $router->render('auth/recover-password', [
                'alerts' => $alerts,
                'invalid' => $invalid
            ]);
        }

        public static function create(Router $router){
            $user = new User;

            //Alertas vacias
            $alerts = [];

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $user->sincronizar($_POST);

                $alerts = $user->validateNewAccount();

                //Reviasar que alertas esté vacío
                if(empty($alerts)){
                    //Verificar que el usuario no esté verificado
                    $result = $user->userExist();

                    if($result->num_rows){
                        $alerts = User::getAlerts();
                    }else{
                        //Hashear el password
                        $user->hashPassword();

                        //Generar un token único
                        $user->createToken();

                        //Enviar email
                        $email = new Email($user->email, $user->name, $user->token);

                        $email->sendConfirmation();

                        //Crear el usuario
                        $result = $user->guardar();

                        if($result){
                            header('Location: /message');
                        }
                    }
                }
            }

            $router->render('auth/create-account', [
                'user' => $user,
                'alerts' => $alerts
            ]);
        }

        public static function  message(Router $router){
            $router->render('auth/message', [
                
            ]);
        }

        public static function confirm(Router $router){
            //Generar arreglo de alertas para evitar referencias nulas
            $alerts = [];

            //Obtener token de la URL
            $token = s($_GET['token']);

            //Buscar el usuario a partir del token
            $user = User::where('token', $token);

            //Acciones si se encuentra el usuario
            if(empty($user)){
                //Mostrar mensaje de arror
                User::setAlert('error', 'Token no valido');
            }else{
                //Modificar el usuario a confirmar
                $user -> confirmed = 1;
                $user -> token = null;

                //Guardar modificaciones
                $user -> guardar();
                
                //Generar mensaje de exito
                User::setAlert('success', 'Usuario confirmado correctamente');
            }

            $alerts = User::getAlerts();

            $router->render('auth/confirm-account', [
                'alerts' => $alerts
            ]);
        }
    }
?>