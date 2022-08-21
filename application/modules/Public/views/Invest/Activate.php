<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
);
$pageURIA		= $this->uri->segment(1);
$pageURIB		= $this->uri->segment(2);
$pageURIC		= $this->uri->segment(3);
$pageURID		= $this->uri->segment(4);
$orderID		= $pageURIC;
?>
<div class="nk-app-root py-3">
	<div class="nk-main">
		<div class="nk-wrap">
			<div class="nk-content nk-content-fluid">
				<div class="container-xl wide-lg">
					<div class="nk-content-body">
						<div class="nk-block">
							<div class="row pt-5 gy-gs">
								<div class="col-lg-12 col-xl-12">
									<div class="nk-block">
										<div class="nk-block-head-xs">
											<div class="nk-block-head-content">
												<h2 class="nk-block-title title text-center display-7">ACTIVATE YOUR INVESTOR ACCOUNT!</h2>
<!--
												<a href="<?php echo site_url('/Invest/Complete/' . $orderID); ?>">Return to Trade Tracker</a>							
-->
											</div>
										</div>
									</div>
									<div class="nk-block">
										<div class="row justify-content-center">
											<div class="col-12 col-md-10"> 
												<?php echo form_open('Public/Invest/Activate', array('class' => "form-horizontal", 'id' => "ask-question-form", 'autocomplete' => 'off')); ?>
													<fieldset>
														<?php
                                                        Template::block('users/wallet_meta', 'users/wallet_meta', $fieldData);
                                                        Template::block('Public/Invest/Activate/user_fields', 'Public/Invest/Activate/user_fields', $fieldData);
                                                        ?>
													</fieldset>
													<fieldset>
														<?php
                                                        // Allow modules to render custom fields. No payload is passed
                                                        // since the user has not been created, yet.
                                                        Events::trigger('render_user_form');
                                                        ?>
														<!-- Start of User Meta -->
														<?php //$this->load->view('users/user_meta', array('frontend_only' => true));?>
														<!-- End of User Meta -->
													</fieldset>
												<?php echo form_close(); ?>	
												<?php if (validation_errors()) : ?>
													<div class="alert alert-error fade in">
														<?php echo validation_errors(); ?>
													</div>
												<?php endif; ?>
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
</div>
