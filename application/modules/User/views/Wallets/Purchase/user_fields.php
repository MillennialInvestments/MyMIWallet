<?php /* /users/views/user_fields.php */
date_default_timezone_set('America/Chicago');
$client                                         = new \GuzzleHttp\Client(); 
$date 						                    = date("F jS, Y");
$hostTime 					                    = date("g:i A");
$time 						                    = date("g:i A", strtotime($hostTime) - 60 * 60 * 5);
$currentMethod 				                    = $this->router->fetch_method();
$errorClass    			 	                    = empty($errorClass) ? ' error' : $errorClass;
$controlClass  		 		                    = empty($controlClass) ? 'span4' : $controlClass;
$registerClass 		 		                    = $currentMethod == 'register' ? ' required' : '';
$editSettings   			                    = $currentMethod == 'edit';
// Set Form Config
$formGroup				                    	= $this->config->item('form_container');
$formLabel					                    = $this->config->item('form_label');
$formConCol					                    = $this->config->item('form_control_column');
$formControl				                    = $this->config->item('form_control');
$formSelect					                    = $this->config->item('form_select');
$formSelectPicker			                    = $this->config->item('form_selectpicker');
$formText					                    = $this->config->item('form_text');
$formCustomText				                    = $this->config->item('form_custom_text');
$MyMIGoldValue				                    = $this->config->item('mymig_coin_value');
$wallet_cost				                    = $this->config->item('wallet_cost');
$gas_fee					                    = $this->config->item('gas_fee');
$trans_fee					                    = $this->config->item('trans_fee');
$trans_percent				                    = $this->config->item('trans_percent');
$cuID   					                    = $_SESSION['allSessionData']['userAccount']['cuID'];
$cuUserType					                    = $_SESSION['allSessionData']['userAccount']['cuUserType'];
$cuUsername					                    = $_SESSION['allSessionData']['userAccount']['cuUsername'];
$cuEmail					                    = $_SESSION['allSessionData']['userAccount']['cuEmail'];
$cuWalletID					                    = $_SESSION['allSessionData']['userAccount']['cuWalletID'];
if ($featureType === 'Purchase-Wallet') {
    if ($walletType === 'Fiat') {
        $feature_title                          = 'Purchase Premium Wallet';
        $feature_type                           = 'Premium Wallet';
        echo '<input type="hidden" class="form-control" name="wallet_type" id="wallet_type" value="' . set_value('wallet_type', isset($user) ? $user->wallet_type : $walletType) . '">';
    } elseif ($walletType === 'Digital') {
        $feature_title                          = 'Purchase Premium Wallet';
        $feature_type                           = 'Premium Wallet';
        echo '<input type="hidden" class="form-control" name="wallet_type" id="wallet_type" value="' . set_value('wallet_type', isset($user) ? $user->wallet_type : $walletType) . '">';
    }
    echo '<input type="hidden" class="form-control" name="feature_type" id="feature_type" value="' . set_value('feature_type', isset($user) ? $user->feature_type : $feature_type) . '">';
}
$MyMIGCoinSum				                    = $_SESSION['allSessionData']['userAccount']['MyMIGCoinSum'];
$walletID					                    = $_SESSION['allSessionData']['userAccount']['walletID'];
$expenses					                    = $trans_percent + $trans_fee;
$total_fees					                    = $expenses;
$fee_coins					                    = round(($total_fees / $MyMIGoldValue), 8);
$walletCost					                    = $wallet_cost + $expenses;
$available_coins			                    = $this->config->item('mymig_coin_available');
//~ echo $walletCoins;
$remainingCoins				                    = $MyMIGCoinSum - $walletCost;

?>                              
<h4 class="card-title"><?php echo $feature_title; ?></h4>
<p class="card-description"> Please fill out information below</p>			
<hr>
<?php
if ($cuUserType === 'Beta') {
    ?>
<input type="hidden" id="beta" name="beta" value="<?php echo set_value('beta', isset($user) ? $user->beta : 'Yes'); ?>" /> 
<?php
} else {
        ?>             
<input type="hidden" id="beta" name="beta" value="<?php echo set_value('beta', isset($user) ? $user->beta : 'No'); ?>" /> 
<?php
    }
