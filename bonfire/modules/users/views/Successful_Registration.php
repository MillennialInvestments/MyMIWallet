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
<?php 
$success_note               = 'Account Created Successfully'; 
$success_link               = site_url('/Dashboard'); 
$success_btn                = 'Access Dashboard';
$notoData                   = array(
    'success_note'          => $success_note,
    'success_link'          => $success_link,
    'success_btn'           => $success_btn,
);
$this->load->view('User/Dashboard/index/success_noto', $notoData); 
?>
