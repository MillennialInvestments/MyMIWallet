<?php
    $pageURIB	                                = $this->uri->segment(2);
    $page_title	                                = str_replace("_", " ", $pageURIB);
    $cuID					 					= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
?>
<style>
	@media (max-width: 375px) {
	#header01-m {padding-top: 15px !important;}	
	}
	@media (min-width: 767px) {
	#header01-m {padding-top: 1rem !important;}
	}
	.breadcrumb{background-color: transparent !important;}
	.blog-text{font-size:1.25rem;} 
	.img-hgt{min-height:38px;max-height:68px;}
</style>
<section class="cid-s0KKUOB7cY py-0" id="header01-m">
    <div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 col-md-10 grid-margin stretch-card px-5">
				<div class="card">
					<div class="card-body pt-3">
						<div class="row">
							<div class="col">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="<?php echo site_url('/Invest'); ?>">Invest</a></li>
										<li class="breadcrumb-item active" aria-current="page">Become An Investor</li>
									</ol>
								</nav>        
								<h1 class="card-title display-5 d-none d-md-block">BECOME AN INVESTMENT PARTNER OF MILLENNIAL INVESTMENTS</h1>    
								<h1 class="card-title display-7 d-block d-md-none">BECOME AN INVESTMENT PARTNER OF MILLENNIAL INVESTMENTS</h1>    
								<p class="card-description">STEP 1: Puchase MyMI Coins</p>
							</div>
						</div>       
						<hr> 
						<div class="row">
							<?php if ($this->agent->is_mobile()) { ?>
							<div class="col-12 col-md-5 border-left border-right">     
								<h4 class="card-title text-center display-7 mb-5">GET STARTED NOW!</h4>  
								<p class="card-text blog-text text-center">
									<strong>MYMI CURRENT VALUE</strong>
								</p>   
								<table class="table table-borderless">
									<?php
                                    $getCoinValue	= $this->investment_model->get_coin_value();
                                    foreach ($getCoinValue->result_array() as $coinValue) {
                                        $initial_value				= $coinValue['initial_value'];
                                        $available_coins			= $coinValue['available_coins'] - 11500000;
                                        $coin_value					= round($initial_value / $coinValue['available_coins'], 8);
                                        $current_value				= $coin_value * 115000000;
                                        $minimum_coin_amount		= $coinValue['minimum_coin_amount'];
                                        $minimum_purchase			= $this->config->item('minimum_purchase');
                                        $gas_fee					= $this->config->item('gas_fee');
                                        $trans_percent				= $this->config->item('trans_percent');
                                        $trans_fee					= $this->config->item('trans_fee');
                                        $data 						= array(
                                            'initial_value'			=> $initial_value,
                                            'available_coins'		=> $available_coins,
                                            'coin_value'			=> $coin_value,
                                            'minimum_purchase'		=> $minimum_purchase,
                                            'minimum_coin_amount' 	=> $minimum_purchase / $coin_value,
                                            'gas_fee'				=> $gas_fee,
                                            'trans_percent'			=> $trans_percent,
                                            'trans_fee'				=> $trans_fee,
                                            
                                        );
                                        echo '
									<tr>
										<th>Total Net Worth:</th>
										<td class="text-right">$' . number_format($current_value, 2) . '</td>
									</tr>
									<tr>
										<th>Qty. Available:</th>
										<td class="text-right">' . number_format($available_coins, 0) . '</td>
									</tr>
									<tr>
										<th>Cost Per Coin:</th>
										<td class="text-right">$' . number_format($coin_value, 8) . '</td>
									</tr>
									<tr>
										<th>Min. Coins/Purchase:</th>
										<td class="text-right">' . number_format($minimum_coin_amount, 0) . '</td>
									</tr>
									<tr>
										<th>Min. Purchase Amount:</th>
										<td class="text-right">$' . $minimum_purchase . '.00</td>
									</tr>
									<tr>
										<th>Gas Fees:</th>
										<td class="text-right">0.00007457</td>
									</tr>
										';
                                    }
                                    ?>
								</table>
								<?php
                                if (!empty($cuID)) {
                                    $this->load->view('Public/Invest/Request', $data);
                                } else {
                                    $this->load->view('Public/Invest/Register', $data);
                                }
                                ?>
							</div>
							<?php } ?>
							<div class="col-12 col-md-7">
								<p class="card-text blog-text">
									Looking to become an investor in Millennial Investments to profit from the growth of our platform? We are now allowing interested investors to own their stake of Millennial Investments by purchasing their shares of our MyMI Crypto Coin! 
								</p>  
								<p class="card-text blog-text pb-3">
									Already own MyMI Coins? <a href="<?php echo site_url('Free/register'); ?>">Register</a> or <a href="<?php echo site_url('login'); ?>">Log In</a> to your Investor Account!
								</p> 
								<h3 class="card-title display-7">What You'll Need To Get Started</h3>
								<p class="card-text blog-text">
									Investing is quick and easy! You will simply need to complete the following steps:
								</p>                                 
								<ul class="card-list">
									<li class="pb-3">
										Create Digibyte Wallet using the <a href="https://digibytewallets.com/">Digibyte Mobile App</a> on your Mobile Device to receive your <strong>MyMI Coins</strong>. 
										<br>
										<div class="row">
											<span class="col-md-2"></span>
											<span class="col-6 col-md-4">
												<a href="https://play.google.com/store/apps/details?id=io.digibyte&hl=en_US&gl=US">
													<img class="full-width img-hgt" src="<?php echo base_url('assets/images/google-play-store.png'); ?>" alt="Digibyte Mobile Wallet App - Google Play Store" />
												</a>
											</span>
											<span class="col-6 col-md-4">
												<a href="https://apps.apple.com/us/app/digibyte/id1378061425">
													<img class="full-width img-hgt" src="<?php echo base_url('assets/images/apple-app-store.png'); ?>" alt="Digibyte Mobile Wallet App - Apple App Store" />
												</a>
											</span>
										</div>
									</li>
									<li class="pb-3">
										Once you have created your wallet and obtained a DigiAsset Wallet ID, simply complete the form to begin your purchase
									</li>
									<li class="pb-3">
										After submitting the form, you will be redirected to complete your payment for your purchase of MyMI Coins via PayPal.
										<br>
										<small>Please note: You will not need a PayPal Account to complete the transaction. PayPal allows Guest to use the selected payment method of your choice.</small>
									</li>
									<li class="pb-3">
										Once we have received your payment, we will send your MyMI Crypto to your Digibyte Mobile App. 
									</li>
								</ul>
								<h3 class="card-title display-7">What Do I Gain From My Investment?</h3>
								<p class="card-text blog-text">
									As other investors continue to purchase their shares of MyMI Coins, your investment will continue to increase in value. We also will elect to commit 50% of our Monthly Membership Sales towards the MyMI Net Worth to assist in the exponential growth of value for the MyMI Coins you own.
									<br>
									The reason we will only commit 50% of the Monthly Membership Sales to the MyMI Network is due to the expenses required to continue to manage the platform. Investors will also have the ability to elect to utilize their own MyMI Coins to pay for their own monthly memberships.
								</p>
								<h3 class="card-title display-7">Additional Methods To Acquire MyMI Coins:</h3>
								<p class="card-text blog-text">
									Millennial Investments Members and Investors can also gain access to obtaining additional MyMI Coins by referring investors and traders to purchase a Monthly Membership.
								</p>
								<ul class="card-list">
									<li class="pb-3">
										Members/Investors will receive 50% of the total value for our Monthly Memberships in MyMI Coins per Membership they refer after the new members initial purchase of that membership.
									</li>
									<li class="pb-3">
										Members/Investors will continue to receive 25% of the total value for Monthly Memberships for every subsequent month that a member continues to have their Active Membership.
									</li>
								</ul>
							</div>
