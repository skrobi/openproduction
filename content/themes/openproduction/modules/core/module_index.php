 <?php
$option = array(
    'primary_id' => 'module_id',
    'column' => array(
        array(
            'bind_name' => 'module_id'
            , 'bind_type' => 'data'
            , 'description' => '#'
            , 'width_th' => '10'
        ),
        array(
            'bind_name' => 'module_name'
            , 'bind_type' => 'data'
            , 'description' => _t('Nazwa grupy')
            , 'width_th' => '202'
            , 'class_td' => 'color-blue-grey-lighter'
        ),
        array(
            'bind_name' => 'module_desc'
            , 'bind_type' => 'data'
            , 'description' => _t('Opis')
            , 'class_th_icon' => 'fa fa-info'
            , 'class_td' => 'table-datess'
        ),
        array(
            'bind_name' => 'module_status'
            , 'bind_type' => 'reg'
            , 'description' => _t('Status modułu')
            , 'class_th_icon' => 'fa fa-info'
            , 'class_td' => 'table-datess'
            , 'width_th' => '152'
            , 'out' => '{if {module_status}==1} Aktywny {else} Wyłączony {/if}'
        ),
        array(
            'bind_name' => 'edit'
            , 'bind_type' => 'reg'
            , 'description' => ''
            , 'width_th' => '202'
            , 'out' => ''
            . '<div class="dropdown">
                    <button class="btn btn-rounded dropdown-toggle" id="dd-header-add" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Akcje
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dd-header-add">
                        <a style="border: 0px" class="dropdown-item" href="' . site_url('core/module/activate') . '/{module_id}">{if {module_status}==1} Dezaktywuj {else} Aktywuj {/if}</a>
                        <a style="border: 0px" class="dropdown-item" href="' . site_url('core/module/settings') . '/{module_id}">' . ( _t('Ustawienia')) . '</a>
                        <a style="border: 0px" class="dropdown-item" href="' . site_url('/auth/admin/permissions') . '#{module_name}">'. ( _t('Uprawnienia')) .'</a>           
                    </div>
                </div>'
            ,
            
        )
    )
);
?>

<?php print table_header('Moduły', array(array('class' => 'font-icon font-icon-plus-1', 'href' => site_url().'/core/module/add', 'extra' => ''))); ?>
    <?php print table_create($option, $module_list); ?>
<?php print '</section>'; ?> 