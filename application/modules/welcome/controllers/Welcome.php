<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends My_Access_Controller
{
    public function index()
    {
        $data =array();
        
        $this->theme->load('welcome', $data);
    }
}

