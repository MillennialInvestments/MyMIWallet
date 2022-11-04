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
                    <div class="tab-pane active" id="tabItem1"> 
                        <div class="nk-block-head nk-block-head-lg">
                            <div class="nk-block-between">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">Personal Information</h4>
                                    <div class="nk-block-des">
                                        <p>Basic info, like your name and address, that you use at MyMI Wallet.</p>
                                    </div>
                                </div>
                                <div class="nk-block-head-content align-self-start d-lg-none">
                                    <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                </div>
                            </div>
                        </div><!-- .nk-block-head -->
                        <div class="nk-block">
                            <div class="nk-data data-list">
                                <div class="data-head">
                                    <h6 class="overline-title">Basics</h6>
                                </div>
                                <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                    <div class="data-col">
                                        <span class="data-label">Full Name</span>
                                        <span class="data-value"><?php echo $cuFirstName . ' ' . $cuLastName; ?></span>
                                    </div>
                                    <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                </div><!-- data-item -->
                                <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                    <div class="data-col">
                                        <span class="data-label">Display Name</span>
                                        <span class="data-value"><?php echo $cuDisplayName; ?></span>
                                    </div>
                                    <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                </div><!-- data-item -->
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="data-label">Email</span>
                                        <span class="data-value"><?php echo $cuEmail; ?></span>
                                    </div>
                                    <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                                </div><!-- data-item -->
                                <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                    <div class="data-col">
                                        <span class="data-label">Phone Number</span>
                                        <span class="data-value text-soft"><?php echo $cuPhone; ?></span>
                                    </div>
                                    <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                </div><!-- data-item -->
                                <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                    <div class="data-col">
                                        <span class="data-label">Date of Birth</span>
                                        <span class="data-value">29 Feb, 1986</span>
                                    </div>
                                    <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                </div><!-- data-item -->
                                <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit" data-tab-target="#address">
                                    <div class="data-col">
                                        <span class="data-label">Address</span>
                                        <span class="data-value"><?php echo $cuAddress . '<br>' . $cuCity . ', ' . $cuState . '<br>' . $cuCountry . ' ' . $cuZipCode; ?></span>
                                    </div>
                                    <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                </div><!-- data-item -->
                            </div><!-- data-list -->
                            <div class="nk-data data-list">
                                <div class="data-head">
                                    <h6 class="overline-title">Preferences</h6>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="data-label">Language</span>
                                        <span class="data-value">English (United State)</span>
                                    </div>
                                    <div class="data-col data-col-end"><a href="#" class="link link-primary">Change Language</a></div>
                                </div><!-- data-item -->
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="data-label">Date Format</span>
                                        <span class="data-value">M d, YYYY</span>
                                    </div>
                                    <div class="data-col data-col-end"><a href="#" class="link link-primary">Change</a></div>
                                </div><!-- data-item -->
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="data-label">Timezone</span>
                                        <span class="data-value">Bangladesh (GMT +6)</span>
                                    </div>
                                    <div class="data-col data-col-end"><a href="#" class="link link-primary">Change</a></div>
                                </div><!-- data-item -->
                            </div><!-- data-list -->
                        </div><!-- .nk-block -->
                    </div>   
                    <div class="tab-pane" id="tabItem2">
                        <div class="nk-block">
                            <div class="card card-bordered">
                                <div class="card-aside-wrap">
                                    <div class="card-inner card-inner-lg">
                                        <div class="nk-block-head nk-block-head-lg">
                                            <div class="nk-block-between">
                                                <div class="nk-block-head-content">
                                                    <h4 class="nk-block-title">Login Activity</h4>
                                                    <div class="nk-block-des">
                                                        <p>Here is your last 20 login activities log. <span class="text-soft"><em class="icon ni ni-info"></em></span></p>
                                                    </div>
                                                </div>
                                                <div class="nk-block-head-content align-self-start d-lg-none">
                                                    <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                                </div>
                                            </div>
                                        </div><!-- .nk-block-head -->
                                        <div class="nk-block card card-bordered">
                                            <table class="table table-ulogs">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="tb-col-os"><span class="overline-title">Browser <span class="d-sm-none">/ IP</span></span></th>
                                                        <th class="tb-col-ip"><span class="overline-title">IP</span></th>
                                                        <th class="tb-col-time"><span class="overline-title">Time</span></th>
                                                        <th class="tb-col-action"><span class="overline-title">&nbsp;</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="tb-col-os">Chrome on Window</td>
                                                        <td class="tb-col-ip"><span class="sub-text">192.149.122.128</span></td>
                                                        <td class="tb-col-time"><span class="sub-text">11:34 PM</span></td>
                                                        <td class="tb-col-action"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tb-col-os">Mozilla on Window</td>
                                                        <td class="tb-col-ip"><span class="sub-text">86.188.154.225</span></td>
                                                        <td class="tb-col-time"><span class="sub-text">Nov 20, 2019 <span class="d-none d-sm-inline-block">10:34 PM</span></span></td>
                                                        <td class="tb-col-action"><a href="#" class="link-cross me-sm-n1"><em class="icon ni ni-cross"></em></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tb-col-os">Chrome on iMac</td>
                                                        <td class="tb-col-ip"><span class="sub-text">192.149.122.128</span></td>
                                                        <td class="tb-col-time"><span class="sub-text">Nov 12, 2019 <span class="d-none d-sm-inline-block">08:56 PM</span></span></td>
                                                        <td class="tb-col-action"><a href="#" class="link-cross me-sm-n1"><em class="icon ni ni-cross"></em></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tb-col-os">Chrome on Window</td>
                                                        <td class="tb-col-ip"><span class="sub-text">192.149.122.128</span></td>
                                                        <td class="tb-col-time"><span class="sub-text">Nov 03, 2019 <span class="d-none d-sm-inline-block">04:29 PM</span></span></td>
                                                        <td class="tb-col-action"><a href="#" class="link-cross me-sm-n1"><em class="icon ni ni-cross"></em></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tb-col-os">Mozilla on Window</td>
                                                        <td class="tb-col-ip"><span class="sub-text">86.188.154.225</span></td>
                                                        <td class="tb-col-time"><span class="sub-text">Oct 29, 2019 <span class="d-none d-sm-inline-block">09:38 AM</span></span></td>
                                                        <td class="tb-col-action"><a href="#" class="link-cross me-sm-n1"><em class="icon ni ni-cross"></em></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tb-col-os">Chrome on iMac</td>
                                                        <td class="tb-col-ip"><span class="sub-text">192.149.122.128</span></td>
                                                        <td class="tb-col-time"><span class="sub-text">Oct 23, 2019 <span class="d-none d-sm-inline-block">04:16 PM</span></span></td>
                                                        <td class="tb-col-action"><a href="#" class="link-cross me-sm-n1"><em class="icon ni ni-cross"></em></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tb-col-os">Chrome on Window</td>
                                                        <td class="tb-col-ip"><span class="sub-text">192.149.122.128</span></td>
                                                        <td class="tb-col-time"><span class="sub-text">Oct 15, 2019 <span class="d-none d-sm-inline-block">11:41 PM</span></span></td>
                                                        <td class="tb-col-action"><a href="#" class="link-cross me-sm-n1"><em class="icon ni ni-cross"></em></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tb-col-os">Mozilla on Window</td>
                                                        <td class="tb-col-ip"><span class="sub-text">86.188.154.225</span></td>
                                                        <td class="tb-col-time"><span class="sub-text">Oct 13, 2019 <span class="d-none d-sm-inline-block">05:43 AM</span></span></td>
                                                        <td class="tb-col-action"><a href="#" class="link-cross me-sm-n1"><em class="icon ni ni-cross"></em></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tb-col-os">Chrome on iMac</td>
                                                        <td class="tb-col-ip"><span class="sub-text">192.149.122.128</span></td>
                                                        <td class="tb-col-time"><span class="sub-text">Oct 03, 2019 <span class="d-none d-sm-inline-block">04:12 AM</span></span></td>
                                                        <td class="tb-col-action"><a href="#" class="link-cross me-sm-n1"><em class="icon ni ni-cross"></em></a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div><!-- .nk-block-head -->
                                    </div><!-- .card-inner -->
                                    <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-toggle-body="true" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                        <div class="card-inner-group">
                                            <div class="card-inner">
                                                <div class="user-card">
                                                    <div class="user-avatar bg-primary">
                                                        <span>AB</span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text">Abu Bin Ishtiyak</span>
                                                        <span class="sub-text">info@softnio.com</span>
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
                                                    <h6 class="overline-title-alt">Nio Wallet Account</h6>
                                                    <div class="user-balance">12.395769 <small class="currency currency-btc">BTC</small></div>
                                                    <div class="user-balance-sub">Locked <span>0.344939 <span class="currency currency-btc">BTC</span></span></div>
                                                </div>
                                            </div><!-- .card-inner -->
                                            <div class="card-inner p-0">
                                                <ul class="link-list-menu">
                                                    <li><a href="html/user-profile-regular.html"><em class="icon ni ni-user-fill-c"></em><span>Personal Infomation</span></a></li>
                                                    <li><a href="html/user-profile-notification.html"><em class="icon ni ni-bell-fill"></em><span>Notifications</span></a></li>
                                                    <li><a class="active" href="html/user-profile-activity.html"><em class="icon ni ni-activity-round-fill"></em><span>Account Activity</span></a></li>
                                                    <li><a href="html/user-profile-setting.html"><em class="icon ni ni-lock-alt-fill"></em><span>Security Settings</span></a></li>
                                                    <li><a href="html/user-profile-social.html"><em class="icon ni ni-grid-add-fill-c"></em><span>Connected with Social</span></a></li>
                                                </ul>
                                            </div><!-- .card-inner -->
                                        </div><!-- .card-inner-group -->
                                    </div><!-- card-aside -->
                                </div><!-- card-aside-wrap -->
                            </div><!-- .card -->
                        </div><!-- .nk-block -->
                    </div>
                    <div class="tab-pane" id="tabItem3">
                        Assets
                    </div>
                    <div class="tab-pane" id="tabItem4">
                        Connected Accounts
                    </div>
                    <div class="tab-pane" id="tabItem5">
                        <div class="nk-block">
                            <div class="card card-bordered">
                                <div class="card-aside-wrap">
                                    <div class="card-inner card-inner-lg">
                                        <div class="nk-block-head nk-block-head-lg">
                                            <div class="nk-block-between">
                                                <div class="nk-block-head-content">
                                                    <h4 class="nk-block-title">Notification Settings</h4>
                                                    <div class="nk-block-des">
                                                        <p>You will get only notification what have enabled.</p>
                                                    </div>
                                                </div>
                                                <div class="nk-block-head-content align-self-start d-lg-none">
                                                    <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                                </div>
                                            </div>
                                        </div><!-- .nk-block-head -->
                                        <div class="nk-block-head nk-block-head-sm">
                                            <div class="nk-block-head-content">
                                                <h6>Security Alerts</h6>
                                                <p>You will get only those email notification what you want.</p>
                                            </div>
                                        </div><!-- .nk-block-head -->
                                        <div class="nk-block-content">
                                            <div class="gy-3">
                                                <div class="g-item">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" checked id="unusual-activity">
                                                        <label class="custom-control-label" for="unusual-activity">Email me whenever encounter unusual activity</label>
                                                    </div>
                                                </div>
                                                <div class="g-item">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="new-browser">
                                                        <label class="custom-control-label" for="new-browser">Email me if new browser is used to sign in</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .nk-block-content -->
                                        <div class="nk-block-head nk-block-head-sm">
                                            <div class="nk-block-head-content">
                                                <h6>News</h6>
                                                <p>You will get only those email notification what you want.</p>
                                            </div>
                                        </div><!-- .nk-block-head -->
                                        <div class="nk-block-content">
                                            <div class="gy-3">
                                                <div class="g-item">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" checked id="latest-sale">
                                                        <label class="custom-control-label" for="latest-sale">Notify me by email about sales and latest news</label>
                                                    </div>
                                                </div>
                                                <div class="g-item">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="feature-update">
                                                        <label class="custom-control-label" for="feature-update">Email me about new features and updates</label>
                                                    </div>
                                                </div>
                                                <div class="g-item">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" checked id="account-tips">
                                                        <label class="custom-control-label" for="account-tips">Email me about tips on using account</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .nk-block-content -->
                                    </div>
                                    <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-toggle-body="true" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                        <div class="card-inner-group">
                                            <div class="card-inner">
                                                <div class="user-card">
                                                    <div class="user-avatar bg-primary">
                                                        <span>AB</span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text">Abu Bin Ishtiyak</span>
                                                        <span class="sub-text">info@softnio.com</span>
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
                                                    <h6 class="overline-title-alt">Nio Wallet Account</h6>
                                                    <div class="user-balance">12.395769 <small class="currency currency-btc">BTC</small></div>
                                                    <div class="user-balance-sub">Locked <span>0.344939 <span class="currency currency-btc">BTC</span></span></div>
                                                </div>
                                            </div><!-- .card-inner -->
                                            <div class="card-inner p-0">
                                                <ul class="link-list-menu">
                                                    <li><a href="html/user-profile-regular.html"><em class="icon ni ni-user-fill-c"></em><span>Personal Infomation</span></a></li>
                                                    <li><a class="active" href="html/user-profile-notification.html"><em class="icon ni ni-bell-fill"></em><span>Notifications</span></a></li>
                                                    <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-round-fill"></em><span>Account Activity</span></a></li>
                                                    <li><a href="html/user-profile-setting.html"><em class="icon ni ni-lock-alt-fill"></em><span>Security Settings</span></a></li>
                                                    <li><a href="html/user-profile-social.html"><em class="icon ni ni-grid-add-fill-c"></em><span>Connected with Social</span></a></li>
                                                </ul>
                                            </div><!-- .card-inner -->
                                        </div><!-- .card-inner-group -->
                                    </div><!-- card-aside -->
                                </div><!-- .card-inner -->
                            </div><!-- .card-aside-wrap -->
                        </div><!-- .nk-block -->
                    </div>
                    <div class="tab-pane" id="tabItem6">
                        Security Settings
                    </div>
                    <div class="tab-pane" id="tabItem7">
                        Transactions
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
                        <ul class="nav link-list-menu border border-light round m-0 flex-column">
                            <li><a class="active" data-bs-toggle="tab" href="#tabItem1"><em class="icon ni ni-user-fill-c"></em><span>Personal Infomation</span></a></li>
                            <li><a data-bs-toggle="tab" href="#tabItem2"><em class="icon ni ni-activity-round-fill"></em><span>Activities</span></a></li>
                            <li><a data-bs-toggle="tab" href="#tabItem3"><em class="icon ni ni-coins"></em><span>Assets</span></a></li>
                            <li><a data-bs-toggle="tab" href="#tabItem4"><em class="icon ni ni-grid-add-fill-c"></em><span>Connected Accounts</span></a></li>
                            <li><a data-bs-toggle="tab" href="#tabItem5"><em class="icon ni ni-bell-fill"></em><span>Notifications</span></a></li>
                            <li><a data-bs-toggle="tab" href="#tabItem6"><em class="icon ni ni-lock-alt-fill"></em><span>Security Settings</span></a></li>
                            <li><a data-bs-toggle="tab" href="#tabItem7"><em class="icon ni ni-bell-fill"></em><span>Transactions</span></a></li>
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card-inner-group -->
            </div><!-- card-aside -->
        </div><!-- .card-aside-wrap -->
    </div><!-- .card -->
</div><!-- .nk-block -->