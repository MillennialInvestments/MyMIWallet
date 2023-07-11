<?php
// require_once 'vendor/autoload.php';
<<<<<<< HEAD
$testPage = $this->config->item('test_view_page');
$cuID = $_SESSION['allSessionData']['userAccount']['cuID'];
$cuEmail = $_SESSION['allSessionData']['userAccount']['cuEmail'];
$testInfo = array(
    'cuID' => $cuID,
);
?> 
=======
$testPage						= $this->config->item('test_view_page');
$cuID 							= $_SESSION['allSessionData']['userAccount']['cuID'];
$testInfo						= array(
    'cuID'						=> $cuID,
);
?>   
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-lg-12 col-xl-12">
			<div class="nk-block">
				<div class="nk-block-head-xs">
					<div class="nk-block-head-content">
						<h1 class="nk-block-title title">Web Development - Content Creator</h1>
<<<<<<< HEAD
                        <br>
                        <br>
                        <br>
                        <?php //$this->load->view('Management/Web_Design/Content_Creator/Components/Pass_Data_To_Modal'); ?>
                    </div>
				</div>
			</div>
        </div>
        <div class="col-12">
            <?php //$this->load->view('Management/Wallets/Generate_Wallets'); ?>
            <?php //$this->load->view('Management/Web_Design/Content_Creator/Management/Wallets/Generate_Wallet'); ?>
            <?php //$this->load->view('Management/Web_Design/Content_Creator/Plaid/Integration'); ?>
            <?php //$this->load->view('Management/Web_Design/Content_Creator/Budgeting/All_Arrays'); ?>
            <?php //$this->load->view('Management/Web_Design/Content_Creator/Components/ChartJS_Bar_Chart'); ?>
            <?php //$this->load->view('User/Wallets/Wallet_Selection'); ?>
            <?php //$this->load->view('User/Wallets/Add_Account'); ?>
            <?php //$this->load->view('Management/Web_Design/Content_Creator/Codat/GuzzleHttp'); ?>
        </div>
        <div class="col-12 d-none">
            <?php
            // // Remove My Test User's Budgeting
            // $this->db->where('created_by_email', $cuEmail);
            // return $this->db->delete('bf_users_budgeting');
            // $this->db->where('name', 'Conterra - Salary');
            // return $this->db->delete('bf_users_budgeting');
            // $this->db->from('bf_users');
            // $this->db->where('active', 1);
            // $getUsers = $this->db->get();
            // foreach ($getUsers->result_array() as $users) {
            //     $this->db->from('bf_users_wallets');
            //     $this->db->where('default_wallet', 'Yes');
            //     $getAllWallets = $this->db->get();
            //     foreach ($getAllWallets->result_array() as $wallets) {
            //         if ($wallets['user_id']) {
            //             echo 'This Account: ' . $wallets['user_id'];
            //         }
            //     }
            // }
            ?>
		</div>
	</div>
</div>
=======
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
            $this->load->view('User/Dashboard/Investor_Profile/Activity', $testInfo); 
            ?>
		</div>
	</div>
</div>
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
