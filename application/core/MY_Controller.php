<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Extending CodeIgniter CI_Controller
 *
 * @package 	CodeIgniter
 * @category 	core
 * @author 	Kader Bouyakoub <bkader@mail.com>
 * @link 	https://github.com/bkader
 * @link 	https://twitter.com/KaderBouyakoub
 */
class MY_Controller extends MX_Controller {

    /**
     * Instance of Gettext class
     * @var object
     */
    protected $gettext;

    /**
     * Module's name
     * @var string
     */
    protected $module = NULL;

    /**
     * Controller's name
     * @var string
     */
    protected $controller = NULL;

    /**
     * Method's name
     * @var string
     */
    protected $method = NULL;

    /**
     * Constructor
     */
    public function __construct() {
        // Prepare Gettext class reference
        $this->gettext = new Gettext;
        parent::__construct();

        // Fill module, controller and method
        $this->module       = $this->get_module();
        $this->controller   = $this->router->fetch_class();
        $this->method       = $this->router->fetch_method();
        
        $this->theme->theme('openproduction');
        
        $language = $this->config->item('current_language');
        $this->theme->set('language', $language, true);
        
        // Prepare available languages
        $languages = $this->config->item('languages');
        // Remove current language from available languages
        unset($languages[$language['folder']]);

        $this->theme->set('languages', $languages, true);

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error" style="color: #fa424a">', '</div>');
    }

    // ------------------------------------------------------------------------

    /**
     * In case of using a module, this method retrieves the path to it and
     * build the path to the folder where translation files should be.
     *
     * @access 	private
     * @param 	none
     * @return 	string|NULL
     */
    private function get_module() {
        if (method_exists($this->router, 'fetch_module') && !empty($module = $this->router->fetch_module())) {
            // Retrieve module's path and build path to locales.
            $locale_path = NULL;
            foreach (Modules::$locations as $location => $offset) {
                if (is_dir($location . $module)) {
                    $locale_path = realpath($location . $module) . DIRECTORY_SEPARATOR . 'locale';
                    break;
                }
            }

            // IF $local_path is set, we bind textdomain.
            if ($locale_path !== NULL) {
                T_bindtextdomain($module, $locale_path);
            }

            return $module;
        }

        return NULL;
    }
 
    public function get_breadcrumb($title, $more = array()) {
        $breadcrumb[0] = array('href' => site_url(), 'name' => 'Home');
        $breadcrumb[1] = array('href' => site_url($this->module), 'name' => $this->module);
        
        foreach ($more as $k => $v)
        {
            array_push($breadcrumb, $v);
        }
        
        //var_dump($breadcrumb); die;
        $path = null;
        $module = new Module_model();
        
        
        foreach ($breadcrumb as $k => $v)
        {
            if($k>0)
            {
                $mod = $module->get(array('module_name' => $v['name']));
                //var_dump($mod->module_display_name); 
                $path .= '<li><a href="' . $v['href'] . '">';
                if($mod == true)
                {
                    $path .= $mod->module_display_name;
                }
            else
            {
                $path .= $v['name'];
                $path .= '</a></li>';
            }
            }
            else 
            {
                $path .= '<li><a href="' . $v['href'] . '">'.$v['name'].'</a></li>';
            }
        }

        $z = '<header class="section-header">
        <div class="tbl">
            <div class="tbl-row">
                <div class="tbl-cell">
                    <h3>' . $title . '</h3>
                    <ol class="breadcrumb breadcrumb-simple">
                        ' . $path . '
                    </ol>
                </div>
            </div>
        </div>
    </header>';

        $this->theme->set('breadcrumb', $z, true);
    }

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */