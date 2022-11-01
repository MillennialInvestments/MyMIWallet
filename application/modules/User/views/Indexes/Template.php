<?php
$redirectURL			= $this->uri->uri_string();
$exchange 				= $this->uri->segment(2);
$symbol 				= $this->uri->segment(3);
$cuID				 	= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$cuRole	 				= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
// Set Date & Time
$userData               = array(
    'redirectURL'       => $redirectURL,
    'date'              => date("F jS, Y"),
    'hostTime'          => date("g:i A"), 
    'exchange'          => $exchange,
    'symbol'            => $symbol,
    'cuID'              => $cuID,
    'cuRole'            => $cuRole,
);
?>
<style>
	@media (max-width: 375px) {
	#header01-m {padding-top: 15px !important;}	
	}
	@media (min-width: 767px) {
	#header01-m {padding-top: 0rem !important;}
	}
	.tradingview-widget-container {max-height:1024px; height: 100%;}
	.posts-feed {background-color: transparent;}
	.body {background-color: transparent;}
	#add-post-card-body{padding-top:0px !important;}
	#add-post-form{padding-top:0px !important;}     
	#add-post-form-row{margin-bottom:0rem !important;}
	#add-post-share-buttons{margin-top:0rem !important;}
	#additional-row{padding-top:0px !important;}
	#trade-alert-card-body{padding-top:0px !important;}
	#like-button-form{padding-left:0px !important; padding-right:0px !important;}
	#add-comment-form{padding-left:0px !important; padding-right:0px !important;}
	.textarea-modal-btn {border:none;background:none;width:100%;max-width:100%}
	.btn-secondary {
		background-color: #fff;
		color: #212529 !important;
		border:none;
	}
	.user-comment-btns {
		color: #212529 !important;
		border:none;
	}
</style>

<?php
// Mobile Version
if ($this->agent->is_mobile()) {
    $this->load->view('includes/Mobile_Template');
} else {
    ?>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-lg-12 col-xl-12">
			<div class="nk-block">
				<div class="nk-block-head-xs">
					<div class="nk-block-head-content">
						<h1 class="nk-block-title title">Web Development - Content Creator</h1>
						<p id="private_key"></p>
						<p id="address"></p>
						<!-- <a href="<?php //echo site_url('/Trade-Tracker'); ?>">Test Page Environment</a>							 -->
					</div>
				</div>
			</div>
			<div class="nk-block">
                <div class="card card-bordered">
                    <div class="card-body">
						<div class="row justify-content-center mb-0">
							<div class="col-sm-12 col-md-12 col-lg-12 pr-0">
								<?php
                                //~ $this->load->view('Stocks/includes/Symbol_Info');
                                $this->load->view('ETF/includes/Advanced_Real_Time_Chart', $userData); ?>
							</div>
						</div>
                    </div>
                </div>
			</div>    
		</div>    
	</div>    
</div>    
<?php
    $this->load->view('includes/Desktop_Template', $userData);
}
?>

<?php
if (isset($cuUserID)) {
    //$this->load->view('Management/Advertisements/Users/Membership_Ads/Dashboard/Referrals', $userData);
} else {
    //$this->load->view('Management/Advertisements/Registration-Ad', $userData);
}
?>
