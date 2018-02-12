<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ConfigDbClass
{
    
    public function set_autoload_config()
    {
        $CI =& get_instance();
        $rows = $CI->db->get_where('module_settings', array('module_autoload' => 1))->result();
        
        foreach ($rows as $row)
        {
            
            $CI->config->set_item($row->module_parm_name, $row->module_parm_value);
        }
        
    }
}