<?php
$option = array(
    'primary_id' => 'id',
    'column'     => array(
        array(
            'bind_name'   => 'id'
            , 'bind_type'   => 'data'
            , 'description' => '#'
            , 'width_th'    => '10'
            , 'class_td'    => 'idTdPermission'
        ),
        array(
            'bind_name'   => 'name'
            , 'bind_type'   => 'data'
            , 'description' => _t('Nazwa grupy')
            , 'width_th'    => '302'
            , 'class_td'    => 'color-blue-grey-lighter'
        ),
        array(
            'bind_name'     => 'definition'
            , 'bind_type'     => 'data'
            , 'description'   => _t('Definicja')
            , 'class_th_icon' => 'glyphicon glyphicon-info-sign'
            , 'class_td'      => 'table-datess'
        ),
        array(
            'bind_name'   => 'edit'
            , 'bind_type'   => 'reg'
            , 'description' => ''
            , 'width_th'    => '170'
            , 'out'         => '<a class="btn btn-sm btn-default" href="' . site_url('auth/admin/permissionedit/{id}') . '"><i class="font-icon font-icon-pencil"> </i>' . ( _t('Edycja')) . '</a>
                <button class="btn btn-sm btn-danger" id="removePermission" data-toggle="modal" data-target="#myModal" href="' . site_url('auth/admin/ajax_permissiondel/{id}') . '"><i class="font-icon font-icon-trash"> </i> ' . ( _t('Usuń')) . '</button>'
        )
    )
);
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="<?php print _t('Zamknij') ?>">
                    <i class="font-icon-close-2"></i>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?php print _t('Usunięcie uprawnienia.') ?></h4>
            </div>
            <div class="modal-body">
                <?php _e('Czy na pewno chcesz usunąć uprawnienie?.') ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal"><?php _e('Anuluj') ?></button>
                <button type="button" id="modalButton" class="btn btn-rounded btn-primary"><?php _e('TAK, usuń') ?></button>
            </div>
        </div>
    </div>
</div>

<?php print $breadcrumb ?>
<a class="btn btn-inline btn-primary" href="<?php print site_url('auth/admin/permissionadd') ?>" data-toggle="tooltip" title="Dodaj uprawnienia" data-placement="right"><?php _e('Dodaj uprawnienia'); ?></a>
<?php if (count($permmison) > 0): ?>
    <?php foreach ($permmison as $k => $value): ?>
        <?php print '<a name="' . $k . '"></a>' ?>
        <?php
        print table_header($k, array(
            array(
                'class' => 'font-icon font-icon-plus-1',
                'href'  => site_url('auth/admin/permissionadd/' . $value['0']->module_id),
                'extra' => 'data-toggle="tooltip" title="Dodaj uprawnienia" data-placement="left"'
            ),
            array(
                'class' => 'fa fa-cube',
                'href'  => site_url('core/module/'),
                'extra' => 'data-toggle="tooltip" title="Ustawienia modułu" data-placement="left"'
            )
                        )
        );
        ?>
        <?php print table_create($option, $value); ?>
        <?php print '</section>'; ?>
    <?php endforeach; ?>
<?php else: ?>
    <?php print _t('Nie zdefiniowano jeszcze żadnych uprawnień.'); ?>
<?php endif; ?>

<script>
    $(document).ready(function ()
    {
        $('button#removePermission').click(function ()
        {
            var o = $(this);
            var buttonYes = $('#modalButton');

            buttonYes.attr('href', o.attr('href')).on('click', function (result)
            {
                $.ajax({url: $(this).attr('href'), success: function (result) {

                        var obj = jQuery.parseJSON(JSON.stringify(result));
                        if (obj.status == 'success')
                        {
                            $('#myModal').modal('hide');
                            o.parent().parent('tr').hide();
                        }
                        else
                        {
                            $('#myModal').modal('hide');
                            alert('Error - Json return error');
                        }           
                    }});
            });
        });

    });
</script>

