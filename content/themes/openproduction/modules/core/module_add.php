<?php print $breadcrumb; ?>

<div class="box-typical box-typical-padding">
    <?php print form_open_boot(); ?>
        <?php print form_row_start(form_error('module_name')); ?>
             <?php print form_input_boot(
                                _t('Nazwa systemowa modułu'), 
                                array('name' => 'module_name', 
                                'value' => set_value('module_name')), 
                                form_error('module_name')); ?>
        <?php print form_row_end(); ?>
    
        <?php print form_row_start(form_error('module_desc')); ?>
             <?php print form_input_boot(
                                _t('Opis modułu'), 
                                array('name' => 'module_desc', 
                                'value' => set_value('module_desc')),
                                form_error('module_desc')); ?>
        <?php print form_row_end(); ?>
    
        <?php print form_row_start(form_error('module_display_name')); ?>
             <?php print form_input_boot(
                                _t('Nazwa wyświetlana'), 
                                array('name' => 'module_display_name', 
                                'value' => set_value('module_display_name')),
                                form_error('module_display_name')); ?>
        <?php print form_row_end(); ?>
        
        <?php print form_submit(array('value' => _t('Zapisz'), 'class' => 'btn btn-inline')); ?>
        
    <?php print form_close(); ?>
</div>