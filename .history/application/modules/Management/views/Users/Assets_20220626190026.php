<?php
$pageURIA                                   = $this->uri->segment(1);
$pageURIB                                   = $this->uri->segment(2);
$pageURIC                                   = $this->uri->segment(3);
$pageURID                                   = $this->uri->segment(4);
$pageURIE                                   = $this->uri->segment(5);
$userID                                     = $pageURID; 
$redirect_url                               = current_url();
$this->db->from('bf_exchanges'); 
$this->db->where('alt_cur', 'No');
$this->db->where('int_cur', 'No'); 
$this->db->order_by('market_pair', 'ASC'); 
$getExchanges                               = $this->db->get(); 
$this->db->select_sum('coin_value');
$this->db->from('bf_exchanges_assets'); 
$this->db->where('user_id', $userID); 
$getApprovedAssets                          = $this->db->get(); 
foreach($getApprovedAssets->result_array() as $assetTotals) {
    $totalAssetValue                        = $assetTotals['coin_value'];
    if ($totalAssetValue > 0) {
        $totalAssetValue                    = '<span class="statusGreen">' . $totalAssetValue . '</span>';
    } elseif ($totalAssetValue < 0) {
        $totalAssetValue                    = '<span class="statusRed">' . $totalAssetValue . '</span>';
    }
}
$totalApprovedAssets                        = $getApprovedAssets->num_rows(); 
$dashboardTitle                             = 'Users /';
$dashboardSubtitle                          = 'Assets'; 
$initial_value								= $_SESSION['allSessionData']['userGoldData']['myMIGInitialValue'];
$available_coins							= $_SESSION['allSessionData']['userGoldData']['coinSum'];
$coin_value									= $this->config->item('mymig_coin_value');
$gas_fee									= $this->config->item('gas_fee');
$trans_percent								= $this->config->item('trans_percent');
$trans_fee									= $this->config->item('trans_fee');
$viewFileData                               = array(
    'userID'                                => $userID,
    'redirect_url'                          => $redirect_url,
    'initial_value'                         => $initial_value,
    'available_coins'                       => $available_coins,
    'coin_value'                            => $coin_value,
    'gas_fee'                               => $gas_fee,
    'trans_percent'                         => $trans_percent,
    'trans_fee'                             => $trans_fee,
    'dashboardTitle'                        => $dashboardTitle,
    'dashboardSubtitle'                     => $dashboardSubtitle,        
    'getExchanges'                          => $getExchanges,
);
?>
<style>
    .user-activity-ck {
        height: 100%; 
    }
    canvas {
        height:100%;
        max-height:200px;
    }
