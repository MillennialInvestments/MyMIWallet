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
    /* .user-activity-ck {
        height: 100%; 
    }
    canvas {
        height:100%;
        max-height:200px;
    } */
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
                            <div class="row">
                                <div class="col-12">
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
                                </div>
                                <div class="user-activity-ck col-12">
                                    <canvas id="lineChart"></canvas>
                                </div>
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
<script>//line
var label = document.querySelector(".label");
var c = document.getElementById("lineChart");
var ctx = c.getContext("2d");
var cw = c.width = 700;
var ch = c.height = 350;
var cx = cw / 2,
  cy = ch / 2;
var rad = Math.PI / 180;
var frames = 0;

ctx.lineWidth = 1;
ctx.strokeStyle = "#999";
ctx.fillStyle = "#ccc";
ctx.font = "14px monospace";

var grd = ctx.createLinearGradient(0, 0, 0, cy);
grd.addColorStop(0, "hsla(167,72%,60%,1)");
grd.addColorStop(1, "hsla(167,72%,60%,0)");

var oData = {
  "2008": 10,
  "2009": 39.9,
  "2010": 17,
  "2011": 30.0,
  "2012": 5.3,
  "2013": 38.4,
  "2014": 15.7,
  "2015": 9.0
};

var valuesRy = [];
var propsRy = [];
for (var prop in oData) {

  valuesRy.push(oData[prop]);
  propsRy.push(prop);
}


var vData = 4;
var hData = valuesRy.length;
var offset = 50.5; //offset chart axis
var chartHeight = ch - 2 * offset;
var chartWidth = cw - 2 * offset;
var t = 1 / 7; // curvature : 0 = no curvature 
var speed = 2; // for the animation

var A = {
  x: offset,
  y: offset
}
var B = {
  x: offset,
  y: offset + chartHeight
}
var C = {
  x: offset + chartWidth,
  y: offset + chartHeight
}

/*
      A  ^
	    |  |  
	    + 25
	    |
	    |
	    |
	    + 25  
      |__|_________________________________  C
      B
*/

// CHART AXIS -------------------------
ctx.beginPath();
ctx.moveTo(A.x, A.y);
ctx.lineTo(B.x, B.y);
ctx.lineTo(C.x, C.y);
ctx.stroke();

// vertical ( A - B )
var aStep = (chartHeight - 50) / (vData);

var Max = Math.ceil(arrayMax(valuesRy) / 10) * 10;
var Min = Math.floor(arrayMin(valuesRy) / 10) * 10;
var aStepValue = (Max - Min) / (vData);
console.log("aStepValue: " + aStepValue); //8 units
var verticalUnit = aStep / aStepValue;

var a = [];
ctx.textAlign = "right";
ctx.textBaseline = "middle";
for (var i = 0; i <= vData; i++) {

  if (i == 0) {
    a[i] = {
      x: A.x,
      y: A.y + 25,
      val: Max
    }
  } else {
    a[i] = {}
    a[i].x = a[i - 1].x;
    a[i].y = a[i - 1].y + aStep;
    a[i].val = a[i - 1].val - aStepValue;
  }
  drawCoords(a[i], 3, 0);
}

//horizontal ( B - C )
var b = [];
ctx.textAlign = "center";
ctx.textBaseline = "hanging";
var bStep = chartWidth / (hData + 1);

for (var i = 0; i < hData; i++) {
  if (i == 0) {
    b[i] = {
      x: B.x + bStep,
      y: B.y,
      val: propsRy[0]
    };
  } else {
    b[i] = {}
    b[i].x = b[i - 1].x + bStep;
    b[i].y = b[i - 1].y;
    b[i].val = propsRy[i]
  }
  drawCoords(b[i], 0, 3)
}

function drawCoords(o, offX, offY) {
  ctx.beginPath();
  ctx.moveTo(o.x - offX, o.y - offY);
  ctx.lineTo(o.x + offX, o.y + offY);
  ctx.stroke();

  ctx.fillText(o.val, o.x - 2 * offX, o.y + 2 * offY);
}
//----------------------------------------------------------

// DATA
var oDots = [];
var oFlat = [];
var i = 0;

for (var prop in oData) {
  oDots[i] = {}
  oFlat[i] = {}

  oDots[i].x = b[i].x;
  oFlat[i].x = b[i].x;

  oDots[i].y = b[i].y - oData[prop] * verticalUnit - 25;
  oFlat[i].y = b[i].y - 25;

  oDots[i].val = oData[b[i].val];
  
  i++
}