<!--
							<div class="col-12 col-md-4 pl-5 border-left border-right">     
								<h4 class="card-title text-center display-7 mb-5">GET STARTED NOW!</h4>  
								<p class="card-text blog-text">
									<strong>MYMI CURRENT VALUE</strong>
								</p>   
								<table class="table table-borderless">
									<?php
                                    //~ $getCoinValue	= $this->investment_model->get_coin_value();
                                    //~ foreach ($getCoinValue->result_array() as $coinValue) {
                                        //~ echo '
                                    //~ <tr>
                                        //~ <th>Qty. Available:</th>
                                        //~ <td>' . $coinValue['available_coins'] . '</td>
                                    //~ </tr>
                                    //~ <tr>
                                        //~ <th>Total Net Worth:</th>
                                        //~ <td>' . $coinValue['initial_value'] . '</td>
                                    //~ </tr>
                                    //~ <tr>
                                        //~ <th>Cost per Coin:</th>
                                        //~ <td>' . $coinValue['coin_value'] . '</td>
                                    //~ </tr>
                                        //~ ';
                                    //~ }
                                    ?>
								</table>
								<hr>
								<h4 class="card-title text-center display-7 my-5">REGISTER AN INVESTOR ACCOUNT!</h4> 
								<p class="card-text blog-text">
									To purchase your share of MyMI Coins and own your stake in the Millennial Investments Platform, register an Investor Account by clicking the link below: 
								</p> 
								<p class="text-center">
									<a class="btn btn-primary text-center" href="<?php echo site_url('Investor/register'); ?>">Get Started!</a>
								</p>
								<hr>
								<h4 class="card-title text-center display-7 my-5">ALREADY A REGISTERED MEMBER?</h4> 
								<p class="card-text blog-text">
									Already have an Membership with Millennial Investments? Not an issue! Claim your stake in Millennial Investments by clicking the link below: 
								</p> 
								<p class="text-center">
									<a class="btn btn-primary text-center" href="<?php echo site_url('Investor/login'); ?>">LOGIN!</a>
								</p>
							</div>
