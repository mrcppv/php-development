<?php

/**
 * TEMPORARY DOCS
 * Don't create quieries here, call database for that
 * User these methods to do native user stuff here
 * 
 */

class User{

    private $database;
    private $table;

    public function __construct(){
        $this->database = new Database();
        $this->table = "user";

    }

    
    public function get_all(){
        $data_from_db = $this->database->select($this->table, "*")->output();
        return $data_from_db;
    }

    public function get($user_id){

        $user_id = Security::escape($user_id);
        $user_id = Security::clean($user_id);

        $data_from_db = $this->database->select($this->table, "*", "id", $user_id)->output();
        return $data_from_db;
    }

    public function add($firstname, $lastname, $email, $phone){
        $columns = array("firstname", "lastname", "email", "phone");

        $firstname = Security::escape($firstname);
        $lastname = Security::escape($lastname);
        $email = Security::escape($email);
        $phone = Security::escape($phone);

        $firstname = Security::clean($firstname);
        $lastname = Security::clean($lastname);
        $email = Security::clean($email);
        $phone = Security::clean($phone);

        $data = array($firstname, $lastname, $email, $phone);
        $executed = $this->database->insert($this->table, $columns, $data);
       
        return $executed;
    }

    public function edit($firstname, $lastname, $email, $phone, $id){

        $firstname = Security::escape($firstname);
        $lastname = Security::escape($lastname);
        $email = Security::escape($email);
        $phone = Security::escape($phone);
        $id = Security::escape($id);

        $firstname = Security::clean($firstname);
        $lastname = Security::clean($lastname);
        $email = Security::clean($email);
        $phone = Security::clean($phone);
        $id = Security::clean($id);

        $columns = array("firstname", "lastname", "email", "phone");
        $data = array($firstname, $lastname, $email, $phone);
        $executed = $this->database->update($this->table, $columns, $data, "id", $id);
       
        return $executed;
    }

    public function delete($id){

        $id = Security::escape($id);
        $id = Security::clean($id);

        $executed = $this->database->delete($this->table, "id", $id);
       
        return $executed;
    }

    public function search($data){

        $data = Security::escape($data);
        $data = Security::clean($data);


        $columns = array("firstname", "lastname", "email", "phone");
        $values = array($data, $data, $data, $data);
        $executed = $this->database->like($this->table, "*", $columns, $values, "OR")->output();

        return $executed;
    }

}
