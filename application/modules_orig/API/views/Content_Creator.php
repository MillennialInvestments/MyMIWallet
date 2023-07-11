<?php
// require_once 'vendor/autoload.php';
$testPage = $this->config->item('test_view_page');
$cuID = $_SESSION['allSessionData']['userAccount']['cuID'];
$cuEmail = $_SESSION['allSessionData']['userAccount']['cuEmail'];
$testInfo = array(
    'cuID' => $cuID,
);
?> 
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-lg-12 col-xl-12">
			<div class="nk-block">
				<div class="nk-block-head-xs">
					<div class="nk-block-head-content">
						<h1 class="nk-block-title title">Web Development - Content Creator</h1>
                        <br>
                        <br>
                        <br>
                        <?php //$this->load->view('Management/Web_Design/Content_Creator/Components/Pass_Data_To_Modal'); ?>
                    </div>
				</div>
			</div>
        </div>
        <div class="col-12">
            <?php 
            // ! Only Add Content Views Below To Be Edited //
            $this->load->view('API/Content_Creator/Plaid/Node_JS');
            ?>

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