-->
							
							<?php if (!$this->agent->is_mobile()) { ?>
							<div class="col-12 col-md-5 pl-5 border-left border-right">     
								<h4 class="card-title text-center display-7 mb-5">GET STARTED NOW!</h4>  
								<p class="card-text blog-text text-center">
									<strong>MYMI CURRENT VALUE</strong>
								</p>   
								<table class="table table-borderless">
									<?php
                                    $ownership_coins				= $this->config->item('ownership_coins');
                                    $getCoinValue					= $this->investment_model->get_coin_value();
                                    foreach ($getCoinValue->result_array() as $coinValue) {
                                        $initial_value				= $coinValue['initial_value'];
                                        $available_coins			= $coinValue['available_coins'] - $ownership_coins;
                                        $coin_value					= round($initial_value / $coinValue['available_coins'], 8);
                                        $current_value				= $coin_value * 115000000;
                                        $minimum_coin_amount		= $coinValue['minimum_coin_amount'];
                                        $minimum_purchase			= $this->config->item('minimum_purchase');
                                        $gas_fee					= $this->config->item('gas_fee');
                                        $trans_percent				= $this->config->item('trans_percent');
                                        $trans_fee					= $this->config->item('trans_fee');
                                        $data 						= array(
                                            'initial_value'			=> $initial_value,
                                            'available_coins'		=> $available_coins,
                                            'coin_value'			=> $coin_value,
                                            'minimum_purchase'		=> $minimum_purchase,
                                            'minimum_coin_amount' 	=> $minimum_purchase / $coin_value,
                                            'gas_fee'				=> $gas_fee,
                                            'trans_percent'			=> $trans_percent,
                                            'trans_fee'				=> $trans_fee,
                                            
                                        );
                                        echo '
									<tr>
										<th>Total Net Worth:</th>
										<td class="text-right">$' . number_format($current_value, 2) . '</td>
									</tr>
									<tr>
										<th>Qty. Available:</th>
										<td class="text-right">' . number_format($available_coins, 0) . '</td>
									</tr>
									<tr>
										<th>Cost Per Coin:</th>
										<td class="text-right">$' . number_format($coin_value, 8) . '</td>
									</tr>
									<tr>
										<th>Min. Coins/Purchase:</th>
										<td class="text-right">' . number_format($minimum_coin_amount, 0) . '</td>
									</tr>
									<tr>
										<th>Min. Purchase Amount:</th>
										<td class="text-right">$' . $minimum_purchase . '.00</td>
									</tr>
									<tr>
										<th>Gas Fees:</th>
										<td class="text-right">0.00007457</td>
									</tr>
										';
                                    }
                                    ?>
								</table>
								<?php
                                if (!empty($cuID)) {
                                    $this->load->view('Public/Invest/Request', $data);
                                } else {
                                    $this->load->view('Public/Invest/Register', $data);
                                }
                                ?>
							</div>
							<?php } ?>
						</div>     
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
