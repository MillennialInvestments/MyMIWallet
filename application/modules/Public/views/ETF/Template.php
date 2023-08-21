<?php
$redirectURL			= $this->uri->uri_string();
$exchange 				= $this->uri->segment(2);
$symbol 				= $this->uri->segment(3);
$cuID				 	= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$cuRole	 				= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
// Set Date & Time
$data['redirectURL']	= $redirectURL;
$data['date']			= date("F jS, Y");
$data['hostTime'] 		= date("g:i A");
$data['exchange']		= $exchange;
$data['symbol']			= $symbol;
$data['cuID']			= $cuID;
$data['cuRole']			= $cuRole;

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
<section class="cid-s0KKUOB7cY py-0" id="header01-m">
    <div class="container-fluid full-width px-0">
		<div class="row">
			<div class="col-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body p-0">
						<div class="row justify-content-center mb-0">
							<div class="col-sm-12 col-md-12 col-lg-12 pr-0">
								<?php
                                //~ $this->load->view('Stocks/includes/Symbol_Info');
                                $this->load->view('Stock/includes/Advanced_Real_Time_Chart', $data); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
    $this->load->view('includes/Desktop_Template');
}
?>

<?php
if (isset($cuUserID)) {
    $this->load->view('Management/Advertisements/Users/Membership_Ads/Dashboard/Referrals', $data);
} else {
    $this->load->view('Management/Advertisements/Registration-Ad', $data);
}
?>
