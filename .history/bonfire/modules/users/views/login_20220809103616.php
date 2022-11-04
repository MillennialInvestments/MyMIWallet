
<div class="intro-section intro-feature bg-white pt-0" id="registration-form">
    <div class="container-fluid px-0">
        <div class="row justify-content-center py-0">
            <div class="mbr-black col-sm-12 col-md-12 col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body py-5">
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
	            </div>
	        </div>
	    </div>
	</div>
	</div>
</section>

