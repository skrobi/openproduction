<?php

class Module_model extends MY_Model {

    public $table           = 'modules';
    public $primary_key     = 'module_id';
    public $protected       = array('module_id');
    public $fillable        = array('module_name', 'module_desc', 'module_status', 'module_display_name');
    
    public function __construct() {
               
        $this->has_many['settings'] = array('ModuleSettings_model', 'module_id', 'module_id');
        
        parent::__construct();
    }
}
