<?php 
$this->load->library('MyMIAnalytics'); 
if ($pageURIB === 'Assets') {
    $dashboardTitle                             = 'Asset Management /';
    $dashboardSubtitle                          = 'Application Details';
}
$pageURIA                                       = $this->uri->segment(1);
$pageURIB                                       = $this->uri->segment(2);
$pageURIC                                       = $this->uri->segment(3);
$pageURID                                       = $this->uri->segment(4);
$pageURIE                                       = $this->uri->segment(5);
// Management Information 
$cuRole                                         = $_SESSION['allSessionData']['userAccount']['cuRole']; 
// Coin Information
$appID                                          = $pageURIE;
$pendingAssetByID                               = $this->mymianalytics->get_pending_asset_by_id($appID); 
$pendingAsset                                   = $pendingAssetByID['pendingAsset']; 
$userInfo                                       = $pendingAssetByID['getUserInfo'];
$userID                                         = $userInfo['cuID'];
$userEmail                                      = $userInfo['cuEmail'];
$userFirstName                                  = $userInfo['cuFirstName'];
$userMiddleName                                 = $userInfo['cuMiddleName'];
$userLastName                                   = $userInfo['cuLastName'];
$userNameSuffix                                 = $userInfo['cuNameSuffix'];
$userKYC                                        = $userInfo['cuKYC'];
$userType                                       = $userInfo['cuUserType'];
$userSignupDate                                 = $userInfo['cuSignupDate'];
$userPhone                                      = $userInfo['cuPhone'];
$userAddress                                    = $userInfo['cuAddress'];
$userCity                                       = $userInfo['cuCity'];
$userState                                      = $userInfo['cuState'];
$userCountry                                    = $userInfo['cuCountry'];
$userZipcode                                    = $userInfo['cuZipCode'];
if ($userInfo['cuPartner'] === 0) {
    $userPartner                                = 'No';
} else {
    $userPartner                                = 'Yes';
}
$userReferrer                                   = $userInfo['cuReferrer'];
$symbol                                         = $pendingAsset['symbol']; 
$blockchain                                     = $pendingAsset['blockchain'];
$coin_name                                      = $pendingAsset['coin_name'];
$coin_value                                     = $pendingAsset['coin_value'];
$coin_quantity                                  = $pendingAsset['coin_quantity'];
if (empty($pendingAsset['coin_logo'])) {
    $coin_logo                                  = 'N/A';
} else {
    $coin_logo                                  = '<img class="full-width" src="' . $coin_logo . '" alt="' . $symbol . ' - ' . $blockchain . '"/>'; 
}
if (empty($pendingAsset['description'])) {
    $coin_description                           = '<p class="card-text text-center">--- Description Currently Not Available ---<br><a class="btn btn-primary btn-md pt-3" href="' . site_url('Management/Assets/Request-Information/' . $userID . '/' . $appID) . '">Request Additional Information</a></p>'; 
} else {
    $coin_description                           = '<p class="card-text">' . $pendingAsset['description'] . '</p>'; 
}
if (empty($pendingAsset['coin_file'])) {
    $coin_file                                  = '<p class="card-text text-center">--- Files Currently Not Available ---<br><a class="btn btn-primary btn-md pt-3" href="' . site_url('Management/Assets/Request-Information/' . $userID . '/' . $appID) . '">Request Additional Information</a></p></p>';
} else {
    $coin_file                                  = '<p class="card-text"><a href="' . $pendingAsset['coin_file'] .'" download>' . $pendingAsset['coin_file'] . '</a></p>';
}
if (empty($pendingAsset['coin_links'])) {
    $coin_links                                 = '<p class="card-text text-center">--- Links Currently Not Available ---<br><a class="btn btn-primary btn-md pt-3" href="' . site_url('Management/Assets/Request-Information/' . $userID . '/' . $appID) . '">Request Additional Information</a></p></p>';
} else {
    $coin_links                                 = '<p class="card-text"><a href="' . $pendingAsset['coin_links'] . '">' . $pendingAsset['coin_links'] . '</a></p>';
}
$coinCreationDate                               = $pendingAsset['date'];      
$coinCreationTime                               = $pendingAsset['time']; 
    
