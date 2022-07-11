 <?php

use LDAP\Result;

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Default_student extends My_Controller {

        public function __Construct(){

            parent:: __Construct();
            // $this->load->database();
            $this->load->model('Default_model');
            // header('Content-Type: application/json');
        }
        
        public function get_list(){
            $result['student'] = $this->Default_model->get_list();
            
            if($result){
                $res['error'] = true;
                $res['message'] = 'success get data';
                $res['data'] = $result;
            }
            else{
                $res['error'] = false;
                $res['message'] = 'not find data';
                $res['data'] = '';
            }

            echo (json_encode($res));
        }


        public function get_id($id){
            $count = $this->Default_model->get_id($id);

            echo (json_encode($count));
        }


        public function get_name(){
            $first_name = $this->input->post('first_name');

            if(!empty($first_name)){
                $result = $this->Default_model->get_name($first_name);

                if($result){
                    $res['error'] = false;
                    $res['message'] = 'success get data by name';
                    $res['data'] = $result;
                }
                else{
                    $res['error'] = true;
                    $res['message'] = 'not find get data by name';
                    $res['data'] = '';
                }
            }
            else{
                $result['student'] = $this->Default_model->get_list();

                if($result){
                    $res['error'] = false;
                    $res['message'] = 'success get data';
                    $res['data'] = $result;
                }
                else{
                    $res['error'] = true;
                    $res['message'] = 'not find data';
                    $res['data'] = '';
                }
            }

            echo(json_encode($res));
        }

        public function insert_student(){
            
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $age = $this->input->post('age');
            $sex =$this->input->post('sex');
        
            $this->Default_model->insert_student($first_name, $last_name, $age, $sex);
            $result['student'] = $this->Default_model->get_name($first_name);

            echo(json_encode($result));
        }

        public function edit_student( ){
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $age = $this->input->post('age');
            $sex = $this->input->post('sex');
            $id = $this->input->post('id');
            
            if(!empty($id)){

                if($this->Default_model->get_id($id)){
                    $this->Default_model->edit_student( $first_name, $last_name, $age, $sex, $id);

                    $res['error'] = false;
                    $res['message'] = 'success edit data';
                    // $res['data'] = $this->Default_model->get_id($id);
                }
                else{
                    $res['error'] = true;
                    $res['message'] = 'false edit data';
                    $res['data'] = '';
                }
            }else{
                $result['student'] = $this->Default_model->get_list();

                if($result){
                    $res['error'] = false;
                    $res['message'] = 'success get data';
                    $res['data'] = $result;
                }
                else{
                    $res['error'] = true;
                    $res['message'] = 'not find data';
                    $res['data'] = '';
                }
            }

            echo(json_encode($res));
        }

        public function delete_student(
            $id = NULL
        ){
            $result = $this->Default_model->delete_student( $id);

            if($result){
                $res['error'] = true;
                $res['message'] = 'success delete';
                $res['data'] = $this->Default_model->get_list();
            }
            else{
                $res['error'] = false;
                $res['message'] = 'not find id for delete';
                $res['data'] = $this->Default_model->get_list();
            }

            echo(json_encode($res));
        }
        
    }
?>