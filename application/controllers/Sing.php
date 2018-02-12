<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sing extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error" style="color: #fa424a">', '</div>');

        $this->theme->theme('singin')
                ->add_css('login.min.css')
                ->add_css('lib/font-awesome/font-awesome.min.css')
                ->add_css('lib/bootstrap/bootstrap.min.css')
                ->add_css('main.css')
                ->add_js('lib/jquery/jquery.min.js')
                ->add_js('lib/tether/tether.min.js')
                ->add_js('lib/bootstrap/bootstrap.min.js')
                ->add_js('lib/match-height/jquery.matchHeight.min.js')
                ->add_js('app.js')
                ->add_js('plugins.js');
    }

    /**
     * Login to system operations.
     */
    public function in() 
    {
        $data = array();

        if (!$this->aauth->is_loggedin()) 
        {
            $this->form_validation->set_rules('email', t_('Email'), 'trim|required|valid_email',
                    array(
                        'required' => _t('Email musi być wypełniony'),
                        'valid_email' => _t('Podany email jest w niewłaściwiej formie')
            ));
            $this->form_validation->set_rules('password', _t('Hasło'), 'required',
                    array('required' => _t('Hasło jest wymagane.'))
            );
            if (isset($_POST['email']))
            {
                if ($this->form_validation->run() == FALSE) 
                {
                    // Błędna walidacja danych
                } 
                else 
                {
                    if ($this->aauth->login($this->input->post('email'), $this->input->post('password'), $this->input->post('remember'))) 
                    {
                        redirect();
                    } 
                    else 
                    {
                        $this->session->set_flashdata('message', _t('Błędne dane logowania.'));
                        redirect('sing/in');
                    }
                    //$this->session->set_flashdata('message', line('Błędne dane logowania.'));
                    //redirect('sing/in');
                }
            }
        }

        $this->theme->title(line('Logowanie'))->load('in', $data);
    }

    /**
     * Rejestracja użytkownika
     */
    public function up() {
        $data = array();

        if (!$this->aauth->is_loggedin()) 
        {                
            $validation = $this->config->load('validation', TRUE);
            $this->form_validation->set_rules($validation['up']);

            if ($this->form_validation->run() == FALSE) {
                
            } 
            else 
            {
                $errorz;
                if ($this->aauth->create_user($this->input->post('email'), $this->input->post('password'))) 
                {
                    $this->session->set_flashdata('message', ('Witamy. Konto zostało utworzone.'));
                    redirect('');
                } 
                else 
                {
                    $this->session->set_flashdata('message', $this->aauth->errors);
                    redirect('sing/up');
                }
            }

            $this->theme->title(_t('Rejestracja'))->load('up', $data);
        } 
        else 
        {
            $this->session->set_flashdata('message', (_t('Użytkownik on-line. Brak możliwości rejestracji - proszę się wylogować.')));
            redirect('');
        }
    }

    /*
     * Logout
     */

    public function out() {
        $this->aauth->logout();
        redirect();
    }

    public function reset() {
        $data = array();
        $this->form_validation->set_rules('email', _t('Email'), 'trim|required|valid_email',
                array(
                    'required'      => _t('Email musi być wypełniony.'),
                    'valid_email'   => _t('Podany email jest w niewłaściwiej formie.')
        ));
        if ($this->form_validation->run() == FALSE) {
            
        } 
        else 
        {
            $z =  $this->aauth->remind_password($this->input->post('email'));
            if($z) 
            {  
                $this->session->set_flashdata('message', (_t('Przypomnienie zostało wysłane na wskazany email.')));
                redirect();
            }
            else 
            {
               $this->session->set_flashdata('message_information', (_t('Wystąpił błąd zweryfikuj poprawność przypisania hasła.')));
                redirect('sing/reset');
            }
        }
        $this->theme->title(_t('Reset hasła'))->load('reset', $data);
    }
}
    