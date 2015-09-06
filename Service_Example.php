<?php

    namespace SOA;
    require 'Base_Service.php';

    Class Service_Example extends Base_Service {

        public function __construct() {
            $this->foos = [];
            $foo = new \StdClass();
            $foo->id = 1;
            $foo->subject = 'Subject here';
            $foo->body = 'Body here';
            $this->foos[$foo->id] = $foo;

        }

        public function create($subject, $body) {
            $foo = new \StdClass();
            $foo->subject = $subject;
            $foo->body = $body;
            return self::out($foo);
        }

        public function read($fooId) {
            return self::out($this->foos[$fooId]);
        }

        public function update() {

        }

        public function delete() {

        }


    }
