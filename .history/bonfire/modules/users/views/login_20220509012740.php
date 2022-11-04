<section class="cid-s0KKUOB7cY bg-white" id="header01-m">
    <div class="container-fluid">
		<div class="row justify-content-center pt-5">
			<?php
                $site_open = $this->settings_lib->item('auth.allow_register');
            ?>
			<p><br/><a href="<?php echo site_url(); ?>">&larr; <?php echo lang('us_back_to') . 'Home'; ?></a></p>
		</div>
		<div class="row">
			<div id="login">
				<?php $this->load->view('users/login-form'); ?>
			</div>
		</div>
	</div>
</section>

