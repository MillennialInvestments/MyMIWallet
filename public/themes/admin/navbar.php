<?php
<<<<<<< HEAD
$userAccount            = $_SESSION['allSessionData']['userAccount'];
$MyMICoinData           = $_SESSION['allSessionData']['MyMICoinData'];
$userCoinData           = $_SESSION['allSessionData']['userCoinData'];
$userGoldData           = $_SESSION['allSessionData']['userGoldData'];
$cuID					= $userAccount['cuID'];
$cuRole                 = $userAccount['cuRole'];
$cuEmail				= $userAccount['cuEmail'];
$cuDisplayName			= $userAccount['cuDisplayName'];
$cuUserType				= $userAccount['cuUserType'];
$walletAmount			= $userAccount['walletAmount'];
$MyMICCurrentValue		= $MyMICoinData['current_value'];
$MyMICCoinSum			= $MyMICoinData['current_value'] / $MyMICoinData['mymic_coin_value'];
$MyMIGCurrentValue		= $userGoldData['totalValue'];
$MyMIGCoinSum			= $userGoldData['coinSum'];
$myMIGPerChange			= $userGoldData['myMIGPerChange'];

// New Configuration for User Coin Data
if ($userCoinData['totalValue'] > 0) {
    $totalMyMICValue    = '$' . number_format($userCoinData['totalValue'],2);
} elseif ($userCoinData['totalValue'] < 0) {
    $totalMyMICValue    = '-$' . number_format($userCoinData['totalValue'],2); 
} else {
    $totalMyMICValue    = '$0.00';
}
if ($userGoldData['totalValue'] > 0) {
    $totalMyMIGValue    = '$' . number_format($userGoldData['totalValue'],2);
} elseif ($userGoldData['totalValue'] < 0) {
    $totalMyMIGValue    = '-$' . number_format($userGoldData['totalValue'],2); 
} else {
    $totalMyMIGValue    = '$0.00';
}
$totalMyMICCoinSum      = number_format($userCoinData['coinSum'],0);
?>
<style>
    @media (max-width: 420px) {
        #navbar-account-balance-dropdown {
            left: -17.5rem !important;
        }
        #navbar-user-profile-dropdown {
            left: -17.5rem !important;
        }
        #collapseSidebar {
            left: 17.5rem !important;
        }
        #close-sidebar-nav-arrow {
            margin-left: -3rem;
        }
    }
    @media (min-width: 956px) {
        #navbar-user-profile-dropdown {
            left: -10rem !important;
        }
    }
    .my-dropdown-menu {
        position: absolute;
        transform: none;
        top: 20px;
        left: -160px;
        will-change: transform;
    }
</style>
<div class="nk-header nk-header-fluid nk-header-fixed is-light">
	<div class="container-fluid full-width pl-1 pl-lg-5">
		<div class="nk-header-wrap pr-2 pr-lg-1">
=======
$cuID					= $_SESSION['allSessionData']['userAccount']['cuID'];
$cuEmail				= $_SESSION['allSessionData']['userAccount']['cuEmail'];
$cuDisplayName			= $_SESSION['allSessionData']['userAccount']['cuDisplayName'];
$cuUserType				= $_SESSION['allSessionData']['userAccount']['cuUserType'];
$walletAmount			= $_SESSION['allSessionData']['userAccount']['walletAmount'];
$MyMICCurrentValue		= $_SESSION['allSessionData']['MyMICoinData']['current_value'];
$MyMICCoinSum			= $_SESSION['allSessionData']['MyMICoinData']['current_value'] / $_SESSION['allSessionData']['MyMICoinData']['mymic_coin_value'];
$MyMIGCurrentValue		= $_SESSION['allSessionData']['userGoldData']['totalValue'];
$MyMIGCoinSum			= $_SESSION['allSessionData']['userGoldData']['coinSum'];
$totalValue				= $_SESSION['allSessionData']['userGoldData']['totalValue'];
$myMIGPerChange			= $_SESSION['allSessionData']['userGoldData']['myMIGPerChange'];
?>
<div class="nk-header nk-header-fluid nk-header-fixed is-light">
	<div class="container-fluid full-width pl-5">
		<div class="nk-header-wrap">
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
			<div class="nk-menu-trigger d-xl-none ml-n1">
				<a type="button" class="nk-nav-toggle nk-quick-nav-icon" data-toggle="collapse" href="#collapseSidebar" role="button" aria-expanded="false" aria-controls="collapseSidebar"><em class="icon ni ni-menu"></em></a>
			</div>
			<div class="nk-header-brand d-xl-none">
				<a href="<?php echo site_url('/Dashboard'); ?>" class="logo-link">
					<?php
                    if ($this->agent->is_mobile()) {
                        echo '
						<img class="logo-light logo-img d-lg-block" src="' . base_url('assets/images/Millennial-Investments-The-Best-In-Investments-Logo-Only-White-BG.png') . '" srcset="' . base_url('assets/images/Millennial-Investments-The-Best-In-Investments-Logo-Only-White-BG.png') . '" alt="logo" />
						<img class="logo-dark logo-img d-lg-block" src="' . base_url('assets/images/Millennial-Investments-The-Best-In-Investments-Logo-Only-White-BG.png') . '" srcset="' . base_url('assets/images/Millennial-Investments-The-Best-In-Investments-Logo-Only-White-BG.png') . '" alt="logo" />
						';
                    } else {
                        echo '
						<img class="logo-light logo-img d-lg-block" src="' . base_url('assets/images/Millennial-Investments.png') . '" srcset="' . base_url('assets/images/Millennial-Investments-213x70.png') . '" alt="logo" />
						<img class="logo-dark logo-img d-lg-block" src="' . base_url('assets/images/Millennial-Investments.png') . '" srcset="' . base_url('assets/images/Millennial-Investments-213x70.png') . '" alt="logo" />
						';
                    }
                    ?>
				</a>
			</div>
