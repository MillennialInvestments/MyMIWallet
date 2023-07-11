<?php
// require_once 'vendor/autoload.php';
$testPage						= $this->config->item('test_view_page');
$cuID 							= $_SESSION['allSessionData']['userAccount']['cuID'];
$testInfo						= array(
    'cuID'						=> $cuID,
);
?>   
<style>
	.tt-input {
		display: block;
		height: calc(2.125rem + 2px);
		padding: .4375rem 1rem;
		font-size: .8125rem;
		font-weight: 400;
		line-height: 1.25rem;
		color: #3c4d62;
		background-color: #fff;
		background-clip: padding-box;
		border: 1px solid #dbdfea;
		border-radius: 4px;
		transition: border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out;
}
</style>  
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-lg-12 col-xl-12">
			<div class="nk-block">
				<div class="nk-block-head-xs">
					<div class="nk-block-head-content">
						<h1 class="nk-block-title title">Web Development - Test Page</h1>
						<p id="private_key"></p>
						<p id="address"></p>
						<a href="<?php echo site_url('/Trade-Tracker'); ?>">Test Page Environment</a>							
					</div>
				</div>
			</div>
			<div class="nk-block">
				<?php
                //$this->load->view('Management/Web_Design/Test_Page/data-distribution', $testInfo);
                // $this->load->view('Management/Web_Design/Test_Page/trade_tracker', $testInfo);
                ?>
			</div>
			<div class="nk-block">
                <?php
                $recordID                   = '790';
                $userBudgetRecord           = $this->mymibudget->get_user_budget_record($cuID, $recordID);  
                print_r($userBudgetRecord['getUserBudgetRecord'][0]['name']); 
                $budgetRecord               = $userBudgetRecord['getUserBudgetRecord'][0]['name'];
                // echo '<br><br>'; 
                // echo $budgetRecord;
                // foreach($userBudgetRecord as $userRecord) {
                //     print_r($userRecord['getUserBudgetRecord'][0]['name']); 
                // }
                // print_r($getUserBudgetRecord); 
                ?>
			</div>     
		</div>
	</div>
</div>
