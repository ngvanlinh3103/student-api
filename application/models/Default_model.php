<?php
    class Default_model extends CI_Model{

        function get_list(){

            $query = $this->db->query("call default_student_list");

            return $query->result_array();
        }

        function get_id($id = NULL){

            $query = $this->db->query("call default_student_getid(?)",array($id));
            
            return $query->result();
        }

        function get_name($name = NULL){

            $query = $this->db->query("call default_student_getname(?)",array($name));
            
            return $query->result();
        }

        function insert_student(
            $first_name = NULL, 
            $last_name = NULL, 
            $age = NULL,
            $sex =NULL
        ){
            return $this->db->query("call default_student_insert(?,?,?,?)",array($first_name, $last_name, $age, $sex));

        }

        function edit_student(    
            $first_name = NULL, 
            $last_name = NULL, 
            $age = NULL,
            $sex =NULL,
            $id = NULL, 
        ){

            $this->db->query("call default_student_update(?,?,?,?,?)",array($first_name, $last_name, $age, $sex, $id));

            var_dump($this->db->last_query());die;

        } 

        function delete_student(
            $id = NULL
        ){
            return $this->db->query("call default_student_delete(?)",array($id));

        } 
        
    }