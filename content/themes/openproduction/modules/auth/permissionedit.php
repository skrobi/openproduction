<?php print $breadcrumb; ?>

<div class="box-typical box-typical-padding">
    <?php print form_open_boot(); ?>

    <?php print form_row_start(form_error('name')); ?>
    <?php
    print form_input_boot(
                    'Uprawnienie', array('name' => 'name', 'value' => set_value('name', $permission->name)), form_error('name'));
    ?>
    <?php print form_row_end(); ?>

    <?php print form_row_start(form_error('definition')); ?>
    <?php
    print form_input_boot(
                    'Opis grupy', array('name' => 'definition', 'value' => set_value('definition', $permission->definition)), form_error('definition'));
    ?>
    <?php print form_row_end(); ?>

    <?php print form_row_start(form_error('module_id')); ?>
    <?php
    print form_select_boot(
                    'Moduł', array(
        'name' => 'module_id',
        'value' => set_value('module_id', $permission->module_id),
        'options' => array($permission->module_id => $permission->module_name),
        'selected' => $permission->module_id
                    ), form_error('module_id'));
    ?>
    <?php print form_row_end(); ?>

    <?php print form_submit(array('value' => 'Zapisz', 'class' => 'btn btn-inline')); ?>

    <?php print form_close(); ?>
</div>