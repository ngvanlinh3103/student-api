<?php
    class Default_model extends MY_Model{

        function get_id(int $id = NULL){

            $res = $this->db->query("call default_student_getid(?)",array($id));

            return $this->process_results($res)->get_results();
        }

        //list information default student
        function get_list(int $input_page_number = null, int $input_num_rows = null){

            $this->init_m_sql();
            $sql = "call default_student_list(".
                (NULL === $input_page_number ? "NULL" : "'". $input_page_number."'").", ".
                (NULL === $input_num_rows   ? "NULL" :"'". $input_num_rows."'").
            ")";
            
            //using multi when return 2 sql: result want fill and result Total result count 
            $res = $this->m_query($sql);
            log_message("info", "Default student List: {$sql}");

            return $this->process_m_results($res)->get_results();
        }

        //find information default student with name
        function get_name(string $first_name = NULL){

            $this->init_m_sql();
            $sql = "call default_student_get_name(".
                (null === $first_name ? "NULL" : "'". $first_name."'").
            ")";
            
            $res = $this->m_query($sql);
            log_message("info", "Default student Name: {$sql}");

            return $this->process_m_results($res)->get_results();
        }

        function insert_student(
            $first_name = NULL, 
            $last_name = NULL, 
            $age = NULL,
            $sex =NULL
        ){
            $res = $this->db->query("call default_student_insert(?,?,?,?)",array($first_name, $last_name, $age, $sex));

            return $this->process_results($res)->get_results();
        }

        function edit_student(    
            $first_name = NULL, 
            $last_name = NULL, 
            $age = NULL,
            $sex =NULL,
            $id = NULL, 
        ){

            $res = $this->db->query("call default_student_update(?,?,?,?,?)",array($first_name, $last_name, $age, $sex, $id));

            return $this->process_results($res)->get_results();
        } 

        function delete_student(
            $id = NULL
        ){
            $res = $this->db->query("call default_student_delete(?)",array($id));

            return $this->process_results($res)->get_results();

        } 

        public function translate($data = NULL)
        {
            foreach ($data as $key => $s) :
                $data[$key] = $this->translate_single($s);
            endforeach;
    
    
            return $data;
        }

        public function translate_single($s = NULL)
        {
            if(gettype($s) === "object"){
                $s = (array)$s;
            }
        
            isset($s['sex']) && $s['sex_text'] = $this->config->item("gender")[$s['sex']] ?? "";
    
            return $s;
    
        }
        
    }