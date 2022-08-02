<?php
/*
- Available_Coins 	- Previous New_Availability of MyMI Gold
- New Availability	- New MyMI Gold Total + Available Coins
-

*/
$cuID					 					= $_SESSION['allSessionData']['userAccount']['cuID'];
$cuEmail				 					= $_SESSION['allSessionData']['userAccount']['cuEmail'];
$cuEmail				 					= $_SESSION['allSessionData']['userAccount']['cuEmail'];
$cuWalletID				 					= $_SESSION['allSessionData']['userAccount']['cuWalletID'];
$cuType					 					= $_SESSION['allSessionData']['userAccount']['cuUserType'];
$initial_value								= $_SESSION['allSessionData']['userGoldData']['myMIGInitialValue'];
$available_coins							= $_SESSION['allSessionData']['userGoldData']['coinSum'];
$coin_value									= $this->config->item('mymig_coin_value');
$gas_fee									= $this->config->item('mymig_gas_fee');
$trans_percent								= $this->config->item('trans_percent');
$trans_fee									= $this->config->item('trans_fee');
$currentMethod 								= $this->router->method;
$errorClass     							= empty($errorClass) ? ' error' : $errorClass;
$registerClass  							= $currentMethod == 'register' ? ' required' : '';
$editSettings   							= $currentMethod == 'edit';
$defaultLanguage							= isset($user->language) ? $user->language : strtolower(settings_item('language'));
$defaultTimezone 							= isset($user->timezone) ? $user->timezone : strtoupper(settings_item('site.default_user_timezone'));
// Input Field Settings
$controlGroup 								= 'control-group form-row pb-3';
$controlLabel 								= 'control-label col-sm-4 col-md-4 col-lg-4 pt-2';
$controlClass 								= 'controls col-sm-8 col-md-8 col-lg-8 pl-3';
$controlInput   							= 'form-control full-width';
if ($this->uri->uri_string() === 'Wallet-Selection/Fiat') {
    $feature                                = 'Premium Fiat Wallet';
    $redirect_url                           = 'Purchase-Wallet/Fiat';
} elseif ($this->uri->uri_string() === 'Wallet-Selection/Digital') {
    $feature                                = 'Premium Crypto Wallet';
    $redirect_url                           = 'Purchase-Wallet/Digital';
} elseif ($this->uri->uri_string() === 'Wallets/Link-Account/Brokerage/Fiat') {
    $feature                                = 'Premium Fiat Wallet';
    $redirect_url                           = 'Purchase-Wallet/Fiat';
} elseif ($this->uri->uri_string() === 'Wallets/Link-Account/Brokerage/Digital ') {
    $feature                                = 'Premium Fiat Wallet';
    $redirect_url                           = 'Purchase-Wallet/Fiat';
}
?>  
<input class="<?php e($controlInput); ?>" type="hidden" id="redirect_url" name="redirect_url" value="<?php echo set_value('redirect_url', isset($user) ? $user->redirect_url : $redirect_url); ?>" /> 
<?php
if ($cuType === 'Beta') {
    ?>
<input class="<?php e($controlInput); ?>" type="hidden" id="beta" name="beta" value="<?php echo set_value('beta', isset($user) ? $user->beta : 'Yes'); ?>" /> 
<?php
} else {
        ?>             
<input class="<?php e($controlInput); ?>" type="hidden" id="beta" name="beta" value="<?php echo set_value('beta', isset($user) ? $user->beta : 'No'); ?>" /> 
<?php
    }
?>
<input class="<?php e($controlInput); ?>" type="hidden" id="user_id" name="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>" /> 
<input class="<?php e($controlInput); ?>" type="hidden" id="user_email" name="user_email" value="<?php echo set_value('user_email', isset($user) ? $user->user_email : $cuEmail); ?>" />  
<input class="<?php e($controlInput); ?>" type="hidden" id="coin" name="coin" value="<?php echo set_value('coin', isset($user) ? $user->coin : 'MyMIG'); ?>" />  
<div class="<?php e($controlGroup); ?> <?php echo form_error('wallet_id') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="wallet_id">
		Wallet ID <a data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><i class="icon-question"></i></a>
    </label>
    <div class="<?php e($controlClass); ?>">
		<input class="<?php e($controlInput); ?>"type="text" id="wallet_id" name="wallet_id" value="<?php echo set_value('wallet_id', isset($user) ? $user->wallet_id : $cuWalletID); ?>" />
    </div>
