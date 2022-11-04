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
                $getUsers                   = $this->db->get();
                print_r($getUsers->result_array());
                foreach ($getUsers->result_array() as $userInfo) {
                    $userID                 = $userInfo['id']; 
                    $this->db->from('bf_users_wallet'); 
                    $getWallets     
                }

            ?>
		</div>
	</div>
</div>
