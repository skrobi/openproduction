<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Access_Controller extends My_Controller 
{
    public $need_be_login;
    
    public function __construct() 
    {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
        $this->set_js_openproduction();
        
        if($this->need_be_login)
        {
            if($this->aauth->is_loggedin() == false)
            {
                redirect('sing/in');
            }
        }
    }
    
    public function _is_allowed($perm)
    {
        if(!$this->aauth->is_allowed($perm)) 
        {
            $this->session->set_flashdata('message', _t('Brak uprawnień dla dostępu: '.$perm));
            redirect('process/nopermission');
        }
    }
    
    public function set_js_openproduction()
    {
        $this->theme
            
            ->add_css('lib/lobipanel/lobipanel.min.css')
            ->add_css('lib/lobipanel/lobipanel.min.css')
            ->add_css('separate/vendor/lobipanel.min.css')
            ->add_css('lib/jqueryui/jquery-ui.min.css')
            ->add_css('separate/pages/widgets.min.css')
            ->add_css('lib/font-awesome/font-awesome.min.css')
            ->add_css('lib/bootstrap/bootstrap.min.css')  
            ->add_css('main.css')
                
                
            ->add_js('lib/jquery/jquery.min.js','common')
            
            ->add_js('lib/tether/tether.min.js')
            ->add_js('lib/bootstrap/bootstrap.min.js')
            ->add_js('plugins.js')

            ->add_js('lib/jqueryui/jquery-ui.min.js')
            ->add_js('lib/lobipanel/lobipanel.min.js')
            ->add_js('lib/match-height/jquery.matchHeight.min.js')
            
            ->add_js('app.js');
    }
}

