 <?php

use LDAP\Result;

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Default_student extends My_Controller {

        function __construct(){
            parent::__construct();
            
            $this->load->model('Default_model');
        }

  

        public function get_id($id = NULL){
   
            if(!$id) return $this->failed("Missing default id")->render_json();

            $result = $this->Default_model->get_id($id);

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
        
        public function get_list(
            $input_page_number = 1,
            $input_num_rows =  DF_NUM_ROWS 
        ){

            $posting_data = $this->posting_data;

            isset($posting_data['input_page_number'])   && $input_page_number   = $posting_data['input_page_number'];
            isset($posting_data['input_num_rows'])      && $input_num_rows      = $posting_data['input_num_rows'];

            $input_page_number  === "" ? $input_page_number     = 1             : $input_page_number;
            $input_num_rows     === "" ? $input_num_rows        = DF_NUM_ROWS   : $input_num_rows;

            $result = $this->Default_model->get_list($input_page_number, $input_num_rows);  

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

        public function get_name($first_name = NULL){

            $posting_data = $this->posting_data;
            isset($posting_data['first_name']) && $first_name = $posting_data['first_name'];

            $first_name === "" ? $first_name        = NULL      : $first_name;
            
            $result = $this->Default_model->get_name($first_name);
            var_dump($result->data);die();

            if(isset($result->status) && $result->status){
                if(isset($result->total) && $result->total > 0){
                    $this->success()
                            ->set("data", isset($result->data)? $result->data : [])
                            ->set("total", $result->total);
                }
            }
            else{
                $this->failed("No found data");
            }

            return $this->render_json();
        }

        public function insert_student(){
            
            $posting_data = $this->posting_data;

            isset( $posting_data['first_name'] ) && $first_name = $posting_data['first_name'];
            isset( $posting_data['last_name'] ) && $last_name = $posting_data['last_name'];
            isset( $posting_data['age'] ) && $age = $posting_data['age'];
            isset( $posting_data['sex'] ) && $sex = $posting_data['sex'];

            $first_name === "" ? $first_name = "NULL" : $first_name;
            $last_name === ""? $last_name = "NULL" : $last_name;
            $age === null ? $age = null : $age;
            $sex === null ? $sex = null : $sex;

            $result = $this->Default_model->insert_student($first_name, $last_name, $age, $sex);

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

            isset($posting_data['id']) && $id = $posting_data['id'];
            isset( $posting_data['first_name'] ) && $first_name = $posting_data['first_name'];
            isset( $posting_data['last_name'] ) && $last_name = $posting_data['last_name'];
            isset( $posting_data['age'] ) && $age = $posting_data['age'];
            isset( $posting_data['sex'] ) && $sex = $posting_data['sex'];

            $id         === ""      ? $id           = "NULL" : $id ;
            $first_name === ""      ? $first_name   = "NULL" : $first_name;
            $last_name  === ""      ? $last_name    = "NULL" : $last_name;
            $age        === null    ? $age          = "NULL" : $age;
            $sex        === null    ? $sex          = "NULL" : $sex;

            $result = $this->Default_model->edit_student($first_name, $last_name, $age, $sex, $id);

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