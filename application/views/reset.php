<div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
                    <?php echo form_open('', array('class' => 'sign-box reset-password-box', 'name' => 'up')); ?>
                    <div class="sign-avatar">
                        <img src="<?php print img_url('avatar-sign.png') ?>" alt="">
                    </div>
                    <header class="sign-title"><?php _e('Reset hasła'); ?></header>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="<?php _e('E-Mail'); ?>"/>
                        <?php echo form_error('email'); ?>
                    </div>
                    <button type="submit" class="btn btn-rounded"><?php _e('Resetuj') ?></button>
                    <?php _e('lub') ?> <a href="<?php print site_url('sing/in') ?>"><?php _e('Zaloguj się'); ?></a>
                    <button type="button" class="close" id="closeWindow" onclick="window.location.href = '<?php print site_url('') ?>'">
                <span aria-hidden="true">&times;</span>
            </button>
                </form>
            </div>
        </div>
    </div><!--.page-center-->

    <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });

            $(window).resize(function(){
                setTimeout(function(){
                    $('.page-center').matchHeight({ remove: true });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                },100);
            });
        });
    </script>