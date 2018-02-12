<?php $i=1; ?>
<?php $t = array(); ?>

<section class="tabs-section">
    <div class="tabs-section-nav">
        <div class="tbl">
            <ul class="nav" role="tablist">
                <?php foreach($tabs as $k => $v): ?>
                <li class="nav-item">
                    <a class="nav-link <?php if($i ==1) { print 'active'; }  ?>" href="#tabs-2-tab-<?php print $i ?>" role="tab" data-toggle="tab" aria-expanded="false">
                        <span class="nav-link-in">
                            <?php print ($v[0]->module_group_name) ?>
                            <?php $t[$i] = $v[0]->module_group_name; ?>
                            <?php $i++; ?>
                        </span>
                    </a>
                </li>
               <?php endforeach; ?>
                <li class="nav-item">
                    <a class="nav-link" href="#tabs-2-tab-add-cat" role="tab" data-toggle="tab">
                       <span class="nav-link-in">
                            <span class="icon fa fa-plus"></span>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div><!--.tabs-section-nav-->
    <?php $i=1; ?>
    <div class="tab-content">
        <?php foreach($tabs as $k): ?>
        <div role="tabpanel" class="tab-pane fade in <?php if($i ==1) { print 'active'; }  ?>" id="tabs-2-tab-<?php print $i ?>">
           <!-- <div class="row">
                <div class="col-xs-12">
                    <div class="text-right">
                        <a href="<?php print site_url('core/module/settings_add_param/'.$module_id.'/'.$t[$i]); ?>" class="btn btn-inline" id="add_param"><?php _e('Dodaj parametr') ?></a>
                    </div>
                </div>
            </div> -->
            
            <?php print form_open(); ?>
            <?php print form_hidden('action', 'edit'); ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-1">
                        <strong><?php _e('Autoload'); ?></strong>
                    </div>
                    <div class="col-md-3">
                        <strong><?php _e('Parametr'); ?></strong>
                    </div>
                    <div class="col-md-8">
                        <strong><?php _e('Wartość'); ?></strong>
                    </div>
                </div>
                <div class="row"><P></P></div>
                <?php foreach ($k as $u): ?>
                    <div class="row">
                        <div class="input-group">
                            <div class="col-md-1">
                               <?php print form_checkbox(array('name' => 'param['.$u->module_setting_id.'][module_autoload]', 'checked' => (int)$u->module_autoload, 'value' => (int)$u->module_autoload)); ?>
                            </div>
                            <div class="col-md-3">
                                <strong><?php print $u->module_parm_name ?></strong><br>
                                <small><?php print $u->module_parm_desc ?></small>
                            </div>
                            <div class="col-md-8">
                               <?php print form_input(array('name' => 'param['.$u->module_setting_id.'][module_parm_value]', 'value' => set_value($u->module_parm_name, $u->module_parm_value),'class' => 'form-control')); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <input type="submit" class="btn btn-inline" value="Zapisz"/>
            </div>
            <?php print form_close(); ?>
            
        </div>
        
        <?php $i++; ?> 
        <?php endforeach; ?><!--.tab-pane-->
        <div role="tabpanel" class="tab-pane fade  <?php if(!count($tabs)) { print 'in active'; }  ?>" id="tabs-2-tab-add-cat">
            <h5>
                <strong>
                    <?php _e('Dodawanie nowej katogorii'); ?>
                </strong>
            </h5>
            
                <?php print form_open(); ?>
            <?php print form_hidden('action', 'add'); ?>
            <?php print form_hidden('module_id', $module_id); ?>
             <?php print form_row_start(form_error('module_group_name')); ?>
             <?php print form_input_boot(
                                _t('Nazwa grupy parametrów'), 
                                array('name'    => 'module_group_name', 
                                      'value'   => set_value('module_group_name')), 
                                form_error('module_group_name')); ?>
        <?php print form_row_end(); ?>
            
        <?php print form_row_start(form_error('module_parm_name')); ?>
             <?php print form_input_boot(
                                _t('Nazwa systemowa parametru modułu'), 
                                array('name' => 'module_parm_name', 
                                'value' => set_value('module_parm_name')), 
                                form_error('module_parm_name')); ?>
        <?php print form_row_end(); ?>
            
        <?php print form_row_start(form_error('module_parm_desc')); ?>
        <?php print form_input_boot(
                            _t('Krótki opis parametru'), 
                            array('name' => 'module_parm_desc', 
                            'value' => set_value('module_parm_desc')), 
                            form_error('module_parm_desc')); ?>
        <?php print form_row_end(); ?>
            
         <?php print form_row_start(form_error('module_parm_value')); ?>
             <?php print form_input_boot(
                                _t('Wartość parametru'), 
                                array('name' => 'module_parm_value', 
                                'value' => set_value('module_parm_value')), 
                                form_error('module_parm_value')); ?>
        <?php print form_row_end(); ?>
            
            <?php print form_submit(array('value' => _t('Zapisz'), 'class' => 'btn btn-inline')); ?>
            
            <?php print form_close(); ?>
        </div><!--.tab-pane-->
    </div><!--.tab-content-->
</section>