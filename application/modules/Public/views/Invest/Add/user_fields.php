<?php
$cuID					 					= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$cuEmail				 					= isset($current_user->email) && ! empty($current_user->email) ? $current_user->email : '';
$cuUsername				 					= isset($current_user->username) && ! empty($current_user->username) ? $current_user->username : '';
$cuUserType				 					= isset($current_user->type) && ! empty($current_user->type) ? $current_user->type : '';
$cuWalletID				 					= isset($current_user->wallet_id) && ! empty($current_user->wallet_id) ? $current_user->wallet_id : '';
$pageURIA 	 								= $this->uri->segment(1);
$pageURIB 	 								= $this->uri->segment(2);
$pageURIC 	 								= $this->uri->segment(3);
$pageURID 	 								= $this->uri->segment(4);
$pageURIE 	 								= $this->uri->segment(5);
$referralID									= $pageURIB;
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
if ($cuUserType === 'Beta') {
    $beta									= 'Yes';
} else {
    $beta									= 'No';
}
?>                                                         
<input class="<?php e($controlInput); ?>" type="hidden" id="beta" name="beta" value="<?php echo set_value('beta', isset($user) ? $user->beta : $beta); ?>" />
<div class="<?php e($controlGroup); ?> <?php echo form_error('beta') ? $errorClass : ''; ?>">
<input class="<?php e($controlInput); ?>" type="hidden" id="cuID" name="cuID" value="<?php echo set_value('cuID', isset($user) ? $user->cuID : $cuID); ?>" />
<input class="<?php e($controlInput); ?>" type="hidden" id="cuEmail" name="cuEmail" value="<?php echo set_value('cuEmail', isset($user) ? $user->cuEmail : $cuEmail); ?>" />
<input class="<?php e($controlInput); ?>" type="hidden" id="trading_account" name="trading_account" value="<?php echo set_value('trading_account', isset($user) ? $user->trading_account : $cuWalletID); ?>" />
    <label class="<?php e($controlLabel); ?> " for="zipcode">
		Wallet ID <a data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><i class="icon-question"></i></a>
    </label>
    <label class="<?php e($controlClass); ?> pt-2 mb-1 no-font-weight">
		<?php if (!empty($cuWalletID)) {  ?>
			<p class="mb-0" id="wallet_id" style="font-size: 0.65rem; margin-top: 0.35rem"><?= $cuWalletID; ?></p>
			<input class="<?php e($controlInput); ?>"type="hidden" id="wallet_id" name="wallet_id" value="<?php echo set_value('wallet_id', isset($user) ? $user->wallet_id : $cuWalletID); ?>" />
		<?php } else { ?>
			<input class="<?php e($controlInput); ?>"type="text" id="wallet_id" name="wallet_id" placeholder="Enter Digibyte Wallet Address" value="<?php echo set_value('wallet_id', isset($user) ? $user->wallet_id : $cuWalletID); ?>" />
		<?php } ?>
    </label>
</div>
<input class="<?php e($controlInput); ?>" type="hidden" id="initial_value" name="initial_value" value="<?php echo set_value('initial_value', isset($user) ? $user->initial_value : $initial_value); ?>" />
<input class="<?php e($controlInput); ?>" type="hidden" id="available_coins" name="available_coins" value="<?php echo set_value('available_coins', isset($user) ? $user->available_coins : $available_coins); ?>" />
<input class="<?php e($controlInput); ?>" onChange="calculateDiscount(); return false;" type="hidden" id="coin_value" name="coin_value" value="<?php echo set_value('coin_value', isset($user) ? $user->coin_value : $coin_value); ?>" />
  
<div class="<?php e($controlGroup); ?> <?php echo form_error('amount') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="zipcode">Amount</label>
    <div class="<?php e($controlClass); ?> ">
        <input class="<?php e($controlInput); ?> mt-0" onChange="calculateDiscount(); return false;" type="text" id="amount" name="amount" value="<?php echo set_value('amount', isset($user) ? $user->amount : ''); ?>" placeholder="<?php echo 'Min: $' . $minimum_purchase . '.00';?>" />
        <span class="help-inline"><?php echo form_error('amount'); ?></span>
    </div>  
</div>   
<hr>
<h2 class="nk-block-title title text-center display-7">SUBTOTAL:</h2>                                              
<input class="<?php e($controlInput); ?>" onChange="calculateDiscount(); return false;" type="hidden" id="minimum_purchase" name="minimum_purchase" value="<?php echo set_value('minimum_purchase', isset($user) ? $user->minimum_purchase : $minimum_purchase); ?>" />

