<?php
// require_once 'vendor/autoload.php';
$testPage						= $this->config->item('test_view_page');
$cuID 							= $_SESSION['allSessionData']['userAccount']['cuID'];
$testInfo						= array(
    'cuID'						=> $cuID,
);
?>   
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-lg-12 col-xl-12">
			<div class="nk-block">
				<div class="nk-block-head-xs">
					<div class="nk-block-head-content">
						<h1 class="nk-block-title title">Web Development - Content Creator</h1>
						<p id="private_key"></p>
						<p id="address"></p>
						<!-- <a href="<?php //echo site_url('/Trade-Tracker'); ?>">Test Page Environment</a>							 -->
					</div>
				</div>
			</div>
			<!-- <div class="nk-block">
                <div class="card card-bordered">
                    <div class="card-body">

                    </div>
                </div>
			</div>     -->
            <?php 
            // use MichaelDrennen\TDAmeritradeAPI\TDAmeritradeAPI;
            // $tdaClient              = new TDAmeritradeAPI(); 
            // // $tdaClient->login();
			// print_r($tdaClient);   
            use MichaelDrennen\TDAmeritradeAPI\Authenticator;
            $callbackURL                = 'https%3A%2F%2Fwww.mymiwallet.com%2Fpublic%2Findex.php%2FWallets%2FLink-Account%2F1';
            $oauthConsumerKey           = 'XGCE3NA1BXIGQG2NHDTLHZ6OUSIZTITF%40AMER.OAUTHAP';
            $tdaAuthenticator           = new Authenticator($callbackURL, $oauthConsumerKey); 
            $tdaAuthenticate            = $tdaAuthenticator->authenticate($callbackURL, $oauthConsumerKey); 
            // $tdaAuthenticator->authenticate($callbackURL,$oauthConsumerKey,$debug = FALSE);
			print_r($tdaAuthenticator); 
            echo '<br><br>';
			print_r($tdaAuthenticate); 
            ?>
		</div>
	</div>
</div>
