<?php /* /users/views/user_fields.php */
$cuID									        = $_SESSION['allSessionData']['userAccount']['cuID'];
$cuRole									        = $_SESSION['allSessionData']['userAccount']['cuRole'];
$cuEmail								        = $_SESSION['allSessionData']['userAccount']['cuEmail'];
$cuWalletID								        = $_SESSION['allSessionData']['userAccount']['cuWalletID'];
$cuWalletCount							        = $_SESSION['allSessionData']['userAccount']['cuWalletCount'];
$cuTotalWalletCount						        = $_SESSION['allSessionData']['userAccount']['cuTotalWalletCount'];
$cuKYC                                          = $_SESSION['allSessionData']['userAccount']['cuKYC'];
$walletID								        = $_SESSION['allSessionData']['userAccount']['walletID'];
$walletTitle							        = $_SESSION['allSessionData']['userAccount']['walletTitle'];
$walletBroker							        = $_SESSION['allSessionData']['userAccount']['walletBroker'];
$walletNickname							        = $_SESSION['allSessionData']['userAccount']['walletNickname'];
$walletDefault							        = $_SESSION['allSessionData']['userAccount']['walletDefault'];
$walletExchange							        = $_SESSION['allSessionData']['userAccount']['walletExchange'];
$walletMarketPair						        = $_SESSION['allSessionData']['userAccount']['walletMarketPair'];
$walletMarket							        = $_SESSION['allSessionData']['userAccount']['walletMarket'];
$walletFunds							        = $_SESSION['allSessionData']['userAccount']['walletFunds'];
$walletInitialAmount					        = $_SESSION['allSessionData']['userAccount']['walletInitialAmount'];
$walletAmount							        = $_SESSION['allSessionData']['userAccount']['walletAmount'];
$walletPercentChange					        = $_SESSION['allSessionData']['userAccount']['walletPercentChange'];
$walletGains							        = $_SESSION['allSessionData']['userAccount']['walletGains'];
$depositAmount							        = $_SESSION['allSessionData']['userAccount']['depositAmount'];
$withdrawAmount							        = $_SESSION['allSessionData']['userAccount']['withdrawAmount'];
$MyMICoinValue							        = $_SESSION['allSessionData']['userAccount']['MyMICoinValue'];
$MyMICCurrentValue						        = $_SESSION['allSessionData']['userAccount']['MyMICCurrentValue'];
$MyMICCoinSum							        = $_SESSION['allSessionData']['userAccount']['MyMICCoinSum'];
$MyMIGoldValue							        = $_SESSION['allSessionData']['userAccount']['MyMIGoldValue'];
$MyMIGCurrentValue						        = $_SESSION['allSessionData']['userAccount']['MyMIGCurrentValue'];
$MyMIGCoinSum							        = $_SESSION['allSessionData']['userAccount']['MyMIGCoinSum'];
$lastTradeActivity                              = $_SESSION['allSessionData']['userAccount']['lastTradeActivity'];
// $walletData							    	= $_SESSION['allSessionData']['userAccount']['walletData'];
$getWallets								        = $_SESSION['allSessionData']['userAccount']['getWallets'];
$walletSum                                      = $_SESSION['allSessionData']['myMIWalletSummary']['walletSum'];
$assetNetValue                                  = $_SESSION['allSessionData']['userAccount']['assetNetValue'];
$assetTotalCount                                = $_SESSION['allSessionData']['userAccount']['assetTotalCount'];
$assetTotalGains                                = $_SESSION['allSessionData']['userAccount']['assetTotalGains'];

