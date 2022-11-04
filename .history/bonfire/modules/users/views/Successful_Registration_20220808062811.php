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
<div class="intro-section intro-feature bg-white pb-0" id="features">
    <div class="container container-ld pt-5">
        <div class="row justify-content-center pt-3">
            <div class="col-lg-9 col-xl-7">
                <div class="intro-section-title text-center">
                    <span class="overline-title">Account Information</span>
                    <h2 class="intro-heading-lead title">Complete Your Account Information</h2>
                    <div class="intro-section-desc">
                        <p>
                            Provide your account information to complete you registration and access our Investor Dashboard and Crypto Asset Marketplace & Exchange.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="intro-section intro-feature bg-white pt-0" id="registration-form">
    <div class="container-fluid px-0">
        <div class="row justify-content-center py-0">
            <div class="mbr-black col-sm-12 col-md-12 col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body py-5 px-0">
                        <div class="row">
                            <div class="col-12">

                            </div>
                            </div>
<?php 
$success_note               = 'Account Created Successfully'; 
$success_link               = site_url('/Dashboard'); 
$success_btn                = 'Access Dashboard';
$notoData                   = array(
    'success_note'          => $success_note,
    'success_link'          => $success_link,
    'success_btn'           => $success_btn,
);
$this->load->view('User/Dashboard/index/success-noto', $notoData); 
?>
