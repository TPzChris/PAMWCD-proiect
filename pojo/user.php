<?php

class User{

    private $id;
    private $name;
    private $email;
    private $roles = array();

    function set_id($id) {
        $this->id = $id;
    }
    function get_id() {
        return $this->id;
    }

    function set_name($name) {
        $this->name = $name;
    }
    function get_name() {
        return $this->name;
    }

    function set_email($email) {
        $this->email = $email;
    }
    function get_email() {
        return $this->email;
    }

    function set_roles($roles) {    
        $this->roles = $roles;
    }

    function get_roles() {    
        return $this->roles;
    } 

}

?>