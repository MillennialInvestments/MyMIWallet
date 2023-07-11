<?php

$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
    'errorClass'        => $errorClass,
    'controlClass'      => $controlClass,
);
$registerType           = $this->uri->segment(1);
$register               = $this->uri->segment(2);
if ($registerType === 'Investor') {
    $title		        = 'Create an Investor Account';
} elseif ($registerType === 'Team') {
    $title              = 'Join The MyMI Team';
} else {
    $title		        = 'Register an Account';
};
$formData               = array(
    'registerType'      => $registerType,
    'register'          => $register,
    'title'             => $title,
);
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
                    <span class="overline-title">Register An Account</span>
                    <h2 class="intro-heading-lead title">Account Registration</h2>
                    <div class="intro-section-desc">
                        <p>
                            Register your <?php echo $registerType; ?> Account to join our Community of Investors and Partners, while enjoying the benefits of our Investment Accounting/Analytical Software and Crypto Asset Marketplace & Exchange.
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
                        <div class="intro-banner-wrap">
                            <div class="row justify-content-center">
                                <div class="col-md-1 col-sm-1"></div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <?php $this->load->view('users/register_form', $formData); ?>
                                </div>	
                                <div class="d-none d-sm-block col-md-3 col-sm-3 pl-5 border-left">         
                                    <h2 class="mbr-section-title mb-5 pb-3 mbr-fonts-style card-title display-7">My Progress</h2>
                                    <div class="stepper d-flex flex-column mt-5 ml-2">
                                        <?php
                                        $step				= 1;
                                        ?>
                                        <div class="d-flex mb-1">
                                            <div class="d-flex flex-column pr-4 align-items-center">
                                                <div class="rounded-circle border py-2 px-3 btn bg-primary btn-sm text-white mb-1"><?php echo $step; ?></div>
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
                                                <div class="rounded-circle border py-2 px-3 btn bg-default btn-sm text-default mb-1"><?php echo $step; ?></div>
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
                        </div>	
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
