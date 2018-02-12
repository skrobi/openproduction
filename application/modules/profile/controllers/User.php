<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends My_Access_Controller


{
    public function __construct() {
        parent::__construct();
        
        $this->theme->add_css('separate/pages/profile.min.css');
    }

    public function index()
    {
        $data =array();
        
        $this->load->model('Users_model');
        $u = new Users_model();
        $r = $u->getAll();
        $this->theme->load('profile', $data);
        
        
    }
}