</style>
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
                    $userAccount            = $this->mymiuser->user_account_info($userID); 
                    // print_r($_SESSION);
                    echo '
                    <div class="col-sm-6 col-lg-4 col-xxl-3">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="team">
                                    <div class="team-options">
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#"><em class="icon ni ni-focus"></em><span>Quick View</span></a></li>
                                                    <li><a href="' . site_url('Users/Profile/' . $userAccount['cuID']) . '"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                    <li><a href="mailto:' . $userAccount['cuEmail'] . '"><em class="icon ni ni-mail"></em><span>Send Email</span></a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="' . site_url('Users/Force-Reset/' . $userAccount['cuID']) . '"><em class="icon ni ni-shield-star"></em><span>Reset Pass</span></a></li>
                                                    <!--<li><a href="#"><em class="icon ni ni-shield-off"></em><span>Reset 2FA</span></a></li>-->
                                                    <li><a href="' . site_url('Users/Block/' . $userAccount['cuID']) . '"><em class="icon ni ni-na"></em><span>Suspend User</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-card user-card-s2">
                                        <div class="user-avatar lg bg-primary">
                                            <span>' . $userAccount['cuFirstName'][0] . $userAccount['cuLastName'][0] . '</span>
                                            <div class="status dot dot-lg dot-success"></div>
                                        </div>
                                        <div class="user-info">
                                            <h6>' . $userAccount['cuFirstName'] . ' ' . $userAccount['cuLastName'] . '</h6>
                                            <span class="sub-text">' . $userAccount['cuUserType'] . ' User</span>
                                        </div>
                                    </div>
                                    <ul class="team-info">
                                        <li><span><strong>Join Date</strong></span><span>' . $userAccount['cuSignupDate'] . '</span></li>
                                        <li><span><strong>Contact</strong></span><span>' . $userAccount['cuPhone'] . '</span></li>
                                        <li><span><strong>Email</strong></span><span><a href="mailto:' . $userAccount['cuEmail'] . '">' . $userAccount['cuEmail'] . '</a></span></li>
                                    </ul>
                                    <div class="team-view">
                                        <a href="' . site_url('Management/Users/Profile/' . $userAccount['cuID']) . '" class="btn btn-block btn-dim btn-primary text-white"><span>View Profile</span></a>
                                    </div>
                                </div><!-- .team -->
                            </div><!-- .card-inner -->
                        </div><!-- .card -->
                    </div><!-- .col -->
                    ';
                    ?>
                    <div class="col-md-6 col-lg-8">
                        <div class="card card-bordered card-full">
                            <div class="card-inner">
                                <div class="card-title-group align-start mb-3">
                                    <div class="card-title">
                                        <h6 class="title">User Activities</h6>
                                        <p>In last 30 days <em class="icon ni ni-info" data-bs-toggle="tooltip" data-bs-placement="right" title="Referral Informations"></em></p>
                                    </div>
                                    <div class="card-tools mt-n1 me-n1">
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#"><span>15 Days</span></a></li>
                                                    <li><a href="#" class="active"><span>30 Days</span></a></li>
                                                    <li><a href="#"><span>3 Months</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-activity-group row g-4">
                                    <div class="user-activity col">
                                        <em class="icon icon-lg ni ni-coins"></em>
                                        <div class="info">
                                            <span class="amount"><?php echo $totalApprovedAssets; ?></span>
                                            <span class="title">Total Assets</span>
                                        </div>
                                    </div>
                                    <div class="user-activity col">
                                        <em class="icon ni ni-sign-dollar"></em>
                                        <div class="info">
                                            <span class="amount"><?php echo $totalAssetValue; ?></span>
                                            <span class="title">Total Value</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="user-activity-ck">
                                <canvas class="line-chart" id="userAssetProgressChart" sty></canvas>
                            </div>
                        </div><!-- .card -->
                    </div>
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
                                            <span class="tb-odr-status d-none d-md-inline-block">Status</span>
                                        </th>
                                        <th class="tb-odr-action">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="tb-odr-body">
                                    <?php
                                    $this->db->from('bf_exchanges_orders'); 
                                    $this->db->where('user_id', $userAccount['cuID']);
                                    $getUserOrders              = $this->db->get();
                                    foreach($getUserOrders->result_array() as $userOrder) {
                                    echo '                                    
                                    <tr class="tb-odr-item">
                                        <td class="tb-odr-info">
                                            <span class="tb-odr-id"><a href="#">#' . $userOrder['id'] . '</a></span>
                                            <span class="tb-odr-date">' . date("F", strtotime($userOrder['month'])) . ' ' . date("jS", strtotime($userOrder['day'])) . ', ' . $userOrder['year'] . ' - ' . $userOrder['time'] .'</span>
                                        </td>
                                        <td class="tb-odr-info">
                                            <span class="tb-odr-date"><a href="' . site_url('Exchange/Market/' . $userOrder['market_pair'] . '/' . $userOrder['market']) . '">' . $userOrder['market'] .'-' . $userOrder['market_pair'] . '</a></span>
                                        </td>
                                        <td class="tb-odr-amount">
                                            <span class="tb-odr-total">
                                                <span class="amount">$' . number_format($userOrder['amount'],2) . '</span>
                                            </span>
                                            <span class="tb-odr-status">
                                                <span class="badge badge-dot statusWarning">' . $userOrder['status'] . '</span>
                                            </span>
                                        </td>
                                        <td class="tb-odr-action">
                                            <div class="tb-odr-btns d-none d-md-inline">
                                                <a href="' . site_url('Management/Users/Orders/' . $userOrder['id']) . '" class="btn btn-sm btn-primary">View</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
var yValues = [55, 49, 44, 24, 15];
var barColors = ["red", "green","blue","orange","brown"];

new Chart("userAssetProgressChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "World Wine Production 2018"
    }
  }
});
</script>