///// Animation Chart ///////////////////////////
//var speed = 3;
function animateChart() {
  requestId = window.requestAnimationFrame(animateChart);
  frames += speed; //console.log(frames)
  ctx.clearRect(60, 0, cw, ch - 60);
  
  for (var i = 0; i < oFlat.length; i++) {
    if (oFlat[i].y > oDots[i].y) {
      oFlat[i].y -= speed;
    }
  }
  drawCurve(oFlat);
  for (var i = 0; i < oFlat.length; i++) {
      ctx.fillText(oDots[i].val, oFlat[i].x, oFlat[i].y - 25);
      ctx.beginPath();
      ctx.arc(oFlat[i].x, oFlat[i].y, 3, 0, 2 * Math.PI);
      ctx.fill();
    }

  if (frames >= Max * verticalUnit) {
    window.cancelAnimationFrame(requestId);
    
  }
}
requestId = window.requestAnimationFrame(animateChart);

/////// EVENTS //////////////////////
c.addEventListener("mousemove", function(e) {
  label.innerHTML = "";
  label.style.display = "none";
  this.style.cursor = "default";

  var m = oMousePos(this, e);
  for (var i = 0; i < oDots.length; i++) {

    output(m, i);
  }

}, false);

function output(m, i) {
  ctx.beginPath();
  ctx.arc(oDots[i].x, oDots[i].y, 20, 0, 2 * Math.PI);
  if (ctx.isPointInPath(m.x, m.y)) {
    //console.log(i);
    label.style.display = "block";
    label.style.top = (m.y + 10) + "px";
    label.style.left = (m.x + 10) + "px";
    label.innerHTML = "<strong>" + propsRy[i] + "</strong>: " + valuesRy[i] + "%";
    c.style.cursor = "pointer";
  }
}

// CURVATURE
function controlPoints(p) {
  // given the points array p calculate the control points
  var pc = [];
  for (var i = 1; i < p.length - 1; i++) {
    var dx = p[i - 1].x - p[i + 1].x; // difference x
    var dy = p[i - 1].y - p[i + 1].y; // difference y
    // the first control point
    var x1 = p[i].x - dx * t;
    var y1 = p[i].y - dy * t;
    var o1 = {
      x: x1,
      y: y1
    };

    // the second control point
    var x2 = p[i].x + dx * t;
    var y2 = p[i].y + dy * t;
    var o2 = {
      x: x2,
      y: y2
    };

    // building the control points array
    pc[i] = [];
    pc[i].push(o1);
    pc[i].push(o2);
  }
  return pc;
}

function drawCurve(p) {

  var pc = controlPoints(p); // the control points array

  ctx.beginPath();
  //ctx.moveTo(p[0].x, B.y- 25);
  ctx.lineTo(p[0].x, p[0].y);
  // the first & the last curve are quadratic Bezier
  // because I'm using push(), pc[i][1] comes before pc[i][0]
  ctx.quadraticCurveTo(pc[1][1].x, pc[1][1].y, p[1].x, p[1].y);

  if (p.length > 2) {
    // central curves are cubic Bezier
    for (var i = 1; i < p.length - 2; i++) {
      ctx.bezierCurveTo(pc[i][0].x, pc[i][0].y, pc[i + 1][1].x, pc[i + 1][1].y, p[i + 1].x, p[i + 1].y);
    }
    // the first & the last curve are quadratic Bezier
    var n = p.length - 1;
    ctx.quadraticCurveTo(pc[n - 1][0].x, pc[n - 1][0].y, p[n].x, p[n].y);
  }

  //ctx.lineTo(p[p.length-1].x, B.y- 25);
  ctx.stroke();
  ctx.save();
  ctx.fillStyle = grd;
  ctx.fill();
  ctx.restore();
}

function arrayMax(array) {
  return Math.max.apply(Math, array);
};

function arrayMin(array) {
  return Math.min.apply(Math, array);
};

function oMousePos(canvas, evt) {
  var ClientRect = canvas.getBoundingClientRect();
  return { //objeto
    x: Math.round(evt.clientX - ClientRect.left),
    y: Math.round(evt.clientY - ClientRect.top)
  }
}
</script>