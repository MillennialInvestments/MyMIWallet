<?php

$errorClass   		= empty($errorClass) ? ' error' : $errorClass;
$controlClass 		= empty($controlClass) ? 'span6' : $controlClass;
$fieldData 			= array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
);
$pageURIA           = $this->uri->segment(1);
if ($pageURIA === 'Investor') {
    $cuID           = $this->uri->segment(3);
} else {
    $cuID			= $this->uri->segment(2);
}
$getUserEmail		= $this->user_model->get_user_email($cuID);
foreach ($getUserEmail->result_array() as $userInfo) {
    $cuEmail		= $userInfo['email'];
    $registerType   = $userInfo['type'];
}
$title				= 'Verify Email Address';
?>
<style scoped='scoped'>
#register p.already-registered {
    text-align: center;
}
</style>
<style>
	@media (max-width: 375px) {
	#header01-m {padding-top: 15px !important;}	
	}
	@media (min-width: 767px) {
	#header01-m {padding-top: 1rem !important;}
	}
</style>
<div class="intro-section intro-feature bg-white pb-0" id="features">
    <div class="container container-ld pt-5">
        <div class="row justify-content-center pt-3">
            <div class="col-lg-9 col-xl-7">
                <div class="intro-section-title text-center">
                    <span class="overline-title">Verfi Your <?php echo $registerType; ?> Account</span>
                    <h2 class="intro-heading-lead title">Account Registration</h2>
                    <div class="intro-section-desc">
                        <p>
                            Activate your account to verify your email address to to join our Community of Investors and Partners, while enjoying the benefits of our Investment Accounting/Analytical Software and Crypto Asset Marketplace & Exchange.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="intro-section intro-feature bg-white pt-0" id="registration-form">
    <div class="container-fluid px-0">
        <div class="row justify-content-center py-0">
            <div class="mbr-black col-sm-12 col-md-12 col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body py-5">
						<?php echo form_open($registerType . '/register', array('class' => "form-horizontal", 'autocomplete' => 'off')); ?>
							<fieldset>
								<div class="row">
									<div class="col-md-1"></div>
									<div class="col-12 col-sm-12 col-md-7 pl-5">
										<h1 class="mbr-section-title mbr-bold mb-1 pb-3 mbr-fonts-style card-title display-7"><?php echo $title; ?></h1>	
										<p class="mbr-bold mb-0">A verification email has been sent to <?php echo '<span style="color:green">' . $cuEmail . '</span>'; ?>.</p>
										<p class="text-muted">Please open the email and click on the "Verify" button to confirm that the email address belongs to you.</p>
										<p class="mbr-bold mb-0">Did not receive the email within 5 minutes?</p>
										<ul class="text-muted">
											<li>Make sure you provided the correct email address.</li>
											<li>Check your email spam/junk folder.</li>
											<li>Verify that you haven't already signed up for an account with this email address.</li>
											<li>To resend the Activation Code to your email, click <a href="<?php echo site_url('/resend-activation/' . $cuID); ?>">here</a></li>
										</ul>
										<p class="mbr-bold mb-0">Need assistance?</p>
										<p class="text-muted"> Contact <a href="mailto:support@mymiwallet.comm">support@mymiwallet.com</a></p>
									</div>
									<div class="col-md-1 border-right px-5"></div>		
									<div class="col-12 col-sm-12 col-md-3 pl-5">                    
										<h2 class="mbr-section-title mb-5 pb-3 mbr-fonts-style card-title display-7">My Progress</h2>
										<div class="stepper d-flex flex-column mt-5 ml-2">
											<?php
                                            $step				= 1;
                                            ?>
											<div class="d-flex mb-1">
												<div class="d-flex flex-column pr-4 align-items-center">
													<div class="rounded-circle border py-2 px-3 btn bg-default btn-sm text-default mb-1"><?php echo $step; ?></div>
													<div class="line h-100"></div>
												</div>
												<div class="pt-3">
													<h6 class="text-dark">Register Account</h6>
												</div>
											</div>
											<?php
                                            $step				= $step + 1;
                                            ?>
											<div class="d-flex mb-1">
												<div class="d-flex flex-column pr-4 align-items-center">
													<div class="rounded-circle border py-2 px-3 btn bg-primary btn-sm text-white mb-1"><?php echo $step; ?></div>
													<div class="line h-100"></div>
												</div>
												<div class="pt-3">
													<h6 class="text-dark">Verify Email Address</h6>
												</div>
											</div>
											<?php
                                            $step				= $step + 1;
                                            ?>
											<div class="d-flex mb-1">
												<div class="d-flex flex-column pr-4 align-items-center">
													<div class="rounded-circle border py-2 px-3 btn bg-default btn-sm text-default mb-1"><?php echo $step; ?></div>
													<div class="line h-100"></div>
												</div>
												<div class="pt-3">
													<h6 class="text-dark">Account Information</h6>
												</div>
											</div>
											<?php
                                            //~ $step				= $step + 1;
                                            ?>
<!--
											<div class="d-flex mb-1">
												<div class="d-flex flex-column pr-4 align-items-center">
													<div class="rounded-circle border py-2 px-3 btn bg-default btn-sm text-primary mb-1"><?php echo $step; ?></div>
													<div class="line h-100"></div>
												</div>
												<div class="pt-3">
													<h6 class="text-dark">Additional Information (Optional)</h6>
												</div>
											</div>
-->
											<?php
                                            $step				= $step + 1;
                                            ?>
											<div class="d-flex mb-1">
												<div class="d-flex flex-column pr-4 align-items-center">
													<div class="rounded-circle border py-2 px-3 btn bg-default btn-sm text-default mb-1"><?php echo $step; ?></div>
												</div>
												<div class="pt-3">
													<h6 class="text-dark">Registration Complete</h6>
												</div>
											</div>
										 </div>	
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
</div>
