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
	
<h4 class="card-title">Add Withdrawal Information</h4>
<p class="card-description"> Please fill out information below</p>		
<hr>
<input type="hidden" class="form-control" name="trans_mode" id="trans_mode" value="<?php echo set_value('trans_mode', isset($user) ? $user->trans_mode : 'Withdraw Funds'); ?>">
<input type="hidden" name="redirectURL" id="redirectURL" value="<?php echo set_value('redirectURL', isset($user) ? $user->redirectURL : $redirectURL); ?>">	
<input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">	
<input type="hidden" class="form-control" name="user_email" id="user_email" value="<?php echo set_value('user_email', isset($user) ? $user->user_email : $cuEmail); ?>">
<input type="hidden" class="form-control" name="wallet_id" id="wallet_id" value="<?php echo set_value('wallet_id', isset($user) ? $user->wallet_id : $walletID); ?>">	
<input type="hidden" class="form-control" name="wallet_sum" id="wallet_sum" value="<?php echo set_value('wallet_sum', isset($user) ? $user->wallet_sum : $walletFunds); ?>">	
<input type="hidden" class="form-control" name="type" id="type" value="<?php echo set_value('type', isset($user) ? $user->type : 'Fiat'); ?>">
<input type="hidden" class="form-control" name="broker" id="broker" value="<?php echo set_value('broker', isset($user) ? $user->broker : $walletBroker); ?>">
<input type="hidden" class="form-control" name="nickname" id="nickname" value="<?php echo set_value('nickname', isset($user) ? $user->nickname : $walletNickname); ?>">
<div class="<?php echo $formGroup; ?>">    
	<div class="col-12">
		<?php
            echo '
			<select name="account" class="' . $formControl . '" id="account" required="required">			
				<option>Select-Bank-Account</option>
				';
                $getBankAccounts					= $this->wallet_model->get_user_bank_accounts($cuID);
                foreach ($getBankAccounts->result_array() as $bankAccount) {
                    $accountID						= $bankAccount['id'];
                    $bank_name						= $bankAccount['bank_name'];
                    $account_number					= $bankAccount['account_number'];
                        
                    $account_value = array(
                        $accountID		    		=> $bank_name . ' - x' . substr($account_number, -4),
                    );
                    foreach ($account_value as $value => $display_text) {
                        $selected = ($value == $this->input->post('account')) ? ' selected="selected"' : "";

                        echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                    } ;
                }
            echo '</select>';
        ?>
		<button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#createBankAccountModal"><em class="icon icon-plus mr-1"></em> Create New Bank ACH Connection</button>
				  
	</div>
</div>
<div class="<?php echo $formGroup; ?>">    
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="amount" id="withdraw_amount" placeholder="USD" onChange="validateWithdrawAmount(); calculateWithdraw();" value="<?php echo set_value('amount', isset($user) ? $user->amount : ''); ?>">	
	</div>
</div>
<div class="row">
	<div class="col-6"></div>
	<div class="col-6 text-right">
		<p style="font-size: 0.75rem"><span>Account Balance: </span><span id="account_balance"><?= $walletFunds; ?></span><span> USD</span></p>
		<p style="font-size: 0.75rem"><span>Withdraw Amount: </span><span id="withdraw_amount_display">0.00</span><span> USD</span></p>
		<p style="font-size: 0.75rem"><span>Remaining Balance: </span><span id="remaining_balance">$0.00</span><span> USD</span></p>
	</div>
</div>
<div class="<?php echo $formGroup; ?> pt-3">
	<div class="col-md-4"></div>
	<div class="col-12 col-md-8">
		<div class="row">
			<div class="col-6 px-1">                   
				<button type="button" class="btn btn-secondary btn-block" class="close closeModalBtn" data-dismiss="modal" aria-label="Close">Cancel</button>
			</div>
			<div class="col-6 px-1">                   
				<input class="btn btn-primary btn-block" type="submit" name="register" id="submit" value="Submit" />
			</div>
		</div>
	</div>
</div>
<script>
function validateWithdrawAmount() {
  var x, text;
//  var minimum	= <?php //echo $walletFunds;?>;
  var alertText = "Amount must be $" + minimum + ".00 or less!";
  // Get the value of the input field with id="numb"
  x = document.getElementById("withdraw_amount").value;

  // If x is Not a Number or less than one or greater than 10
//  if (isNaN(x) || x > <?php echo $walletFunds; ?>) {
//    alert(alertText);
//    document.getElementById("withdraw_amount").value = minimum;
//  }
  
}
</script>
