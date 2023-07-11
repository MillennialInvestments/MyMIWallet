<?php /* /users/views/user_fields.php */
date_default_timezone_set('America/Chicago');
$date                           = date("F jS, Y");
$hostTime                       = date("g:i A");
$time                           = date("g:i A", strtotime($hostTime) - 60 * 60 * 5);
$currentMethod                  = $this->router->fetch_method();

$errorClass                     = empty($errorClass) ? ' error' : $errorClass;
$controlClass                   = empty($controlClass) ? 'span4' : $controlClass;
$registerClass                  = $currentMethod == 'register' ? ' required' : '';
$editSettings                   = $currentMethod == 'edit';
// Set Form Config
$formGroup				        = $this->config->item('form_container');
$formLabel				        = $this->config->item('form_label');
$formConCol				        = $this->config->item('form_control_column');
$formControl			        = $this->config->item('form_control');
$formSelect				        = $this->config->item('form_select');
$formSelectPicker		        = $this->config->item('form_selectpicker');
$formText				        = $this->config->item('form_text');
$formCustomText			        = $this->config->item('form_custom_text');
$walletAccount                  = $getUserAccount->result_array(); 
// print_r($walletAccount); 
if (!empty($walletAccount)) {

    foreach ($walletAccount as $account) { 
        $accountBeta                = $account['beta'];
        $accountStatus              = $account['status'];
        $accountDate                = $account['date'];
        $accountTime                = $account['time'];
        $accountUserID              = $account['user_id'];
        $accountUserEmail           = $account['user_email']; 
        $accountUsername            = $account['username'];
        $accountWalletID            = $account['wallet_id'];
        $accountType                = $account['account_type'];
        $accountBank                = $account['debtor'];
        $accountNickname            = $account['nickname'];
        $accountNumber              = $account['account_number'];
        $accountLimit               = $account['credit_limit'];
        $accountCurrent             = $account['current_balance'];
        $accountAvailable           = $account['available_balance'];
    }
    
} else {
    $this->db->from('bf_users_debt_accounts'); 
    $this->db->where('id', $accountID); 
    $getUserAccount                 = $this->db->get(); 
    foreach($getUserAccount->result_array() as $account) {
        $accountBeta                = $account['beta'];
        $accountStatus              = $account['status'];
        $accountDate                = $account['date'];
        $accountTime                = $account['time'];
        $accountUserID              = $account['user_id'];
        $accountUserEmail           = $account['user_email']; 
        $accountUsername            = $account['username'];
        $accountWalletID            = $account['wallet_id'];
        $accountType                = $account['account_type'];
        $accountBank                = $account['debtor'];
        $accountNickname            = $account['nickname'];
        $accountNumber              = $account['account_number'];
        $accountLimit               = $account['credit_limit'];
        $accountCurrent             = $account['current_balance'];
        $accountAvailable           = $account['available_balance'];
    }
}
?>
<?php
// Set up Validation for whether or not we accept Third-Party Accounts
?>		                
<h4 class="card-title">Edit Account Information</h4>
<p class="card-description"> Please fill out information below</p>			
<hr>
<input type="hidden" name="form_mode" id="form_mode" value="<?php echo set_value('form_mode', isset($user) ? $user->form_mode : 'Edit'); ?>">	
<input type="hidden" name="redirectURL" id="redirectURL" value="<?php echo set_value('redirectURL', isset($user) ? $user->redirectURL : $redirectURL); ?>">	
<input type="hidden" name="beta" id="beta" value="<?php echo set_value('beta', isset($user) ? $user->beta : $beta); ?>">	
<input type="hidden" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">	
<input type="hidden" name="user_email" id="user_email" value="<?php echo set_value('user_email', isset($user) ? $user->user_email : $cuEmail); ?>">
<input type="hidden" name="username" id="username" value="<?php echo set_value('username', isset($user) ? $user->username : $cuUsername); ?>">
<input type="hidden" name="wallet_id" id="wallet_id" value="<?php echo set_value('wallet_id', isset($user) ? $user->wallet_id : $walletID); ?>">	
<input type="hidden" name="wallet_type" id="wallet_type" value="<?php echo set_value('wallet_type', isset($user) ? $user->wallet_type : $walletType); ?>">
<input type="hidden" name="purchase_type" id="purchase_type" value="<?php echo set_value('purchase_type', isset($user) ? $user->purchase_type : $purchaseType); ?>">
<input type="hidden" name="account_id" id="account_id" value="<?php echo set_value('account_id', isset($user) ? $user->account_id : $accountID); ?>">	
<div class="<?php echo $formGroup; ?> mb-2">
        <label for="credit_status" class="col-12">Account Status</label>
        <div class="col-12">
            <select name="credit_status" class="<?php echo $formSelectPicker; ?>" id="credit_status" style="height: 40px; padding: 10px;">
                <option value="Active">Active</option>
                <option value="Closed">Closed</option>
            </select>
        </div>
    </div>
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Name of Lendor</label>
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="bank_name" id="bank_name" placeholder="Ex: Capital One Bank" value="<?php echo set_value('bank_name', isset($user) ? $user->bank_name : $accountBank); ?>">	
	</div>
</div>	
<?php if (!empty($accountNickname)) { ?>
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Nickname for Account</label>
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="nickname" id="nickname" placeholder="Ex: Main Banking Account" value="<?php echo set_value('nickname', isset($user) ? $user->nickname : $accountNickname); ?>">	
	</div>
</div>
<?php } ?>
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Account Number</label>
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="account_number" id="account_number" placeholder="Ex: 012345678910" value="<?php echo set_value('account_number', isset($user) ? $user->account_number : $accountNumber); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Total Balance</label>
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="available_balance" id="available_balance" onChange="calculateBalance(); return false;"  placeholder="Ex: 1500.00" value="<?php echo set_value('available_balance', isset($user) ? $user->available_balance : $accountAvailable); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Current Balance</label>
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="current_balance" id="current_balance" onChange="calculateBalance(); return false;"  placeholder="Ex: 1500.00" value="<?php echo set_value('current_balance', isset($user) ? $user->current_balance : $accountCurrentBalance); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Monthly Payment</label>
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="current_balance" id="current_balance" onChange="calculateBalance(); return false;"  placeholder="Ex: 1500.00" value="<?php echo set_value('current_balance', isset($user) ? $user->current_balance : $accountCurrent); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?> pt-3">
	<div class="col-md-4"></div>
	<div class="col-12 col-md-8">
		<div class="row">
			<div class="col-6 px-1">                   
				<a class="btn btn-secondary btn-block" href="<?php echo site_url('/Wallets'); ?>">Cancel</a>
			</div>
			<div class="col-6 px-1">                   
				<input class="btn btn-primary btn-block" type="submit" name="register" id="addNewWalletSubmit" value="Submit" />
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function calculateBalance()
{
	var credit_limit 		                                        = document.getElementById('credit_limit').value;
	var current_balance 		                                    = document.getElementById('current_balance').value;
    
	var available_balance                                           = credit_limit - current_balance;  
	// Update Field Displays
	document.getElementById('available_balance').value			    = available_balance.toFixed(2);

}
</script> 
