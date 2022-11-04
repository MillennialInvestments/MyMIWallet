<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass  			= empty($errorClass) ? ' error' : $errorClass;
$controlClass 			= empty($controlClass) ? 'span6' : $controlClass;
$pageURIA				= $this->uri->segment(1);
$pageURIB				= $this->uri->segment(2);
$pageURIC				= $this->uri->segment(3);
$pageURID				= $this->uri->segment(4);
?>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-md-12 mb-3">  
			<div class="nk-block">
				<div class="nk-block-head">
					<?php echo theme_view('navigation_breadcrumbs'); ?>
					<div class="nk-block-between-md g-4">
						<div class="nk-block-head-content">
							<h2 class="nk-block-title fw-bold">Application Submitted Successfully!</h2>
							<div class="nk-block-des">
								<p>
									<span >Thank You For Choosing MyMI Exchange To You List Your Digital Assets!</span>
									<span class="d-block d-md-none">Thank You For Choosing MyMI Exchange!</span>
								</p>
							</div>
						</div>
						<!-- <div class="nk-block-head-content">
							<ul class="nk-block-tools gx-3">
								<li>
									<a href="#" class="btn btn-primary text-white depositFundsBtn" role="button" data-toggle="modal" data-target="#transactionModal">
										<span>Deposit Funds</span> <em class="icon icon-arrow-right"></em>
									</a>
								</li>
								<li>
									<a href="#" class="btn btn-primary text-white withdrawFundsBtn" role="button" data-toggle="modal" data-target="#transactionModal">
										<span>Withdraw Funds</span> <em class="icon icon-arrow-right"></em>
									</a>
								</li>
							</ul>
						</div> -->
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-10 mb-3">
			<div class="nk-block">	
				<p>We ask that you please allow 24-48 hours for your Application to be reviewed! If approved, you will be notified by one of our Customer Support Staff in regards to your listing or any additional/required information needed to approve your Digital Asset.</p>
				<p>If you have any questions or need additional support, please reach out to our Customer Support Team via email at <a href="mailto:support@mymiwallet.com">support@mymiwallet.com</a>.</p>
				<a class="btn btn-primary" href="mailto:support@mymiwallet.com">Contact Us!</a>
			</div>
		</div>
	</div>
</div>								
