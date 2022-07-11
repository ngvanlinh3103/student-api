<?php
    class Default_model extends CI_Model{

        public function get_all($start, $page_size)
        {
            $this->db->limit($start, $page_size);

            $query = $this->db->get('default_student');

            return $query;
        }

        public function get_by_id($name)
        {
            $query = $this->db->get_where('default_student', ['name => $name']);

            return $query;
        }

        public function insert($data)
        {
            return $this->db->insert('default_student', $data);
        }

        public function edit($id, $data)
        {
            $this->db->where('id', $id);

            return $this->db->update('default_student',$data);
        }

        public function delete($id){
            $this->db->where('id', $id);

            return $this->db->delete('default_student');
        }

        /* function get_list(){

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

        function edit_student(
            $id = NULL, 
            $first_name = NULL, 
            $last_name = NULL, 
            $age = NULL,
            $sex =NULL
        ){
            $this->db->query("call default_student_update(?,?,?,?,?)",array($first_name, $last_name, $age, $sex, $id));

        } 

        function delete_student(
            $id = NULL
        ){
            $this->db->query("call extension_student_delete(?)",array($id));

        } */
    }