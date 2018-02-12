<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Profile extends My_Access_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->theme->add_css('separate/vendor/select2.css');
    }

    public function users() {
        $data = array();
        $this->theme->load('profile_users_list', $data);
    }

    /**
     * Sending information to table 
     * @return JSON Return list of users in JSON
     */
    public function json_get_users() {
        $response = $this->aauth->list_users();
        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response))
                ->_display();
        exit;
    }

    public function user($user_id) {
        $user_id = (int) $user_id;
        $user = $this->aauth->get_user($user_id);
         $this->load->library('form_validation');
         
        $data = array();

        if ($user) 
        {
            $this->load->helper('formboot');
            $data['user'] = $user;
            $data['user_id'] = $user_id;
            
            /**
             * Weryfikacja zakładki pierwszej - danych podstawowych, tj. username, email.
             * Pole email niezmienne z racji wymaganina logowania
             */
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST' and $this->input->post('action') == 'core_edit') 
            {
                $this->form_validation->set_rules('username', _t('Username'), 'required');

                if ($this->form_validation->run() == FALSE) 
                { }
                else
                {
                    $z = $this->aauth->update_user($user_id, $this->input->post('email'), null, $this->input->post('username'));
                    if ($z === TRUE) 
                    {
                        $this->session->set_flashdata('message', _t('Wprowadzono zmiany.'));
                        redirect('core/profile/user/' . $user_id);
                    }
                    
                }   
            }
            
            /**
             * Reset hasła przez osobę posiadającą uprawnienia.
             */
            if ($_SERVER['REQUEST_METHOD'] === 'POST' and $this->input->post('action') == 'password_edit')
            {
                $this->form_validation->set_rules('password', 'Hasło', 'required');
                $this->form_validation->set_rules('password_confirm', 'Potwierdzenie hasła', 'required|matches[password]');
                
                if ($this->form_validation->run() == FALSE) {} else
                {
                    $z = $this->aauth->update_user($user_id, null, $this->input->post('password'));
                    if ($z === TRUE) 
                    {
                        $this->session->set_flashdata('message', _t('Wprowadzono zmiany.'));
                        redirect('core/profile/user/' . $user_id);
                    }
                }
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST' and $this->input->post('action') == 'add_group_to_user')
            {
                $z = $this->aauth->add_member($user_id, (int)$this->input->post('group_selected'));
                if ($z === TRUE) 
                {
                    $this->session->set_flashdata('message', _t('Wprowadzono zmiany.'));
                    redirect('core/profile/user/' . $user_id);
                }
            }
        } else {
            $this->session->set_flashdata('message_information', _t('Nie zidentyfikowano użytkownika o takim numerze #ID.'));
            redirect('core/profile/users');
        }

        $this->theme->load('profile_user_manage', $data);
    }
    
    public function ajax_get_user_group($user_id)
    {
        $response = $this->aauth->get_user_groups($user_id);
        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response))
                ->_display();
        exit;
    }
    
    
    public function ajax_get_group()
    {

        $groups = $this->aauth->list_groups($this->input->get('q'));
        $data = array();
        foreach ($groups as $k)
        {
            $data['results'][] = array('id' => $k->id, 'text' => $k->name);
        }
        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
    }
}
