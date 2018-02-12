<?php

class ModuleSettings_model extends MY_Model {

    public $table           = 'module_settings';
    public $primary_key     = 'module_setting_id';
    public $protected       = array('module_setting_id');
    public $fillable        = array(  'module_parm_name'
                                    , 'module_parm_value'
                                    , 'module_parm_desc'
                                    , 'module_autoload'
                                    , 'module_id'
                                    , 'module_group_name');
    
    
    public $rules = array(
        'update' => array(
                'module_parm_name' => array(
                        'field'=>'module_parm_name',
                        'label'=> 'Nazwa parametru',
                        'rules'=>'trim|required'),

                'module_parm_value' => array(
                        'field'=>'module_parm_value',
                        'label'=>'Wartość parametru',
                        'rules'=>'trim|required',
                ),
                
        ),                    
        'insert' => array(
                'module_parm_name' => array(
                        'field'=>'module_parm_name',
                        'label'=> 'Nazwa parametru',
                        'rules'=>'trim|required'),
                
            'module_parm_desc' => array(
                        'field'=>'module_parm_desc',
                        'label'=> 'Opis parametru',
                        ),

                'module_parm_value' => array(
                        'field'=>'module_parm_value',
                        'label'=>'Wartość parametru',
                        'rules'=>'trim|required',
                        
                ),
                'module_id' => array(
                        'field'=>'module_id',
                        'label'=>'ID',
                        'rules'=>'required'),
            
                'module_group_name' => array(
                        'field'=>'module_group_name',
                        'label'=>'module_group_name',
                        'rules'=>'required'),
        )                    
    );
    
    public function __construct()
    {
        parent::__construct();
    }
}
