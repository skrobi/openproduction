<div class="mobile-menu-left-overlay"></div>
<ul class="main-nav nav nav-inline">
	<li class="nav-item">
		<a class="nav-link" href="#"><i class="font-icon font-icon-dashboard"></i> <?php _e('HOME'); ?></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="#"><?php _e('Admin Panel'); ?></a>
	</li>
	<li class="nav-item">
		<a class="nav-link active" href="#"><?php _e('CRM'); ?></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="#"><?php _e('Sprzedaż'); ?></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="#"><?php _e('Projekty'); ?></a>
	</li>
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php _e('Core'); ?></a>
		<div class="dropdown-menu">
			<a class="dropdown-item" href="<?php print site_url('core/module/'); ?>"><?php _e('Modules'); ?></a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="<?php print site_url('core/profile/users'); ?>"><?php _e('Users'); ?></a>
		</div>
	</li>
	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php _e('Auth'); ?></a>
		<div class="dropdown-menu">
			<a class="dropdown-item" href="<?php print site_url('auth/admin/groups'); ?>"><?php _e('Grupy'); ?></a>
			
			<a class="dropdown-item" href="<?php print site_url('auth/admin/permissions'); ?>"><?php _e('Uprawnienia'); ?></a>
		</div>
	</li>
</ul>

