<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends My_Access_Controller {

    /**
     * @var string Walidacja parametrów dla zakładania grupy 
     */
    public $group_validation_rule = array();

    /**
     *
     * @var string Rules for validation of new permission 
     */
    public $permission_validation_rule = array(
        array(
            'field'  => 'name',
            'label'  => 'Uprawnienie',
            'rules'  => 'required|min_length[5]|is_unique[aauth_groups.name]',
            'errors' => array(
                'required' => 'Pole %s musi być wypełnione.'
            ),
            array(
                'field'  => 'definition',
                'label'  => 'Definicja',
                'rules'  => 'required',
                'errors' => array(
                    'required' => 'Wymagany opis i przeznaczenie grupy.'
                )
            ),
            array(
                'field'  => 'module_id',
                'label'  => 'Moduł',
                'rules'  => 'required',
                'errors' => array(
                    'required' => 'Wymagane przypisanie do modułu'
                )
            )
        )
    );

    public function __construct() 
    {
        parent::__construct();
        $this->group_validation_rule = array(
            array(
                'field'  => 'name',
                'label'  => _t('Grupa'),
                'rules'  => 'required|min_length[5]',
                'errors' => array(
                    'required'    => _t('Pole %s musi być wypełnione.')
                    , 'length'    => _t('Wymagane minimum 5 znaków.')
                    , 'is_unique' => _t('Grupa o podanej nazwie istnieje.'))
            ),
            array(
                'field'  => 'definition',
                'label'  => 'Definicja',
                'rules'  => 'required',
                'errors' => array(
                    'required' => _t('Pole %s musi być wypełnione.')
                )
        ));
    }


    /**
     * Display of all avalible groups
     */
    public function groups() {
        $b[] = array('href' => site_url('auth/admin/groups'), 'name' => _t('Grupy'));
        $this->get_breadcrumb(_t('Grupy uprawnień'), $b);

        $this->load->helper('table');
        $data = array();

        $data['groups'] = $this->aauth->list_groups();
        $this->theme->load('groups', $data);
    }

    /**
     * Dodawanie grup autoryzacyjnych bez definiowania użytkowników
     * Panel administracyjny
     */
    public function groupadd() {
        $this->load->helper('formboot');
        $this->load->library('form_validation');

        $this->form_validation->set_rules($this->group_validation_rule);

        $b[] = array('href' => site_url('auth/admin/groups'), 'name' => _t('Grupy'));
        $b[] = array('href' => '', 'name' => _t('Dodawanie grupy'));
        $this->get_breadcrumb(_t('Dodawanie grupy uprawnień'), $b);

        if ($this->form_validation->run() == FALSE)
        {
            $this->theme->load('groupadd');
        }
        else
        {
            if ($this->aauth->create_group($this->input->post('name'), $this->input->post('definition')) !== FALSE)
            {
                $this->session->set_flashdata('message', _t('Grupa została dodana.'));
                redirect('auth/admin/groups');
            }
            else
            {
                $this->session->set_flashdata('message', _t('Grupa nie została dodana.'));
                redirect('auth/admin/groupadd');
            }
        }
        $this->theme->load('groupadd');
    }

    public function groupedit($id) {
        $id = (int) $id;

        $b[] = array('href' => site_url('auth/admin/groups'), 'name' => _t('Grupy'));
        $b[] = array('href' => site_url('auth/admin/groupedit/' . $id), 'name' => _t('Edycja grupy'));

        if (is_int($id) and $id > 0)
        {
            $group = $this->aauth->get_group($id);
            $this->get_breadcrumb(_t('Edycja grupy uprawnień <strong>%s</strong>', null, array($group->name)), $b);
            if ($group == FALSE)
            {
                $this->session->set_flashdata('message', _t('Brak grupy.'));
                redirect('auth/admin/groups');
            }
            $data['group'] = $group;

            $this->load->helper('formboot');
            $this->load->library('form_validation');

            $this->group_validation_rule[0]['rules'] = 'required|min_length[5]';

            if ($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                if ($this->input->post('formType') == 'edit')
                {
                    $this->form_validation->set_rules($this->group_validation_rule);

                    if ($this->form_validation->run() == FALSE)
                    {
                        // nie przeszło validacji
                    }
                    else
                    {
                        if ($this->aauth->update_group($id, $this->input->post('name'), $this->input->post('definition')))
                        {
                            $this->session->set_flashdata('message', _t('Zmiany zostały wprowadzone.'));
                            redirect('auth/admin/groups');
                        }
                    }
                }
                else if ($this->input->post('groupId') == $id)
                {
                    if ($this->aauth->delete_group($id))
                    {
                        $this->session->set_flashdata('message', _t('Grupa została usunięta.'));
                        redirect('auth/admin/groups');
                    }
                    else
                    {
                        $this->session->set_flashdata('message', _t('Nie można usunąć grupy.'));
                        redirect('auth/admin/groupedit/' . (int) $id);
                    }
                }
            }
            $this->theme->load('groupedit', $data);
        }
        else
        {
            $this->session->set_flashdata('message', line('błędne parametry na wejściu.'));
            redirect('auth/admin/groups');
        }
    }

    /**
     * Lista rol danego modułu
     */
    public function permissions() {
        $this->load->helper('table');

        $b[] = array('href' => site_url('auth/admin/permissions'), 'name' => _t('Uprawnienia'));
        $this->get_breadcrumb(_t('Uprawnienia'), $b);

        $perm      = $this->aauth->list_perms();
        $permmison = array();

        foreach ($perm as $o)
        {
            $permmison[$o->module_name][] = $o;
        }

        $data['permmison'] = $permmison;

        $this->theme->load('permissions', $data);
    }

    public function permissionadd($module_id = 0) {
        $b[] = array('href' => site_url('auth/admin/permissions'), 'name' => _t('Uprawnienia'));
        $this->get_breadcrumb(_t('Dodanie uprawnień'), $b);

        $data = array();
        $this->load->model('Module_model');
        $this->load->helper('formboot');
        $this->load->library('form_validation');

        $module_id = (int) $module_id;

        $this->form_validation->set_rules($this->permission_validation_rule);

        $modules         = new Module_model();
        $m               = $modules->get_all();
        $list_of_modules = array();

        foreach ($m as $v)
        {
            $list_of_modules[$v->module_id] = $v->module_name;
        }

        $data['selected_module_id'] = $module_id;
        $data['modules']            = $list_of_modules;


        if ($_SERVER['REQUEST_METHOD'] == 'POST' and (int) $this->input->post('module_id'))
        {

            if ($this->form_validation->run() == FALSE)
            {
                
            }
            else
            {
                if ($this->aauth->create_perm($this->input->post('name'), $this->input->post('definition'), $this->input->post('module_id')))
                {
                    //dodano
                    $this->session->set_flashdata('message', _t('Dodano uprawnienie.'));
                    redirect('auth/admin/permissions');
                }
                else
                {
                    //$this->session->set_flashdata('message', line('Nie dodano dodano .'));
                    //redirect('auth/admin/permissions');
                }
            }
        }

        $this->theme->load('permissionadd', $data);
    }

    public function permissionedit($permission_id = 0) {
        $permission_id = (int) $permission_id;
        $data          = array();

        $permission = $this->aauth->get_perm($permission_id);

        if ($permission)
        {
            $b[] = array('href' => site_url('auth/admin/permissions'), 'name' => _t('Uprawnienia'));
            $this->get_breadcrumb(_t('Edycja uprawnień <strong>%s</strong>', null, array($permission->name)), $b);

            $data['permission'] = $permission;

            $this->load->helper('formboot');
            $this->load->library('form_validation');

            $this->form_validation->set_rules($this->permission_validation_rule);

            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                if ($this->form_validation->run() == FALSE)
                {
                    
                }
                else
                {
                    if ($this->aauth->update_perm($permission_id, $this->input->post('name'), $this->input->post('definition')))
                    {
                        $this->session->set_flashdata('message', _t('Zmiany został naniesione.'));
                        redirect('auth/admin/permissions');
                    }
                    else
                    {
                        $this->session->set_flashdata('message', _t('Zmiany nie został wprowadzone. Proszę o weryfikację z administrtorem'));
                        redirect('auth/admin/permissions');
                    }
                }
            }

            $this->theme->load('permissionedit', $data);
        }
    }

    public function setpermissiontogroup($group_id) {
        $group_id = (int) $group_id;
        $data     = array();
        if (is_int($group_id) and $group_id > 0)
        {
            $b[] = array('href' => site_url('auth/admin/groups'), 'name' => _t('Grupy'));
            $b[] = array('href' => '', 'name' => _('Uprawnienia w grupie'));

            $group = $this->aauth->get_group($group_id);

            if ($group)
            {
                $data['group_id'] = $group_id;
                $allowed     = '';
                $group_perms = $this->aauth->get_group_perms($group->id);

                if ($group_perms)
                {
                    foreach ($group_perms as $k => $v)
                    {
                        $allowed[$v->perm_id] = 1;
                    }
                }

                $this->load->helper('table');

                $this->get_breadcrumb(_t('Przyisanie uprawnień do grupy <strong>%s</strong>', null, array($group->name)), $b);

                $data['group'] = $group;

                $perm      = $this->aauth->list_perms();
                $permmison = array();

                foreach ($perm as $o)
                {

                    $o->group_id = $group_id;
                    if (isset($allowed[$o->id]) and $allowed[$o->id] == 1)
                    {
                        $o->allowed = 1;
                    }
                    $permmison[$o->module_name][] = $o;
                }

                $data['permmison'] = $permmison;
            }

            $this->theme->load('setpermissiontogroup', $data);
        }
    }

    public function users() {
        $data = array();

        $this->theme->load('users', $data);
    }

    public function ajax_permissiondel($permission_id) {
        
        $response['status'] = 'erorr';

        $perm = $this->aauth->get_perm($permission_id);
        if($perm)
        {
            if($this->aauth->delete_perm($perm->id))
            {
                $response['status'] = 'success';
            }
        }
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response))
            ->_display();

        exit;
    }

    public function ajax_setallowpermingroup($group_id = 0, $permission_id = 0, $state = '') {
        $response = array('status' => 'erorr');

        if ($state == 'checked')
        {
            $d = '';
            if ($d = $this->aauth->allow_group($group_id, $permission_id))
            {
                $response = array('status' => 'success');
                $response = array('errorDesc' => _t('Wpadlo wi wykonalo allow ' . $d));
            }
            else
            {
                $response = array('errorDesc' => _t('Brak zmiany ALLOW'));
            }
        }
        elseif ($state == 'unchecked')
        {
            if ($this->aauth->deny_group($group_id, $permission_id))
            {
                $response = array('status' => 'success');
            }
            else
            {
                $response = array('errorDesc' => _t('Brak zmiany DENY'));
            }
        }
        elseif ($state == '')
        {
            $response = array('errorDesc' => _t('Brak parametru zmiany stanu'));
        }

        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response))
                ->_display();

        exit;
    }
}
