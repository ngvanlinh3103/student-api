<?php
    class Student_model extends CI_Model{

        function get_list(){

            $query = $this->db->query("call student_list");

            return $query->result_array();
        }

        function get_id($id = NULL){

            $query = $this->db->query("call student_get_id(?)",array($id));

            return $query->result();
        }

    }