<div class="<?php e($controlGroup); ?> <?php echo form_error('total') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="zipcode">Total Coins</label>
    <label class="<?php e($controlClass); ?> pt-2 mb-1 no-font-weight">
		<p class="mb-0" id="display_total" onChange="calculateDiscount(); return false;" onClick="clearBuyContent();"></p>
		<input class="<?php e($controlInput); ?>" type="hidden" id="total" name="total" value="<?php echo set_value('total', isset($user) ? $user->total : ''); ?>" />
    </label>
</div>  

<input class="<?php e($controlInput); ?>" onChange="calculateDiscount(); return false;" type="hidden" id="gas_fee" name="gas_fee" value="<?php echo set_value('gas_fee', isset($user) ? $user->gas_fee : $gas_fee); ?>" /> 

<input class="<?php e($controlInput); ?>" onChange="calculateDiscount(); return false;" type="hidden" id="trans_percent" name="trans_percent" value="<?php echo set_value('trans_percent', isset($user) ? $user->trans_percent : $trans_percent); ?>" /> 

<input class="<?php e($controlInput); ?>" onChange="calculateDiscount(); return false;" type="hidden" id="trans_fee" name="trans_fee" value="<?php echo set_value('trans_fee', isset($user) ? $user->trans_fee : $trans_fee); ?>" /> 
  
<div class="<?php e($controlGroup); ?> <?php echo form_error('user_gas_fee') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="user_gas_fee">Gas Fee</label>
    <label class="<?php e($controlClass); ?> pt-2 mb-1 no-font-weight">
		<p class="mb-0" id="display_user_gas_fee" onChange="calculateDiscount(); return false;" onClick="clearBuyContent();"></p>
		<input class="<?php e($controlInput); ?>" onChange="calculateDiscount(); return false;" type="hidden" id="user_gas_fee" name="user_gas_fee" value="<?php echo set_value('user_gas_fee', isset($user) ? $user->user_gas_fee : ''); ?>" />  
    </label>
</div> 

<div class="<?php e($controlGroup); ?> <?php echo form_error('fees') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="zipcode">Fees</label>
    <label class="<?php e($controlClass); ?> pt-2 mb-1 no-font-weight">
		<p class="mb-0" id="display_fees" onChange="calculateDiscount(); return false;" onClick="clearBuyContent();"></p>
		<input class="<?php e($controlInput); ?>" onChange="calculateDiscount(); return false;" type="hidden" id="fees" name="fees" value="<?php echo set_value('fees', isset($user) ? $user->fees : ''); ?>" />  
    </label>
</div> 

<div class="<?php e($controlGroup); ?> <?php echo form_error('total') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> " for="zipcode">Cost + Fees</label>
    <label class="<?php e($controlClass); ?> pt-2 mb-1 no-font-weight">
		<p class="mb-0" id="display_total_cost" onChange="calculateDiscount(); return false;" onClick="clearBuyContent();"></p>
		<input class="<?php e($controlInput); ?>" type="hidden" id="total_cost" name="total_cost" value="<?php echo set_value('total_cost', isset($user) ? $user->total_cost : ''); ?>" />
    </label>
</div>
<input class="<?php e($controlInput); ?>" type="hidden" id="referral_id" name="referral_id" value="<?php echo set_value('referral_id', isset($user) ? $user->referral_id : $referralID); ?>" />
<div class="control-group">
	<div class="controls ml-3">
		<input class="btn btn-primary" type="submit" name="register" id="submit" value="Buy Now!" />
	</div>
