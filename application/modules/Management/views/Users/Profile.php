<?php
$pageURIA               = $this->uri->segment(1); 
$pageURIB               = $this->uri->segment(2); 
$pageURIC               = $this->uri->segment(3); 
$pageURID               = $this->uri->segment(4); 
$pageURIE               = $this->uri->segment(5);  
if ($pageURIA === 'Investor-Profile') {
    $userAccount        = $_SESSION['allSessionData']['userAccount']; 
} elseif ($pageURIA === 'Management' AND $pageURIB === 'Users' AND $pageURIC === 'Profile') {
    $userID             = $pageURID; 
    // $userAccount        = $this->mymiuser->user_account_info($userID);
    $userAccount        = $_SESSION['allSessionData']['userAccount'];
}
// print_r($userAccount);
?>
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between g-3">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Users / <strong class="text-primary small"><?php echo $userAccount['cuFirstName'] . ' ' . $userAccount['cuLastName']; ?></strong></h3>
            <div class="nk-block-des text-soft">
                <ul class="list-inline">
                    <li>User ID: <span class="text-base"><?php echo $userAccount['cuID']; ?></span></li>
                    <li>Last Login: <span class="text-base"><?php echo $userAccount['cuLastLogin']; ?></span></li>
                </ul>
            </div>
        </div>
        <div class="nk-block-head-content">
            <a href="html/user-list-regular.html" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
            <a href="html/user-list-regular.html" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
        </div>
    </div>
