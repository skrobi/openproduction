<div class="page-center">
    <div class="page-center-in">
        <div class="container-fluid">
            <?php echo form_open('', array('class' => 'sign-box', 'name' => 'up')); ?>
            
            <p class="error" style="color: #fa424a">
                <?php if(is_array($z = $this->session->flashdata('message'))): ?>
                    <?php foreach ($z as $i): ?>
                        <?php print $i ?><br/>
                    <?php endforeach; ?>
                
                <?php endif; ?>
            </p>
          
            <?php if (isset($message)): ?>
                <p class="error" style="color: #fa424a"><?php echo $message;  ?></p>
            <?php endif; ?>
            <div class="sign-avatar no-photo">&plus;</div>
            
            <header class="sign-title"><?php _e('Rejestracja'); ?></header>
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="<?php _e('E-mail'); ?>"/>
                <?php echo form_error('email'); ?>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="<?php _e('Hasło'); ?>"/>
                <?php echo form_error('password'); ?>
            </div>
            <div class="form-group">
                <input type="password" name="cfpassword" class="form-control" placeholder="<?php _e('Powtórz hasło'); ?>"/>
                <?php echo form_error('cfpassword'); ?>
            </div>
            <button type="submit" class="btn btn-rounded btn-success sign-up"><?php _e('Zarejestruj') ?></button>
            <p class="sign-note"><?php _e('Posiadasz już konto?'); ?> <a href="<?php print site_url('sing/in'); ?>"><?php _e('Zaloguj się') ?></a></p>

            <button type="button" class="close" onclick="window.location.href = '<?php print site_url('') ?>'">
                <span aria-hidden="true">&times;</span>
            </button>
            </form>
        </div>
    </div>
</div>