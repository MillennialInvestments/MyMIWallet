<?php
    $pageURIA							= $this->uri->segment(1);
    $pageURIB							= $this->uri->segment(2);
    $page_title							= str_replace("-", " ", $pageURIB);
    
    $getCoinValue						= $this->mymigold_model->get_coin_value();
    foreach ($getCoinValue->result_array() as $MyMIGold) {
        $initial_coin_value				= $MyMIGold['coin_value'];
        $initial_available_coins		= number_format($MyMIGold['available_coins'], 0);
        $initial_percent_increase		= 0.25;
        $initial_percent_increase_num	= $percent_increase * 100;
        $initial_new_available_coins	= $available_coins * $percent_increase;
    }
    $getInitialCoinValue				= $this->mymigold_model->get_initial_coin_value();
    foreach ($getCoinValue->result_array() as $MyMIGold) {
        $current_value					= number_format($MyMIGold['current_value'], 2);
        $coin_value						= number_format($MyMIGold['coin_value'], 8);
        $new_availability				= number_format($MyMIGold['new_availability'], 0);
    }
    $percent_increase					= 0.25;
    $percent_increase_num				= $percent_increase * 100;
    $new_available_coins				= number_format($initial_available_coins * $percent_increase * 1000000, 0);
    $package_a							= 5;
    $package_a_coins					= number_format($package_a / $coin_value, 0);
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
</style>
<section class="cid-s0KKUOB7cY py-0" id="header01-m">
    <div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-11 grid-margin stretch-card px-5">
				<div class="card">
					<div class="card-body px-5 pt-3">
						<div class="row">
							<div class="col">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="<?php echo site_url('/Premium-Features'); ?>">Premium Features</a></li>
										<li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
									</ol>
								</nav>        
								<h1 class="card-title display-5">PREMIUM WALLETS</h1>    
								<p class="card-description">STEP-BY-STEP GUIDE</p>
							</div>
						</div>       
						<hr> 
						<div class="row">
							<div class="col-12 col-md-7">
								<h2 class="card-title display-5 pt-4">What Are Premium Wallets?</h2>
								<p class="card-text blog-text pt-3">
									Every member receives (<strong>2</strong>) Free Wallets when they create a Free Memberships at MyMI Wallets to track their trades all in one place. Each wallet can either be a Fiat or Digital Wallet which is up to the discretion of the member. 
								</p>
								<p class="card-text blog-text pt-3">
									With our Premium Wallets, you will be able to purchase additional wallets with <a href="<?php echo site_url('How-It-Work/MyMI-Gold'); ?>">MyMI Gold Coins</a> to have the ability to track each individual trading account and have more precise analytics on your financial growth with each of your individual brokerage accounts.  
								</p>   
								<hr>       
								<h3 class="card-title display-5 pt-4">How MyMI Wallets Work</h3>
								<p class="card-text blog-text pt-3">
									A member can create an MyMI Wallet for each of their brokerage accounts (for ex: TD Ameritrade) and assign a purpose or nickname to the wallet, such as <strong>"Long-Term Investment"</strong> or <strong>"Day-Trading Account"</strong>. Once the wallet has been created and assigned, the member can utilize our Free Trade Tracker to track and receive analytics for (<strong>1</strong>) month of trades.  
								</p> 
								<p class="card-text blog-text pt-3">
									<strong>NOTE:</strong> In order to access additional features using our trade tracker, you can purchase our Advanced Trade Tracker package to obtain customizable analytics, as well as track trades over a longer period of time. You can reference our Premium Trade Tracker Feature by clicking below for more information: 
								</p> 
								<a class="btn btn-primary btn-rounded btn-sm" href="<?php echo site_url('Premium-Features/Advanced-Trade-Tracker'); ?>">Premium Trade Tracker</a>   
								<hr> 
								<h4 class="card-title display-5 pt-4">How to access Additional Wallets</h4>
								<p class="card-text blog-text pt-3">
									In order to purchase additional wallets, you will need to purchase <a href="<?php echo site_url('How-It-Works/MyMI-Gold'); ?>">MyMI Gold Coins</a> to gain access to more wallets to assign to each of your brokerage accounts.
								</p>       
								<p class="card-text blog-text pt-3 text-center"> 
									<strong>The current cost of Additional Wallets:</strong> 
									<table class="table table-borderless">
										<thead>
											<tr>
												<th class="text-center">Cost of Wallet(s)</th>
												<th class="text-center">Total MyMI Gold Coins</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="text-center">$<?php echo $package_a; ?>/Month</td>
												<td class="text-center"><?php echo $package_a_coins; ?> MyMI Gold</td>
											</tr>
										</tbody>
									</table>
								</p>   
								<hr> 
								<?php $this->load->view('Support/Need_Assistance'); ?>
							</div>
							<div class="col-md-1 border-right px-5"></div>
							<div class="col-12 col-md-4 pl-5">
								<h2 class="card-title display-5 pt-4">Related Topics:</h2>
								<ul>
									<li>
										<a href="<?php echo site_url('How-It-Works/MyMI-Gold'); ?>">How to purchase MyMI Gold</a>
									</li>       
									<li>
										<a href="<?php echo site_url('Premium-Features/Advanced-Trade-Tracker'); ?>">How to use Advanced Trade Tracker</a>
									</li>
									<li>                    
										<a href="<?php echo site_url('Premium-Features/Advanced-Charting'); ?>">How to use Advanced Charting</a> 
									</li>
									<li>                             
										<a href="<?php echo site_url('Premium_Features/Brokerage-Integrations'); ?>">How to integrate Brokerage Accounts</a>
									</li>
									<li>                                                    
										<a href="<?php echo site_url('Premium-Features/Due-Diligence-Database'); ?>">How Community Due Database works</a>   
									</li>
								</ul>                                       
							</div>
						</div>       
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
