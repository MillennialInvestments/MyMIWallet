<?php
$userAccount                            = $_SESSION['allSessionData']['userAccount']; 
// print_r($userAccount); 
$cuID                                   = $userAccount['cuID']; 
$cuFirstName                            = $userAccount['cuFirstName']; 
$cuMiddleName                           = $userAccount['cuMiddleName']; 
$cuLastName                             = $userAccount['cuLastName']; 
$cuNameSuffix                           = $userAccount['cuNameSuffix']; 
$cuUsername                             = $userAccount['cuUsername']; 
$cuEmail                                = $userAccount['cuEmail']; 
// $cuDOB                                  = $userAccount['cuDOB']; 
$cuPhone                                = $userAccount['cuPhone']; 
$cuAddress                              = $userAccount['cuAddress']; 
$cuCity                                 = $userAccount['cuCity']; 
$cuState                                = $userAccount['cuState']; 
$cuCountry                              = $userAccount['cuCountry']; 
$cuZipCode                              = $userAccount['cuZipCode']; 
$cuReferrer                             = $userAccount['cuReferrer']; 
$cuPartner                              = $userAccount['cuPartner']; 
$cuWalletID                             = $userAccount['cuWalletID']; 
$walletSum                              = $_SESSION['allSessionData']['myMIWalletSummary']['walletSum'];
$MyMIGCoinSum			                = $_SESSION['allSessionData']['userGoldData']['coinSum'];
if (!empty($_SESSION['allSessionData']['userAccount']['assetNetValue'])) {
    $walletAmount                       = $walletSum;
} else {
    $walletAmount					    = $walletSum;
}
$viewData                               = array(
    'userAccount'                       => $userAccount,
    'cuID'                              => $cuID,
    'cuFirstName'                       => $cuFirstName,
    'cuMiddleName'                      => $cuMiddleName,
    'cuLastName'                        => $cuLastName,
    'cuNameSuffix'                      => $cuNameSuffix,
    'cuUsername'                        => $cuUsername,
    'cuEmail'                           => $cuEmail,
    // 'cuDOB'                             => $cuDOB,
    'cuPhone'                           => $cuPhone,
    'cuAddress'                         => $cuAddress,
    'cuCity'                            => $cuCity,
    'cuState'                           => $cuState,
    'cuCountry'                         => $cuCountry,
    'cuZipCode'                         => $cuZipCode,
    'cuReferrer'                        => $cuReferrer,
    'cuPartner'                         => $cuPartner,
    'cuWalletID'                        => $cuWalletID,
    'walletSum'                         => $walletSum,
    'MyMIGCoinSum'                        => $MyMIGCoinSum,
);
?>
<div class="nk-block">
    <div class="card">
        <div class="card-aside-wrap">
            <div class="card-inner card-inner-lg pt-3">
                <div class="tab-content">
                    <!-- Personal Information -->
                    <div class="tab-pane active" id="tabItem1"> 
                        <?php $this->load->view('User/Dashboard/Investor_Profile/Personal_Information', $viewData); ?>
                    </div>   
                    <!-- User Activities -->
                    <div class="tab-pane" id="tabItem2">
                        <?php $this->load->view('User/Dashboard/Investor_Profile/Activity', $viewData); ?>
                    </div>
                    <!-- Assets -->
                    <div class="tab-pane" id="tabItem3">
                        <?php $this->load->view('User/Dashboard/Investor_Profile/Assets', $viewData); ?>
                    </div>
                    <!-- Bank Accounts -->
                    <div class="tab-pane" id="tabItem4">
                        <?php $this->load->view('User/Dashboard/Investor_Profile/Bank_Accounts', $viewData); ?>
                    </div>  
                    <!-- Connected Accounts -->
                    <div class="tab-pane" id="tabItem5">
                        <?php //$this->load->view('User/Dashboard/Investor_Profile/Connected_Accounts', $viewData); ?>
                    </div>
                    <!-- Notification Settings -->
                    <div class="tab-pane" id="tabItem6">
                        <?php //$this->load->view('User/Dashboard/Investor_Profile/Notifications', $viewData); ?>
                    </div>
                    <!-- Security Settings -->
                    <div class="tab-pane" id="tabItem7">
                        <?php $this->load->view('User/Dashboard/Investor_Profile/Security_Settings', $viewData); ?>
                    </div>
                    <!-- Transactions -->
                    <div class="tab-pane" id="tabItem7">
                        <?php 
                        $transactionData                    = array(
                            'userAccount'                   => $userAccount,
                        ); 
                        $this->load->view('User/Dashboard/index/transaction-table', $transactionData); 
                        ?>
                    </div>
                </div>
            </div>
            <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-toggle-body="true" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                <div class="card-inner-group" data-simplebar>
                    <div class="card-inner">
                        <div class="user-card">
                            <div class="user-avatar bg-primary">
                                <span>AB</span>
                            </div>
                            <div class="user-info">
                                <span class="lead-text"><?php echo $cuFirstName; ?> <?php echo $cuLastName; ?></span>
                                <span class="sub-text"><?php echo $cuEmail; ?></span>
                            </div>
                            <div class="user-action">
                                <div class="dropdown">
                                    <a class="btn btn-icon btn-trigger me-n2" data-bs-toggle="dropdown" href="#"><em class="icon ni ni-more-v"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <!-- <li><a href="#"><em class="icon ni ni-camera-fill"></em><span>Change Photo</span></a></li> -->
                                            <!-- <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Update Profile</span></a></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .user-card -->
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <div class="user-account-info py-0">
                            <h6 class="overline-title-alt">MyMI Wallet</h6>
                            <div class="user-balance"><?php echo $walletAmount; ?> <small class="currency currency-btc">USD</small></div>
                            <div class="user-balance-sub">Locked <span><?php echo $MyMIGCoinSum; ?> <span class="currency currency-usd">MyMI Gold</span></span></div>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner p-0">
                        <ul class="nav link-list-menu border border-light round m-0 flex-column">
                            <li><a class="active" data-bs-toggle="tab" href="#tabItem1"><em class="icon ni ni-user-fill-c"></em><span>Personal Infomation</span></a></li>
                            <li><a data-bs-toggle="tab" href="#tabItem2"><em class="icon ni ni-activity-round-fill"></em><span>Activities</span></a></li>
                            <li><a data-bs-toggle="tab" href="#tabItem3"><em class="icon ni ni-coins"></em><span>Assets</span></a></li>
                            <li><a data-bs-toggle="tab" href="#tabItem4"><em class="icon ni ni-wallet-fill"></em><span>Bank Accounts</span></a></li>
                            <!-- <li><a data-bs-toggle="tab" href="#tabItem5"><em class="icon ni ni-grid-add-fill-c"></em><span>Connected Accounts</span></a></li>
                            <li><a data-bs-toggle="tab" href="#tabItem6"><em class="icon ni ni-bell-fill"></em><span>Notifications</span></a></li> -->
                            <li><a data-bs-toggle="tab" href="#tabItem7"><em class="icon ni ni-lock-alt-fill"></em><span>Security Settings</span></a></li>
                            <li><a data-bs-toggle="tab" href="#tabItem8"><em class="icon ni ni-bell-fill"></em><span>Transactions</span></a></li>
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card-inner-group -->
            </div><!-- card-aside -->
        </div><!-- .card-aside-wrap -->
    </div><!-- .card -->
</div><!-- .nk-block -->