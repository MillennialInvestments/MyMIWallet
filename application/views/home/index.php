<?php
$currentUserID 			= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$currentUserRoleID 		= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
$beta                   = $this->config->item('beta'); 
if ($beta === 0) {
    $registrationURL    = site_url('/Free/register'); 
} elseif ($beta === 1) {
    $registrationURL    = site_url('/Beta/register'); 
}
?>
<style>
.btn-white:hover, .btn-white:focus {color: white !important;}
</style>
<section class="header2 cid-s0IC7u5tND mbr-fullscreen mbr-parallax-background" id="extHeader5-2">
    <div class="mbr-overlay" style="opacity: 0.6; background-color: rgb(0, 0, 0);"></div>
    <div class="container">
        <div class="row">
            <div class="mbr-white col-md-12">
                <?php
                if ($this->agent->is_mobile()) {
                    echo ' 
					<h1 class="mbr-section-title mbr-bold typed-text pb-3 text-center display-2">
						<span class="mbr-section-subtitle mbr-fonts-style mbr-white display-2">Track</span><br>
						<span>
						  <span class="animated-element mbr-bold" data-word1="Your Trading Accounts" data-word2="Your Daily Trades" data-word3="Your Due Diligence" data-speed="60">
						  </span>
						</span>
					</h1>
					';
                } else {
                    echo '
					<h1 class="mbr-section-title mbr-bold typed-text pb-3 display-1">
						<span class="mbr-section-subtitle mbr-fonts-style mbr-white display-1">Track</span>
						<span>
						  <span class="animated-element mbr-bold" data-word1="Your Trading Accounts" data-word2="Your Daily Trades" data-word3="Your Due Diligence" data-speed="60">
						  </span>
						</span>
					</h1>
					';
                }
                ?>
                
                <p class="mbr-section-text mbr-fonts-style display-7">
                    Gain access to our Investment Accounting Software and Trade Tracking System in order to keep track of your multiple brokerages accounts and the trades you conduct throughout your brokerages including Stocks and Cryptos.
                    <br>
                    <br>
                    Discover your True Net Worth with the MyMI Investment Platform today!
                    Get Started Below!
                </p>
				<?php
                if ($this->session->userdata('logged_in')) {
                    echo '
					<div class="pt-3 mbr-section-btn">
						<a class="btn btn-md btn-white display-4" type="submit" href="' . site_url('/Trade-Tracker/Search') . '">SEARCH STOCKS/ETFs</a>
						<a class="btn btn-md btn-secondary display-4" type="submit" href="' . site_url('/Dashboard') . '">MY DASHBOARD</a>
					</div>
					';
                } else {
                    echo '
					<div class="pt-3 mbr-section-btn">
						<a class="btn btn-md btn-white display-4" type="submit" href="' . site_url('/login') . '">LOG IN</a>
						<a class="btn btn-md btn-secondary display-4" type="submit" href="' . $registrationURL . '">CREATE ACCOUNT</a>
					</div>
					';
                }
                ?>
            </div>
        </div>
    </div>
