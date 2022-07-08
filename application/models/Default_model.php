<?php
    class Default_model extends CI_Model{

        function get_list(){

            $query = $this->db->query("call default_student_list");

            return $query->result_array();
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
            $this->db->query("call default_student_insert(?,?,?,?)",array($first_name, $last_name, $age, $sex));

        }

        function delete_student(
            $first_name = NULL, 
            $last_name = NULL, 
            $age = NULL,
            $sex =NULL
        ){
            $this->db->query("call default_student_insert(?,?,?,?)",array($first_name, $last_name, $age, $sex));

        }
    }