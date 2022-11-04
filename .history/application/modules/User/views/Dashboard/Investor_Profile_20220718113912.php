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
                    <!-- Personal Information -->
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
                    <!-- User Activities -->
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
                    <!-- Assets -->
                    <div class="tab-pane" id="tabItem3">
                        Assets
                    </div>
                    <!-- Connected Accounts -->
                    <div class="tab-pane" id="tabItem4">
                        <div class="nk-block">
                            <div class="card card-bordered">
                                <div class="card-aside-wrap">
                                    <div class="card-inner card-inner-lg">
                                        <div class="nk-block">
                                            <div class="nk-block-head">
                                                <div class="nk-block-between">
                                                    <div class="nk-block-head-content">
                                                        <h5 class="nk-block-title">Connected with Social Account</h5>
                                                        <div class="nk-block-des">
                                                            <p>You can connect with your social account such as facebook, google etc to make easier to login into account.</p>
                                                        </div>
                                                    </div>
                                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                                    </div>
                                                </div>
                                            </div><!-- .nk-block-head -->
                                            <h6 class="lead-text">Connect to Facebook</h6>
                                            <div class="card card-bordered">
                                                <div class="card-inner">
                                                    <div class="between-center flex-wrap flex-md-nowrap g-3">
                                                        <div class="media media-center gx-3 wide-xs">
                                                            <div class="media-object">
                                                                <em class="icon icon-circle icon-circle-lg ni ni-facebook-f"></em>
                                                            </div>
                                                            <div class="media-content">
                                                                <p>You have successfully connected with your facebook account, you can easily log in using your account too.</p>
                                                            </div>
                                                        </div>
                                                        <div class="nk-block-actions flex-shrink-0">
                                                            <a href="#" class="btn btn-lg btn-danger">Revoke Access</a>
                                                        </div>
                                                    </div>
                                                </div><!-- .nk-card-inner -->
                                            </div><!-- .nk-card -->
                                            <h6 class="lead-text">Connect to Google</h6>
                                            <div class="card card-bordered">
                                                <div class="card-inner">
                                                    <div class="between-center flex-wrap flex-md-nowrap g-3">
                                                        <div class="media media-center gx-3 wide-xs">
                                                            <div class="media-object">
                                                                <em class="icon icon-circle icon-circle-lg ni ni-google"></em>
                                                            </div>
                                                            <div class="media-content">
                                                                <p>You can connect with your google account. <em class="d-block text-soft">Not connected yet</em></p>
                                                            </div>
                                                        </div>
                                                        <div class="nk-block-actions flex-shrink-0">
                                                            <a href="#" class="btn btn-lg btn-dim btn-primary">Connect</a>
                                                        </div>
                                                    </div>
                                                </div><!-- .nk-card-inner -->
                                            </div><!-- .nk-card -->
                                            <div class="nk-block-head nk-block-head-sm">
                                                <div class="nk-block-head-content">
                                                    <h6 class="nk-block-title">Import Contacts <a href="#" class="link link-primary ms-auto">Import from Google</a></h6>
                                                    <div class="nk-block-des">
                                                        <p>You have not imported contacts from your mobile phone.</p>
                                                    </div>
                                                </div>
                                            </div><!-- .nk-block-head -->
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
                                                    <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-round-fill"></em><span>Account Activity</span></a></li>
                                                    <li><a href="html/user-profile-setting.html"><em class="icon ni ni-lock-alt-fill"></em><span>Security Settings</span></a></li>
                                                    <li><a class="active" href="html/user-profile-social.html"><em class="icon ni ni-grid-add-fill-c"></em><span>Connected with Social</span></a></li>
                                                </ul>
                                            </div><!-- .card-inner -->
                                        </div><!-- .card-inner-group -->
                                    </div><!-- card-aside -->
                                </div><!-- .card-aside-wrap -->
                            </div><!-- .card -->
                        </div><!-- .nk-block -->
                    </div>
                    <!-- Notification Settings -->
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
                    <!-- Security Settings -->
                    <div class="tab-pane" id="tabItem6">
                        <div class="nk-block-head nk-block-head-lg">
                            <div class="nk-block-between">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">Security Settings</h4>
                                    <div class="nk-block-des">
                                        <p>These settings are helps you keep your account secure.</p>
                                    </div>
                                </div>
                                <div class="nk-block-head-content align-self-start d-lg-none">
                                    <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                </div>
                            </div>
                        </div><!-- .nk-block-head -->
                        <div class="nk-block">
                            <div class="card card-bordered">
                                <div class="card-inner-group">
                                    <div class="card-inner">
                                        <div class="between-center flex-wrap flex-md-nowrap g-3">
                                            <div class="nk-block-text">
                                                <h6>Save my Activity Logs</h6>
                                                <p>You can save your all activity logs including unusual activity detected.</p>
                                            </div>
                                            <div class="nk-block-actions">
                                                <ul class="align-center gx-3">
                                                    <li class="order-md-last">
                                                        <div class="custom-control custom-switch me-n2">
                                                            <input type="checkbox" class="custom-control-input" checked="" id="activity-log">
                                                            <label class="custom-control-label" for="activity-log"></label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- .card-inner -->
                                    <div class="card-inner">
                                        <div class="between-center flex-wrap g-3">
                                            <div class="nk-block-text">
                                                <h6>Change Password</h6>
                                                <p>Set a unique password to protect your account.</p>
                                            </div>
                                            <div class="nk-block-actions flex-shrink-sm-0">
                                                <ul class="align-center flex-wrap flex-sm-nowrap gx-3 gy-2">
                                                    <li class="order-md-last">
                                                        <a href="#" class="btn btn-primary">Change Password</a>
                                                    </li>
                                                    <li>
                                                        <em class="text-soft text-date fs-12px">Last changed: <span>Oct 2, 2019</span></em>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- .card-inner -->
                                    <div class="card-inner">
                                        <div class="between-center flex-wrap flex-md-nowrap g-3">
                                            <div class="nk-block-text">
                                                <h6>2 Factor Auth &nbsp; <span class="badge bg-success ms-0">Enabled</span></h6>
                                                <p>Secure your account with 2FA security. When it is activated you will need to enter not only your password, but also a special code using app. You can receive this code by in mobile app. </p>
                                            </div>
                                            <div class="nk-block-actions">
                                                <a href="#" class="btn btn-primary">Disable</a>
                                            </div>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .card-inner-group -->
                            </div><!-- .card -->
                        </div><!-- .nk-block -->
                    </div>
                    <!-- Transactions -->
                    <div class="tab-pane" id="tabItem7">
                        <div class="nk-block-head nk-block-head-sm">
                            <div class="nk-block-between g-3">
                                <div class="nk-block-head-content">
                                    <h3 class="nk-block-title page-title">Crypto Transaction</h3>
                                    <div class="nk-block-des text-soft">
                                        <p>You have total 12,835 orders.</p>
                                    </div>
                                </div><!-- .nk-block-head-content -->
                                <div class="nk-block-head-content">
                                    <div class="toggle-wrap nk-block-tools-toggle">
                                        <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                        <div class="toggle-expand-content" data-content="pageMenu">
                                            <ul class="nk-block-tools g-3">
                                                <li><a href="#" class="btn btn-white btn-dim btn-outline-light"><em class="icon ni ni-download-cloud"></em><span>Export</span></a></li>
                                                <li class="nk-block-tools-opt">
                                                    <div class="drodown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#"><span>Add Tranx</span></a></li>
                                                                <li><a href="#"><span>Add Deposit</span></a></li>
                                                                <li><a href="#"><span>Add Withdraw</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head-content -->
                            </div><!-- .nk-block-between -->
                        </div><!-- .nk-block-head -->
                        <div class="nk-block">
                            <div class="card card-bordered card-stretch">
                                <div class="card-inner-group">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h5 class="title">All Orders</h5>
                                            </div>
                                            <div class="card-tools me-n1">
                                                <ul class="btn-toolbar gx-1">
                                                    <li>
                                                        <a href="#" class="search-toggle toggle-search btn btn-icon" data-target="search"><em class="icon ni ni-search"></em></a>
                                                    </li><!-- li -->
                                                    <li class="btn-toolbar-sep"></li><!-- li -->
                                                    <li>
                                                        <div class="dropdown">
                                                            <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                                                <div class="badge badge-circle bg-primary">4</div>
                                                                <em class="icon ni ni-filter-alt"></em>
                                                            </a>
                                                            <div class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-end">
                                                                <div class="dropdown-head">
                                                                    <span class="sub-title dropdown-title">Advance Filter</span>
                                                                    <div class="dropdown">
                                                                        <a href="#" class="link link-light">
                                                                            <em class="icon ni ni-more-h"></em>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-body dropdown-body-rg">
                                                                    <div class="row gx-6 gy-4">
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="overline-title overline-title-alt">Type</label>
                                                                                <select class="form-select js-select2">
                                                                                    <option value="any">Any Type</option>
                                                                                    <option value="deposit">Deposit</option>
                                                                                    <option value="buy">Buy Coin</option>
                                                                                    <option value="sell">Sell Coin</option>
                                                                                    <option value="transfer">Transfer</option>
                                                                                    <option value="withdraw">Withdraw</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="overline-title overline-title-alt">Status</label>
                                                                                <select class="form-select js-select2">
                                                                                    <option value="any">Any Status</option>
                                                                                    <option value="pending">Pending</option>
                                                                                    <option value="cancel">Cancel</option>
                                                                                    <option value="process">Process</option>
                                                                                    <option value="completed">Completed</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="overline-title overline-title-alt">Pay Currency</label>
                                                                                <select class="form-select js-select2">
                                                                                    <option value="any">Any Coin</option>
                                                                                    <option value="bitcoin">Bitcoin</option>
                                                                                    <option value="ethereum">Ethereum</option>
                                                                                    <option value="litecoin">Litecoin</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="overline-title overline-title-alt">Method</label>
                                                                                <select class="form-select js-select2">
                                                                                    <option value="any">Any Method</option>
                                                                                    <option value="paypal">PayPal</option>
                                                                                    <option value="bank">Bank</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="includeDel">
                                                                                    <label class="custom-control-label" for="includeDel"> Including Deleted</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <button type="button" class="btn btn-secondary">Filter</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-foot between">
                                                                    <a class="clickable" href="#">Reset Filter</a>
                                                                    <a href="#savedFilter" data-bs-toggle="modal">Save Filter</a>
                                                                </div>
                                                            </div><!-- .filter-wg -->
                                                        </div><!-- .dropdown -->
                                                    </li><!-- li -->
                                                    <li>
                                                        <div class="dropdown">
                                                            <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                                                <em class="icon ni ni-setting"></em>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                                <ul class="link-check">
                                                                    <li><span>Show</span></li>
                                                                    <li class="active"><a href="#">10</a></li>
                                                                    <li><a href="#">20</a></li>
                                                                    <li><a href="#">50</a></li>
                                                                </ul>
                                                                <ul class="link-check">
                                                                    <li><span>Order</span></li>
                                                                    <li class="active"><a href="#">DESC</a></li>
                                                                    <li><a href="#">ASC</a></li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- .dropdown -->
                                                    </li><!-- li -->
                                                </ul><!-- .btn-toolbar -->
                                            </div><!-- .card-tools -->
                                            <div class="card-search search-wrap" data-search="search">
                                                <div class="search-content">
                                                    <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                    <input type="text" class="form-control border-transparent form-focus-none" placeholder="Quick search by transaction">
                                                    <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                                </div>
                                            </div><!-- .card-search -->
                                        </div><!-- .card-title-group -->
                                    </div><!-- .card-inner -->
                                    <div class="card-inner p-0">
                                        <div class="nk-tb-list nk-tb-tnx">
                                            <div class="nk-tb-item nk-tb-head">
                                                <div class="nk-tb-col"><span>Details</span></div>
                                                <div class="nk-tb-col tb-col-xxl"><span>Source</span></div>
                                                <div class="nk-tb-col tb-col-lg"><span>Order</span></div>
                                                <div class="nk-tb-col text-end"><span>Amount</span></div>
                                                <div class="nk-tb-col text-end tb-col-sm"><span>Balance</span></div>
                                                <div class="nk-tb-col nk-tb-col-status"><span class="sub-text d-none d-md-block">Status</span></div>
                                                <div class="nk-tb-col nk-tb-col-tools"></div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="nk-tnx-type">
                                                        <div class="nk-tnx-type-icon bg-success-dim text-success">
                                                            <em class="icon ni ni-arrow-up-right"></em>
                                                        </div>
                                                        <div class="nk-tnx-type-text">
                                                            <span class="tb-lead">Deposited Funds</span>
                                                            <span class="tb-date">18/10/2019 12:04 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span class="tb-lead-sub">Using PayPal Account</span>
                                                    <span class="tb-sub">mypay*****com</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-lead-sub">YWLX52JG73</span>
                                                    <span class="badge badge-dot bg-success">Deposit</span>
                                                </div>
                                                <div class="nk-tb-col text-end">
                                                    <span class="tb-amount">+ 0.010201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">1290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col text-end tb-col-sm">
                                                    <span class="tb-amount">1.30910201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">101290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-status">
                                                    <div class="dot dot-success d-md-none"></div>
                                                    <span class="badge badge-sm badge-dim bg-outline-success d-none d-md-inline-flex">Completed</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-2">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#tranxDetails" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                                        </li>
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt">
                                                                        <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                                        <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="nk-tnx-type">
                                                        <div class="nk-tnx-type-icon bg-warning-dim text-warning">
                                                            <em class="icon ni ni-arrow-up-right"></em>
                                                        </div>
                                                        <div class="nk-tnx-type-text">
                                                            <span class="tb-lead">Withdrawal Funds</span>
                                                            <span class="tb-date">18/10/2019 12:04 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span class="tb-lead-sub">Using PayPal Account</span>
                                                    <span class="tb-sub">mypay*****com</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-lead-sub">YWLX52JG73</span>
                                                    <span class="badge badge-dot bg-warning">Withdrawal</span>
                                                </div>
                                                <div class="nk-tb-col text-end">
                                                    <span class="tb-amount">+ 0.010201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">1290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col text-end tb-col-sm">
                                                    <span class="tb-amount">1.30910201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">101290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-status">
                                                    <div class="dot dot-success d-md-none"></div>
                                                    <span class="badge badge-sm badge-dim bg-outline-warning d-none d-md-inline-flex">Upcoming</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-2">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#tranxDetails" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                                        </li>
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt">
                                                                        <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                                        <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="nk-tnx-type">
                                                        <div class="nk-tnx-type-icon bg-info-dim text-info">
                                                            <em class="icon ni ni-arrow-up-right"></em>
                                                        </div>
                                                        <div class="nk-tnx-type-text">
                                                            <span class="tb-lead">Credited Profits</span>
                                                            <span class="tb-date">18/10/2019 12:04 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span class="tb-lead-sub">Using PayPal Account</span>
                                                    <span class="tb-sub">mypay*****com</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-lead-sub">YWLX52JG73</span>
                                                    <span class="badge badge-dot bg-info">Profit</span>
                                                </div>
                                                <div class="nk-tb-col text-end">
                                                    <span class="tb-amount">+ 0.010201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">1290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col text-end tb-col-sm">
                                                    <span class="tb-amount">1.30910201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">101290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-status">
                                                    <div class="dot dot-info d-md-none"></div>
                                                    <span class="badge badge-sm badge-dim bg-outline-info d-none d-md-inline-flex">Pending</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-2">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#tranxDetails" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                                        </li>
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt">
                                                                        <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                                        <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="nk-tnx-type">
                                                        <div class="nk-tnx-type-icon bg-danger-dim text-danger">
                                                            <em class="icon ni ni-arrow-up-right"></em>
                                                        </div>
                                                        <div class="nk-tnx-type-text">
                                                            <span class="tb-lead">Withdrawal Funds</span>
                                                            <span class="tb-date">18/10/2019 12:04 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span class="tb-lead-sub">Using PayPal Account</span>
                                                    <span class="tb-sub">mypay*****com</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-lead-sub">YWLX52JG73</span>
                                                    <span class="badge badge-dot bg-danger">Withdrawal</span>
                                                </div>
                                                <div class="nk-tb-col text-end">
                                                    <span class="tb-amount">+ 0.010201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">1290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col text-end tb-col-sm">
                                                    <span class="tb-amount">1.30910201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">101290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-status">
                                                    <div class="dot dot-success d-md-none"></div>
                                                    <span class="badge badge-sm badge-dim bg-outline-danger d-none d-md-inline-flex">Rejected</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-2">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#tranxDetails" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                                        </li>
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt">
                                                                        <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                                        <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="nk-tnx-type">
                                                        <div class="nk-tnx-type-icon bg-warning-dim text-warning">
                                                            <em class="icon ni ni-arrow-up-right"></em>
                                                        </div>
                                                        <div class="nk-tnx-type-text">
                                                            <span class="tb-lead">Deposited Funds</span>
                                                            <span class="tb-date">18/10/2019 12:04 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span class="tb-lead-sub">Using PayPal Account</span>
                                                    <span class="tb-sub">mypay*****com</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-lead-sub">YWLX52JG73</span>
                                                    <span class="badge badge-dot bg-warning">Deposit</span>
                                                </div>
                                                <div class="nk-tb-col text-end">
                                                    <span class="tb-amount">+ 0.010201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">1290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col text-end tb-col-sm">
                                                    <span class="tb-amount">1.30910201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">101290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-status">
                                                    <div class="dot dot-warning d-md-none"></div>
                                                    <span class="badge badge-sm badge-dim bg-outline-warning d-none d-md-inline-flex">Pending</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-2">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#tranxDetails" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                                        </li>
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt">
                                                                        <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                                        <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="nk-tnx-type">
                                                        <div class="nk-tnx-type-icon bg-warning-dim text-warning">
                                                            <em class="icon ni ni-arrow-up-right"></em>
                                                        </div>
                                                        <div class="nk-tnx-type-text">
                                                            <span class="tb-lead">Withdrawal Funds</span>
                                                            <span class="tb-date">18/10/2019 12:04 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span class="tb-lead-sub">Using PayPal Account</span>
                                                    <span class="tb-sub">mypay*****com</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-lead-sub">YWLX52JG73</span>
                                                    <span class="badge badge-dot bg-warning">Withdrawal</span>
                                                </div>
                                                <div class="nk-tb-col text-end">
                                                    <span class="tb-amount">+ 0.010201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">1290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col text-end tb-col-sm">
                                                    <span class="tb-amount">1.30910201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">101290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-status">
                                                    <div class="dot dot-success d-md-none"></div>
                                                    <span class="badge badge-sm badge-dim bg-outline-warning d-none d-md-inline-flex">Upcoming</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-2">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#tranxDetails" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                                        </li>
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt">
                                                                        <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                                        <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="nk-tnx-type">
                                                        <div class="nk-tnx-type-icon bg-info-dim text-info">
                                                            <em class="icon ni ni-arrow-up-right"></em>
                                                        </div>
                                                        <div class="nk-tnx-type-text">
                                                            <span class="tb-lead">Credited Profits</span>
                                                            <span class="tb-date">18/10/2019 12:04 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span class="tb-lead-sub">Using PayPal Account</span>
                                                    <span class="tb-sub">mypay*****com</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-lead-sub">YWLX52JG73</span>
                                                    <span class="badge badge-dot bg-info">Profit</span>
                                                </div>
                                                <div class="nk-tb-col text-end">
                                                    <span class="tb-amount">+ 0.010201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">1290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col text-end tb-col-sm">
                                                    <span class="tb-amount">1.30910201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">101290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-status">
                                                    <div class="dot dot-info d-md-none"></div>
                                                    <span class="badge badge-sm badge-dim bg-outline-info d-none d-md-inline-flex">Pending</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-2">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#tranxDetails" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                                        </li>
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt">
                                                                        <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                                        <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="nk-tnx-type">
                                                        <div class="nk-tnx-type-icon bg-danger-dim text-danger">
                                                            <em class="icon ni ni-arrow-up-right"></em>
                                                        </div>
                                                        <div class="nk-tnx-type-text">
                                                            <span class="tb-lead">Withdrawal Funds</span>
                                                            <span class="tb-date">18/10/2019 12:04 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span class="tb-lead-sub">Using PayPal Account</span>
                                                    <span class="tb-sub">mypay*****com</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-lead-sub">YWLX52JG73</span>
                                                    <span class="badge badge-dot bg-danger">Withdrawal</span>
                                                </div>
                                                <div class="nk-tb-col text-end">
                                                    <span class="tb-amount">+ 0.010201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">1290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col text-end tb-col-sm">
                                                    <span class="tb-amount">1.30910201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">101290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-status">
                                                    <div class="dot dot-success d-md-none"></div>
                                                    <span class="badge badge-sm badge-dim bg-outline-danger d-none d-md-inline-flex">Rejected</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-2">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#tranxDetails" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                                        </li>
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt">
                                                                        <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                                        <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="nk-tnx-type">
                                                        <div class="nk-tnx-type-icon bg-warning-dim text-warning">
                                                            <em class="icon ni ni-arrow-up-right"></em>
                                                        </div>
                                                        <div class="nk-tnx-type-text">
                                                            <span class="tb-lead">Deposited Funds</span>
                                                            <span class="tb-date">18/10/2019 12:04 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span class="tb-lead-sub">Using PayPal Account</span>
                                                    <span class="tb-sub">mypay*****com</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-lead-sub">YWLX52JG73</span>
                                                    <span class="badge badge-dot bg-warning">Deposit</span>
                                                </div>
                                                <div class="nk-tb-col text-end">
                                                    <span class="tb-amount">+ 0.010201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">1290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col text-end tb-col-sm">
                                                    <span class="tb-amount">1.30910201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">101290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-status">
                                                    <div class="dot dot-warning d-md-none"></div>
                                                    <span class="badge badge-sm badge-dim bg-outline-warning d-none d-md-inline-flex">Pending</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-2">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#tranxDetails" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                                        </li>
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt">
                                                                        <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                                        <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                        </div><!-- .nk-tb-list -->
                                    </div><!-- .card-inner -->
                                    <div class="card-inner">
                                        <ul class="pagination justify-content-center justify-content-md-start">
                                            <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><span class="page-link"><em class="icon ni ni-more-h"></em></span></li>
                                            <li class="page-item"><a class="page-link" href="#">6</a></li>
                                            <li class="page-item"><a class="page-link" href="#">7</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        </ul>
                                    </div><!-- .card-inner -->
                                </div><!-- .card-inner-group -->
                            </div><!-- .card -->
                        </div><!-- .nk-block -->
                        <div class="nk-block-head nk-block-head-sm">
                            <div class="nk-block-between g-3">
                                <div class="nk-block-head-content">
                                    <h3 class="nk-block-title page-title">Crypto Transaction</h3>
                                    <div class="nk-block-des text-soft">
                                        <p>You have total 12,835 orders.</p>
                                    </div>
                                </div><!-- .nk-block-head-content -->
                                <div class="nk-block-head-content">
                                    <div class="toggle-wrap nk-block-tools-toggle">
                                        <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                        <div class="toggle-expand-content" data-content="pageMenu">
                                            <ul class="nk-block-tools g-3">
                                                <li><a href="#" class="btn btn-white btn-dim btn-outline-light"><em class="icon ni ni-download-cloud"></em><span>Export</span></a></li>
                                                <li class="nk-block-tools-opt">
                                                    <div class="drodown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#"><span>Add Tranx</span></a></li>
                                                                <li><a href="#"><span>Add Deposit</span></a></li>
                                                                <li><a href="#"><span>Add Withdraw</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head-content -->
                            </div><!-- .nk-block-between -->
                        </div><!-- .nk-block-head -->
                        <div class="nk-block">
                            <div class="card card-bordered card-stretch">
                                <div class="card-inner-group">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h5 class="title">All Orders</h5>
                                            </div>
                                            <div class="card-tools me-n1">
                                                <ul class="btn-toolbar gx-1">
                                                    <li>
                                                        <a href="#" class="search-toggle toggle-search btn btn-icon" data-target="search"><em class="icon ni ni-search"></em></a>
                                                    </li><!-- li -->
                                                    <li class="btn-toolbar-sep"></li><!-- li -->
                                                    <li>
                                                        <div class="dropdown">
                                                            <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                                                <div class="badge badge-circle bg-primary">4</div>
                                                                <em class="icon ni ni-filter-alt"></em>
                                                            </a>
                                                            <div class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-end">
                                                                <div class="dropdown-head">
                                                                    <span class="sub-title dropdown-title">Advance Filter</span>
                                                                    <div class="dropdown">
                                                                        <a href="#" class="link link-light">
                                                                            <em class="icon ni ni-more-h"></em>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-body dropdown-body-rg">
                                                                    <div class="row gx-6 gy-4">
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="overline-title overline-title-alt">Type</label>
                                                                                <select class="form-select js-select2">
                                                                                    <option value="any">Any Type</option>
                                                                                    <option value="deposit">Deposit</option>
                                                                                    <option value="buy">Buy Coin</option>
                                                                                    <option value="sell">Sell Coin</option>
                                                                                    <option value="transfer">Transfer</option>
                                                                                    <option value="withdraw">Withdraw</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="overline-title overline-title-alt">Status</label>
                                                                                <select class="form-select js-select2">
                                                                                    <option value="any">Any Status</option>
                                                                                    <option value="pending">Pending</option>
                                                                                    <option value="cancel">Cancel</option>
                                                                                    <option value="process">Process</option>
                                                                                    <option value="completed">Completed</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="overline-title overline-title-alt">Pay Currency</label>
                                                                                <select class="form-select js-select2">
                                                                                    <option value="any">Any Coin</option>
                                                                                    <option value="bitcoin">Bitcoin</option>
                                                                                    <option value="ethereum">Ethereum</option>
                                                                                    <option value="litecoin">Litecoin</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label class="overline-title overline-title-alt">Method</label>
                                                                                <select class="form-select js-select2">
                                                                                    <option value="any">Any Method</option>
                                                                                    <option value="paypal">PayPal</option>
                                                                                    <option value="bank">Bank</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="includeDel">
                                                                                    <label class="custom-control-label" for="includeDel"> Including Deleted</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <button type="button" class="btn btn-secondary">Filter</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="dropdown-foot between">
                                                                    <a class="clickable" href="#">Reset Filter</a>
                                                                    <a href="#savedFilter" data-bs-toggle="modal">Save Filter</a>
                                                                </div>
                                                            </div><!-- .filter-wg -->
                                                        </div><!-- .dropdown -->
                                                    </li><!-- li -->
                                                    <li>
                                                        <div class="dropdown">
                                                            <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                                                <em class="icon ni ni-setting"></em>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                                <ul class="link-check">
                                                                    <li><span>Show</span></li>
                                                                    <li class="active"><a href="#">10</a></li>
                                                                    <li><a href="#">20</a></li>
                                                                    <li><a href="#">50</a></li>
                                                                </ul>
                                                                <ul class="link-check">
                                                                    <li><span>Order</span></li>
                                                                    <li class="active"><a href="#">DESC</a></li>
                                                                    <li><a href="#">ASC</a></li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- .dropdown -->
                                                    </li><!-- li -->
                                                </ul><!-- .btn-toolbar -->
                                            </div><!-- .card-tools -->
                                            <div class="card-search search-wrap" data-search="search">
                                                <div class="search-content">
                                                    <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                    <input type="text" class="form-control border-transparent form-focus-none" placeholder="Quick search by transaction">
                                                    <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                                </div>
                                            </div><!-- .card-search -->
                                        </div><!-- .card-title-group -->
                                    </div><!-- .card-inner -->
                                    <div class="card-inner p-0">
                                        <div class="nk-tb-list nk-tb-tnx">
                                            <div class="nk-tb-item nk-tb-head">
                                                <div class="nk-tb-col"><span>Details</span></div>
                                                <div class="nk-tb-col tb-col-xxl"><span>Source</span></div>
                                                <div class="nk-tb-col tb-col-lg"><span>Order</span></div>
                                                <div class="nk-tb-col text-end"><span>Amount</span></div>
                                                <div class="nk-tb-col text-end tb-col-sm"><span>Balance</span></div>
                                                <div class="nk-tb-col nk-tb-col-status"><span class="sub-text d-none d-md-block">Status</span></div>
                                                <div class="nk-tb-col nk-tb-col-tools"></div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="nk-tnx-type">
                                                        <div class="nk-tnx-type-icon bg-success-dim text-success">
                                                            <em class="icon ni ni-arrow-up-right"></em>
                                                        </div>
                                                        <div class="nk-tnx-type-text">
                                                            <span class="tb-lead">Deposited Funds</span>
                                                            <span class="tb-date">18/10/2019 12:04 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span class="tb-lead-sub">Using PayPal Account</span>
                                                    <span class="tb-sub">mypay*****com</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-lead-sub">YWLX52JG73</span>
                                                    <span class="badge badge-dot bg-success">Deposit</span>
                                                </div>
                                                <div class="nk-tb-col text-end">
                                                    <span class="tb-amount">+ 0.010201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">1290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col text-end tb-col-sm">
                                                    <span class="tb-amount">1.30910201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">101290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-status">
                                                    <div class="dot dot-success d-md-none"></div>
                                                    <span class="badge badge-sm badge-dim bg-outline-success d-none d-md-inline-flex">Completed</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-2">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#tranxDetails" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                                        </li>
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt">
                                                                        <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                                        <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="nk-tnx-type">
                                                        <div class="nk-tnx-type-icon bg-warning-dim text-warning">
                                                            <em class="icon ni ni-arrow-up-right"></em>
                                                        </div>
                                                        <div class="nk-tnx-type-text">
                                                            <span class="tb-lead">Withdrawal Funds</span>
                                                            <span class="tb-date">18/10/2019 12:04 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span class="tb-lead-sub">Using PayPal Account</span>
                                                    <span class="tb-sub">mypay*****com</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-lead-sub">YWLX52JG73</span>
                                                    <span class="badge badge-dot bg-warning">Withdrawal</span>
                                                </div>
                                                <div class="nk-tb-col text-end">
                                                    <span class="tb-amount">+ 0.010201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">1290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col text-end tb-col-sm">
                                                    <span class="tb-amount">1.30910201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">101290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-status">
                                                    <div class="dot dot-success d-md-none"></div>
                                                    <span class="badge badge-sm badge-dim bg-outline-warning d-none d-md-inline-flex">Upcoming</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-2">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#tranxDetails" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                                        </li>
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt">
                                                                        <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                                        <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="nk-tnx-type">
                                                        <div class="nk-tnx-type-icon bg-info-dim text-info">
                                                            <em class="icon ni ni-arrow-up-right"></em>
                                                        </div>
                                                        <div class="nk-tnx-type-text">
                                                            <span class="tb-lead">Credited Profits</span>
                                                            <span class="tb-date">18/10/2019 12:04 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span class="tb-lead-sub">Using PayPal Account</span>
                                                    <span class="tb-sub">mypay*****com</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-lead-sub">YWLX52JG73</span>
                                                    <span class="badge badge-dot bg-info">Profit</span>
                                                </div>
                                                <div class="nk-tb-col text-end">
                                                    <span class="tb-amount">+ 0.010201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">1290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col text-end tb-col-sm">
                                                    <span class="tb-amount">1.30910201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">101290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-status">
                                                    <div class="dot dot-info d-md-none"></div>
                                                    <span class="badge badge-sm badge-dim bg-outline-info d-none d-md-inline-flex">Pending</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-2">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#tranxDetails" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                                        </li>
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt">
                                                                        <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                                        <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="nk-tnx-type">
                                                        <div class="nk-tnx-type-icon bg-danger-dim text-danger">
                                                            <em class="icon ni ni-arrow-up-right"></em>
                                                        </div>
                                                        <div class="nk-tnx-type-text">
                                                            <span class="tb-lead">Withdrawal Funds</span>
                                                            <span class="tb-date">18/10/2019 12:04 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span class="tb-lead-sub">Using PayPal Account</span>
                                                    <span class="tb-sub">mypay*****com</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-lead-sub">YWLX52JG73</span>
                                                    <span class="badge badge-dot bg-danger">Withdrawal</span>
                                                </div>
                                                <div class="nk-tb-col text-end">
                                                    <span class="tb-amount">+ 0.010201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">1290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col text-end tb-col-sm">
                                                    <span class="tb-amount">1.30910201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">101290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-status">
                                                    <div class="dot dot-success d-md-none"></div>
                                                    <span class="badge badge-sm badge-dim bg-outline-danger d-none d-md-inline-flex">Rejected</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-2">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#tranxDetails" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                                        </li>
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt">
                                                                        <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                                        <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="nk-tnx-type">
                                                        <div class="nk-tnx-type-icon bg-warning-dim text-warning">
                                                            <em class="icon ni ni-arrow-up-right"></em>
                                                        </div>
                                                        <div class="nk-tnx-type-text">
                                                            <span class="tb-lead">Deposited Funds</span>
                                                            <span class="tb-date">18/10/2019 12:04 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span class="tb-lead-sub">Using PayPal Account</span>
                                                    <span class="tb-sub">mypay*****com</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-lead-sub">YWLX52JG73</span>
                                                    <span class="badge badge-dot bg-warning">Deposit</span>
                                                </div>
                                                <div class="nk-tb-col text-end">
                                                    <span class="tb-amount">+ 0.010201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">1290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col text-end tb-col-sm">
                                                    <span class="tb-amount">1.30910201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">101290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-status">
                                                    <div class="dot dot-warning d-md-none"></div>
                                                    <span class="badge badge-sm badge-dim bg-outline-warning d-none d-md-inline-flex">Pending</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-2">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#tranxDetails" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                                        </li>
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt">
                                                                        <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                                        <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="nk-tnx-type">
                                                        <div class="nk-tnx-type-icon bg-warning-dim text-warning">
                                                            <em class="icon ni ni-arrow-up-right"></em>
                                                        </div>
                                                        <div class="nk-tnx-type-text">
                                                            <span class="tb-lead">Withdrawal Funds</span>
                                                            <span class="tb-date">18/10/2019 12:04 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span class="tb-lead-sub">Using PayPal Account</span>
                                                    <span class="tb-sub">mypay*****com</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-lead-sub">YWLX52JG73</span>
                                                    <span class="badge badge-dot bg-warning">Withdrawal</span>
                                                </div>
                                                <div class="nk-tb-col text-end">
                                                    <span class="tb-amount">+ 0.010201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">1290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col text-end tb-col-sm">
                                                    <span class="tb-amount">1.30910201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">101290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-status">
                                                    <div class="dot dot-success d-md-none"></div>
                                                    <span class="badge badge-sm badge-dim bg-outline-warning d-none d-md-inline-flex">Upcoming</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-2">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#tranxDetails" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                                        </li>
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt">
                                                                        <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                                        <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="nk-tnx-type">
                                                        <div class="nk-tnx-type-icon bg-info-dim text-info">
                                                            <em class="icon ni ni-arrow-up-right"></em>
                                                        </div>
                                                        <div class="nk-tnx-type-text">
                                                            <span class="tb-lead">Credited Profits</span>
                                                            <span class="tb-date">18/10/2019 12:04 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span class="tb-lead-sub">Using PayPal Account</span>
                                                    <span class="tb-sub">mypay*****com</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-lead-sub">YWLX52JG73</span>
                                                    <span class="badge badge-dot bg-info">Profit</span>
                                                </div>
                                                <div class="nk-tb-col text-end">
                                                    <span class="tb-amount">+ 0.010201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">1290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col text-end tb-col-sm">
                                                    <span class="tb-amount">1.30910201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">101290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-status">
                                                    <div class="dot dot-info d-md-none"></div>
                                                    <span class="badge badge-sm badge-dim bg-outline-info d-none d-md-inline-flex">Pending</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-2">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#tranxDetails" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                                        </li>
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt">
                                                                        <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                                        <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="nk-tnx-type">
                                                        <div class="nk-tnx-type-icon bg-danger-dim text-danger">
                                                            <em class="icon ni ni-arrow-up-right"></em>
                                                        </div>
                                                        <div class="nk-tnx-type-text">
                                                            <span class="tb-lead">Withdrawal Funds</span>
                                                            <span class="tb-date">18/10/2019 12:04 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span class="tb-lead-sub">Using PayPal Account</span>
                                                    <span class="tb-sub">mypay*****com</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-lead-sub">YWLX52JG73</span>
                                                    <span class="badge badge-dot bg-danger">Withdrawal</span>
                                                </div>
                                                <div class="nk-tb-col text-end">
                                                    <span class="tb-amount">+ 0.010201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">1290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col text-end tb-col-sm">
                                                    <span class="tb-amount">1.30910201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">101290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-status">
                                                    <div class="dot dot-success d-md-none"></div>
                                                    <span class="badge badge-sm badge-dim bg-outline-danger d-none d-md-inline-flex">Rejected</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-2">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#tranxDetails" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                                        </li>
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt">
                                                                        <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                                        <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="nk-tnx-type">
                                                        <div class="nk-tnx-type-icon bg-warning-dim text-warning">
                                                            <em class="icon ni ni-arrow-up-right"></em>
                                                        </div>
                                                        <div class="nk-tnx-type-text">
                                                            <span class="tb-lead">Deposited Funds</span>
                                                            <span class="tb-date">18/10/2019 12:04 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-xxl">
                                                    <span class="tb-lead-sub">Using PayPal Account</span>
                                                    <span class="tb-sub">mypay*****com</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-lead-sub">YWLX52JG73</span>
                                                    <span class="badge badge-dot bg-warning">Deposit</span>
                                                </div>
                                                <div class="nk-tb-col text-end">
                                                    <span class="tb-amount">+ 0.010201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">1290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col text-end tb-col-sm">
                                                    <span class="tb-amount">1.30910201 <span>BTC</span></span>
                                                    <span class="tb-amount-sm">101290.49 USD</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-status">
                                                    <div class="dot dot-warning d-md-none"></div>
                                                    <span class="badge badge-sm badge-dim bg-outline-warning d-none d-md-inline-flex">Pending</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-2">
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
                                                        </li>
                                                        <li class="nk-tb-action-hidden">
                                                            <a href="#tranxDetails" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                                        </li>
                                                        <li>
                                                            <div class="dropdown">
                                                                <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt">
                                                                        <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                                        <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                        </div><!-- .nk-tb-list -->
                                    </div><!-- .card-inner -->
                                    <div class="card-inner">
                                        <ul class="pagination justify-content-center justify-content-md-start">
                                            <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><span class="page-link"><em class="icon ni ni-more-h"></em></span></li>
                                            <li class="page-item"><a class="page-link" href="#">6</a></li>
                                            <li class="page-item"><a class="page-link" href="#">7</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        </ul>
                                    </div><!-- .card-inner -->
                                </div><!-- .card-inner-group -->
                            </div><!-- .card -->
                        </div><!-- .nk-block -->
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