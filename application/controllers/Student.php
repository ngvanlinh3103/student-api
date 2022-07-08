<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Student extends CI_Controller {

        public function __Construct(){

            parent:: __Construct();
            $this->load->model('Student_model');
        }
        
        public function get_list(){
            $result['student'] = $this->Student_model->get_list();

            echo (json_encode($result));
        }

        public function get_id($id = NULL){
            $result['student'] = $this->Student_model->get_id($id);

            echo(json_encode($result));
        }

    }