<<<<<<< HEAD
			<!-- <div class="nk-header-news d-none d-xl-block">
				<div class="nk-news-list">
					<a class="nk-news-item" href="https://www.youtube.com/channel/UCtWWy71LQpea_tHkb7fIL7A" target="_blank">
						<div class="nk-news-icon"><em class="icon ni ni-youtube"></em></div>
						<div class="nk-news-text full-width">
							!-- <p>Sucribe to our Youtube Channel for more videos &amp; Tutorials! <span>Subscribe Now!</span></p> --
							<p class="full-width">Subcribe To Our Youtube Channel</p>
=======
			<div class="nk-header-news d-none d-xl-block">
				<div class="nk-news-list">
					<a class="nk-news-item" href="https://www.youtube.com/channel/UCtWWy71LQpea_tHkb7fIL7A" target="_blank">
						<div class="nk-news-icon"><em class="icon ni ni-card-view"></em></div>
						<div class="nk-news-text">
							<p>Sucribe to our Youtube Channel for more videos &amp; Tutorials! <span>Subscribe Now!</span></p>
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
							<em class="icon ni ni-external"></em>
						</div>
					</a>
				</div>
<<<<<<< HEAD
			</div> -->
			<div class="nk-header-news d-none d-xl-block" style="width: 25%;">
				<div class="nk-news-list">
					<a class="nk-news-item" href="<?php echo site_url('/Support/Feedback'); ?>" target="_blank">
						<div class="nk-news-icon"><em class="icon ni ni-youtube"></em></div>
						<div class="nk-news-text full-width">
							<p class="full-width" style="text-overflow:inherit; overflow:visible;">Subcribe to our Youtube Channel for more videos &amp; Tutorials! <span>Give Feedback!</span></p>
							<!-- <p class="full-width" style="text-overflow:inherit; overflow:visible;">Your Feedback Is Important!</p> -->
                            <!-- <btn class="btn btn-primary btn-block btn-xs mx-3">Submit Feedback!</btn> -->
							<!-- <em class="icon ni ni-external"></em> -->
						</div>
					</a>
				</div>
			</div>
			<div class="nk-header-tools">
				<ul class="nk-quick-nav">
                    <?php
                    if ($cuRole === '1') {
                    ?>
                    <li class="d-none d-sm-block">
                        <a class="btn btn-primary text-white" data-toggle="modal" data-target="#userInfoModal">User Data</a>
                    </li>
                    <?php    
                    } elseif ($cuRole === '4') {
                    ?>
                    <li class="d-none d-sm-block">
                        <a class="btn btn-primary text-white" data-toggle="modal" data-target="#userFeedbackModal">Feedback?</a>
                    </li>
                    <?php     
                    }
                    ?>
=======
			</div>
			<div class="nk-header-tools">
				<ul class="nk-quick-nav">
                    <li class="d-none d-sm-block">
                        <a class="btn btn-primary text-white" data-toggle="modal" data-target="#userInfoModal">User Data</a>
                    </li>
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
					<li class="dropdown user-dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<div class="user-toggle">
								<div class="user-avatar sm"><em class="icon ni ni-coins"></em></div>
								<div class="user-info d-none d-md-block">
									<div class="user-status">Current MyMI Balance:</div>
									<div class="user-name dropdown-indicator"><?= number_format($MyMIGCoinSum, 0); ?> MyMI Gold</div>
								</div>
							</div>
						</a>   
<<<<<<< HEAD
						<div class="dropdown-menu dropdown-menu-md dropdown-menu-left dropdown-menu-s1" id="navbar-account-balance-dropdown">    
=======
						<div class="dropdown-menu dropdown-menu-md dropdown-menu-left dropdown-menu-s1">    
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
							<div class="dropdown-inner user-account-info">
								<h6 class="overline-title-alt">MyMI Coin Balance</h6>
								<div class="user-balance" style="font-weight:bold;">
									<?php
<<<<<<< HEAD
                                    echo $totalMyMICValue;
