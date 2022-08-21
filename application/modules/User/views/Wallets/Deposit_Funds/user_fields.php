<?php /* /users/views/user_fields.php */
date_default_timezone_set('America/Chicago');
$date = date("F jS, Y");
$hostTime = date("g:i A");
$time = date("g:i A", strtotime($hostTime) - 60 * 60 * 5);
$currentMethod = $this->router->fetch_method();

$errorClass     = empty($errorClass) ? ' error' : $errorClass;
$controlClass   = empty($controlClass) ? 'span4' : $controlClass;
$registerClass  = $currentMethod == 'register' ? ' required' : '';
$editSettings   = $currentMethod == 'edit';
// Set Form Config
$formGroup				= $this->config->item('form_container');
$formLabel				= $this->config->item('form_label');
$formConCol				= $this->config->item('form_control_column');
$formControl			= $this->config->item('form_control');
$formSelect				= $this->config->item('form_select');
$formSelectPicker		= $this->config->item('form_selectpicker');
$formText				= $this->config->item('form_text');
$formCustomText			= $this->config->item('form_custom_text');
?>
			
<hr>
<input type="hidden" class="form-control" name="trans_mode" id="trans_mode" value="<?php echo set_value('trans_mode', isset($user) ? $user->trans_mode : 'Deposit Funds'); ?>">	
<input type="hidden" name="redirectURL" id="redirectURL" value="<?php echo set_value('redirectURL', isset($user) ? $user->redirectURL : $redirectURL); ?>">	
<input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">	
<input type="hidden" class="form-control" name="user_email" id="user_email" value="<?php echo set_value('user_email', isset($user) ? $user->user_email : $cuEmail); ?>">
<input type="hidden" class="form-control" name="wallet_id" id="wallet_id" value="<?php echo set_value('wallet_id', isset($user) ? $user->wallet_id : $walletID); ?>">	
<input type="hidden" class="form-control" name="wallet_sum" id="wallet_sum" value="<?php echo set_value('wallet_sum', isset($user) ? $user->wallet_sum : $walletAmount); ?>">	
<input type="hidden" class="form-control" name="type" id="type" value="<?php echo set_value('type', isset($user) ? $user->type : 'Fiat'); ?>">
<input type="hidden" class="form-control" name="broker" id="broker" value="<?php echo set_value('broker', isset($user) ? $user->broker : $walletBroker); ?>">
<input type="hidden" class="form-control" name="nickname" id="nickname" value="<?php echo set_value('nickname', isset($user) ? $user->nickname : $walletNickname); ?>">
<div class="<?php echo $formGroup; ?>">    
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="amount" id="amount" placeholder="USD" onChange="calculateDeposit();" value="<?php echo set_value('amount', isset($user) ? $user->amount : ''); ?>">	
	</div>
</div>
<div class="row">
	<div class="col-3 col-md-6"></div>
	<div class="col-9 col-md-6 text-right">
		<p style="font-size: 0.75rem"><span>Subtotal: </span><span id="subtotal">0.00</span><span> USD</span></p>
		<p style="font-size: 0.75rem"><span>Card Processing Fee: </span><span id="expenses">0.00</span><span> USD</span></p>
		<p style="font-size: 0.75rem"><span>Total Charge: </span><span id="total_charge">$0.00</span><span> USD</span></p>
	</div>
</div>
<div class="<?php echo $formGroup; ?> pt-3">
	<div class="col-md-4"></div>
	<div class="col-12 col-md-8">
		<div class="row">
			<div class="col-6 px-1">                   
				<button type="button" class="btn btn-secondary btn-block" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
			</div>
			<div class="col-6 px-1">                   
				<input class="btn btn-primary btn-block" type="submit" name="register" id="submit" value="Submit" />
			</div>
		</div>
	</div>
</div>
<hr>
<p style="font-size:0.65rem;">
By proceeding, you acknowledge and agree that your transaction is governed by the Terms of Service, the Terms of Service Addendum for Card Payments and the Privacy Policy. All transactions are final.	
</p>
<p style="font-size:0.65rem;">
Your card-issuing bank may charge a foreign transaction fee or another type of fee. Any fees charged by your bank are separate from and in addition to the card processing fee charged by Bittrex. By proceeding, you also acknowledge that you are solely responsible for paying any fees charged by your bank.
</p>
<script>
function calculateDeposit()
{
	// Get Variables
	var amount 											= document.getElementById('amount').value;
	var fee												= 0.03;
	var expenses										= amount * fee;
	var total_charge									= parseInt(amount) + parseInt(expenses);
	console.log(amount);
	console.log(fee);
	console.log(expenses);
	console.log(total_charge);
	
	document.getElementById('subtotal').innerHTML		= parseFloat(amount).toFixed(2).toLocaleString(); 
	document.getElementById('expenses').innerHTML		= parseFloat(expenses).toFixed(2).toLocaleString(); 
	document.getElementById('total_charge').innerHTML	= parseFloat(total_charge).toFixed(2).toLocaleString(); 
} 
</script>
