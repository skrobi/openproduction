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
            , 'class_th_icon' => 'glyphicon glyphicon-info-sign'
            , 'class_td' => 'table-datess'
        ),
        array(
            'bind_name' => ''
            , 'bind_type' => 'reg'
            , 'description' => _t('Przypisanie')
            , 'class_th_icon' => 'fa fa-key'
            , 'class_td' => ''
            , 'width_th' => '140'
            , 'out' => '<div class="checkbox-toggle">
                    <input name="setallow" type="checkbox" id="check-toggle-{id}" href="' . site_url('auth/admin/ajax_setallowpermingroup/{group_id}/{id}/{if {allowed} == 1}unchecked{else}checked{/if}/') . '" {if {allowed} == 1} checked {/if} />
                    <label for="check-toggle-{id}"></label>
            </div>'
        ),
        array(
            'bind_name' => 'edit'
            , 'bind_type' => 'reg'
            , 'description' => ''
            , 'width_th' => '107'
            , 'out' => '<a class="btn btn-sm btn-default" href="' . site_url('auth/admin/permissionedit/{id}') . '"><i class="font-icon font-icon-pencil"> </i>' . _t('Edycja') . '</a>'
        )
    )
);
?>

<?php //var_dump($permmison); ?>
<?php print $breadcrumb ?>
<?php if (count($permmison) > 0): ?>
    <?php foreach ($permmison as $k => $value): ?>
        <?php print '<a name="' . $k . '"></a>' ?>
        <?php
        print table_header($k, array(
            array(
                'class' => 'font-icon font-icon-plus-1',
                'href' => site_url('auth/admin/permissionadd/' . $value['0']->module_id),
                'extra' => 'data-toggle="tooltip" title="'._t('Dodaj uprawnienia').'" data-placement="left"'
            ),
            array(
                'class' => 'fa fa-cube',
                'href' => site_url('core/module/'),
                'extra' => 'data-toggle="tooltip" title="'. _t('Ustawienia modułu').'" data-placement="left"'
            )
                        )
        );
        ?>
        <?php print table_create($option, $value); ?>
        <?php print '</section>'; ?>
    <?php endforeach; ?>
<?php else: ?>
    <?php _e('Nie zdefiniowano uprawnień dla tej grupy użytkowników.'); ?><br>
    <a href="<?php print site_url('auth/admin/permissionadd/') ?>" class="btn btn-default" name="set_new_permission"><?php _e('Zdefiniuj uprawnienia modułu'); ?></a>

<?php endif; ?>
<script>
$(document).ready(function(){
    $("input[type=checkbox]").click(function()
    {
        var o = $(this);
        $.ajax({url: $(this).attr('href'), success: function(result){
            
            var newHref = '';
            if(o.is(':checked'))
            {
                newHref = o.attr('href').replace('checked', 'unchecked');
            }
            else
            {
                newHref =o.attr('href').replace('unchecked', 'checked');
            }
            
            o.attr('href', newHref);
        }});
    });
});
</script>