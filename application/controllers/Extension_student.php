<?php

defined('BASEPATH') OR exit('No direct script access allowed');

    class Extension_student extends My_Controller {

        public function __construct() {
            parent::__construct();

            $this->load->model('Extension_model');
        }

        public function get_id($id = NULL){
            
            $posting_data = $this->posting_data;

            isset($posting_data['id'])   && $id   = $posting_data['id'];


            $id ==="" ? $id = NULL : $id;

            $result = $this->Extension_model->get_id($id);

            if(isset($result->status) || $result->status){
                
                if(isset($result->total) || $result->status){
                    $this->success()
                            ->set("data", isset($result->data) ? $result->data : [])
                            ->set("total", (int )$result->total);
                }
            }
            else{
                $this->failed($result->error ?? []);
            }

            return $this->render_json();
        }
        
        public function get_list(
            $input_page_number = 1,
            $input_num_rows =  DF_NUM_ROWS 
        ){

            $posting_data = $this->posting_data;

            isset($posting_data['input_page_number'])   && $input_page_number   = $posting_data['input_page_number'];
            isset($posting_data['input_num_rows'])      && $input_num_rows      = $posting_data['input_num_rows'];

            $input_page_number  === "" ? $input_page_number     = 1             : $input_page_number;
            $input_num_rows     === "" ? $input_num_rows        = DF_NUM_ROWS   : $input_num_rows;

            $result = $this->Extension_model->get_list($input_page_number, $input_num_rows);  

            if(isset($result->status) || $result->status) {
                if(isset($result->total) && (int)$result->total > 0) {
                    $this->success()
                                ->set("data", isset($result->data) ? $result->data : [])
                                ->set("page", $input_page_number)
                                ->set("limit", $input_num_rows)
                                ->set("total", (int)$result->total);
                }
            }
            else{

                $this->failed("No records found");
            }
        
            return $this->render_json();
        }

        public function insert_student(){
            
            $posting_data = $this->posting_data;

            isset( $posting_data['id_student'] )    && $id_student  = $posting_data['id_student'];
            isset( $posting_data['home'] )          && $home        = $posting_data['home'];
            isset( $posting_data['phone'] )         && $phone       = $posting_data['phone'];
            isset( $posting_data['email'] )         && $email       = $posting_data['email'];
            isset( $posting_data['school'] )        && $school      = $posting_data['school'];

            $id_student     === ""    ? $id_student   = "NULL" : $id_student;
            $home           === ""    ? $home         = "NULL" : $home;
            $phone          === ""    ? $phone        = "NULL" : $phone;
            $email          === ""    ? $email        = "NULL" : $email;
            $school         === ""    ? $school       = "NULL" : $school;

            $result = $this->Extension_model->insert_student($id_student, $home, $phone, $email, $school);

            if(isset($result->status) || $result->status){
                $this->success()
                            ->set("data", isset($result->data) ? $result->data : [])            
                ;
            }
            else{
                $this->failed($result->error ?? []);
            }

            return $this->render_json();
        }

        public function edit_student(){
            $posting_data = $this->posting_data;

            isset( $posting_data['id_student'] )    && $id_student  = $posting_data['id_student'];
            isset( $posting_data['home'] )          && $home        = $posting_data['home'];
            isset( $posting_data['phone'] )         && $phone       = $posting_data['phone'];
            isset( $posting_data['email'] )         && $email       = $posting_data['email'];
            isset( $posting_data['school'] )        && $school      = $posting_data['school'];
            isset( $posting_data['id'] )            && $id          = $posting_data['id'];

            $id_student     === ""    ? $id_student   = "NULL" : $id_student;
            $home           === ""    ? $home         = "NULL" : $home;
            $phone          === ""    ? $phone        = "NULL" : $phone;
            $email          === ""    ? $email        = "NULL" : $email;
            $school         === ""    ? $school       = "NULL" : $school;
            $id             === ""    ? $id           = "NULL" : $id;

            $result = $this->Extension_model->edit_student($id_student, $home, $phone, $email, $school, $id);

            if(isset($result->status) || $result->status){
                $this->success()
                            ->set("data", isset($result->data) ? $result->data : [])            
                ;
            }
            else{
                $this->failed($result->error ?? []);
            }

            return $this->render_json();
        }

        public function delete_student(
            $id = NULL
        ){
            $result = $this->Extension_model->delete_student( $id);

            if(isset($result->status) && $result->status){
                $this->success()
                                ->set("data", isset($result->data) ? $result->data : []);
            }
            else{
                $this->failed($result->error);
            }

            return $this->render_json();
        }
    }