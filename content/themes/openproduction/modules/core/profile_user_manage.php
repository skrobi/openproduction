<section class="tabs-section">
    <div class="tabs-section-nav tabs-section-nav-inline">
        <ul class="nav" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#tabs-4-tab-1" role="tab" data-toggle="tab">
                    <?php _e('Informacje podstawowe'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#tabs-4-tab-2" role="tab" data-toggle="tab">
                    <?php _e('Reste hasła'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#tabs-4-tab-3" role="tab" data-toggle="tab">
                    <?php _e('Grupy uprawnień'); ?>
                </a>
            </li>
            <!-- <li class="nav-item">
                 <a class="nav-link" href="#tabs-4-tab-4" role="tab" data-toggle="tab">
                     In Process
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="#tabs-4-tab-5" role="tab" data-toggle="tab">
                     Active Certs
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="#tabs-4-tab-6" role="tab" data-toggle="tab">
                     Pending Renewal
                 </a>
             </li>  -->
        </ul>
    </div><!--.tabs-section-nav-->

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="tabs-4-tab-1">
            <?php print form_open_boot(); ?>
            <?php print form_hidden('action', 'core_edit'); ?>
            <?php print form_row_start(form_error('email')); ?>
            <?php
            print form_input_boot(
                            _t('Email'), array('name' => 'email', 'readonly' => '', 'value' => set_value('module_name', $user->email)), form_error('email'));
            ?>
            <?php print form_row_end(); ?>

            <?php print form_row_start(form_error('username')); ?>
            <?php
            print form_input_boot(
                            _t('Username'), array('name' => 'username', 'value' => set_value('username', $user->username)), form_error('username'));
            ?>
            <?php print form_row_end(); ?>

            <?php print form_submit(array('value' => 'Zapisz', 'class' => 'btn btn-inline')); ?>

            <?php print form_close(); ?>

        </div><!--.tab-pane-->

        <!-- START PANEL OF RESTET PASSWORD -->
        <div role="tabpanel" class="tab-pane fade" id="tabs-4-tab-2">
            <?php print form_open_boot(); ?>

            <?php print form_hidden('action', 'password_edit'); ?>

            <?php print form_row_start(form_error('password')); ?>
            <?php
            print form_input_boot(
                            _t('Hasło'), array('name' => 'password', 'type' => 'password'), form_error('password'));
            ?>
            <?php print form_row_end(); ?>

            <?php print form_row_start(form_error('password_confirm')); ?>
            <?php
            print form_input_boot(
                            _t('Powtórz hasło'), array('name' => 'password_confirm', 'type' => 'password'), form_error('password_confirm'));
            ?>
            <?php print form_row_end(); ?>
            <?php print form_submit(array('value' => 'Zapisz', 'class' => 'btn btn-inline')); ?>
            <?php print form_close(); ?>
        </div><!--.tab-pane-->
        <div role="tabpanel" class="tab-pane fade" id="tabs-4-tab-3">
            <?php print $this->theme->js('lib/bootstrap-table2/bootstrap-table.js'); ?>
            <?php print $this->theme->js('lib/bootstrap-table2/extensions/flat-json/bootstrap-table-flat-json.js'); ?>
            <?php print $this->theme->js('lib/bootstrap-table2/extensions/multiple-sort/bootstrap-table-multiple-sort.js'); ?>

            <?php print $this->theme->js('lib/select2/select2.full.min.js'); ?>
            <div class="row">
                <?php print form_open(); ?>
                <?php print form_hidden('action', 'add_group_to_user'); ?>
                
                <div class="col-md-9">

                    <select name="group_selected" class="addGroup">
                        <option><?php _e('Wybierz grupę uprawnień do dodania'); ?></option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-inline" type="submit"><?php _e('Dodaj'); ?></button>
                </div>
                <?php print form_close();?>
            </div>
            <script>
                $(document).ready(function () {
                    $('.addGroup').not('.manual').select2({
                        ajax: {
                            url: '<?php print site_url('core/profile/ajax_get_group'); ?>',
                            dataType: 'json' 
                        }
                    });
                });
            </script>


            <table id="table"
                   data-toggle="table"
                   data-url="<?php print site_url('core/profile/ajax_get_user_group/' . $user_id); ?>"
                   data-detail-formatter="detailFormatter"
                   data-minimum-count-columns="2"
                   data-pagination="true"
                   data-id-field="id"
                   >
                <thead>
                    <tr>
                        <th data-field="id">ID</th>
                        <th data-field="name" data-sortable="true"><?php _e('Nazwa') ?></th>
                        <th data-field="definition" data-sortable="true"><?php _e('Opis') ?></th>
                        <th data-field="x" data-sortable="true"><?php _e('Akcje') ?></th>
                    </tr>
                </thead>
            </table>
        </div><!--.tab-pane-->
        <div role="tabpanel" class="tab-pane fade" id="tabs-4-tab-4">Tab 4</div><!--.tab-pane-->
        <div role="tabpanel" class="tab-pane fade" id="tabs-4-tab-5">Tab 5</div><!--.tab-pane-->
        <div role="tabpanel" class="tab-pane fade" id="tabs-4-tab-6">Tab 6</div><!--.tab-pane-->
    </div><!--.tab-content-->
</section><!--.tabs-section-->

<script>
    $('documnet').
</script>