</div><!-- .nk-block-head -->
<div class="nk-block">
    <div class="card card-bordered">
        <div class="card-aside-wrap">
            <div class="card-content">
                <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><em class="icon ni ni-user-circle"></em><span>Personal</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><em class="icon ni ni-repeat"></em><span>Transactions</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><em class="icon ni ni-file-text"></em><span>Documents</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><em class="icon ni ni-bell"></em><span>Notifications</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><em class="icon ni ni-activity"></em><span>Activities</span></a>
                    </li>
                    <li class="nav-item nav-item-trigger d-xxl-none">
                        <a href="<?php echo site_url('/Management/Users'); ?>" class="toggle btn btn-icon btn-trigger" data-target="userAside"><em class="icon ni ni-user-list-fill"></em></a>
                    </li>
                </ul><!-- .nav-tabs -->
                <div class="card-inner">
                    <div class="nk-block">
                        <div class="nk-block-head">
                            <h5 class="title">Personal Information</h5>
                            <p>Basic info, like your name and address, that you use on Nio Platform.</p>
                        </div><!-- .nk-block-head -->
                        <div class="profile-ud-list">
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Account Type</span>
                                    <span class="profile-ud-value"><?php echo $userAccount['cuUserType']; ?></span>
                                </div>
                            </div>
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Mobile Number</span>
                                    <span class="profile-ud-value"><?php echo $userAccount['cuPhone']; ?></span>
                                </div>
                            </div>
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Full Name</span>
                                    <span class="profile-ud-value"><?php echo $userAccount['cuFirstName'] . ' ' . $userAccount['cuMiddleName'] . ' ' . $userAccount['cuLastName'] . ' ' . $userAccount['cuNameSuffix']; ?></span>
                                </div>
                            </div>
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Address</span>
                                    <span class="profile-ud-value"><?php echo $userAccount['cuAddress']; ?></span>
                                </div>
                            </div>
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Email Address</span>
                                    <span class="profile-ud-value"><a href="mailto:<?php echo $userAccount['cuEmail']; ?>" target="_blank"><?php echo $userAccount['cuEmail']; ?></a></span>
                                </div>
                            </div>
                            <!--
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Date of Birth</span>
                                    <span class="profile-ud-value">N/A</span>
                                </div>
                            </div> 
                            -->
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">City/State/Country</span>
                                    <span class="profile-ud-value"><?php echo $userAccount['cuCity'] . ', ' . $userAccount['cuState'] . ' ' . $userAccount['cuCountry'] . ' ' . $userAccount['cuZipCode']; ?></span>
                                </div>
                            </div>
                        </div><!-- .profile-ud-list -->
                    </div><!-- .nk-block -->
                    <div class="nk-block">
                        <div class="nk-block-head nk-block-head-line">
                            <h6 class="title overline-title text-base">Additional Information</h6>
                        </div><!-- .nk-block-head -->
                        <div class="profile-ud-list">
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Joining Date</span>
                                    <span class="profile-ud-value"><?php echo $userAccount['cuSignupDate']; ?></span>
                                </div>
                            </div>
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Wallet ID:</span>
                                    <span class="profile-ud-value"><small><?php echo $userAccount['cuWalletID']; ?></small></span>
                                </div>
                            </div>
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Referral/Advertisement</span>
                                    <span class="profile-ud-value"><?php echo $userAccount['cuAdvertisement']; ?></span>
                                </div>
                            </div>
                            <div class="profile-ud-item">
                                <div class="profile-ud wider">
                                    <span class="profile-ud-label">Referral Code</span>
                                    <span class="profile-ud-value"><?php echo $userAccount['cuReferrerCode']; ?></span>
                                </div>
                            </div>
                        </div><!-- .profile-ud-list -->
                    </div><!-- .nk-block -->
                    <div class="nk-divider divider md"></div>
                    <div class="nk-block">
                        <div class="nk-block-head nk-block-head-sm nk-block-between">
                            <h5 class="title">Admin Note</h5>
                            <a href="#" class="link link-sm">+ Add Note</a>
                        </div><!-- .nk-block-head -->
                        <div class="bq-note">
                            <?php 
                            $this->db->from('bf_users_notes'); 
                            $this->db->where('user_id', $userAccount['cuID']); 
                            $getUserNotes           = $this->db->get(); 
                            if (!empty($getUserNotes->result_array())) {
                                foreach ($getUserNotes->result_array() as $userNotes) {
                                    echo '
                                    <div class="bq-note-item">
                                        <div class="bq-note-text">
                                            <p>' . $userNotes['notes'] . '</p>
                                        </div>
                                        <div class="bq-note-meta">
                                            <span class="bq-note-added">Added on <span class="date">' . $userNotes['month'] . ' ' . $userNotes['day'] . ', ' . $userNotes['year']. '</span> at <span class="time">' . $userNotes['time'] . '</span></span>
                                            <span class="bq-note-sep sep">|</span>
                                            <span class="bq-note-by">By <span>' . $userNotes['admin_name'] . '</span></span>
                                            <a href="' . site_url('Management/Users/Deactive-Note/' . $userNotes['id']) . '" class="link link-sm link-danger">Delete Note</a>
                                        </div>
                                    </div><!-- .bq-note-item -->
                                    ';
                                };
                            } else {
                                echo '
                                <div class="bq-note-item">
                                    <div class="bq-note-text">
                                        <p>No Existing Admin Notes For This User At This Time!</p>
                                    </div>
                                </div><!-- .bq-note-item -->
                                ';
                            }
                            ?>
                        </div><!-- .bq-note -->
                    </div><!-- .nk-block -->
                </div><!-- .card-inner -->
            </div><!-- .card-content -->
            <div class="card-aside card-aside-right user-aside toggle-slide toggle-slide-right toggle-break-xxl" data-content="userAside" data-toggle-screen="xxl" data-toggle-overlay="true" data-toggle-body="true">
                <div class="card-inner-group" data-simplebar>
                    <div class="card-inner">
                        <div class="user-card user-card-s2">
                            <div class="user-avatar lg bg-primary">
                                <span><?php echo $userAccount['cuFirstName'][0] . ' ' . $userAccount['cuLastName'][0]; ?></span>
                            </div>
                            <div class="user-info">
                                <div class="badge bg-outline-light rounded-pill ucap">Investor</div>
                                <h5><?php echo $userAccount['cuFirstName'] . ' ' . $userAccount['cuLastName']; ?></h5>
                                <span class="sub-text"><a href="mailto:<?php echo $userAccount['cuEmail']; ?>" target="_blank"><?php echo $userAccount['cuEmail']; ?></a></span>
                            </div>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner card-inner-sm">
                        <ul class="btn-toolbar justify-center gx-1">
                            <li><a href="<?php echo site_url('Management/Users/Distribute/' . $userAccount['cuID'] . '/Distribute'); ?>" class="btn btn-trigger btn-icon"><em class="icon ni ni-coins"></em></a></li>
                            <li><a class="btn btn-trigger btn-icon" href="mailto:<?php echo $userAccount['cuEmail']; ?>" target="_blank"><em class="icon ni ni-mail"></em></a></li>
                            <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-download-cloud"></em></a></li>
                            <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-bookmark"></em></a></li>
                            <li><a href="<?php echo site_url('Management/Users/Block/' . $userAccount['cuID']); ?>" class="btn btn-trigger btn-icon text-danger"><em class="icon ni ni-na"></em></a></li>
                        </ul>
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <div class="overline-title-alt mb-2">In Account</div>
                        <div class="profile-balance">
                            <div class="profile-balance-group gx-4">
                                <div class="profile-balance-sub">
                                    <div class="profile-balance-amount">
                                        <div class="number"><?php echo $userAccount['walletFunds'] + $userAccount['assetNetValue']; ?> <small class="currency currency-usd">USD</small></div>
                                    </div>
                                    <div class="profile-balance-subtitle">Total Value</div>
                                </div>
                                <div class="profile-balance-sub">
                                    <span class="profile-balance-plus text-soft"><em class="icon ni ni-plus"></em></span>
                                    <div class="profile-balance-amount">
                                        <div class="number"><?php echo $userAccount['MyMIGCoinSum']; ?> <small class="currency currency-usd">GOLD</small></div>
                                    </div>
                                    <div class="profile-balance-subtitle">MyMI Gold</div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="profile-stats">
                                    <span class="amount"><?php echo $userAccount['cuWalletCount'] - 1; ?></span>
                                    <span class="sub-text" style="font-size: 11px;">Wallets Created</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="profile-stats">
                                    <span class="amount"><?php echo $userAccount['assetTotalCount']; ?></span>
                                    <span class="sub-text" style="font-size: 11px;">Assets Created</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="profile-stats">
                                    <span class="amount" style="font-size:0.75rem;">0<?php echo number_format($userAccount['coinsExchanged'],0); ?></span>
                                    <span class="sub-text" style="font-size: 11px;">Coins Exchanged</span>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <h6 class="overline-title-alt mb-2">Additional</h6>
                        <div class="row g-3">
                            <div class="col-6">
                                <span class="sub-text">User ID:</span>
                                <span><?php echo $userAccount['cuID']; ?></span>
                            </div>
                            <div class="col-6">
                                <span class="sub-text">Last Login:</span>
                                <span><?php echo $userAccount['cuLastLogin']; ?></span>
                            </div>
                            <div class="col-6">
                                <span class="sub-text">KYC Status:</span>
                                <?php 
                                if ($userAccount['cuKYCVerified'] === 'No') {
                                    echo '<span class="lead-text text-danger">Not Submitted</span>';
                                } else {
                                    if ($userAccount['cuKYC'] === 'Yes' || $userAccount['cuKYCVerified'] === 'No') {
                                        echo '<span class="lead-text text-warning">Pending</span>';
                                    } elseif ($userAccount['cuKYC'] === 'Yes' || $userAccount['cuKYCVerified'] === 'Yes') {
                                        echo '<span class="lead-text text-success">Approved</span>';
                                    }
                                }
                                ?>
                            </div>
                            <div class="col-6">
                                <span class="sub-text">Register At:</span>
                                <span><?php echo $userAccount['cuSignupDate']; ?></span>
                            </div>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <h6 class="overline-title-alt mb-3">Groups</h6>
                        <ul class="g-1">
                            <li class="btn-group">
                                <a class="btn btn-xs btn-light btn-dim" href="#">investor</a>
                                <a class="btn btn-xs btn-icon btn-light btn-dim" href="#"><em class="icon ni ni-cross"></em></a>
                            </li>
                            <li class="btn-group">
                                <a class="btn btn-xs btn-light btn-dim" href="#">support</a>
                                <a class="btn btn-xs btn-icon btn-light btn-dim" href="#"><em class="icon ni ni-cross"></em></a>
                            </li>
                            <li class="btn-group">
                                <a class="btn btn-xs btn-light btn-dim" href="#">another tag</a>
                                <a class="btn btn-xs btn-icon btn-light btn-dim" href="#"><em class="icon ni ni-cross"></em></a>
                            </li>
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card-inner -->
            </div><!-- .card-aside -->
        </div><!-- .card-aside-wrap -->
    </div><!-- .card -->
</div><!-- .nk-block -->