</div>   
<script>
function calculateDiscount()
{
	var coin_value 	= document.getElementById('coin_value').value;
	var amount 		= document.getElementById('amount').value;
	var gas	 		= document.getElementById('gas_fee').value;
	var tpercent	= document.getElementById('trans_percent').value;
	var tfee 		= document.getElementById('trans_fee').value;
	var gasfee		= amount * gas;
	//do the math
	var subtotal 	= amount / coin_value;
	var total		= subtotal - gasfee;
	var expenses	= amount * tpercent + +tfee;
	var total_cost	= +amount + +expenses;
	//update
	document.getElementById('display_total').innerHTML = total.toFixed(0) + " MYMI";
	document.getElementById('total').value = total;
	document.getElementById('display_user_gas_fee').innerHTML = gasfee;
	document.getElementById('user_gas_fee').value = gasfee;
	document.getElementById('display_fees').innerHTML = "$" + expenses.toFixed(2);
	document.getElementById('fees').value = expenses.toFixed(2);
	document.getElementById('display_total_cost').innerHTML = "$" + total_cost.toFixed(2);
	document.getElementById('total_cost').value = total_cost.toFixed(2);
	// Validation
	var available_coins		= <?= $available_coins; ?>;
	var minimum				= <?= $minimum_purchase; ?>;
	var amount_avail		= coin_value * available_coins;
	var amount_available	= amount_avail.toFixed(2);
	var total_coins			= amount / coin_value;
	var minText 			= "Minimum Amount must be $" + minimum + ".00 or more!";;
	var maxText 			= "Maximum Amount of MyMI Coin must be $" + amount_available + " or less! Only " + available_coins + " MyMI Coins available to purchase.";

	// If x is Not a Number or less than one or greater than 10
	if (isNaN(amount) || amount < <?php echo $minimum_purchase; ?>) {
		alert(minText);
		document.getElementById("amount").value = minimum;
	}
	// If x is Not a Number or less than one or greater than 10
	if (isNaN(total_coins) || total_coins > available_coins) {
		alert(maxText);
		document.getElementById("amount").value = amount_available;
		var adj_coin_value 	= document.getElementById('coin_value').value;
		var adj_amount 		= document.getElementById('amount').value;
		var adj_gas	 		= document.getElementById('gas_fee').value;
		var adj_tpercent	= document.getElementById('trans_percent').value;
		var adj_tfee 		= document.getElementById('trans_fee').value;
		var adj_gasfee		= amount * gas;
		//do the math
		var adj_subtotal 	= adj_amount / adj_coin_value;
		var adj_total		= adj_subtotal - adj_gasfee;
		var adj_expenses	= adj_amount * adj_tpercent + +adj_tfee;
		var adj_total_cost	= +adj_amount + +adj_expenses;
		//update
		document.getElementById('display_total').innerHTML = adj_total.toFixed(0) + " MYMI";
		document.getElementById('total').value = adj_total;
		document.getElementById('display_user_gas_fee').innerHTML = adj_gasfee;
		document.getElementById('user_gas_fee').value = gasfee;
		document.getElementById('display_fees').innerHTML = "$" + adj_expenses.toFixed(2);
		document.getElementById('fees').value = adj_expenses.toFixed(2);
		document.getElementById('display_total_cost').innerHTML = "$" + adj_total_cost.toFixed(2);
		document.getElementById('total_cost').value = adj_total_cost.toFixed(2);
	}
	console.log("Amount: " + amount); 
	console.log("Available Coins: " + available_coins); 
	console.log("Coin Value: " + coin_value); 
	console.log("Amount Available: " + amount_available); 
	console.log("Total Coins: " + total_coins); 
	console.log("Min Alert Text: " + minText); 
	console.log("Max Alert Text: " + maxText); 
	
	console.log("Adj. Coin Value: " + adj_coin_value); 
	console.log("Adj. Amount: " + adj_amount); 
	console.log("Adj. Gas: " + adj_gas); 
	console.log("Adj. Trans Percent: " + adj_tpercent); 
	console.log("Adj. Trans Fee: " + adj_tfee); 
	console.log("Adj. Gas Fee: " + adj_gasfee); 
	console.log("Adj. Subtotal: " + adj_subtotal); 
	console.log("Adj. Total: " + adj_total); 
	console.log("Adj. Expenses: " + adj_expenses); 
	console.log("Adj. Total Cost: " + adj_total_cost); 
	
}
</script>
<script>
//~ function validateCoinAmount() {
  //~ var x, text;
  //~ var minimum		= <?php echo $minimum_purchase; ?>;
  //~ var alertText 	= "Amount must be $" + minimum + ".00 or more!";
  //~ // Get the value of the input field with id="numb"
  //~ x 				= document.getElementById("amount").value;

  //~ // If x is Not a Number or less than one or greater than 10
  //~ if (isNaN(x) || x < <?php echo $minimum_purchase; ?>) {
    //~ alert(alertText);
    //~ document.getElementById("amount").value = minimum;
  //~ }
  
//~ }
//~ function validateMaxCoinAmount() {
  //~ var x, text;
  //~ var available_coins		= <?= $available_coins; ?>;
  //~ var amount_available		= coin_value * available_coins;
  //~ var total_coins			= amount * coin_value;
  //~ var alertText 			= "Maximum Amount of MyMI Coin must be $" + amount_available + ".00 or less!";
  //~ console.log("Amount: " + amount); 
  //~ console.log("Available Coins: " + available_coins); 
  //~ console.log("Coin Value: " + coin_value); 
  //~ console.log("Amount Available: " + amount_available); 
  //~ console.log("Total Coins: " + total_coins); 
  //~ console.log("Alert Text: " + alertText); 
  //~ // Get the value of the input field with id="numb"

  //~ // If x is Not a Number or less than one or greater than 10
  //~ if (isNaN(total_coins) || total_coins > available_coins) {
    //~ alert(alertText);
    //~ document.getElementById("amount").value = amount_available;
  //~ }
  
//~ }
</script>
