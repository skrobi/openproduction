<?php print $this->theme->js('lib/bootstrap-table2/bootstrap-table.js'); ?>
<?php print $this->theme->js('lib/bootstrap-table2/extensions/flat-json/bootstrap-table-flat-json.js'); ?>
<?php print $this->theme->js('lib/bootstrap-table2/extensions/multiple-sort/bootstrap-table-multiple-sort.js'); ?>


    <table id="table"
           data-toggle="table"
           data-url="<?php print site_url('core/profile/json_get_users'); ?>"
           data-detail-formatter="detailFormatter"
           data-minimum-count-columns="2"
           data-show-pagination-switch="true"
           data-pagination="true"
           data-id-field="id"
           data-page-list="[5, 25, 50, 100, ALL]"
           data-pagination="true"
           data-search="true"
           data-show-multi-sort="true">
        <thead>
        <tr>
            <th data-field="id">ID</th>
            <th data-field="email" data-sortable="true"><?php _e('Email') ?></th>
            <th data-field="username" data-sortable="true"><?php _e('Użytkownik') ?></th>
            <th data-field="last_login" data-sortable="true"><?php _e('Ostatnie logowanie') ?></th>
            <th data-field="last_activity" data-sortable="true"><?php _e('Ostatnia aktywność') ?></th>
            <th data-field="banned" data-sortable="true"><?php _e('Ban') ?></th>
            <th data-field="price" data-formatter="yourFormatter" data-events="actionEvents">Action</th>
        </tr>
        </thead>
</table>
<script>
    function yourFormatter(value, row, index) {
    return [
        '<a class="edit ml10" href="javascript:void(0)" title="<?php _e('Edycja') ?>">',
        '<i class="glyphicon glyphicon-edit"></i>',
        '</a>',
        '<a class="remove ml10" href="javascript:void(0)" title="<?php _e('Blokada') ?>">',
        '<i class="glyphicon glyphicon-remove"></i>',
        '</a>'
    ].join('');
}

window.actionEvents = {
    'click .edit': function (e, value, row, index) {
        window.location.href = "<?php print site_url('core/profile/user/')?>"+row.id;
    }
};
    
</script>