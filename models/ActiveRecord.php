<?php 
    namespace Model;
    class ActiveRecord {
    
        // Base DE DATOS
        protected static $db;
        protected static $table = '';
        protected static $columnsDB = [];
    
        // Alertas y Mensajes
        protected static $alerts = [];
        
        // Definir la conexión a la BD - includes/database.php
        public static function setDB($database) {
            self::$db = $database;
        }
    
        public static function setAlert($type, $message) {
            static::$alerts[$type][] = $message;
        }
    
        // Validación
        public static function getAlerts() {
            return static::$alerts;
        }
    
        public function validate() {
            static::$alerts = [];
            return static::$alerts;
        }
    
        // Consulta SQL para crear un objeto en Memoria
        public static function consultarSQL($query) {
            // Consultar la base de datos
            $result = self::$db->query($query);
    
            // Iterar los resultados
            $array = [];
            while($registro = $result->fetch_assoc()) {
                $array[] = static::crearObjeto($registro);
            }
    
            // liberar la memoria
            $result->free();
    
            // retornar los resultados
            return $array;
        }
    
        // Crea el objeto en memoria que es igual al de la BD
        protected static function crearObjeto($registro) {
            $objeto = new static;
    
            foreach($registro as $key => $value ) {
                if(property_exists( $objeto, $key  )) {
                    $objeto->$key = $value;
                }
            }
    
            return $objeto;
        }
    
        // Identificar y unir los atributos de la BD
        public function atributos() {
            $atributos = [];
            
            foreach(static::$columnsDB as $columna) {
                if($columna === 'id') continue;
                $atributos[$columna] = $this->$columna;
            }
            return $atributos;
        }
    
        // Sanitizar los datos antes de guardarlos en la BD
        public function sanitizarAtributos() {
            $atributos = $this->atributos();
            $sanitizado = [];
            foreach($atributos as $key => $value ) {
                $sanitizado[$key] = self::$db->escape_string($value);
            }
            return $sanitizado;
        }
    
        // Sincroniza BD con Objetos en memoria
        public function sincronizar($args=[]) { 
            foreach($args as $key => $value) {
              if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
              }
            }
        }
    
        // Registros - CRUD
        public function guardar() {
            $result = '';
            if(!is_null($this->id)) {
                // actualizar
                $result = $this->actualizar();
            } else {
                // Creando un nuevo registro
                $result = $this->crear();
            }
            return $result;
        }
    
        // Todos los registros
        public static function all() {
            $query = "SELECT * FROM " . static::$table;
            $result = self::consultarSQL($query);
            return $result;
        }
    
        // Busca un registro por su id
        public static function find($id) {
            $query = "SELECT * FROM " . static::$table  ." WHERE id = ${id}";
            $result = self::consultarSQL($query);
            return array_shift( $result ) ;
        }
    
        // Obtener Registros con cierta cantidad
        public static function get($limite) {
            $query = "SELECT * FROM " . static::$table . " LIMIT ${limite}";
            $result = self::consultarSQL($query);
            return array_shift( $result ) ;
        }

        // Busca un registro por su id
        public static function where($key, $value) {
            $query = "SELECT * FROM " . static::$table  ." WHERE ${key} = '${value}'";
            $result = self::consultarSQL($query);
            return array_shift( $result ) ;
        }

        //Consulta plana de SQL (utilizar cuando los metodos del modelo no son suficientes)
        public static function SQL($query) {
            $result = self::consultarSQL($query);
            return $result;
        }
    
        // crea un nuevo registro
        public function crear() {
            // Sanitizar los datos
            $atributos = $this->sanitizarAtributos();
    
            // Insertar en la base de datos
            $query = " INSERT INTO " . static::$table . " ( ";
            $query .= join(', ', array_keys($atributos));
            $query .= " ) VALUES ('"; 
            $query .= join("', '", array_values($atributos));
            $query .= "')";
    
            // result de la consulta
            $result = self::$db->query($query);
            return [
               'result' =>  $result,
               'id' => self::$db->insert_id
            ];
        }
    
        // Actualizar el registro
        public function actualizar() {
            // Sanitizar los datos
            $atributos = $this->sanitizarAtributos();
    
            // Iterar para ir agregando cada campo de la BD
            $valores = [];
            foreach($atributos as $key => $value) {
                $valores[] = "{$key}='{$value}'";
            }
    
            // Consulta SQL
            $query = "UPDATE " . static::$table ." SET ";
            $query .=  join(', ', $valores );
            $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
            $query .= " LIMIT 1 "; 
    
            // Actualizar BD
            $result = self::$db->query($query);
            return $result;
        }
    
        // Eliminar un Registro por su ID
        public function eliminar() {
            $query = "DELETE FROM "  . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
            $result = self::$db->query($query);
            return $result;
        }
    
    }
?>