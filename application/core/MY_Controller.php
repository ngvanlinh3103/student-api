<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class My_Controller extends CI_Controller {

        private $data               = array();
        private $scripts            = array();
        private $styles             = array();
        private $messages           = array();
        private $errors             = array();
        private $body_classes       = array();
        public $posting_data        = array();
        public $auth_data           = array();
        private $request_params     = array();
        private $token              = "";
        private $key                = "";
        private $format             = "";
        private $has_permission     = TRUE;
        private $full_layout        = FALSE;
        private $layout_no_header   = FALSE;
        private $current_user       = NULL;
        private $current_app        = NULL;
        public $user_id             = NULL;
        
        const SESS_MSG_KEY = "messages";
        const SESS_ERR_KEY = "errors";
        const KEY_CURRENT_LOB = "sess_current_lob";

        private $page_title = "";

        public function __Construct(){

            parent:: __Construct();
            $this->posting_data = $this->get_posting_data();

            $this->load->database();
            header('Content-Type: application/json');
        }
        
        //get post data 
        public function get_posting_data(){
            $posting_data = $this->input->post();
            // format data oject to strings
            if(NULL === $posting_data || empty($posting_data)){
                $raw_data = file_get_contents('php://input');
                if(NULL === $raw_data || empty($raw_data)) return $posting_data;
                $posting_data = json_decode($raw_data, TRUE);
            }

            return $posting_data;
        }

        public function set_format($value = NULL){ 
            $this->format = ($value !== NULL) ? $value : "";

            return $this;
        }

        public function get_format(){
            return $this->format;
        }

        public function show_404(){ return $this->failed("404")->render_json();}

        public function render_json($data = NULL) {

            $this->consolidate_data_json($data);

        $this->$data['api_version'] = API_VERSION;
        }

        private function consolidate_data_json($data = NULL){
            NULL != $data && $this->array_merge($this->$data, $data);

            $this->date['errors'] = $this->get_error();
            $this->date['messages'] = $this->get_messages();
            if(define('SHOW_LOG_DETAILS') && SHOW_LOG_DETAILS){
                $this->date["server"] = $_SERVER;
                $this->date["request"] = $_REQUEST;
                $this->date["post"] = $_POST;
            }

            return $this;
        }

        public function get_error(){

            return $this->errors;
        }

        public function get_messages(){

            return $this->messages;
        }
    
    }
?>