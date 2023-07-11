
<div class="intro-section intro-feature bg-white pt-0" id="registration-form">
    <div class="container-fluid px-0">
<<<<<<< HEAD
        <div class="row justify-content-center pt-5">
            <?php
                $site_open = $this->settings_lib->item('auth.allow_register');
            ?>
            <p><br/><a href="<?php echo site_url(); ?>">&larr; <?php echo lang('us_back_to') . 'Home'; ?></a></p>
        </div>
        <div class="row justify-content-center py-0">
            <div class="mbr-black col-xxl-4 col-lg-4 col-md-4 col-md-8 col-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body py-5">
                        <div id="login">
                            <?php $this->load->view('users/login-form'); ?>
=======
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
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                        </div>
	                </div>
	            </div>
	        </div>
<<<<<<< HEAD
            <div class="mbr-black d-none col-xxl-8 col-lg-8 col-md-8 col-12 grid-margin stretch-card">
                <div class="card card-bordered pricing">
                    <div class="card-body py-lg-5">
                        <div class="full-width" id="login">
                            <h1 class="card-title">Access Your Investor Dashboard</h1>
                            <div class="list-group">
                                <?php 
                                $this->db->from('bf_users_services'); 
                                $this->db->where('status', 1);
                                $getUserServices                = $this->db->get();
                                foreach ($getUserServices->result_array() as $service) {
                                    echo '
                                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Personal Budgeting &amp; Financial Forecasting</h5>
                                        <small></small>
                                        </div>
                                        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                        <small>Donec id elit non mi porta.</small>
                                    </a>
                                    ';
                                };
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
	    </div>
	</div>
</div>
