<?php 
    namespace Model;

    class User extends ActiveRecord{
        //Base de datos
        protected static $table = 'users';

        protected static $columnsDB = ['id', 'name', 'surname', 'email', 'password', 'tel', 'admin', 'confirmed', 'token'];

        public $id;
        public $name;
        public $surname;
        public $email;
        public $password;
        public $tel;
        public $admin;
        public $confirmed;
        public $token;

        public function __construct($args = []){
            $this->id=$args['id'] ?? null;
            $this->name=$args['name'] ?? '';
            $this->surname=$args['surname'] ?? '';
            $this->email=$args['email'] ?? '';
            $this->password=$args['password'] ?? '';
            $this->tel=$args['tel'] ?? '';
            $this->admin=$args['admin'] ?? '0';
            $this->confirmed=$args['confirmed'] ?? '0';
            $this->token=$args['token'] ?? '';
        }

        //Mensajes de validacion para la creacion de una cuenta
        public function validateNewAccount(){
            if(!$this->name){
                self::$alerts['error'][] = 'El nombre es obligatorio';
            }

            if(!$this->surname){
                self::$alerts['error'][] = 'El apellido es obligatorio';
            }

            if(!$this->tel){
                self::$alerts['error'][] = 'El teléfono es obligatorio';
            }

            if(!$this->email){
                self::$alerts['error'][] = 'El correo es obligatorio';
            }

            if(!$this->password){
                self::$alerts['error'][] = 'El password es obligatorio';
            }

            if(strlen($this->password) < 6){
                self::$alerts['error'][] = 'El password debe tener al menos 6 caracteres';
            }

            return self::$alerts;
        }

        //Revisa si el usuario ya existe
        public function userExist(){
            $query = "SELECT * FROM " . self::$table . " WHERE email = '" . $this->email . "' LIMIT 1";

            $result = self::$db->query($query);

            if($result->num_rows){
                self::$alerts['error'][] = 'El usuario ya está registrado';
            }

            return $result;
        }

        public function hashPassword(){
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        }

        public function createToken(){
            $this->token = uniqid();
        }

        //Mensajes de validacion para el intento de login
        public function validateLogin(){
            if(!$this->email){
                self::$alerts['error'][] = 'El correo es obligatorio';
            }

            if(!$this->password){
                self::$alerts['error'][] = 'El password es obligatorio';
            }

            return self::$alerts;
        }

        //Validar si el password es correcto y si está confirmado
        public function validatePasswordAndConfirmed($password){
            $result = password_verify($password, $this->password);

            if(!$result || !$this->confirmed){
                self::$alerts['error'][]= 'Password Incorrecto o tu cuenta no está verificada';
            }else{
                return true;
            }
        }

        //Validar si el email existe
        public function validateEmail(){
            if(!$this->email){
                self::$alerts['error'][]= 'El Email es obligatorio';
            }

            return self::$alerts;
        }

        //Valida el nuevos password del usuario
        public function validateNewPassword(){
            if(!$this->password){
                self::$alerts['error'][] = 'El password es obligatorio';
            }

            if(strlen($this->password) < 6){
                self::$alerts['error'][] = 'El password debe tener al menos 6 caracteres';
            }

            return self::$alerts;
        }
    }
?>