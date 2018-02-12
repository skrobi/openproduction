<?php print $breadcrumb; ?>

<div class="box-typical box-typical-padding">
    <?php print form_open_boot(); ?>
        <?php print form_row_start(form_error('name')); ?>
        <?php print form_input_boot(
                            _t('Uprawnienie'), 
                            array('name' => 'name', 
                            'value' => set_value('name')), 
                            form_error('name')); ?>
        <?php print form_row_end(); ?>
    
        <?php print form_row_start(form_error('definition')); ?>
        <?php print form_input_boot(
                           _t('Opis uprawnienia'), 
                           array('name' => 'definition', 
                           'value' => set_value('definition')),
                           form_error('definition')); ?>
        <?php print form_row_end(); ?>
    
        <?php print form_row_start(form_error('module_id')); ?>
        <?php print form_select_boot(
                           _t('Moduł'), 
                           array(
                               'name'       => 'module_id', 
                               'value'      => set_value('module_id'), 
                               'options'    => $modules,
                               'selected'   => $selected_module_id
                               ),
                           form_error('module_id')); ?>
        <?php print form_row_end(); ?>
    
        <?php print form_submit(array('value' => _t('Dodaj'), 'class' => 'btn btn-inline')); ?>
    
    <?php print form_close(); ?>
</div>