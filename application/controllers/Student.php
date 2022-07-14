<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Student extends My_Controller {

        public function __Construct(){

            parent:: __Construct();
            $this->load->model('Student_model');
            $this->load->model('Default_model');
        }
        
        public function get_list(){
            $result = $this->Student_model->get_list();

            if(isset($result->status) || $result->status){
                
               $this->success()->set("data", isset($result->data) ? $this->Default_model->translate($result->data) : []); 
            }
            
            else{
               $this->failed("No data found");
            }

            return $this->render_json();
        }

        public function get_name($name = NULL){

            $posting_data = $this->posting_data;

            isset($posting_data['name']) && $name = $posting_data['name'];
            $name === "" ? $name = "" : $name;

            $result = $this->Student_model->get_name($name);

            if(isset($result->status) || $result->status){

                if(isset($result->total) && (int)$result->total>0){
                    $this->success()
                            ->set("data", isset($result->data) ? $this->Default_model->translate($result->data) : [])
                            ->set("total", $result->total);
                }
            }else{
                $this->failed("No data found");
            } 

            return $this->render_json();
        }

    }