=======
                                    echo '$' . number_format($MyMICCurrentValue, 2);
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                                    ?> 
									<small class="currency currency-usd">USD</small>
								</div>
								<div class="user-balance-sub">
<<<<<<< HEAD
									Total Coins <span><?php echo $totalMyMICCoinSum; ?> <span class="currency currency-btc">MyMI Coin</span></span>
=======
									Total Coins <span><?php echo $MyMICCoinSum; ?> <span class="currency currency-btc">MyMI Coins</span></span>
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
								</div>
<!--
								<a href="#" class="link"><span>Withdraw Funds</span> <em class="icon ni ni-wallet-out"></em></a>
-->
							</div>     
							<div class="dropdown-inner">
								<ul class="link-list">
									<li>
										<a href="<?php echo site_url('/Exchange/Market/USD/MYMI'); ?>"><em class="icon ni ni-wallet-out"></em><span>Buy/Sell Coins</span></a>
									</li>
								</ul>
							</div>
							<div class="dropdown-inner user-account-info">
								<h6 class="overline-title-alt">MyMI Gold Balance</h6>
								<div class="user-balance" style="font-weight:bold;">
									<?php
<<<<<<< HEAD
                                    echo $totalMyMIGValue;
=======
                                    echo $MyMIGCurrentValue;
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                                    ?> 
									<small class="currency currency-usd">USD</small>
								</div>
								<div class="user-balance-sub">
									Total Coins <span><?php echo number_format($MyMIGCoinSum, 0); ?> <span class="currency currency-btc">MyMI Gold</span></span>
								</div>
<!--
								<a href="#" class="link"><span>Withdraw Funds</span> <em class="icon ni ni-wallet-out"></em></a>
-->
							</div>
							<div class="dropdown-inner">
								<ul class="link-list">
									<li>
<<<<<<< HEAD
										<a href="" class="purMyMIGold" data-toggle="modal" data-target="#transactionModal" title="Purchase MyMI Gold"><em class="icon ni ni-wallet-in"></em><span>Purchase Gold</span></a>
									</li> 
									<li>
										<a href="<?php echo site_url('/Exchange/Market/MYMIG/MYMI'); ?>"><em class="icon ni ni-wallet-out"></em><span>Transfer Gold</span></a>
=======
										<a href="" class="purMyMIGold" data-toggle="modal" data-target="#transactionModal" title="Purchase MyMI Gold"><em class="icon ni ni-wallet-in"></em><span>Purchase Coins</span></a>
									</li> 
									<li>
										<a href="<?php echo site_url('/Exchange/Market/MYMIG/MYMI'); ?>"><em class="icon ni ni-wallet-out"></em><span>Transfer Coins</span></a>
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
									</li>
								</ul>
							</div>
						</div>
					</li>
					<li class="dropdown user-dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<div class="user-toggle">
								<div class="user-avatar sm"><em class="icon ni ni-user-alt"></em></div>
								<div class="user-info d-none d-md-block">
									<div class="user-status user-status-verified"><?php echo $cuUserType; ?></div>
									<div class="user-name dropdown-indicator"><?php echo $cuDisplayName; ?></div>
								</div>
							</div>
						</a>
<<<<<<< HEAD
						<div class="dropdown-menu dropdown-menu-md dropdown-menu-left dropdown-menu-s1" id="navbar-user-profile-dropdown">
							<div class="dropdown-inner user-card-wrap bg-white d-none d-md-block">
=======
						<div class="dropdown-menu dropdown-menu-md dropdown-menu-left dropdown-menu-s1" id="user-profile-dropdown">
							<div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
								<div class="user-card">
									<div class="user-avatar"><span><i class="icon-user"></i></span></div>
									<div class="user-info"><span class="lead-text"><?php echo $cuDisplayName; ?></span><span class="sub-text"><?php echo $cuEmail; ?></span></div>
								</div>
							</div>
							<div class="dropdown-inner user-account-info">
								<h6 class="overline-title-alt">All Accounts</h6>
								<div class="user-balance">
									<?php echo number_format($walletAmount, 2); ?> 
									<small class="currency currency-usd">USD</small>
								</div>
								<div class="user-balance-sub">
<!--
									Locked <span>0.344939 <span class="currency currency-btc">BTC</span></span>
-->
								</div>
<!--
								<a href="#" class="link"><span>Withdraw Funds</span> <em class="icon ni ni-wallet-out"></em></a>
-->
							</div>
							<div class="dropdown-inner">
								<ul class="link-list">
									<?php
                                    /*<li>
                                        <a href="<?php echo site_url('/Profile/' . $cuID); ?>"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a>
                                    </li>*/
                                    ?>
									<li>
										<a href="<?php echo site_url('/Investor-Profile'); ?>"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a>
									</li>
								</ul>
							</div>
							<div class="dropdown-inner">
								<ul class="link-list">
									<li>
										<a href="<?php echo site_url('/logout'); ?>"><em class="icon ni ni-signout"></em><span>Sign out</span></a>
									</li>
								</ul>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
