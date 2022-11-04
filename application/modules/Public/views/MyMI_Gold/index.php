<?php
    $pageURIA	= $this->uri->segment(1);
    $pageURIB	= $this->uri->segment(2);
    $page_title	= str_replace("-", " ", $pageURIA);
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
			<div class="col-10 grid-margin stretch-card px-5">
				<div class="card">
					<div class="card-body px-5 pt-3">
						<div class="row">
							<div class="col">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="<?php echo site_url('/How-To-Guides'); ?>">How It Works</a></li>
										<li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
									</ol>
								</nav>        
								<h1 class="card-title display-5">MANAGING YOUR TRADING WALLETS</h1>    
								<p class="card-description">STEP-BY-STEP GUIDE</p>
							</div>
						</div>       
						<hr> 
						<div class="row">
							<div class="col-8">
								<p class="card-text blog-text">
									Managing multpile trading accounts can be a hassle. That's why Millennial Investments has created a tool we like to call Wallets to make life easier for all Investors and Traders in the process of accounting for their investments and trades.
								</p>  
								<p class="card-text blog-text">
									Wallets allow you to track your deposits and withdrawals, as well as your trading log associated with each individual wallet to accurately account for total net gains or losses across all of your trading accounts.
								</p> 
								<h3 class="card-title display-7">What You'll Need To Get Started</h3>
								<p class="card-text blog-text">
									Creating a wallet is quick and easy, and you will simply need the following information to get started:
								</p>                                 
								<ul class="card-list">
									<li>Name of Brokerage Company</li>
									<li>Initial Account Net Worth</li>
									<li>Nickname of Account (Optional)</li>
								</ul>
							</div>
							<div class="col-4">
								<p class="card-description">How to manage My Wallets at Millennial Investments</p>                        
							</div>
						</div>       
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
