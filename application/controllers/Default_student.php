 <?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Default_student extends CI_Controller {

        public function __Construct(){

            parent:: __Construct();
            // $this->load->database();
            $this->load->model('Default_model');
        }
        
        public function get_list()
        {
            $id = $this->input->get('id');
            if(!empty($id)){
                $data = this->Default_model->get_by_id($id);

                if($data){
                    $res('error') = true;
                    $res('massage') = 'success get data by id';
                    $res('data') = $data;

                }
                else{
                    $res('error') = false;
                    $res('massage') = 'failed get data';
                    $res('data') = '';
                }
            }
            else{
                $pagenum = $this->input->get('pasgenum') ? $this->input->get('pagenum'): '0';
                $pagesize = $this->input->get('pagesize') ? $this->input->get('pagesize'): '0';

                $data = $this->Default_model->get_all($pagenum,$pagesize);

                if($data){
                    $res('error') = true;
                    $res('massage') = 'success get data by id';
                    $res('data') = $data;

                }
                else{
                    $res('error') = false;
                    $res('massage') = 'failed get data';
                    $res('data') = '';
                }
            }

            $this->response($res, 200);
        }

        /*public function get_list(){
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

        public function edit_student(
            $first_name = NULL,
            $last_name = NULL, 
            $age = NULL,
            $sex = NULL,
            $id = NULL
        ){
            $this->Default_model->edit_student($first_name, $last_name, $age, $sex, $id);
            $result['student'] = $this->Default_model->get_name($first_name);

            echo(json_encode($result));
        }

        public function delete_student(
            $id = NULL
        ){
            $this->Default_model->delete_student( $id);
            $result['student'] = $this->Default_model->get_list();

            echo(json_encode($result));
        }*/

    }
?>