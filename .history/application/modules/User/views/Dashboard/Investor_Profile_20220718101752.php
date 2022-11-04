<?php
$userAccount                            = $_SESSION['allSessionData']['userAccount']; 
$cuFirstName                            = $userAccount['cuFirstName']; 
$cuLastName                             = $userAccount['cuLastName']; 
$cuDisplayName                          = $userAccount['cuDisplayName']; 
$cuEmail                                = $userAccount['cuEmail']; 
$cuPhone                                = $userAccount['cuPhone']; 
$cuAddress                              = $userAccount['cuAddress']; 
$cuCity                                 = $userAccount['cuCity']; 
$cuState                                = $userAccount['cuState']; 
$cuCountry                              = $userAccount['cuCountry']; 
$cuZipCode                              = $userAccount['cuZipCode']; 
$cuReferrer                             = $userAccount['cuReferrer']; 
$cuPartner                              = $userAccount['cuPartner']; 
$cuWalletID                             = $userAccount['cuWalletID']; 
?>
<div class="nk-block">
    <div class="card card-bordered">
        <div class="card-aside-wrap">
            <div class="card-inner card-inner-lg">
                <div class="tab-content">
                    <   
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
                                            <li><a href="#"><em class="icon ni ni-camera-fill"></em><span>Change Photo</span></a></li>
                                            <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Update Profile</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .user-card -->
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <div class="user-account-info py-0">
                            <h6 class="overline-title-alt">MyMI Wallet</h6>
                            <div class="user-balance">12.395769 <small class="currency currency-btc">BTC</small></div>
                            <div class="user-balance-sub">Locked <span>0.344939 <span class="currency currency-btc">BTC</span></span></div>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner p-0">
                        <ul class="link-list-menu">
                            <li><a class="active" data-bs-toggle="tab" href="#personal-information"><em class="icon ni ni-user-fill-c"></em><span>Personal Infomation</span></a></li>
                            <li><a data-bs-toggle="tab" href="#personal-information"><em class="icon ni ni-bell-fill"></em><span>Notifications</span></a></li>
                            <li><a data-bs-toggle="tab" href="#personal-information"><em class="icon ni ni-activity-round-fill"></em><span>Account Activity</span></a></li>
                            <li><a data-bs-toggle="tab" href="#personal-information"><em class="icon ni ni-lock-alt-fill"></em><span>Security Settings</span></a></li>
                            <li><a data-bs-toggle="tab" href="#personal-information"><em class="icon ni ni-grid-add-fill-c"></em><span>Connected with Social</span></a></li>
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card-inner-group -->
            </div><!-- card-aside -->
        </div><!-- .card-aside-wrap -->
    </div><!-- .card -->
</div><!-- .nk-block -->