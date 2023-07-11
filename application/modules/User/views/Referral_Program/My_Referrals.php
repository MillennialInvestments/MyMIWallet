<?php
// Access User Libraries
$userAccount                            = $_SESSION['allSessionData']['userAccount'];   
$userReferrals                          = $_SESSION['allSessionData']['userReferrals']; 

$cuWalletID                             = $userAccount['cuWalletID']; 
$cuReferrerCode                         = $userAccount['cuReferrerCode']; 
$getTotalReferrals                      = $userReferrals['getTotalReferrals'];
$totalReferrals                         = $userReferrals['totalReferrals'];
$getTotalActiveReferrals                = $userReferrals['getTotalActiveReferrals'];
$totalActiveReferrals                   = $userReferrals['totalActiveReferrals'];
// $cuReferrerCode                         = $userAccount['cuReferrerCode'];
// $this->db->from('bf_users'); 
// $this->db->where('referral_code', $cuReferrerCode); 
// $getReferrals                           = $this->db->get(); 

$viewData                               = array(
    'cuReferrerCode'                    => $cuReferrerCode,
    'cuWalletID'                        => $cuWalletID,
    'getTotalReferrals'                 => $getTotalReferrals,
    'totalReferrals'                    => $totalReferrals,
    'getTotalActiveReferrals'           => $getTotalActiveReferrals,
    'totalActiveReferrals'              => $totalActiveReferrals,
    'userAccount'                       => $userAccount,
)
?>
<div class="nk-block">
    <div class="row gy-gs">
        <div class="col-lg-12 col-xl-12">
            <div class="nk-block">
                <div class="nk-block-head-xs">
                    <div class="nk-block-head-content">
                        <h1 class="nk-block-title title">My Referrals</h1>
                        <a href="<?php echo site_url('/Referral-Program/Apply'); ?>">Return to Referral Program</a>							
                    </div>
                </div>
            </div>
            <div class="nk-block pt-3">
                <div class="row">
                    <div class="col-12">
                        <?php $this->load->view('Referral_Program/My_Referrals/referral_overview', $viewData); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>