</section>
<section class="features12 cid-s8fK53A7uA" id="features012-19">
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-12 col-md-12 col-lg-6">
                <div class="card-wrapper">
                    <div class="card-box align-left">
                        <h4 class="card-title align-left mbr-semibold pb-3 mbr-black mbr-fonts-style display-1">
                            <strong>What Are MyMI Wallets?</strong></h4>
                        <p class="mbr-text pb-3 mbr-regular mbr-black mbr-fonts-style display-7">MyMI Wallets provide an Investment Accounting System to track your financial growth over multiple brokerage accounts.</p>
                        <div class="link-wrap">
                            <h5 class="link mbr-bold mbr-black mbr-fonts-style display-7"><a href="#">Become a Member</a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6">
                <div class="item mbr-flex">
                    <div class="icon-box">
                        <span class="mbr-iconfont mbri-users"></span>
                    </div>
                    <div class="text-box">
                        <h4 class="icon-title mbr-semibold mbr-black mbr-fonts-style display-7"><strong>Track Multiple Brokerage Accounts</strong></h4>
                        <h5 class="icon-text mbr-black mbr-fonts-style display-4">All-in-one ability to track one or multiple brokerage and summarize your Total Financial Growth</h5>
                    </div>
                </div>	
                <div class="item mbr-flex">
                    <div class="icon-box">
                        <span class="mbr-iconfont icon54-v1-increasing-chart2"></span>
                    </div>
                    <div class="text-box">
                        <h4 class="icon-title mbr-semibold mbr-black mbr-fonts-style display-7"><strong>Auto-Log Your Trades</strong></h4>
                        <h5 class="icon-text mbr-black mbr-fonts-style display-4">Utilize our Trade Tracker to auto-log your trades with our API Integrations</h5>
                    </div>
                </div>
                <div class="item mbr-flex">
                    <div class="icon-box">
                        <span class="mbr-iconfont mbri-cash"></span>
                    </div>
                    <div class="text-box">
                        <h4 class="icon-title mbr-semibold mbr-black mbr-fonts-style display-7"><strong>Collect Your Due Diligence</strong></h4>
                        <h5 class="icon-text mbr-black mbr-fonts-style display-4">Our Due Diligence Database allows you to collect your Due Diligence and share with the MyMI Community</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="extProgressBars cid-s8gcO65Ei9" id="extProgressBars8-1j">
    <div class="main container">
        <div class="row">
            <div class="first-col col-lg-4">
				<div class="row justify-content-center">
					<div class="card p-3 align-center col-12">           
						<h1 class="mbr-section-title mbr-fonts-style mbr-bold align-left display-5 pt-5 mb-0">MyMI Statistics</h1>
					</div>
				</div>
            </div>
            <div class="second-col col-12 col-lg-8">
             <!--  pt-5 mt-2 -->
                <div class="row justify-content-center">
					<?php
                    //
                    $getAllWalletsCount				= $this->public_model->get_all_wallets_count();
                    $walletCount					= $getAllWalletsCount->num_rows();
                    //
                    $getAllTradesCount				= $this->public_model->get_all_trades_count();
                    $tradeCount						= $getAllTradesCount->num_rows();
                    //
                    $getAllGoldCount				= $this->public_model->get_all_gold_count();
                    foreach ($getAllGoldCount->result_array() as $goldCount) {
                        $goldCountTotal				= $goldCount['total'];
                        $goldCountSum				= number_format($goldCount['total'], 0);
                    }
                    ?>
					
					<div class="card p-3 align-center col-12 col-md-4">
						<div class="panel-item">
							<div class="icon-wrap " mbr-if="showIcons">
								<span mbr-icon class="mbri-search mbr-iconfont"></span>
							</div>
							<div class="card-text">
								<h3 class="count pt-3 mbr-fonts-style mbr-white display-5">
									<?php echo $walletCount; ?>
								</h3>
								<h4 class="card panel-item card-text mbr-content-title mbr-fonts-style display-4">
									Wallets
								</h4>
							</div>
						</div>
					</div>
					<div class="card p-3 align-center col-12 col-md-4">
						<div class="panel-item">
							<div class="icon-wrap " mbr-if="showIcons">
								<span mbr-icon class="mbri-search mbr-iconfont"></span>
							</div>
							<div class="card-text">
								<h3 class="count pt-3 mbr-fonts-style mbr-white display-5">
									<?php echo $tradeCount; ?>
								</h3>
								<h4 class="card panel-item card-text mbr-content-title mbr-fonts-style display-4">
									Trades
								</h4>
							</div>
						</div>
					</div>
					<div class="card p-3 align-center col-12 col-md-4">
						<div class="panel-item">
							<div class="icon-wrap">
								<span mbr-icon class="mbri-search mbr-iconfont"></span>
							</div>
							<div class="card-text">
								<h3 class="count pt-3 mbr-fonts-style mbr-white display-5">
									<?php echo $goldCountSum; ?>
								</h3>
								<h4 class="card panel-item card-text mbr-content-title mbr-fonts-style display-4">
									MyMI Coins
								</h4>
							</div>
						</div>
					</div>
                </div>
            </div>         
        </div>
    </div>    
</section>
<section class="info3 cid-s8g4Kg25eI" id="info03-1f">
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-12 col-md-12 col-lg-7">
                <div class="card-wrapper">
                    <div class="card-box align-center">
                        <h4 class="card-title align-center mbr-semibold pb-3 mbr-black mbr-fonts-style display-1"><strong>How It Works</strong></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="extFeatures cid-s8fMu0noUh" id="extFeatures11-1c">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="card p-3 col-12 col-md-6 col-lg-4">
                <div class="card-wrapper card1 align-left">
                    <div class="card-ico pb-4">
                        <span class="mbr-iconfont card-icon mdi-social-notifications-on"></span>
                    </div>
                    <div class="card-box">
                        <h4 class="card-title mbr-white mbr-fonts-style display-7">Register Your Account</h4>
                        <div class="line-wrap">
                            <div class="line"></div>
                        </div>
                        <p class="mbr-text mbr-white mbr-fonts-style display-4">
                            Register an Investor/Trader Account to access Free and Premium Tools to start accounting for your Financial Growth.</p>
                        <div class="card-link pt-2">
                            <a href="<?php echo $registrationURL; ?>"><span class="mbr-iconfont link-ico mobi-mbri-arrow-next mobi-mbri"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-3 col-12 col-md-6 col-lg-4">
                <div class="card-wrapper card2 align-left">
                    <div class="card-ico pb-4 align-left">
                        <span class="mbr-iconfont card-icon mbri-help"></span>
                    </div>
                    <div class="card-box">
                        <h4 class="card-title mbr-white mbr-fonts-style display-7">Purchase MyMI Gold</h4>
                        <div class="line-wrap">
                            <div class="line"></div>
                        </div>
                        <p class="mbr-text mbr-white mbr-fonts-style display-4">Purchase MyMI Gold to access even more Premium Features to improve your ability to track your Financial Growth.<br></p>
                        <div class="card-link pt-2">
                            <a href="<?php echo site_url('How-It-Works/MyMI-Gold'); ?>"><span class="mbr-iconfont link-ico mobi-mbri-arrow-next mobi-mbri"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-3 col-12 col-md-6 col-lg-4">
                <div class="card-wrapper card3 align-left">
                    <div class="card-ico pb-4 align-left">
                        <span class="mbr-iconfont card-icon mbri-cash"></span>
                    </div>
                    <div class="card-box">
                        <h4 class="card-title mbr-white mbr-fonts-style display-7">Utilize Premium Features</h4>
                        <div class="line-wrap">
                            <div class="line"></div>
                        </div>
                        <p class="mbr-text mbr-white mbr-fonts-style display-4">
							Our Premium Features include access to Additional Wallets, Brokerage API Integrations, and our Due Diligence Database.
                        </p>
                        <div class="card-link pt-2">
                            <a href="<?php echo site_url('Premium-Features'); ?>"><span class="mbr-iconfont link-ico mobi-mbri-arrow-next mobi-mbri"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

