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
$beta           = $this->config->item('beta');
?>
<hr>
<div class="nk-app-root py-3">
	<div class="nk-main">
		<div class="nk-wrap">
			<div class="nk-content nk-content-fluid">
				<div class="container-xl wide-lg">
					<div class="nk-content-body">
						<div class="nk-block">
							<div class="row gy-gs">
								<div class="col-lg-12 col-xl-12">
									<div class="nk-block">
										<div class="nk-block-head-xs">
											<div class="nk-block-head-content">
												<h2 class="nk-block-title title text-center display-7">REGISTER TO INVEST!</h2>
<!--
												<a href="<?php echo site_url('/Trade-Tracker'); ?>">Return to Trade Tracker</a>							
-->
											</div>
										</div>
									</div>
									<div class="nk-block">
										<div class="row">
											<div class="col-lg-12 text-center"> 
                                                <p>Register an Investor Account with MyMI Wallet to invest in our MyMI Coin and obtain your stake in our Investment Accounting & Analytical Platform today!</p>
                                                <?php
                                                if ($beta === 'Yes') {
                                                    echo '<a class="btn btn-primary btn-sm" href="' . site_url('Beta/register') . '">Register Now!</a>';
                                                } else {
                                                    echo '<a class="btn btn-primary btn-sm" href="' . site_url('Free/register') . '">Register Now!</a>';
                                                }
                                                ?>
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