$walletCost								        = $this->config->item('wallet_cost');  			 		// $5
$gas_fee								        = $this->config->item('gas_fee');
$trans_fee								        = $this->config->item('trans_fee');
$trans_percent							        = $this->config->item('trans_percent');
$expenses								        = ($walletCost * $trans_percent) + $trans_fee;			// Total Fees
$total_fees								        = number_format($expenses, 2);
$fee_coins								        = round(($MyMICoinValue), 8);
$walletCoins							        = ($walletCost / $MyMICoinValue) + $fee_coins;
$remainingCoins							        = $MyMICCoinSum - $walletCoins;
// New Dashboard Variables
$totalAccountBalan<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.72.0">
  <title>Carousel Template · Bootstrap</title>

  <link rel="canonical" href="https://v5.getbootstrap.com/docs/5.0/examples/carousel/">



  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
    integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
    integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    /* GLOBAL STYLES
    --------------------------------------------- */
    /* Padding below the footer and lighter body text */

    body {
      padding-top: 3rem;
      padding-bottom: 3rem;
      color: #5a5a5a;
    }


    /* CUSTOMIZE THE CAROUSEL
    -------------------------------------------- */

    /* Carousel base class */
    .carousel {
      margin-bottom: 4rem;
    }

    /* Since positioning the image, we need to help out the caption */
    .carousel-caption {
      bottom: 3rem;
      z-index: 10;
    }

    /* Declare heights because of positioning of img element */
    .carousel-item {
      height: 32rem;
    }

    .carousel-item>img {
      position: absolute;
      top: 0;
      left: 0;
      min-width: 100%;
      height: 32rem;
    }


    /* MARKETING CONTENT
-------------------------------------------------- */

    /* Center align the text within the three columns below the carousel */
    .marketing .col-lg-4 {
      margin-bottom: 1.5rem;
      text-align: center;
    }

    .marketing h2 {
      font-weight: 400;
    }

    .marketing .col-lg-4 p {
      margin-right: .75rem;
      margin-left: .75rem;
    }


    /* Featurettes
------------------------- */

    .featurette-divider {
      margin: 5rem 0;
      /* Space out the Bootstrap <hr> more */
    }

    /* Thin out the marketing headings */
    .featurette-heading {
      font-weight: 300;
      line-height: 1;
      letter-spacing: -.05rem;
    }


    /* RESPONSIVE CSS
-------------------------------------------------- */

    @media (min-width: 40em) {

      /* Bump up size of carousel content */
      .carousel-caption p {
        margin-bottom: 1.25rem;
        font-size: 1.25rem;
        line-height: 1.4;
      }

      .featurette-heading {
        font-size: 50px;
      }
    }

    @media (min-width: 62em) {
      .featurette-heading {
        margin-top: 7rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="carousel.css" rel="stylesheet">
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Carousel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
          aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto mb-2 mb-md-0">
            <li class="nav-item active">
              <a class="nav-link" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
          <form class="d-flex">
            <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  </header>

  <main>

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="xMidYMid slice" role="img" focusable="false">
            <rect width="100%" height="100%" fill="#777" /></svg>

          <div class="container">
            <div class="carousel-caption text-left">
              <h1>Example headline.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget
                metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="xMidYMid slice" role="img" focusable="false">
            <rect width="100%" height="100%" fill="#777" /></svg>

          <div class="container">
            <div class="carousel-caption">
              <h1>Another example headline.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget
                metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="xMidYMid slice" role="img" focusable="false">
            <rect width="100%" height="100%" fill="#777" /></svg>

          <div class="container">
            <div class="carousel-caption text-right">
              <h1>One more for good measure.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget
                metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>


    <!-- Marketing messaging and featurettes
  ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4">
          <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg"
            aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" role="img" focusable="false">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
          </svg>

          <h2>Heading</h2>
          <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies
            vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus
            magna.</p>
          <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg"
            aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" role="img" focusable="false">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
          </svg>

          <h2>Heading</h2>
          <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras
            mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris
            condimentum nibh.</p>
          <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg"
            aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" role="img" focusable="false">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
          </svg>

          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta
            felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum
            massa justo sit amet risus.</p>
          <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It’ll blow your mind.</span>
          </h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod
            semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus
            commodo.</p>
        </div>
        <div class="col-md-5">
          <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
            height="500" xmlns="http://www.w3.org/2000/svg" aria-label="Placeholder: 500x500"
            preserveAspectRatio="xMidYMid slice" role="img" focusable="false">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#eee" /><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text>
          </svg>

        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 order-md-2">
          <h2 class="featurette-heading">Oh yeah, it’s that good. <span class="text-muted">See for yourself.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod
            semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus
            commodo.</p>
        </div>
        <div class="col-md-5 order-md-1">
          <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
            height="500" xmlns="http://www.w3.org/2000/svg" aria-label="Placeholder: 500x500"
            preserveAspectRatio="xMidYMid slice" role="img" focusable="false">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#eee" /><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text>
          </svg>

        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod
            semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus
            commodo.</p>
        </div>
        <div class="col-md-5">
          <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
            height="500" xmlns="http://www.w3.org/2000/svg" aria-label="Placeholder: 500x500"
            preserveAspectRatio="xMidYMid slice" role="img" focusable="false">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#eee" /><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text>
          </svg>

        </div>
      </div>

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->

    </div><!-- /.container -->


    <!-- FOOTER -->
    <footer class="container">
      <p class="float-right"><a href="#">Back to top</a></p>
      <p>&copy; 2017-2020 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>
  </main>



</body>

</html>                        = '';
$totalMonthlyOverallFinancialChange             = '';
$totalMonthlyOvervallFinancials                 = '';
$lastMonthlyOvervallFinancials                  = '';
$dashboardData							        = array(
    'getWallets'						        => $getWallets,
    'cuID'								        => $cuID,
    'cuWalletCount'						        => $cuWalletCount,
    'cuTotalWalletCount'				        => $cuTotalWalletCount,
    'walletID'							        => $walletID,
    'walletTitle'						        => $walletTitle,
    'walletAmount'						        => $walletAmount,
    'walletFunds'						        => $walletFunds,
    'walletGains'						        => $walletGains,
    'MyMICCoinSum'						        => $MyMICCoinSum,
    'MyMICCurrentValue'					        => $MyMICCurrentValue,
    'MyMIGCoinSum'						        => $MyMIGCoinSum,
    'MyMIGCurrentValue'					        => $MyMIGCurrentValue,
    'lastTradeActivity'					        => $lastTradeActivity,
    'walletCost'						        => $walletCost,
    'walletCoins'						        => $walletCoins,
    'walletSum'                                 => $walletSum,
    'assetNetValue'                             => $assetNetValue,
    'assetTotalCount'                           => $assetTotalCount,
    'assetTotalGains'                           => $assetTotalGains,
    'totalOvervallFinancials'                   => $totalOvervallFinancials,
    'totalMonthlyOverallFinancialChange'        => $totalMonthlyOverallFinancialChange,
    'totalMonthlyOvervallFinancials'            => $totalMonthlyOvervallFinancials,
    'lastMonthlyOvervallFinancials'             => $lastMonthlyOvervallFinancials,
);
?>   
<style>
.tranx-amount .number {
    font-size:0.87em; 
}
</style>

<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Financial Dashboard</h3>
            <div class="nk-block-des text-soft">
                <p>Welcome to Your Financial Overview</p>
            </div>
        </div><!-- .nk-block-head-content -->
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                        <li><a href="#" class="btn btn-white btn-dim btn-outline-primary"><em class="icon ni ni-download-cloud"></em><span>Export</span></a></li>
                        <li><a href="#" class="btn btn-white btn-dim btn-outline-primary"><em class="icon ni ni-reports"></em><span>Reports</span></a></li>
                        <li class="nk-block-tools-opt">
                            <div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                        <li><a href="#"><em class="icon ni ni-user-add-fill"></em><span>Add User</span></a></li>
                                        <li><a href="#"><em class="icon ni ni-coin-alt-fill"></em><span>Add Order</span></a></li>
                                        <li><a href="#"><em class="icon ni ni-note-add-fill-c"></em><span>Add Page</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div><!-- .toggle-expand-content -->
            </div><!-- .toggle-wrap -->
        </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="nk-block">
    <div class="row g-gs">
        <div class="col-md-4">
            <?php $this->load->view('User/Dashboard/index-new/total_finances', $dashboardData); ?>
        </div><!-- .col -->
        <div class="col-md-4">
            <div class="card card-bordered card-full">
                <div class="card-inner">
                    <div class="card-title-group align-start mb-0">
                        <div class="card-title">
                            <h6 class="subtitle">Total Withdraw</h6>
                        </div>
                        <div class="card-tools">
                            <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Total Withdraw"></em>
                        </div>
                    </div>
                    <div class="card-amount">
                        <span class="amount"> 49,595.34 <span class="currency currency-usd">USD</span>
                        </span>
                        <span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span>
                    </div>
                    <div class="invest-data">
                        <div class="invest-data-amount g-2">
                            <div class="invest-data-history">
                                <div class="title">This Month</div>
                                <div class="amount">2,940.59 <span class="currency currency-usd">USD</span></div>
                            </div>
                            <div class="invest-data-history">
                                <div class="title">This Week</div>
                                <div class="amount">1,259.28 <span class="currency currency-usd">USD</span></div>
                            </div>
                        </div>
                        <div class="invest-data-ck">
                            <canvas class="iv-data-chart" id="totalWithdraw"></canvas>
                        </div>
                    </div>
                </div>
            </div><!-- .card -->
        </div><!-- .col -->
        <div class="col-md-4">
            <div class="card card-bordered  card-full">
                <div class="card-inner">
                    <div class="card-title-group align-start mb-0">
                        <div class="card-title">
                            <h6 class="subtitle">Balance in Account</h6>
                        </div>
                        <div class="card-tools">
                            <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Total Balance in Account"></em>
                        </div>
                    </div>
                    <div class="card-amount">
                        <span class="amount"> 79,358.50 <span class="currency currency-usd">USD</span>
                        </span>
                    </div>
                    <div class="invest-data">
                        <div class="invest-data-amount g-2">
                            <div class="invest-data-history">
                                <div class="title">This Month</div>
                                <div class="amount">2,940.59 <span class="currency currency-usd">USD</span></div>
                            </div>
                            <div class="invest-data-history">
                                <div class="title">This Week</div>
                                <div class="amount">1,259.28 <span class="currency currency-usd">USD</span></div>
                            </div>
                        </div>
                        <div class="invest-data-ck">
                            <canvas class="iv-data-chart" id="totalBalance"></canvas>
                        </div>
                    </div>
                </div>
            </div><!-- .card -->
        </div><!-- .col -->
        <div class="col-md-6 col-xxl-4">
            <div class="card card-bordered card-full">
                <div class="card-inner">
                    <div class="card-title-group mb-1">
                        <div class="card-title">
                            <h6 class="title">Investment Overview</h6>
                            <p>The investment overview of your platform. <a href="#">All Investment</a></p>
                        </div>
                    </div>
                    <ul class="nav nav-tabs nav-tabs-card nav-tabs-xs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#overview">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#thisyear">This Year</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#alltime">All Time</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-0">
                        <div class="tab-pane active" id="overview">
                            <div class="invest-ov gy-2">
                                <div class="subtitle">Currently Actived Investment</div>
                                <div class="invest-ov-details">
                                    <div class="invest-ov-info">
                                        <div class="amount">49,395.395 <span class="currency currency-usd">USD</span></div>
                                        <div class="title">Amount</div>
                                    </div>
                                    <div class="invest-ov-stats">
                                        <div><span class="amount">56</span><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span></div>
                                        <div class="title">Plans</div>
                                    </div>
                                </div>
                                <div class="invest-ov-details">
                                    <div class="invest-ov-info">
                                        <div class="amount">49,395.395 <span class="currency currency-usd">USD</span></div>
                                        <div class="title">Paid Profit</div>
                                    </div>
                                </div>
                            </div>
                            <div class="invest-ov gy-2">
                                <div class="subtitle">Investment in this Month</div>
                                <div class="invest-ov-details">
                                    <div class="invest-ov-info">
                                        <div class="amount">49,395.395 <span class="currency currency-usd">USD</span></div>
                                        <div class="title">Amount</div>
                                    </div>
                                    <div class="invest-ov-stats">
                                        <div><span class="amount">23</span><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span></div>
                                        <div class="title">Plans</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="thisyear">
                            <div class="invest-ov gy-2">
                                <div class="subtitle">Currently Actived Investment</div>
                                <div class="invest-ov-details">
                                    <div class="invest-ov-info">
                                        <div class="amount">89,395.395 <span class="currency currency-usd">USD</span></div>
                                        <div class="title">Amount</div>
                                    </div>
                                    <div class="invest-ov-stats">
                                        <div><span class="amount">96</span><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span></div>
                                        <div class="title">Plans</div>
                                    </div>
                                </div>
                                <div class="invest-ov-details">
                                    <div class="invest-ov-info">
                                        <div class="amount">99,395.395 <span class="currency currency-usd">USD</span></div>
                                        <div class="title">Paid Profit</div>
                                    </div>
                                </div>
                            </div>
                            <div class="invest-ov gy-2">
                                <div class="subtitle">Investment in this Month</div>
                                <div class="invest-ov-details">
                                    <div class="invest-ov-info">
                                        <div class="amount">149,395.395 <span class="currency currency-usd">USD</span></div>
                                        <div class="title">Amount</div>
                                    </div>
                                    <div class="invest-ov-stats">
                                        <div><span class="amount">83</span><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span></div>
                                        <div class="title">Plans</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="alltime">
                            <div class="invest-ov gy-2">
                                <div class="subtitle">Currently Actived Investment</div>
                                <div class="invest-ov-details">
                                    <div class="invest-ov-info">
                                        <div class="amount">249,395.395 <span class="currency currency-usd">USD</span></div>
                                        <div class="title">Amount</div>
                                    </div>
                                    <div class="invest-ov-stats">
                                        <div><span class="amount">556</span><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span></div>
                                        <div class="title">Plans</div>
                                    </div>
                                </div>
                                <div class="invest-ov-details">
                                    <div class="invest-ov-info">
                                        <div class="amount">149,395.395 <span class="currency currency-usd">USD</span></div>
                                        <div class="title">Paid Profit</div>
                                    </div>
                                </div>
                            </div>
                            <div class="invest-ov gy-2">
                                <div class="subtitle">Investment in this Month</div>
                                <div class="invest-ov-details">
                                    <div class="invest-ov-info">
                                        <div class="amount">249,395.395 <span class="currency currency-usd">USD</span></div>
                                        <div class="title">Amount</div>
                                    </div>
                                    <div class="invest-ov-stats">
                                        <div><span class="amount">223</span><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span></div>
                                        <div class="title">Plans</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .col -->
        <div class="col-md-6 col-xxl-4">
            <div class="card card-bordered card-full">
                <div class="card-inner d-flex flex-column h-100">
                    <div class="card-title-group mb-3">
                        <div class="card-title">
                            <h6 class="title">Top Invested Plan</h6>
                            <p>In last 30 days top invested schemes.</p>
                        </div>
                        <div class="card-tools mt-n4 me-n1">
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
                    <div class="progress-list gy-3">
                        <div class="progress-wrap">
                            <div class="progress-text">
                                <div class="progress-label">Strater Plan</div>
                                <div class="progress-amount">58%</div>
                            </div>
                            <div class="progress progress-md">
                                <div class="progress-bar" data-progress="58"></div>
                            </div>
                        </div>
                        <div class="progress-wrap">
                            <div class="progress-text">
                                <div class="progress-label">Silver Plan</div>
                                <div class="progress-amount">18.49%</div>
                            </div>
                            <div class="progress progress-md">
                                <div class="progress-bar bg-orange" data-progress="18.49"></div>
                            </div>
                        </div>
                        <div class="progress-wrap">
                            <div class="progress-text">
                                <div class="progress-label">Dimond Plan</div>
                                <div class="progress-amount">16%</div>
                            </div>
                            <div class="progress progress-md">
                                <div class="progress-bar bg-teal" data-progress="16"></div>
                            </div>
                        </div>
                        <div class="progress-wrap">
                            <div class="progress-text">
                                <div class="progress-label">Platinam Plan</div>
                                <div class="progress-amount">29%</div>
                            </div>
                            <div class="progress progress-md">
                                <div class="progress-bar bg-pink" data-progress="29"></div>
                            </div>
                        </div>
                        <div class="progress-wrap">
                            <div class="progress-text">
                                <div class="progress-label">Vibranium Plan</div>
                                <div class="progress-amount">33%</div>
                            </div>
                            <div class="progress progress-md">
                                <div class="progress-bar bg-azure" data-progress="33"></div>
                            </div>
                        </div>
                    </div>
                    <div class="invest-top-ck mt-auto">
                        <canvas class="iv-plan-purchase" id="planPurchase"></canvas>
                    </div>
                </div>
            </div>
        </div><!-- .col -->
        <div class="col-md-6 col-xxl-4">
            <div class="card card-bordered card-full">
                <div class="card-inner border-bottom">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h6 class="title">Recent Activities</h6>
                        </div>
                        <div class="card-tools">
                            <ul class="card-tools-nav">
                                <li><a href="#"><span>Cancel</span></a></li>
                                <li class="active"><a href="#"><span>All</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nk-activity">
                    <li class="nk-activity-item">
                        <div class="nk-activity-media user-avatar bg-success"><img src="./images/avatar/c-sm.jpg" alt=""></div>
                        <div class="nk-activity-data">
                            <div class="label">Keith Jensen requested to Widthdrawl.</div>
                            <span class="time">2 hours ago</span>
                        </div>
                    </li>
                    <li class="nk-activity-item">
                        <div class="nk-activity-media user-avatar bg-warning">HS</div>
                        <div class="nk-activity-data">
                            <div class="label">Harry Simpson placed a Order.</div>
                            <span class="time">2 hours ago</span>
                        </div>
                    </li>
                    <li class="nk-activity-item">
                        <div class="nk-activity-media user-avatar bg-azure">SM</div>
                        <div class="nk-activity-data">
                            <div class="label">Stephanie Marshall got a huge bonus.</div>
                            <span class="time">2 hours ago</span>
                        </div>
                    </li>
                    <li class="nk-activity-item">
                        <div class="nk-activity-media user-avatar bg-purple"><img src="./images/avatar/d-sm.jpg" alt=""></div>
                        <div class="nk-activity-data">
                            <div class="label">Nicholas Carr deposited funds.</div>
                            <span class="time">2 hours ago</span>
                        </div>
                    </li>
                    <li class="nk-activity-item">
                        <div class="nk-activity-media user-avatar bg-pink">TM</div>
                        <div class="nk-activity-data">
                            <div class="label">Timothy Moreno placed a Order.</div>
                            <span class="time">2 hours ago</span>
                        </div>
                    </li>
                </ul>
            </div><!-- .card -->
        </div><!-- .col -->
        <div class="col-md-6 col-xxl-4">
            <div class="card card-bordered h-100">
                <div class="card-inner border-bottom">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h6 class="title">Notifications</h6>
                        </div>
                        <div class="card-tools">
                            <a href="#" class="link">View All</a>
                        </div>
                    </div>
                </div>
                <div class="card-inner">
                    <div class="timeline">
                        <h6 class="timeline-head">November, 2019</h6>
                        <ul class="timeline-list">
                            <li class="timeline-item">
                                <div class="timeline-status bg-primary is-outline"></div>
                                <div class="timeline-date">13 Nov <em class="icon ni ni-alarm-alt"></em></div>
                                <div class="timeline-data">
                                    <h6 class="timeline-title">Submited KYC Application</h6>
                                    <div class="timeline-des">
                                        <p>Re-submitted KYC Application form.</p>
                                        <span class="time">09:30am</span>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-status bg-primary"></div>
                                <div class="timeline-date">13 Nov <em class="icon ni ni-alarm-alt"></em></div>
                                <div class="timeline-data">
                                    <h6 class="timeline-title">Submited KYC Application</h6>
                                    <div class="timeline-des">
                                        <p>Re-submitted KYC Application form.</p>
                                        <span class="time">09:30am</span>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-status bg-pink"></div>
                                <div class="timeline-date">13 Nov <em class="icon ni ni-alarm-alt"></em></div>
                                <div class="timeline-data">
                                    <h6 class="timeline-title">Submited KYC Application</h6>
                                    <div class="timeline-des">
                                        <p>Re-submitted KYC Application form.</p>
                                        <span class="time">09:30am</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- .card -->
        </div><!-- .col -->
        <div class="col-xl-12 col-xxl-8">
            <div class="card card-bordered card-full">
                <div class="card-inner border-bottom">
                    <div class="card-title-group">
                        <div class="card-title">
                            <h6 class="title">Recent Investment</h6>
                        </div>
                        <div class="card-tools">
                            <a href="#" class="link">View All</a>
                        </div>
                    </div>
                </div>
                <div class="nk-tb-list">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span>Plan</span></div>
                        <div class="nk-tb-col tb-col-sm"><span>Who</span></div>
                        <div class="nk-tb-col tb-col-lg"><span>Date</span></div>
                        <div class="nk-tb-col"><span>Amount</span></div>
                        <div class="nk-tb-col tb-col-sm"><span>&nbsp;</span></div>
                        <div class="nk-tb-col"><span>&nbsp;</span></div>
                    </div>
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <div class="align-center">
                                <div class="user-avatar user-avatar-sm bg-light">
                                    <span>P1</span>
                                </div>
                                <span class="tb-sub ms-2">Silver <span class="d-none d-md-inline">- Daily 4.76% for 21 Days</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="user-card">
                                <div class="user-avatar user-avatar-xs bg-pink-dim">
                                    <span>JC</span>
                                </div>
                                <div class="user-name">
                                    <span class="tb-lead">Janice Carroll</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-lg">
                            <span class="tb-sub">18/10/2019</span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-sub tb-amount">1.094780 <span>BTC</span></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="progress progress-sm w-80px">
                                <div class="progress-bar" data-progress="75"></div>
                            </div>
                        </div>
                        <div class="nk-tb-col nk-tb-col-action">
                            <div class="dropdown">
                                <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                    <ul class="link-list-plain">
                                        <li><a href="#">View</a></li>
                                        <li><a href="#">Invoice</a></li>
                                        <li><a href="#">Print</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <div class="align-center">
                                <div class="user-avatar user-avatar-sm bg-light">
                                    <span>P2</span>
                                </div>
                                <span class="tb-sub ms-2">Dimond <span class="d-none d-md-inline">- Daily 8.52% for 14 Days</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="user-card">
                                <div class="user-avatar user-avatar-xs bg-azure-dim">
                                    <span>VA</span>
                                </div>
                                <div class="user-name">
                                    <span class="tb-lead">Victoria Aguilar</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-lg">
                            <span class="tb-sub">18/10/2019</span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-sub tb-amount">1.094780 <span>BTC</span></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <span class="tb-sub text-success">Completed</span>
                        </div>
                        <div class="nk-tb-col nk-tb-col-action">
                            <div class="dropdown">
                                <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                    <ul class="link-list-plain">
                                        <li><a href="#">View</a></li>
                                        <li><a href="#">Invoice</a></li>
                                        <li><a href="#">Print</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <div class="align-center">
                                <div class="user-avatar user-avatar-sm bg-light">
                                    <span>P3</span>
                                </div>
                                <span class="tb-sub ms-2">Platinam <span class="d-none d-md-inline">- Daily 14.82% for 7 Days</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="user-card">
                                <div class="user-avatar user-avatar-xs bg-purple-dim">
                                    <span>EH</span>
                                </div>
                                <div class="user-name">
                                    <span class="tb-lead">Emma Henry</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-lg">
                            <span class="tb-sub">18/10/2019</span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-sub tb-amount">1.094780 <span>BTC</span></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <span class="tb-sub text-success">Completed</span>
                        </div>
                        <div class="nk-tb-col nk-tb-col-action">
                            <div class="dropdown">
                                <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                    <ul class="link-list-plain">
                                        <li><a href="#">View</a></li>
                                        <li><a href="#">Invoice</a></li>
                                        <li><a href="#">Print</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <div class="align-center">
                                <div class="user-avatar user-avatar-sm bg-light">
                                    <span>P1</span>
                                </div>
                                <span class="tb-sub ms-2">Silver <span class="d-none d-md-inline">- Daily 4.76% for 21 Days</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="user-card">
                                <div class="user-avatar user-avatar-xs bg-teal-dim">
                                    <span>AF</span>
                                </div>
                                <div class="user-name">
                                    <span class="tb-lead">Alice Ford</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-lg">
                            <span class="tb-sub">18/10/2019</span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-sub tb-amount">1.094780 <span>BTC</span></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <span class="tb-sub text-success">Completed</span>
                        </div>
                        <div class="nk-tb-col nk-tb-col-action">
                            <div class="dropdown">
                                <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                    <ul class="link-list-plain">
                                        <li><a href="#">View</a></li>
                                        <li><a href="#">Invoice</a></li>
                                        <li><a href="#">Print</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <div class="align-center">
                                <div class="user-avatar user-avatar-sm bg-light">
                                    <span>P3</span>
                                </div>
                                <span class="tb-sub ms-2">Platinam <span class="d-none d-md-inline">- Daily 14.82% for 7 Days</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <div class="user-card">
                                <div class="user-avatar user-avatar-xs bg-orange-dim">
                                    <span>HW</span>
                                </div>
                                <div class="user-name">
                                    <span class="tb-lead">Harold Walker</span>
                                </div>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-lg">
                            <span class="tb-sub">18/10/2019</span>
                        </div>
                        <div class="nk-tb-col">
                            <span class="tb-sub tb-amount">1.094780 <span>BTC</span></span>
                        </div>
                        <div class="nk-tb-col tb-col-sm">
                            <span class="tb-sub text-success">Completed</span>
                        </div>
                        <div class="nk-tb-col nk-tb-col-action">
                            <div class="dropdown">
                                <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                    <ul class="link-list-plain">
                                        <li><a href="#">View</a></li>
                                        <li><a href="#">Invoice</a></li>
                                        <li><a href="#">Print</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .card -->
        </div><!-- .col -->
    </div>
</div>


