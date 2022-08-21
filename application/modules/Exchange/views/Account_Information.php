<?php

$errorClass  		= empty($errorClass) ? ' error' : $errorClass;
$controlClass 		= empty($controlClass) ? 'span6' : $controlClass;
$fieldData 			= array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
);
$registerType 		= $this->uri->segment(1);
$cuID	 			= $this->uri->segment(2);
?>
<?php
if ($registerType 	=== 'Investor') {
    $title			= 'Investor Account Information';
} else {
    $title			= 'Account Information';
}
?>
<style scoped='scoped'>
#register p.already-registered {
    text-align: center;
}
	@media (max-width: 375px) {
	#header01-m {padding-top: 15px !important;}	
	}
	@media (min-width: 767px) {
	#header01-m {padding-top: 1rem !important;}
	}
</style>
<section class="cid-s0KKUOB7cY border-bottom pb-0" id="header01-m">
    <div class="container-fluid px-0">
        <div class="row justify-content-center py-0">
            <div class="mbr-black col-sm-12 col-md-12 col-lg-12 grid-margin stretch-card">
				<div class="card pt-5">
					<div class="card-body py-5">
						<?php echo form_open('Exchange/Account-Information/' . $cuID, array('class' => "form-horizontal", 'autocomplete' => 'off')); ?>
							<fieldset>
								<div class="row">
									<div class="col-md-1"></div>
									<div class="col-12 col-sm-12 col-md-8 pl-5 pt-5">
										<h1 class="mbr-section-title mbr-bold mb-1 pb-3 mbr-fonts-style card-title display-7"><?php echo $title; ?></h1>	
										<fieldset>
											<?php
                                            // Allow modules to render custom fields. No payload is passed
                                            // since the user has not been created, yet.
                                            Events::trigger('render_user_form');
                                            Template::block('Exchange/Account_Information/user_fields', 'Exchange/Account_Information/user_fields', $fieldData);
                                            ?>
											<!-- Start of User Meta --> 			
											<!-- End of User Meta -->
										</fieldset>
										<div class="control-group form-row pt-3">
											<div class="controls col-sm-4 pl-0">
												<input class="btn btn-primary btn-block display-4" type="submit" name="register" id="submit" value="<?php echo lang('us_register'); ?>" />
											</div>
											<div class="col-sm-8 pt-3">
												<p class='already-registered pl-3'>
													<?php echo lang('us_already_registered'); ?>
													<?php echo anchor(LOGIN_URL, lang('bf_action_login')); ?>
												</p>
											</div>
										</div>	
									</div>
									<div class="col-md-1 border-right px-5"></div>		
<!--
									<div class="col-12 col-sm-12 col-md-3 pl-5">                    
										<h2 class="mbr-section-title mb-5 pb-3 mbr-fonts-style card-title display-7">My Progress</h2>
										 </div>
									</div>	
-->
								</div>
							</fieldset>
							<fieldset>
								<?php
                                // Allow modules to render custom fields. No payload is passed
                                // since the user has not been created, yet.
                                Events::trigger('render_user_form');
                                ?>
								<!-- Start of User Meta -->
								<?php
                                //$this->load->view('users/user_meta', array('frontend_only' => true));
                                ?>
								<!-- End of User Meta -->
							</fieldset>
						<?php echo form_close(); ?>	
					</div>
				</div>
            </div>
        </div>
    </div>
</section>
