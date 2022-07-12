<?php

use function PHPSTORM_META\map;

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
            // format data object to strings
            if(NULL === $posting_data || empty($posting_data)){
                $raw_data = file_get_contents('php://input');
                if(NULL === $raw_data || empty($raw_data)) return $posting_data;
                $posting_data = json_decode($raw_data, TRUE);
            }

            if(!empty($posting_data)) {
                foreach($posting_data as $key => $value) {
                    if(!preg_match('/^input_/', $key)) {
                        $posting_data["input_{$key}"] = $value;
                    }
                }   
            }

            return $posting_data;
        }

        public function set_format($value = NULL){  $this->format = ($value !== NULL) ? $value : ""; return $this;}
        public function get_format(){return $this->format;}

        //set key and value to array "data"
        public function set($key, $value){
            $this->data[$key] = $value;
            
            return $this;
        }
        public function get($key){
            if(isset($this->data[$key])) return $this->data[$key];
            return false;
        }

        //set if data is array and not empty merge data array 
        public function set_params($data){
            if(is_array($data) && !empty($data))
            $this->data = array_merge($this->data, $data);

            return $this;
        }
        public function get_params(){
            return $this->data;
        }

        public function show_404(){ return $this->failed("404")->render_json();}

        public function failed($messages = NULL){ 
            $this->data['status'] = false;
            NULL !== $messages && $this->set_error($messages); 
            return $this;
        }
        public function success($messages = NULL){
            $this->data['status'] = true;
            NULL!== $messages && $this->set_message($messages);
            return $this;
        }

        //get error messages
        public function get_error($message, $data = null){

            $this->lang->load('error_messages');

            $the_message = $this->lang->line($message);

            if(false !== $the_message){
                $message = vsprintf($the_message, $data ?? []);
            }

            return vsprintf($message, $data ?? []);
        }
        // set the errors message
        public function set_error($message, $data = NULL){
            
            $this->lang->load("error_messages");

            if(is_array($message)){
                foreach($message as $key) {
                    $this->errors[] = $this->get_error($key, $data);
                }
            }
            else{
                $this->errors[] = $this->get_error($message, $data);
            }

            return $this;
        }
        //set message use array errors
        public function set_message($message, $data = NULL){
            
            $this->lang->load("messages");
            if(is_array($message)){
                foreach($message as $key){
                    $this->messages[] = $this->_msg($key, $data);
                }
            }else{
                $this->messages[] = $this->_msg($message, $data);
            }

            return $this;
        }
        
        public function _msg($message, $data = null){

            $this->lang->load("messages");
            $the_message = $this->lang->line($message);

            if(false !== $the_message){
                $message = vsprintf($the_message, $data === null ? array(): $data);
            }

            return $message;
        }

        public function render_json($data = NULL) {

            $this->consolidate_data_json($data);
            if("cli" == php_sapi_name()){
                if(!empty($this->data['errors']))   echo cli_color("Red", implode('. ', $this->data['errors'])) . PHP_EOL;
                if(!empty($this->data['messages'])) echo cli_color("green", implode('. ', $this->data['messages'])) . PHP_EOL;
                
                echo "Return type: " . gettype($this->data) . PHP_EOL;
                echo json_encode($this->$data, JSON_PRETTY_PRINT);
                
                exit();
            }
            $this
                ->output
                ->set_status_header($this->data['code'] ?? 200)
                ->set_header("Access-Control-Allow-Origin: *")
                ->set_header("Access-Control-Allow-Headers: *")
                ->set_content_type("application/json")
                ->set_output(json_encode($this->data))
                ->_display();
            exit();
        }

        private function consolidate_data_json($data = NULL){
            NULL != $data && $this->data = array_merge($this->$data, $data);

            $this->date['errors'] = $this->get_errors();
            $this->date['messages'] = $this->get_messages();
            if(defined("SHOW_LOG_DETAILS") && SHOW_LOG_DETAILS){
                $this->date["server"] = $_SERVER;
                $this->date["request"] = $_REQUEST;
                $this->date["post"] = $_POST;
            }

            return $this;
        }

        public function get_errors(){

            return $this->errors;
        }

        public function get_format_errors(){
            $errors = $this->get_errors();
            $err_template = array();

            if(!empty($errors)){
                foreach ($errors as $error) {
                    $err_template[] = "<p class='message red'>{$error}</p>";
                }
                return implode("", $err_template);
            }
            return "";
        }

        public function get_messages(){

            return $this->messages;
        }
        
        public function get_format_messages(){
            $the_messages = $this->get_messages();
            $msg_template = array();

            if(!empty($the_messages)){
                foreach($the_messages as $message){
                    $msg_template[] = "<p class='message green'>{$message}</p>";
                }
                return implode("", $msg_template);
            }
            return "";
        }

        public function can(string $input_action = null){
            if(null === $input_action) return false;
            if(null === $this->current_app) return false;

            return strpos($this->current_app->caps, $input_action) !== false;
        }

    }
?>