<?php 
    namespace Model;

    class DateService extends ActiveRecord{
        protected static $table = 'datesservices';
        protected static $columnsDB = ['id', 'dateId', 'serviceId'];

        public $id;
        public $dateId;
        public $serviceId;

        public function __construct($args = []){
            $this -> id = $args['id'] ?? null;
            $this -> dateId = $args['dateId'] ?? '';
            $this -> serviceId = $args['serviceId'] ?? '';
        }
    }
?>