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
                $this->db->from('bf_users'); 
                $getUsers                               = $this->db->get();
                print_r($getUsers->result_array());
                foreach ($getUsers->result_array() as $userInfo) {
                    $userID                             = $userInfo['id']; 
                    $this->db->from('bf_users_wallet'); 
                    $getWallets                         = $this->db->get(); 
                    if (!empty($getWallets)) {
                        print_r($getWallets); 
                    } else {       
                        $active				            = 'Yes';
                        $beta                           = 'Yes'; 
                        $default_wallet		            = 'Yes';
                        $exchange_wallet	            = 'Yes';
                        $market_pair		            = 'USD';
                        $market				            = 'MYMI';
                        $user_id                        = $userInfo['id'];
                        $username                       = $userInfo['username'];
                        $email                          = $userInfo['email']; 
                        $broker				            = 'Default';
                        $nickname			            = 'MyMI Funds';
                        $wallet_type		            = 'Fiat';
                        $amount				            = '0.00';

                        $newWalletData                  = array(
                            'active'                    => $active,
                            'beta'                      => $beta,
                            'default_wallet'            => $default_wallet,
                            'exchange_wallet'           => $exchange_wallet,
                            'market_pair'               => $market_pair,
                            'market'                    => $market,
                            'user_id'                   => $user_id,
                            'username'                  => $username,
                            'email'                     => $email,
                            'broker'                    => $broker,
                            'nickname'                  => $nickname,
                            'wallet_type'                => $wallet_type,
                            'amount'                    => $amount,
                            'active'                    => $active,
                            'active'                    => $active,
                            'active'                    => $active,
                            'active'                    => $active,
                        );          
                    }
                }

            ?>
		</div>
	</div>
</div>
