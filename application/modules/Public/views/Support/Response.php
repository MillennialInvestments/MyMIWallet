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
    $requestID		= $this->uri->segment(3);
    $this->db->from('bf_support_requests');
    $this->db->where('id', $requestID);
    $getRequests	= $this->db->get();
        
    $this->db->from('bf_support_requests');
    $this->db->where('res_id', $requestID);
    $getResponses	= $this->db->get();
    
?>
<section class="cid-s0KKUOB7cY border-bottom pb-0" id="header01-m">
    <div class="container-fluid px-0">
        <div class="row justify-content-center py-0">
            <div class="mbr-black col-sm-12 col-md-12 col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body py-5 ">
						<div class="row justify-content-center">
							<div class="col-sm-12 col-md-6 col-lg-6 pr-5">
								<div class="row justify-content-center">
									<h1>Customer Support Request</h1>
								</div>
								<br>
								<div class="row">
									<div class="col">
										<table class="table table-default">
											<tbody>
											<?php
                                            foreach ($getRequests->result_array() as $reqInfo) {
                                                $date		= $reqInfo['date'];
                                                $time		= $reqInfo['time'];
                                                $email		= $reqInfo['email'];
                                                $name		= $reqInfo['name'];
                                                $details	= $reqInfo['details'];
                                                echo '
												<tr>
													<td>
														<strong>' . $name . ' - ' . $email . '
														<br>
														<span class="text-muted">' . $date . ' - ' . $time . '</span></strong>
														<br>
														<br>
														' . $details . '
													</td>
												</tr>
												';
                                            }
                                            foreach ($getResponses->result_array() as $resInfo) {
                                                $date		= $resInfo['res_date'];
                                                $time		= $resInfo['res_time'];
                                                $email		= $resInfo['email'];
                                                $name		= $resInfo['name'];
                                                $details	= $resInfo['details'];
                                                echo '
												<tr>
													<td>
														<strong>' . $name . ' - ' . $email . '
														<br>
														<span class="text-muted">' . $date . ' - ' . $time . '</span></strong>
														<br>
														<br>
														' . $details . '
													</td>
												</tr>
												';
                                            }
                                            ?>
											</tbody>
										</table>
									</div>
								</div>
								<hr>
								<?php echo form_open('Support/Response', array('class' => "form-horizontal", 'id' => "ask-question-form", 'autocomplete' => 'off')); ?>
									<fieldset>
										<?php Template::block('Response/user_fields', 'Response/user_fields', $fieldData); ?>
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
									<table class="table table-borderless">
										<tbody>
											<tr>
												<td>Email:</td>
												<td><a href="mailto:support@mymillennialinvestments.com">Customer Support</a></td>
											</tr>
											<tr>
												<td>StockTwits:</td>
												<td><a href="https://www.stocktwits.com/MillennialInvestments/">@MillennialInvestments</a></td>
											</tr>
											<tr>
												<td>Facebook:</td>
												<td><a href="https://www.facebook.com/MyMillennialInvestments/">@MyMillennialInvestments</a></td>
											</tr>
											<tr>
												<td>Twitter:</td>
												<td><a href="https://twitter.com/MyMillennialPro">@MyMillennialPro</a></td>
											</tr>
											<tr>
												<td>LinkedIn:</td>
												<td><a href="https://www.linkedin.com/company/my-millennial-investments">LinkedIn</a></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>	
<?php $this->load->view('Support/FAQ'); ?>

