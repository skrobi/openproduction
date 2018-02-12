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
                           _t('Opis grupy'), 
                           array('name' => 'definition', 
                           'value' => set_value('definition')),
                           form_error('definition')); ?>
    <?php print form_row_end(); ?>

     <?php print form_submit(array('value' => _t('Dodaj'), 'class' => 'btn btn-inline')); ?>
    
    <?php print form_close(); ?>
</div>