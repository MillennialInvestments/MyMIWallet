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
<section class="cid-s0KKUOB7cY pt-0 pb-0 border-bottom" id="header01-m">
    <div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-sm-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body py-5">
						<div class="row">
							<div class="col-md-1"></div>
							<div class="col-12 col-sm-12 col-md-6 pl-5">
								<div class="row pb-3">
									<div class="col-12">
										<h1 class="mbr-section-title mbr-black mbr-bold mbr-fonts-style display-5 align-center">Registration Successful</h1>
										<p class="card-description align-center">Your account was successfully registered with <strong>MyMI Wallet</strong>!</p>
										<hr>
									</div>
								</div>
								<!-- <div class="row">
									<div class="col-md-1"></div>
									<div class="col-md-8">
										<?php 
                                        //$this->load->view('users/login-form'); 
                                        ?>
									</div>
								</div> -->
                                <div class="row">
                                    <div class="col-md-1"></div>
                                        <?php echo $this->load->view('users/Success/account_information'); ?>
                                    <div class="col-md-1"></div>
                                </div>
							</div>
							<div class="col-md-2 border-right px-5"></div>		
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
											<div class="rounded-circle border py-2 px-3 btn bg-default btn-sm text-default mb-1"><?php echo $step; ?></div>
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
											<div class="rounded-circle border py-2 px-3 btn bg-primary btn-sm text-white mb-1"><?php echo $step; ?></div>
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
</section>
