<?php 
    namespace Model;

    class AdminDate extends ActiveRecord{
        protected static $table = 'datesservices';
        protected static $columnsDB = ['id', 'time', 'client', 'email', 'tel', 'service', 'price'];

        public $id;
        public $time;
        public $client;
        public $email;
        public $tel;
        public $service;
        public $price;

        public function __construct($args = []){
            $this->id = $args['id'] = null;
            $this->time = $args['time'] = '';
            $this->client = $args['client'] = '';
            $this->email = $args['email'] = '';
            $this->tel = $args['tel'] = '';
            $this->service = $args['service'] = '';
            $this->price = $args['price'] = '';
        }
    }
?>