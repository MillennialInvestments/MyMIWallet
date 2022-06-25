<?php
// Config Settings
$communityTabs						= $this->config->item('communityTabs');
$exchangeTab						= $this->config->item('exchangeTab');
$marketMovers						= date("F-jS-Y");
$userType							= 'Premium';
$cuID 								= $_SESSION['allSessionData']['userAccount']['cuID'];
$cuRole 							= $_SESSION['allSessionData']['userAccount']['cuRole'];
$cuKYC   							= $_SESSION['allSessionData']['userAccount']['cuKYC'];
$cuEmail 							= $_SESSION['allSessionData']['userAccount']['cuEmail'];
$cuUsername 						= $_SESSION['allSessionData']['userAccount']['cuUsername'];
$cuDisplayName 						= $_SESSION['allSessionData']['userAccount']['cuDisplayName'];
$cuUserType							= $_SESSION['allSessionData']['userAccount']['cuUserType'];
$walletSum                          = $_SESSION['allSessionData']['myMIWalletSummary']['walletSum'];
if (!empty($_SESSION['allSessionData']['userAccount']['assetNetValue'])) {
    $walletAmount                   = $walletSum;
} else {
    $walletAmount					= $walletSum;
}
$walletGains						= $_SESSION['allSessionData']['userAccount']['walletGains'];
$MyMIGCoinSum			            = $_SESSION['allSessionData']['userGoldData']['coinSum'];
if (!empty($cuDisplayName)) {
    $initials						= $cuDisplayName[0] . $cuDisplayName[1];
} else {
    $initials						= 'Me';
}
?>
<?php
if ($this->agent->is_mobile()) {
    echo '<div class="nk-sidebar nk-sidebar-fixed collapse sidebar-offcanvas" id="collapseSidebar">';
} else {
    echo '<div class="nk-sidebar nk-sidebar-fixed" id="#collapseSidebar">';
}
?>
	<div class="nk-sidebar-element nk-sidebar-head">
		<div class="nk-sidebar-brand">
			<a href="<?php echo site_url('/Dashboard'); ?>" class="logo-link nk-sidebar-logo">
                <?php
                if ($this->agent->is_mobile()) {
                    echo '
					<img class="logo-light logo-img" src="' . base_url('assets/images/Millennial-Investments-179x54.png') . '" srcset="' . base_url('assets/images/Millennial-Investments-179x54.png') . '" alt="logo" />
					<img class="logo-dark logo-img" style="" src="' . base_url('assets/images/Millennial-Investments-179x54.png') . '" alt="logo" />
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
		<div class="nk-menu-trigger mr-n2">
			<a type="button" class="nk-nav-toggle nk-quick-nav-icon d-lg-none" data-toggle="collapse" href="#collapseSidebar" role="button" aria-expanded="false" aria-controls="collapseSidebar"><em class="icon ni ni-arrow-left"></em></a>
		</div>
	</div>
	<div class="nk-sidebar-element">
		<div class="nk-sidebar-body" data-simplebar>
			<div class="nk-sidebar-content">
				<div class="nk-sidebar-widget pt-1 d-none d-md-block">
					<div class="user-account-info between-center">
						<div class="user-account-main">
							<h6 class="overline-title-alt">Available Balance</h6>
							<div class="user-balance">
								<?php echo $walletAmount; ?> 
								<small class="currency currency-usd">USD</small>
							</div>
							<div class="user-balance-alt">
								<?php
                                //~ echo $walletGains . ' <span class="currency currency-usd">USD</span> (' . $walletPercentChange . ')';
                                // echo $walletGains . ' <span class="currency currency-usd">USD</span>';
                                echo $MyMIGCoinSum . ' <span class="currency currency-usd">MyMI Gold</span>';
                                ?>
							</div>

						</div>
<!--
						<a href="#" class="btn btn-icon" style="width: 1rem;"><i class="icon-chart"></i></a>
-->
					</div>
					<?php
                    /*
                    <div class="user-account-actions">
                        <ul class="g-3">
                            <li>
                                <a href="<?php echo site_url('/Add-Wallet-Deposit'); ?>" class="btn btn-lg btn-primary"><span>Add Deposit</span></a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('/Add-Wallet-Withdraw'); ?>" class="btn btn-lg btn-warning"><span>Add Withdraw</span></a>
                            </li>
                        </ul>
                    </div>
                    */
                    ?>
				</div>
				<?php // Mobile Sidebar?>
				<div class="nk-sidebar-widget nk-sidebar-widget-full d-block d-md-none pt-1">
                    <a class="nk-profile-toggle toggle-expand" data-target="sidebarProfile" href="#">
						<div class="user-card-wrap">
							<div class="user-card">
								
								<div class="user-avatar"><span><?php echo strtoupper($initials); ?></span></div>
								<div class="user-info"><span class="lead-text"><?php echo $cuDisplayName; ?></span><span class="sub-text"><?php echo $cuEmail; ?></span></div>
							</div>
						</div>
					</a>
					<div class="nk-profile-content" data-content="sidebarProfile">
						<div class="user-account-info between-center">
							<div class="user-account-main">
								<h6 class="overline-title-alt">Available Balance</h6>
								<div class="user-balance">
									<?php echo $walletAmount; ?>
									<small class="currency currency-usd">USD</small>
								</div>
								<div class="user-balance-alt">
									<?php
                                    //~ echo $walletGains . ' <span class="currency currency-usd">USD</span> (' . $walletPercentChange . ')';
                                    echo $walletGains . ' <span class="currency currency-usd">USD</span>';
                                    ?>
								</div>

							</div>
<!--
							<a href="#" class="btn btn-icon" style="width: 1rem;"><i class="icon-chart"></i></a>
-->
						</div>
					</div>
				</div>
				<div class="nk-sidebar-menu">
					<ul class="nk-menu">
						<li class="nk-menu-heading"><h6 class="overline-title">Account</h6></li>
						<li class="nk-menu-item">
							<a href="<?php echo site_url('/Dashboard'); ?>" class="nk-menu-link">
								<span class="nk-menu-icon"><em class="icon ni ni-home"></em></span><span class="nk-menu-text">Dashboard</span>
							</a>
						</li>
						<?php
                        if ($exchangeTab === 1) {
                            ?> 									 
						<li class="nk-menu-item">
							<a href="<?php echo site_url('/Exchange'); ?>" class="nk-menu-link">
								<span class="nk-menu-icon"><em class="icon ni ni-coins"></em></i></span><span class="nk-menu-text">MyMI Exchange</span>
							</a>
						</li>
						<?php
                        }
                        ?>
						<li class="nk-menu-item">
							<a href="<?php echo site_url('/Assets'); ?>" class="nk-menu-link">
								<span class="nk-menu-icon"><em class="icon ni ni-growth"></em></span><span class="nk-menu-text">My Assets</span>
							</a>
						</li> 
                        <li class="nk-menu-item">
							<a href="<?php echo site_url('/Wallets'); ?>" class="nk-menu-link">
								<span class="nk-menu-icon"><em class="icon ni ni-wallet"></em></span><span class="nk-menu-text">My Wallets</span>
							</a>
						</li> 
						<li class="nk-menu-item">
							<a href="<?php echo site_url('/Trade-Tracker'); ?>" class="nk-menu-link">
								<span class="nk-menu-icon"><i class="icon-graph menu-icon"></i></span><span class="nk-menu-text">Trade Tracker</span>
							</a>
						</li> 
					</ul>
				</div>
				<?php
                if ($cuRole === '1') {
                    ?>
				<div class="nk-sidebar-menu pt-0">
					<ul class="nk-menu">
						<li class="nk-menu-heading"><h6 class="overline-title">Manage</h6></li>
						<li class="nk-menu-item">
							<a class="nk-menu-link postAnnouncementBtn" data-toggle="modal" data-target="#transactionModal">
							<span class="nk-menu-icon"><em class="icon ni ni-notice"></em></span><span class="nk-menu-text">Announcements</span>
							</a>
						</li>      
						<?php
                        if ($cuKYC === 'Yes') {
                            ?>    
						<li class="nk-menu-item">
							<a href="<?php echo site_url('/Exchange'); ?>" class="nk-menu-link">
								<span class="nk-menu-icon"><em class="icon ni ni-coins"></em></i></span><span class="nk-menu-text">MyMI Exchange</span>
							</a>
						</li>
						<?php
                        } elseif ($cuKYC === 'No') {
                            ?>    
						<li class="nk-menu-item">
							<a href="<?php echo site_url('/Exchange/Personal-Information/' . $cuID); ?>" class="nk-menu-link">
								<span class="nk-menu-icon"><em class="icon ni ni-coins"></em></i></span><span class="nk-menu-text">MyMI Exchange</span>
							</a>
						</li>
						<?php
                        } ?>
						<li class="nk-menu-item">
							<a href="<?php echo site_url('Exchange-Management'); ?>" class="nk-menu-link">
							<span class="nk-menu-icon"><em class="icon ni ni-sign-usd"></em></span><span class="nk-menu-text">Exchange</span>
							</a>
						</li><li class="nk-menu-item">
							<a href="<?php echo site_url('Investment-Management'); ?>" class="nk-menu-link">
							<span class="nk-menu-icon"><em class="icon ni ni-sign-usd"></em></span><span class="nk-menu-text">Investments</span>
							</a>
						</li>
						<li class="nk-menu-item">
							<a href="<?php echo site_url('Users'); ?>" class="nk-menu-link">
							<span class="nk-menu-icon"><em class="icon ni ni-users"></em></span><span class="nk-menu-text">Users</span>
							</a>
						</li>
					</ul>
				</div>
				<?php
                }
                ?>
				<?php
                if ($communityTabs === 1) {
                    ?>
				<div class="nk-sidebar-menu pt-0">
					<ul class="nk-menu">
						<li class="nk-menu-heading"><h6 class="overline-title">Community</h6></li>
						<li class="nk-menu-item" style="font-size:0.8rem">
							<a href="<?php echo site_url('/Announcements'); ?>" class="nk-menu-link">
							<span class="nk-menu-icon"><em class="icon ni ni-chat-fill"></em></span><span class="nk-menu-text">Announcements</span>
							</a>
						</li>
						<li class="nk-menu-item" style="font-size:0.8rem">
							<a href="https://discord.gg/BsDUjDHqrz" class="nk-menu-link">
							<span class="nk-menu-icon mbr-iconfont socicon-discord socicon"></span><span class="nk-menu-text">Discord</span>
							</a>
						</li>
						<li class="nk-menu-item" style="font-size:0.8rem">
							<a href="https://www.youtube.com/channel/UCtWWy71LQpea_tHkb7fIL7A" class="nk-menu-link">
								<span class="nk-menu-icon mbr-iconfont socicon-youtube socicon"></span><span class="nk-menu-text">Youtube</span>
							</a>
						</li>
						<li class="nk-menu-item" style="font-size:0.8rem">
							<a href="https://www.facebook.com/MyMillennialInvestments/" class="nk-menu-link">
								<span class="nk-menu-icon mbr-iconfont socicon-facebook socicon"></span><span class="nk-menu-text">Facebook</span>
							</a>
						</li>
						<li class="nk-menu-item" style="font-size:0.8rem">
							<a href="https://twitter.com/MyMillennialPro" class="nk-menu-link">
								<span class="nk-menu-icon mbr-iconfont socicon-twitter socicon"></span><span class="nk-menu-text">Twitter</span>
							</a>
						</li>
					</ul>
				</div>
				<?php
                }
                ?>
				<div class="nk-sidebar-footer">
					<ul class="nk-menu nk-menu-footer">
						<li class="nk-menu-item">
							<a href="<?php echo site_url('Support'); ?>" class="nk-menu-link">
								<span class="nk-menu-icon"><i class="icon-support"></i></span><span class="nk-menu-text">Support</span>
							</a>
						</li>
						 
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
