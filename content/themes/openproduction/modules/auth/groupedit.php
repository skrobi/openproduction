<?php print $breadcrumb; ?>

<div class="box-typical box-typical-padding">
    <?php print form_open_boot(); ?>
        <?php print form_hidden('formType', 'edit'); ?>
        <?php print form_row_start(form_error('name')); ?>
             <?php print form_input_boot(
                                'Nazwa grupy', 
                                array('name' => 'name', 'value' => set_value('name', $group->name)), 
                                form_error('name')); ?>
        <?php print form_row_end(); ?>
    
        <?php print form_row_start(form_error('definition')); ?>
             <?php print form_input_boot(
                                'Opis grupy', 
                                array('name' => 'definition', 'value' => set_value('definition', $group->definition)),
                                form_error('definition')); ?>
        <?php print form_row_end(); ?>
        
        <?php print form_submit(array('value' => 'Zapisz', 'class' => 'btn btn-inline')); ?>
        
    <?php print form_close(); ?>
    
    <?php print form_open('', array('style' => 'text-align: right')); ?>
        <?php print  form_hidden('groupId', $group->id); ?>
     <?php print form_submit(array('value' => 'Usuń', 'style' => 'margin-top: -70px;', 'class' => 'btn btn-inline btn-danger')); ?>
    <?php print form_close(); ?>
</div>  