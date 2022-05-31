<?php

class Categ{

    private $id;
    private $den;

    function set_id($id) {
        $this->id = $id;
    }
    function get_id() {
        return $this->id;
    }

    function set_den($den) {
        $this->den = $den;
    }
    function get_den() {
        return $this->den;
    }
    
}
