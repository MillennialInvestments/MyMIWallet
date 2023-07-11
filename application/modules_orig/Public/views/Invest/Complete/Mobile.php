<?php
    $pageURIB	= $this->uri->segment(2);
    $page_title	= str_replace("_", " ", $pageURIB);
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
	. img-hgt{height:}
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
								<h1 class="card-title display-5">WE WELCOME YOU!</h1>    
								<p class="card-description">STEP 3: Purchase Successful</p>
							</div>
						</div>       
						<hr> 
						<div class="row">
							<div class="col-12 col-md-7">
								<h2 class="card-title display-7 text-center">WELCOME TO MYMI!</h2>
								<p class="card-text blog-text">
									You have successfully complete your purchase of MyMI Coins to carry the badge of an MyMI Investor!
								</p>
								<p class="card-text blog-text">
									You will receive an email with further instructions to access even more tools to manage your new investment of MyMI Coins at Millennial Investments.
								</p>
								<hr> 
								<h4 class="card-title display-7">Need Support?</h4>
								<p class="card-text blog-text">
									If you need further assistance with completing your purchase of MyMI Coins, please contact us via email:
								</p>                                                                                     
								<a class="btn btn-primary btn-sm" href="mailto:invest@mymillennialinvestments.com">Email Support</a>
							</div>
						</div>     
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
