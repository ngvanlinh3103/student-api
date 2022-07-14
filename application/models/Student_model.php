<?php
    class Student_model extends MY_Model{

        function get_list(){

            $res = $this->db->query("call student_list()");
// var_dump($this->process_results($res)->get_results());die();
            return $this->process_results($res)->get_results();
        }

        function get_name($name = NULL){

            $this->init_m_sql();
            $sql = "call student_get_name(".(NULL === $name ? 'NULL' : "'". $name."'").")";

            $res = $this->m_query($sql);

            return $this->process_m_results($res)->get_results();
        }

    }