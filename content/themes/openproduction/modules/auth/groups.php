 <?php
$option = array(
    'primary_id' => 'id',
    'column' => array(
        array(
            'bind_name' => 'id'
            , 'bind_type' => 'data'
            , 'description' => '#'
            , 'width_th' => '10'
        ),
        array(
            'bind_name' => 'name'
            , 'bind_type' => 'data'
            , 'description' => _t('Nazwa grupy')
            , 'width_th' => '302'
            , 'class_td' => 'color-blue-grey-lighter'
        ),
        array(
            'bind_name' => 'definition'
            , 'bind_type' => 'data'
            , 'description' => _t('Definicja')
            , 'class_th_icon' => 'font-icon font-icon-comment'
            , 'class_td' => 'table-datess'
        ),
        array(
            'bind_name' => 'edit'
            , 'bind_type' => 'reg'
            , 'description' => ''
            , 'width_th' => '220'
            , 'out' => 
                "<a class=\"btn btn-sm btn-default\" href=\"" . site_url('/auth/admin/groupedit/{id}') . "\"><i class=\"font-icon font-icon-pencil\"> </i>" . ( _t('Edycja')) . "</a> 
                <a class=\"btn btn-sm btn-secondary\" href=\"" . site_url() . "/auth/admin/setpermissiontogroup/{id}\"><i class=\"font-icon font-icon-share\"> </i>" . ( _t('Uprawnienia')) . "</a>",
            
        )
    )
);
?>
<?php print $breadcrumb; ?>
<?php print table_header('Lista ról systemowych', array(
    array(  'class' => 'font-icon font-icon-plus-1', 
            'href' => site_url().'/auth/admin/groupadd',
            'extra' => '')
    )); ?>
    <?php print table_create($option, $groups); ?>
<?php print '</section>' ?>