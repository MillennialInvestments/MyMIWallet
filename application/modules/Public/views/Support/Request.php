<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
    $errorClass   = empty($errorClass) ? ' error' : $errorClass;
    $controlClass = empty($controlClass) ? 'span6' : $controlClass;
    $fieldData = array(
        'errorClass'    => $errorClass,
        'controlClass'  => $controlClass,
    );
?>
<?php
$cuID 						= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
?>
<?php if ($this->uri->segment(1) === 'Customer-Support') {?>
<style>
	@media (max-width: 375px) {
	#support {padding-top: 15px !important;}	
	}
	@media (min-width: 767px) {
	#support {padding-top: 1rem !important;}
	}
</style>
<?php } ?>
<section class="cid-s0KKUOB7cY border-bottom" id="support">
    <div class="container-fluid px-0">
        <div class="row justify-content-center py-0">
            <div class="mbr-black col-sm-12 col-md-12 col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body py-5">
						<div class="row justify-content-center">
							<div class="col-sm-12 col-md-6 col-lg-6 pr-5">
								<div class="row justify-content-center">
									<h1 class="text-center">Submit a Support Request</h1>
								</div>
								<br>
								<?php echo form_open('Support/Request', array('class' => "form-horizontal", 'id' => "ask-question-form", 'autocomplete' => 'off')); ?>
									<fieldset>
										<?php Template::block('Request/user_fields', 'Request/user_fields', $fieldData); ?>
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
									<fieldset>
										<div class="control-group">
											<div class="controls ml-3">
												<input class="btn btn-primary" type="submit" name="register" id="submit" value="Submit" />
											</div>
										</div>
									</fieldset>
								<?php echo form_close(); ?>	
								<?php if (validation_errors()) : ?>
									<div class="alert alert-error fade in">
										<?php echo validation_errors(); ?>
									</div>
								<?php endif; ?>
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4 ">
								<div class="row justify-content-center">
									<h1>Connect With Us</h1>
								</div>
								<br>
								<br> 
								<h4 class="card-title">Service Request Information</h4>
								<p class="card-description">Contact us by using the information below:</p>
								<div class="row justify-content-center pb-4 mb-5">
                                    <?php
                                    $this->db->from('bf_external_sites');
                                    $this->db->where('active', 'Yes');
                                    $this->db->where('customer_support', 'Yes');
                                    $getExternalLinks   = $this->db->get();

                                    foreach ($getExternalLinks->result_array() as $extLinks) {
                                        echo '
                                        <div class="col">
                                            <td><a class="btn btn-default btn-sm" href="' . $extLinks['url_link'] . '"><i class="' . $extLinks['icon'] . ' mr-2"></i> ' . $extLinks['site'] . '</a></td>
                                        </div>
                                        ';
                                    };
                                            ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>	
<?php
if ($cuID !== 0) {
    //$this->load->view('Support/Open_Requests');
}
$this->load->view('Support/FAQ');
?>

