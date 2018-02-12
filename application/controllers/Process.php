<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * This is an example controller on how to switch language
 * @package 	CodeIgniter\CI-Gettext
 * @category 	Controllers
 * @author 	Kader Bouyakoub <bkader@mail.com>
 * @link 	http://www.bkader.com/
 */

class Process extends MY_Controller
{
    /**
     * Change site language
     * @access 	public
     * @param 	string 	$code 	code of the language to use
     * @return 	void
     */
    public function lang($code = 'pl')
    {
            function_exists('redirect') OR $this->load->helper('url');

            if (function_exists('switch_language')) {
                    $z = $this->gettext->change($code); 
            }

            redirect($this->input->get('next', TRUE));
    }
    
    public function nopermission()
    {
        print $this->session->flashdata('message'); die;
    }
}

/* End of file Process.php */
/* Location: ./application/controllers/Process.php */