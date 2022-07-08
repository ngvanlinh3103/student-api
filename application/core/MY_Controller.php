<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller{

    private $data               = array();
    private $scripts            = array();
    private $styles             = array();
    private $messages           = array();
    private $errors             = array();
    private $full_layout        = FALSE;
    private $layout_no_header   = FALSE;
    private $current_user       = NULL;
    private $current_app       = NULL;
    private $body_classes       = array();
    public $posting_data        = [];
    public $auth_data           = [];
    private $token              = "";
    private $key                = "";
    public $user_id             = NULL;
    private $has_permission     = TRUE;

    private $format             = "";
    private $request_params     = array();



    const SESS_MSG_KEY = "messages";
    const SESS_ERR_KEY = "errors";
    const KEY_CURRENT_LOB = "sess_current_lob";

    private $page_title = "";

    public function __construct(){

        parent::__construct();
        $this->posting_data = $this->get_posting_data();
        $this->page_title = META_DEFAULT_PAGE_TITLE;

        $this->check_token();

        $this->load->driver('cache', array('adapter' => 'redis', 'backup' => 'file'));


    } // end of construction

    public function show_404(){return $this->failed("404")->render_json();}
    public function do_404(){return $this->failed("404")->render_json();}

    public function set_format($value = NULL){ $this->format = ($value !== NULL ? $value : ""); return $this; }
    public function get_format() {return $this->format;}


    // get generic text
    public function get_lang_text($_text, $data = NULL){
        $this->load->helper("language");
        $this->lang->load("general");
        $the_text = $this->lang->line($_text);
        FALSE === $the_text && $the_text = $_text;
        preg_match('/\%[ds]/', $the_text) && 
            NULL !== $data &&
            $the_text = vsprintf($the_text, $data);

        return $the_text;
    } //


    // function set
    public function set($key, $value){
        $this->data[$key] = $value;
        return $this;
    } ///


    // function set data
    public function set_params($_data){
        if(is_array($_data) && !empty($_data))
            $this->data = array_merge($this->data, $_data);

        return $this;
    } // end of function set data


    // function get
    public function get($key){
        if(isset($this->data[$key])) return $this->data[$key];
        return false;
    } // end of function get


    // getting complete object
    public function get_params(){return $this->data;}



    public function get_messages(){
        return $this->messages;
    }

    public function get_formatted_messages(){
        $the_messages = $this->get_messages();
        $msg_template = array();
        if(!empty($the_messages)):
            foreach($the_messages as $single_message):
                $msg_template[] = "<p class='message green'> {$single_message}</p>";
            endforeach;

            return implode("", $msg_template);

        endif;
        return "";
    }

    public function get_errors(){
        return $this->errors;
    }

    public function get_formatted_errors(){

        $errors = $this->get_errors();

        $err_template = array();

        if(!empty($errors)):

            foreach($errors as $single_error):
                $err_template[] = "<p class='message red'>{$single_error}</p>";
            endforeach;

            return implode("", $err_template);

        endif;

        return "";

    }//




    // accessing current user
    public function get_current_user(){
        return $this->current_user;
    }

    // 
    // accessing current app
    public function get_current_app(){
        return $this->current_app;
    }

    public function get_user_id(){
        return $this->user_id;
    }

    // function to look up the language file
    // and see if there is any key lang
    public function _msg($message, $data = null){

        $this->lang->load("messages");
        $the_message = $this->lang->line($message);

        if(false !== $the_message):
            $message = vsprintf($the_message, $data === null ? array(): $data);
        endif;


        return $message;

    } //


    // using session to maintain message and error
    public function set_message($message, $data = null){

        $this->lang->load("messages");
        if(is_array($message)):
            foreach($message as $single_message):
                $this->messages[] = $this->_msg($single_message, $data);
            endforeach;
        else:
            $this->messages[] = $this->_msg($message, $data);
        endif;

        return $this;

    } // end of function set message

    // set error
    public function set_error($message, $data = null){

        $this->lang->load("error_messages");

        if(is_array($message)):
            foreach($message as $single_message):
                $this->errors[] = $this->get_error($single_message, $data);
            endforeach;
        else:
            $this->errors[] = $this->get_error($message, $data);
        endif;

        return $this;

    }// end of function set error


    // get the error message
    public function get_error($message, $data = null){

        $this->lang->load("error_messages");

        $the_message = $this->lang->line($message);

        if(false !== $the_message):
            $message = vsprintf($the_message, $data ?? []);
        endif;

        return vsprintf($message, $data ?? []);

    }// end of function set error



    // render json
    public function render_json($data = NULL){

        $this->consolidate_data_json($data);


        // $this->data['api_version'] = API_VERSION;
        // $this->data['assets_version'] = ASSETS_VERSION;
        // $this->data['app_version'] = APP_VERSION;

        if("cli" === php_sapi_name()):

            if(!empty($this->data['errors']))       echo cli_color("red", implode(". ", $this->data['errors'])) . PHP_EOL;
            if(!empty($this->data['messages']))     echo cli_color("green", implode(". ", $this->data['messages'])) . PHP_EOL;

            echo "Return type: " . gettype($this->data) . PHP_EOL;

            echo json_encode($this->data, JSON_PRETTY_PRINT);

            exit();

        endif;

        $this
            ->output
            ->set_status_header($this->data['code'] ?? 200)
            ->set_header("Access-Control-Allow-Origin: *")
            ->set_header("Access-Control-Allow-Headers: *")
            ->set_content_type("application/json")
            ->set_output(json_encode($this->data))
            ->_display();

        exit();

    } // end of rendering json


    private function consolidate_data_json($data = NULL){

        NULL !== $data  && 
            $this->data = array_merge($this->data, $data);

        $this->data["errors"] = $this->get_errors();
        $this->data["messages"] = $this->get_messages();
        if(defined("SHOW_LOG_DETAILS") && SHOW_LOG_DETAILS):
            $this->data["server"] = $_SERVER;
            $this->data["request"] = $_REQUEST;
            $this->data["post"] = $_POST;
        endif;

        return $this;

    } // end of consolidation

    public function is_resting(){ return isset($_SERVER['HTTP_SENDING_METHOD']) && "resting" === $_SERVER['HTTP_SENDING_METHOD']; }
    public function is_posting(){ return "POST" === $_SERVER['REQUEST_METHOD'];}

    public function failed($message = NULL){ $this->data['status'] = FALSE; NULL !== $message && $this->set_error($message); return $this; }
    public function success($message = NULL){ $this->data['status'] = TRUE; NULL !== $message && $this->set_message($message); return $this; }

    public function get_posting_data(){
        $posting_data = $this->input->post();

        if(NULL === $posting_data || empty($posting_data)):
            $raw_data = file_get_contents('php://input');
            if( NULL === $raw_data || empty($raw_data)) return $posting_data;
            $posting_data = json_decode($raw_data, TRUE);
        endif;

        if(!empty($posting_data)):
            foreach($posting_data as $k => $value):
                if(!preg_match('/^input_/', $k)):
                    $posting_data["input_{$k}"] = $value;
                endif;
            endforeach;
        endif;

        return $posting_data;
    }

    public function  reset_request_params(){
        $this->load->helpers('url');
        $this->request_params = $this->input->get();
        return $this;
    }

    public function add_uri_param($key = NULL, $value = NULL)   {
        if(NULL === $value || NULL === $key) return $this;
        $this->request_params[$key] = $value;
        return $this;
    }



    public function has_permission(){ return $this->has_permission === TRUE; }

    public function no_permission($message = NULL){ 

        $this->has_permission = FALSE; 
        return $this->failed($message ?? "permission_denied")->render_json(); 

    } // function return no permission


    public function check_key_valid(){
        $header_keys =  getallheaders(); 

        $token = $header_keys['HTTP_TOKEN'] ?? NULL;  
        $api_key = $header_keys['HTTP_API_KEY']   ?? NULL; 
     
        if(empty($token) && NULL === $token || empty($api_key) && NULL === $api_key){
            return $this->no_permission("Missing token or Missing api key ");
        }

        $result = $this->check_key($token,$api_key); 

        if($result){
            return $this;
        }
    }


    public function check_key($token,$api_key){
        $this->load->model("Application_model","application");

        if(empty($token) || empty($api_key)){
            return $this->no_permission("Invalid token or Invalid api key ");
        }

        $res = $this->application->authenticate($token,$api_key);


        if(!isset($res->status) && !$res->status){
            return $this->no_permission("permission_denied");
        }

        if(isset($res->data[0]->status) && (int)$res->data[0]->status === STATUS_ACTIVE ){
            return true;
        }else{
            return $this->no_permission("permission_denied");
        }


    }

    public function check_token() { 

        $this->load->model("Application_model", "application_model");
        $this->load->model("Application_capability_model", "app_cap_model");
        $this->load->model("User_model", "user_model");

        $posting_data = $this->posting_data; 


        isset($posting_data['app_key']) && !isset($posting_data['application_key']) && $posting_data['application_key']  =  $posting_data['app_key'];

        isset($posting_data['app_token']) && !isset($posting_data['application_token']) && $posting_data['application_token']  =  $posting_data['app_token'];

        $input_key = $posting_data['application_key'] ?? NULL;
        $input_token = $posting_data['application_token'] ?? NULL;

        // Adding support for cli
        if("cli" === php_sapi_name()):
            $s_key = $_SERVER['PT_APP_KEY'] ?? NULL;
            $s_token = $_SERVER['PT_APP_TOKEN'] ?? NULL;
            NULL ===$input_key && $input_key = $s_key;
            NULL ===$input_token && $input_token = $s_token;

            if(NULL === $input_key) $input_key = readline(cli_color("blue", "Application Key: "));
            empty($input_key) && $input_key = NULL;
            if(NULL === $input_token) $input_token = readline(cli_color("blue", "Application Token: "));
            empty($input_token) && $input_token = NULL;
        endif;

        if(!isset($input_key) || NULL === $input_key) return $this->failed("Application Key is Required")->render_json();
        if(!isset($input_token) || NULL === $input_token) return $this->failed("Application Token is Required")->render_json();
        
        $res = $this->application_model->authenticate(
            $input_token,
            $input_key
        );

        if(!isset($res->status) && !$res->status){
            return $this->no_permission("permission_denied");
        }

        if(!isset($res->data[0]->status) || STATUS_ACTIVE !== (int)$res->data[0]->status):
            return $this->no_permission("permission_denied");
        endif;

      
        $this->auth_data = $res->data[0];
        $this->token = $input_token;
        $this->key = $input_key;
        $id_application = $res->data[0]->id;

        $application_detail = $this->application_model->get( $id_application );

        if(FALSE  === ($application_detail->status ?? FALSE)) return $this->no_permission();

        $this->current_app = $application_detail->data[0];

        $id_user = $application_detail->data[0]->id_user; 
        !empty($id_user) && $user = $this->user_model->get((int)$id_user);

        if(!$user->status) return $this->no_permission("permission_denied"); 

        $this->current_user = $user->data[0];
        $this->user_id = $id_user;

        return true;


    }// check token


    /*
     * @description: function to verify action permission against caps
     * of current application
     * @return: boolean
     * */
    public function can(string $input_action = NULL){
        if(NULL === $input_action) return FALSE;
        if(NULL === $this->current_app) return FALSE;
        return strpos($this->current_app->caps, $input_action) !== FALSE;
    } // 
}
