<?php
    class Extension_model extends MY_Model{

        function get_id(int $id = NULL){
            
            $this->init_m_sql();
            $sql = "call extension_student_getid(".
                (null === $id ? "NULL" : "'". $id."'").
            ")";

            $res = $this->m_query($sql);

            return $this->process_m_results($res)->get_results();
        }

        //list information default student
        function get_list(int $input_page_number = null, int $input_num_rows = null){

            $this->init_m_sql();
            $sql = "call extension_student_list(".
                (NULL === $input_page_number ? "NULL" : "'". $input_page_number."'").", ".
                (NULL === $input_num_rows   ? "NULL" :"'". $input_num_rows."'").
            ")";
            
            $res = $this->m_query($sql);
            // log_message("info", "Extension student List: {$sql}");

            return $this->process_m_results($res)->get_results();
        }

        function insert_student(
            $id_student = NULL, 
            $hometowns = NULL, 
            $phone = NULL,
            $email =NULL,
            $school =NULL
        ){
            $res = $this->db->query("call extension_student_insert(?,?,?,?,?)",array($id_student, $hometowns, $phone, $email, $school));

            return $this->process_results($res)->get_results();
        }

        function edit_student(    
            $id_student = NULL, 
            $hometowns = NULL, 
            $phone = NULL,
            $email =NULL,
            $school = NULL, 
            $id = NULL, 
        ){

            $res = $this->db->query("call extension_student_update(?,?,?,?,?,?)",array($id_student, $hometowns, $phone, $email, $school, $id));

            return $this->process_results($res)->get_results();
        } 

        function delete_student(
            $id = NULL
        ){
            $res = $this->db->query("call extension_student_delete(?)",array($id));

            return $this->process_results($res)->get_results();
        } 
        
    }