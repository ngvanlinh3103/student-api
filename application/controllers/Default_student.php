<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Default_student extends CI_Controller {

        public function __Construct(){

            parent:: __Construct();
            // $this->load->database();
            $this->load->model('Default_model');
        }
        
        public function get_list(){
            $result['student'] = $this->Default_model->get_list();

            echo (json_encode($result));
        }

        public function get_name($name = NULL){
            $result['student'] = $this->Default_model->get_name($name);

            echo(json_encode($result));
        }

        public function insert_student(
            $first_name = NULL,
            $last_name = NULL, 
            $age = NULL,
            $sex =NULL
        ){
            $this->Default_model->insert_student($first_name, $last_name, $age, $sex);
            $result['student'] = $this->Default_model->get_name($first_name);

            echo(json_encode($result));
        }
    }