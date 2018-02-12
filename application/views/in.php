<div class="page-center">
    <div class="page-center-in">
        <div class="container-fluid">


            <?php echo form_open('', array('class' => 'sign-box', 'name' => 'in')); ?>
            <?php if ($this->session->userdata('message')): ?>
                <p class="error" style="color: #fa424a"><?php echo $this->session->userdata('message'); ?></p>
            <?php endif; ?>
            <div class="sign-avatar">
                <img src="<?php print img_url('avatar-sign.png') ?>" alt="">
            </div>
            <header class="sign-title"><?php _e('Logowanie'); ?></header>
            <div class="form-group">
                <input type="text" name="email" class="form-control" value="<?php echo set_value('email'); ?>" placeholder="<?php _e('E-Mail'); ?>"/>
                <?php echo form_error('email'); ?>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="<?php _e('Hasło'); ?>"/>
                <?php echo (form_error('password')); ?>
            </div>
            <div class="form-group">
                <div class="checkbox float-left">
                    <input type="checkbox" name="remember" id="signed-in"/>
                    <label for="signed-in"><?php _e('Zapamiętaj logowanie'); ?></label>
                </div>
                <div class="float-right reset">
                    <a href="<?php print site_url('sing/reset'); ?>"><?php _e('Reset hasła'); ?></a>
                </div>
            </div>
            <button type="submit" class="btn btn-rounded"><?php _e('Zaloguj'); ?></button>
            <p class="sign-note"><?php _e('Nowy w procesie openProduction?'); ?><a href="<?php print site_url('sing/up'); ?>"><?php _e('Zarejestruj się'); ?></a></p>
            <button type="button" class="close" id="closeWindow" onclick="window.location.href = '<?php print site_url('') ?>'">
                <span aria-hidden="true">&times;</span>
            </button>
            </form>
        </div>
    </div>
</div>