// Coin Creator Investor Information
$getUserWallets                                 = $this->mymiwallet->get_wallets_by_user($userID); 
$totalUserWallets                               = $getUserWallets->num_rows(); 
$getTradesByUser                                = $this->mymiwallet->get_trades_by_user($userID); 
$totalTradesByUser                              = $getTradesByUser->num_rows();

// Create User Data Array to Pass to View Files for User Additional Information
$userData                                       = array(
    'appID'                                     => $appID,
    'pendingAssetByID'                          => $pendingAssetByID,
    'pendingAsset'                              => $pendingAsset,
    'userInfo'                                  => $userInfo,
    'userID'                                    => $userID,
    'userEmail'                                 => $userEmail,
    'userFirstName'                             => $userFirstName,
    'userMiddleName'                            => $userMiddleName,
    'userLastName'                              => $userLastName,
    'userNameSuffix'                            => $userNameSuffix,
    'userKYC'                                   => $userKYC,
    'userType'                                  => $userType,
    'userSignupDate'                            => $userSignupDate,
    'userPhone'                                 => $userPhone,
    'userAddress'                               => $userAddress,
    'userCity'                                  => $userCity,
    'userState'                                 => $userState,
    'userCountry'                               => $userCountry,
    'userZipcode'                               => $userZipcode,
    'userPartner'                               => $userPartner,
    'userReferrer'                              => $userReferrer,
    'symbol'                                    => $symbol,
    'blockchain'                                => $blockchain,
    'coin_name'                                 => $coin_name,
    'coin_value'                                => $coin_value,
    'coin_quantity'                             => $coin_quantity,
    'coin_logo'                                 => $coin_logo,
    'coin_description'                          => $coin_description,
    'coin_file'                                 => $coin_file,
    'coin_links'                                => $coin_links,
    'coinCreationDate'                          => $coinCreationDate,
    'coinCreationTime'                          => $coinCreationTime,
    'getUserWallets'                            => $getUserWallets,
    'totalUserWallets'                          => $totalUserWallets,
    'getTradesByUser'                           => $getTradesByUser,
    'totalTradesByUser'                         => $totalTradesByUser,
);

