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
?> 
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
);
?>  
<?php echo form_open('User/Trade_Tracker/Search', array('class' => "form-horizontal", 'id' => "deposit-funds-form", 'autocomplete' => 'off')); ?>  
<div class="modal fade" id="addTradeModal" tabindex="-1" aria-labelledby="createBankAccountModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Search for Stocks/ETFs</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<div class="modal-body"> 
				<div class="nk-block">
					<div class="row gy-gs">
						<div class="col-lg-12 col-xl-12">
							<div class="nk-block">
								<div class="nk-block-head-xs">
									<div class="nk-block-head-content">
										<p>
											<strong>Add Quick Trade</strong> 
										</p>
										<p>
										Track your most recent trades and discover your Investment Growth!
										</p>	 						
									</div>
								</div>
							</div>
							<div class="nk-block pt-1">
								<div class="row">
									<div class="col-lg-12">
										<fieldset>
											<?php
                                            Template::block('User/Trade_Tracker/Search/user_fields', 'User/Trade_Tracker/Search/user_fields', $fieldData);
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
<?php echo form_close(); ?>	
<?php if (validation_errors()) : ?>
	<div class="alert alert-error fade in">
		<?php echo validation_errors(); ?>
	</div>
<?php endif; ?>