?>
<input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">	
<input type="hidden" class="form-control" name="user_email" id="user_email" value="<?php echo set_value('user_email', isset($user) ? $user->user_email : $cuEmail); ?>">
<input type="hidden" class="form-control" name="wallet_id" id="wallet_id" value="<?php echo set_value('wallet_id', isset($user) ? $user->wallet_id : $cuWalletID); ?>">
<input type="hidden" class="form-control" name="feature_cost" id="feature_cost" value="<?php echo set_value('feature_cost', isset($user) ? $user->feature_cost : $walletCost); ?>">
<input type="hidden" class="form-control" name="available_coins" id="available_coins" value="<?php echo set_value('available_coins', isset($user) ? $user->available_coins : $available_coins); ?>">
<input type="hidden" class="form-control" name="initial_value" id="initial_value" value="<?php echo set_value('initial_value', isset($user) ? $user->initial_value : $MyMIGoldValue); ?>">	
<input type="hidden" class="form-control" name="coin_value" id="coin_value" value="<?php echo set_value('coin_value', isset($user) ? $user->coin_value : $MyMIGoldValue); ?>">		
<input type="hidden" class="form-control" name="gas_fee" id="gas_fee" value="<?php echo set_value('gas_fee', isset($user) ? $user->gas_fee : $gas_fee); ?>">	
<input type="hidden" class="form-control" name="trans_percent" id="trans_percent" value="<?php echo set_value('trans_percent', isset($user) ? $user->trans_percent : $trans_percent); ?>">	
<input type="hidden" class="form-control" name="trans_fee" id="trans_fee" value="<?php echo set_value('trans_fee', isset($user) ? $user->trans_fee : $trans_fee); ?>">	
<input type="hidden" class="form-control" name="redirect_url" id="redirect_url" value="<?php echo set_value('redirect_url', isset($user) ? $user->redirect_url : $redirect_url); ?>">	

<div class="<?php echo $formGroup; ?> mb-2">    
	<label class="col-6 form-label" for="default-01">Available MyMI Gold</label>    
	<div class="col-6">       
		<label class="form-label mt-3"><?php echo number_format($MyMIGCoinSum, 2); ?> Gold</label>	      	   
		<input type="hidden" name="initial_balance" id="initial_balance" placeholder="Enter Wallet Amount" value="<?php echo set_value('initial_balance', isset($user) ? $user->initial_balance : $MyMIGCoinSum); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?> mb-2">    
	<label class="col-6 form-label" for="default-01">MyMI Gold Cost</label>    
	<div class="col-6"> 
		<label class="form-label mt-3"><?php echo number_format($wallet_cost, 2); ?> Gold</label>	   
	</div>
</div>
<div class="<?php echo $formGroup; ?> mb-2">    
	<label class="col-6 form-label" for="default-01">Transaction Fees</label>    
	<div class="col-6"> 
		<label class="form-label mt-3"><?php echo number_format($expenses, 2); ?> Gold</label>	   
	</div>
</div>
<div class="<?php echo $formGroup; ?> mb-2">    
	<label class="col-6 form-label" for="default-01">Subtotal Cost</label>    
	<div class="col-6"> 
		<label class="form-label mt-3"><?php echo number_format($walletCost, 2); ?> Gold</label>	   
	</div>
</div>
<div class="<?php echo $formGroup; ?> mb-2">    
	<label class="col-6 form-label" for="default-01">Remaining MyMI Gold</label>    
	<div class="col-6">       
		<label class="form-label mt-3"><?php echo number_format($remainingCoins, 2); ?> Gold</label>   
		<input type="hidden" name="remaining_balance" id="remaining_balance" placeholder="Enter Wallet Amount" value="<?php echo set_value('remaining_balance', isset($user) ? $user->remaining_balance : $remainingCoins); ?>">			
	</div>
</div> 