// print_r($pendingAssetByID); 
?>
<div class="nk-block">
    <div class="row gy-gs">
        <div class="col-lg-12 col-xl-12">
            <div class="nk-block">
                <div class="nk-block-head-xs">
                    <div class="nk-block-head-content">
                        <h1 class="nk-block-title title"><?php echo $dashboardTitle; ?></h1>
                        <h2 class="nk-block-title subtitle"><?php echo $dashboardSubtitle; ?></h2>
                        <p id="private_key"></p>
                        <p id="address"></p>
                        <a href="<?php echo site_url('/Management'); ?>">Back to Dashboard</a>							
                    </div>
                </div>
            </div>
            <div class="nk-block">
                <div class="row">
                    <?php 
                    echo '
                    <div class="col-sm-6 col-lg-4 col-xxl-3">
                    ';
                    $this->load->view('Management/Assets/Applications/Details/User_Profile', $userData);
                    echo '
                    </div><!-- .col -->
                    <div class="col-sm-6 col-lg-8 col-xxl-9">
                    ';
                    $this->load->view('Management/Assets/Applications/Details/Asset_Information', $userData);
                    echo '
                    </div><!-- .col -->
                    <div class="col-12 pt-3">
                        <div class="card card-bordered">
                            <div class="card-header border-bottom">Additional Information</div>
                            <div class="card-inner p-3">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#tabItem2">Creator Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#tabItem3">Files</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#tabItem4">Links</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabItem1">
                                    ' . $coin_description . '
                                    </div>
                                    <div class="tab-pane" id="tabItem2">
                                        <div class="row">
                                            <div class="col-4">';
                                            $this->load->view('Management/Assets/Applications/Details/Contact_Information', $userData);
                                            echo '
                                            </div><!-- .col -->
                                            <div class="col-4">';
                                            $this->load->view('Management/Assets/Applications/Details/Investor_Information', $userData);
                                            echo '
                                            </div><!-- .col -->
                                            <div class="col-4">';
                                            $this->load->view('Management/Assets/Applications/Details/Referral_Information', $userData);
                                            echo '
                                            </div><!-- .col -->
                                        </div>
                                    </div> 
                                    <div class="tab-pane" id="tabItem3">
                                        ' . $coin_file . '
                                    </div>
                                    <div class="tab-pane" id="tabItem4">
                                        ' . $coin_links . '
                                    </div>
                                </div>
                            </div><!-- .card-inner -->
                        </div><!-- .card -->
                    </div><!-- .col -->
                    ';
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row gy-gs">
        <div class="col-lg-12 col-xl-12">
            <div class="nk-block">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-bordered card-preview">
                            <table class="table table-orders">
                                <thead class="tb-odr-head">
                                    <tr class="tb-odr-item">
                                        <th class="tb-odr-info">
                                            <span class="tb-odr-id">Order ID</span>
                                            <span class="tb-odr-date d-none d-md-inline-block">Date</span>
                                        </th>
                                        <th class="tb-odr-info">
                                            <span class="tb-odr-date d-none d-md-inline-block">Asset</span>
                                        </th>
                                        <th class="tb-odr-amount">
                                            <span class="tb-odr-total">Amount</span>
                                            <span class="tb-odr-total">Quantity</span>
                                            <span class="tb-odr-status d-none d-md-inline-block">Status</span>
                                        </th>
                                        <th class="tb-odr-action">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="tb-odr-body">
                                    <?php
                                    $this->db->from('bf_exchanges_assets'); 
                                    $this->db->where('user_id', $userID);
                                    $getUsersAssets              = $this->db->get();
                                    foreach($getUsersAssets->result_array() as $usersAssets) {
                                    echo '                                    
                                    <tr class="tb-odr-item">
                                        <td class="tb-odr-info">
                                            <span class="tb-odr-id"><a href="#">#' . $usersAssets['id'] . '</a></span>
                                            <span class="tb-odr-date">' . date("F", strtotime($usersAssets['date'])) . ' - ' . $usersAssets['time'] .'</span>
                                        </td>
                                        <td class="tb-odr-info">
                                            <span class="tb-odr-date"><a href="' . site_url('Exchange/Market/' . $usersAssets['blockchain'] . '/' . $usersAssets['symbol']) . '">' . $usersAssets['symbol'] .'-' . $usersAssets['blockchain'] . '</a></span>
                                        </td>
                                        <td class="tb-odr-amount">
                                            <span class="tb-odr-total">
                                                <span class="amount">$' . number_format($usersAssets['coin_value'],2) . '</span>
                                            </span> 
                                            <span class="tb-odr-total">
                                                <span class="amount">' . number_format($usersAssets['coin_quantity'],0) . '</span>
                                            </span>
                                            <span class="tb-odr-status">
                                                <span class="badge badge-dot statusWarning">' . $usersAssets['status'] . '</span>
                                            </span>
                                        </td>
                                        <td class="tb-odr-action">
                                            <div class="tb-odr-btns d-none d-md-inline">
                                                <a href="' . site_url('Management/Users/Orders/' . $usersAssets['id']) . '" class="btn btn-sm btn-primary">View</a>
                                            </div>
                                            <div class="dropdown">
                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" data-offset="-8,0"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                    <ul class="link-list-plain">
                                                        <li><a href="#" class="text-primary">Edit</a></li>
                                                        <li><a href="#" class="text-danger">Remove</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    ';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div><!-- .card-preview -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>