<?php

$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
);
$registerType = $this->uri->segment(1);
$register = $this->uri->segment(2);
?>
<?php
if ($registerType === 'Investor') {
    $title		= 'Create an Investor Account';
} else {
    $title		= 'Create an Account';
};
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
<div class="intro-section intro-feature bg-white" id="features">
    <div class="container container-ld">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-7">
                <div class="intro-section-title text-center">
                    <span class="overline-title">Register Your <?php echo $registerType; ?> Account</span>
                    <h2 class="intro-heading-lead title">Account Registration</h2>
                    <div class="intro-section-desc">
                        <p>
                            Register your <?php echo $registerType; ?> Account to join our Community of Investors and Partners, while enjoying the benefits of our Investment Accounting/Analytical
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="row intro-feature-list">
                    <div class="col-sm-6 col-lg-4">
                        <div class="intro-feature-item">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="cid-s0KKUOB7cY border-bottom pb-0" id="header01-m">
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
										<?php Template::block('user_fields', 'user_fields', $fieldData); ?>	
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
									<div class="col-12 col-sm-12 col-md-3 pl-5">         
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
<script>
$(document).ready(function(){

var current_fs, next_fs, previous_fs;

// No BACK button on first screen
if($(".show").hasClass("first-screen")) {
$(".prev").css({ 'display' : 'none' });
}

// Next button
$(".next-button").click(function(){

current_fs = $(this).parent().parent();
next_fs = $(this).parent().parent().next();

$(".prev").css({ 'display' : 'block' });

$(current_fs).removeClass("show");
$(next_fs).addClass("show");

$("#progressbar li").eq($(".card2").index(next_fs)).addClass("active");

current_fs.animate({}, {
step: function() {

current_fs.css({
'display': 'none',
'position': 'relative'
});

next_fs.css({
'display': 'block'
});
}
});
});

// Previous button
$(".prev").click(function(){

current_fs = $(".show");
previous_fs = $(".show").prev();

$(current_fs).removeClass("show");
$(previous_fs).addClass("show");

$(".prev").css({ 'display' : 'block' });

if($(".show").hasClass("first-screen")) {
$(".prev").css({ 'display' : 'none' });
}

$("#progressbar li").eq($(".card2").index(current_fs)).removeClass("active");

current_fs.animate({}, {
step: function() {

current_fs.css({
'display': 'none',
'position': 'relative'
});

previous_fs.css({
'display': 'block'
});
}
});
});

});
</script>