</div>
<input class="<?php e($controlInput); ?>" type="hidden" id="initial_value" name="initial_value" value="<?php echo set_value('initial_value', isset($user) ? $user->initial_value : $initial_value); ?>" />
<input class="<?php e($controlInput); ?>" type="hidden" id="available_coins" name="available_coins" value="<?php echo set_value('available_coins', isset($user) ? $user->available_coins : $available_coins); ?>" />
<input class="<?php e($controlInput); ?>" onChange="calculatePurchase(); return false;" type="hidden" id="initial_coin_value" name="initial_coin_value" value="<?php echo set_value('initial_coin_value', isset($user) ? $user->initial_coin_value : $coin_value); ?>" />    
<div class="<?php echo $controlGroup; ?>">
	<label for="amount" class="<?php echo $controlLabel; ?>">Amount</label>
	<div class="<?php echo $controlClass; ?>">
		<?php
            echo '
			<select class="' . $controlInput . '" name="amount" id="package_amount" required="required" onChange="calculatePurchase();">
				<option>Select-Coin-Package</option>
				';
                $type_values = array(
                    10 				=> '$10',
                    25 				=> '$25',
                    50 				=> '$50',
                    75				=> '$75',
                    100				=> '$100',
                );
                foreach ($type_values as $value => $display_text) {
                    $selected = ($value == $this->input->post('amount')) ? ' selected="selected"' : "";
                    ;

                    echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                }
            echo '</select>';
        ?>						
	</div>
</div>              
<input class="<?php e($controlInput); ?>" onChange="calculatePurchase(); return false;" type="hidden" id="total" name="total" value="<?php echo set_value('total', isset($user) ? $user->total : ''); ?>" />  
<input class="<?php e($controlInput); ?>" onChange="calculatePurchase(); return false;" type="hidden" id="total_cost" name="total_cost" value="<?php echo set_value('total_cost', isset($user) ? $user->total_cost : ''); ?>" />
<input class="<?php e($controlInput); ?>" onChange="calculatePurchase(); return false;" type="hidden" id="total_fees" name="total_fees" value="<?php echo set_value('total_fees', isset($user) ? $user->total_fees : ''); ?>" />
<input class="<?php e($controlInput); ?>" onChange="calculatePurchase(); return false;" type="hidden" id="gas_fee" name="gas_fee" value="<?php echo set_value('gas_fee', isset($user) ? $user->gas_fee : $gas_fee); ?>" />                 
<input class="<?php e($controlInput); ?>" onChange="calculatePurchase(); return false;" type="hidden" id="trans_fee" name="trans_fee" value="<?php echo set_value('trans_fee', isset($user) ? $user->trans_fee : $trans_fee); ?>" />  
<input class="<?php e($controlInput); ?>" onChange="calculatePurchase(); return false;" type="hidden" id="trans_percent" name="trans_percent" value="<?php echo set_value('trans_percent', isset($user) ? $user->trans_percent : $trans_percent); ?>" />      
<input class="<?php e($controlInput); ?>" onChange="calculatePurchase(); return false;" type="hidden" id="user_gas_fee" name="user_gas_fee" value="<?php echo set_value('user_gas_fee', isset($user) ? $user->user_gas_fee : ''); ?>" />  
<input class="<?php e($controlInput); ?>" onChange="calculatePurchase(); return false;" type="hidden" id="user_trans_fees" name="user_trans_fees" value="<?php echo set_value('user_trans_fees', isset($user) ? $user->user_trans_fees : ''); ?>" />  
<input class="<?php e($controlInput); ?>" onChange="calculatePurchase(); return false;" type="hidden" id="user_trans_percent" name="user_trans_percent" value="<?php echo set_value('user_trans_percent', isset($user) ? $user->user_trans_percent : ''); ?>" />             
     
<table class="table">
	<tbody>
		<tr>
			<td>Total Coins</td>
			<td> 
				<p class="mb-0" id="display_total" onChange="calculatePurchase(); return false;"></p>
			</td>  
		</tr> 
		<tr>
			<td>Fees</td>
			<td>
				<p class="mb-0" id="display_fees" onChange="calculatePurchase(); return false;"></p>    
			</td>
		</tr>
		<tr>
			<td>Cost + Fees</td>
			<td>
				<p class="mb-0" id="display_total_cost" onChange="calculatePurchase(); return false;"></p>
			</td>
		</tr>
	</tbody>
</table>                                           
<div class="control-group" style="border:none;">
	<div class="controls ml-3">
		<input class="btn btn-primary" type="submit" name="register" id="purchaseGoldSubmit" value="Buy Now!" />
	</div>
</div>   
