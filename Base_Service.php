<?php

    namespace SOA;

    Class Base_Service {

        public function out(\StdClass $class) {
            /** turn class into a JSON response for API **/
            //return json_decode(json_encode($class), true);
            return json_encode((array)$class);
        }

    }
