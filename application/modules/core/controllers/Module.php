<?php

/**
 * This class is resposible to manage all modules, activating and deactivating.
 * 
 * @author Dawid Skrobisz
 * @version 0.1
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Module extends My_Access_Controller {

    private $_module_validation_rule = array();

    public $need_be_login = TRUE;
    
    public function __construct() 
    {
        parent::__construct();
        
        $this->_module_validation_rule = array(
        array(
            'field' => 'module_name',
            'label' => _t('Nazwa systemowa modułu'),
            'rules' => 'required|min_length[3]|is_unique[modules.module_name]',
            'errors' => array(
                'required'      => _t('Pole %s musi być wypełnione.')
                , 'length'      => _t('Pole %s powinno posiadać minimum 3 znaki.')
                , 'is_unique'   => _t('Moduł o podanej nazwie istnieje.'))
        ),
        array(
            'field' => 'module_display_name',
            'label' => _t('Nazwa modułu'),
            'rules' => 'required|min_length[3]',
            'errors' => array(
                'required' => _t('Pole %s musi być wypełnione.')
                , 'length' => _t('Pole %s powinno posiadać minimum 3 znaki.'))
            ),
        );
        
        $this->_is_allowed('core_module_access');
    }

    /**
     * List of modules installed in openFactory
     * @access public
     * @permission core_module_list
     */
    public function index() 
    {
        $this->_is_allowed('core_module_list');
        
        $data = array();

        $this->load->helper('table');
        $this->load->model('Module_model');

        $modules = new Module_model();
        $list = $modules->with_settings()->get_all();

        $data['module_list'] = $list;

        $data['groups'] = $this->aauth->list_groups();
        $this->theme->load('module_index', $data);
    }
    
    /**
     * Activation or deactivation of module
     * 
     * @param type $module_id number of module from db
     * @return none Redirect to the same page
     * @permission core_module_activate
     */
    public function activate($module_id = 0) {
        
        $this->_is_allowed('core_module_activate');
        
        $module_id = (int) $module_id;
        if ($module_id > 0) 
        {
            $module = new Module_model();
            $row = $module->get($module_id);
            if ($row) 
            {
                $id = $module->update(array('module_status' => (int) !$row->module_status), $module_id);
                if($id == $module_id)
                {
                    $this->session->set_flashdata('message', _t('Wprowadzono zmianę statusu modułu.'));
                }
            }
        }
        redirect('core/module');
    }

    /**
    * @todo dodawanie modułu. docelow moduł dodawany jako instalacja pakietów 
    * Na chwillę obecną instalacj aodbywa się poprzez dołożene modułu do bazy 
    * danych - całość modułu tworzona od nowa. Do zmiany w momencie budowy modułów
    * intalacyjnych.
    * 
    *   @permission  core_module_add
    */
    public function add()
    {
        
        $this->_is_allowed('core_module_add');
        
        $b[] = array('href' => site_url('core/module'), 'name' => 'Moduły');
        $b[] = array('href' => '#', 'name' => 'Dodawanie modułu');
        $this->get_breadcrumb(_t('Dodawanie modułu'), $b);

        $this->load->helper('formboot');
        $this->load->library('form_validation');

        $this->form_validation->set_rules($this->_module_validation_rule);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            if ($this->form_validation->run() == FALSE) 
            {
                // Nie przeszło walidacji    
            } else {
                $module = new Module_model();
                if ($module->insert($this->input->post())) 
                {
                    $this->session->set_flashdata('message', _t('Moduł został dodany.'));
                    redirect('core/module');
                }
            }
        }

        $this->theme->load('module_add');
    }

    /**
     * 
     * @param int $module_id Identyfiator modułu
     * @todo How define type of parametr, and loading module with configuratiom from zip file
     */
    public function settings($module_id) 
    {
        
        $this->_is_allowed('core_module_settings_view');
        
        $module_id  = (int)$module_id;
        $data       = array();

        if (is_int($module_id)) 
        {
            $tabs = array();
            $this->load->helper('formboot');
            
            $module = new Module_model();
            $settings = $module->with_settings()->get($module_id);

            if(isset($settings->settings))
            {
                    foreach ($settings->settings as $k => $set) {
                    $tabs[$set->module_group_name][] = $set;
                }
            }
            $data['tabs'] = $tabs;
            $data['module_id'] = $module_id;

            $this->get_breadcrumb(_t('Ustawienia modułu <strong>%s</strong>', $settings->module_name));

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] == 'edit') 
            {
                $this->_is_allowed('core_module_settings_save');
                $module_configuration = new ModuleSettings_model();
                
                $errors         = array();
                $configuration  = array();
                
                foreach ($this->input->post('param') as $key => $val) 
                {
                    $configuration[$key]['module_parm_name']    = $val['module_parm_value'];
                    $configuration[$key]['autoload']            = array_key_exists('module_autoload', $val) ? 1 : 0;

                    if ($module_configuration->update(array('module_parm_value' => $val['module_parm_value'], 'module_autoload' => array_key_exists('module_autoload', $val) ? 1 : 0), $key) == false) 
                    {
                        // Sending information to view: no errors. This parametr is checking as er
                        $errors[$key] = 0;
                    }
                }

                if (sizeof($errors) == 0) 
                {
                    $this->session->set_flashdata('message', _t('Wprowadazono zmiany w ustawieniach modułu.'));
                    redirect(site_url('core/module/settings/' . $module_id));
                }
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] == 'add') 
            {
                $this->_is_allowed('core_module_settings_add');
                
                $module_configuration = new ModuleSettings_model();
                $id = $module_configuration->from_form()->insert();
                
                if($id === FALSE)
                {
                    //Problem with adding cofiguration setting for module. 
                    //Return to errors in forms.
                }
                else
                {
                    $this->session->set_flashdata('message', _t('Dodano parametr do modułu.'));
                    redirect('core/module');
                }
            }
        }
        $this->theme->load('module_settings', $data);
    }
}
