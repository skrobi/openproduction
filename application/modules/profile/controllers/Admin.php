<?php

/**
  Zarzadzanie profilami user�w. Przypisywanie im uprawnie� jak r�wnie� edycja parametr�w.
  @todo: Uprawnienia, edycja parametrów, blokowanie

 **/

class Admin extends My_Access_Controller {

    private $module_rule = array(
        array(
            'field'  => 'module_name',
            'label'  => 'Systemowa nazwa modułu',
            'rules'  => 'required|min_length[3]',
            'errors' => array(
                'required'  => 'Pole %s musi być wypełnione.'
                , 'length'    => 'Minimum 3 znaki.'
                , 'is_unique' => 'Grupa o podanej nazwie istnieje.')
        ),
        array(
            'field'  => 'definition',
            'label'  => 'Definicja',
            'rules'  => 'required',
            'errors' => array(
                'required' => 'Pole %s jest wymagane.'
            )
    ));
    
    public function users() {
        $data = array();

        $this->load->helper('table');

        if (!isset($id))
        {
            $data['users'] = $this->aauth->list_users();
            $this->theme->load('listusers', $data);
        }
    }
    public function add()
    {
        $this->load->helper('formboot');
        $this->load->library('form_validation');
        
        $this->theme->load('add_profile');
    }

}
