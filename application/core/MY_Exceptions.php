<?php
class MY_Exceptions extends CI_Exceptions{
    public function __construct(){parent::__construct();}
    // public function show_404($page = ''){ $ci = & get_instance(); $ci->load->view("errors/errors_404"); $echo $ci->output->get_output(); exit; } 
}
