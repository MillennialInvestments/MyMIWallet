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
foreach ($walletAccount as $account) { 
    $accountID                  = $account['id'];
    $accountBeta                = $account['beta'];
    $accountStatus              = $account['status'];
    $accountDate                = $account['date'];
    $accountTime                = $account['time'];
    $accountUserID              = $account['user_id'];
    $accountUserEmail           = $account['user_email']; 
    $accountUsername            = $account['username'];
    $accountWalletID            = $account['wallet_id'];
    $accountType                = $account['account_type'];
    $accountOwner               = $account['bank_account_owner'];
    $accountBank                = $account['bank_name'];
    $accountRouting             = $account['routing_number'];
    $accountNumber              = $account['account_number'];
    $accountNickname            = $account['nickname'];
    $accountBalance             = $account['balance'];
}
?>
<?php
// Set up Validation for whether or not we accept Third-Party Accounts
?>		                
<h4 class="card-title">Account Information</h4>
<p class="card-description"> Please fill out information below</p>			
<hr>
<input type="hidden" name="form_mode" id="form_mode" value="<?php echo set_value('form_mode', isset($user) ? $user->form_mode : 'Edit'); ?>">	
<input type="hidden" name="redirectURL" id="redirectURL" value="<?php echo set_value('redirectURL', isset($user) ? $user->redirectURL : $redirectURL); ?>">	
<input type="hidden" name="beta" id="beta" value="<?php echo set_value('beta', isset($user) ? $user->beta : $beta); ?>">	
<input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $accountUserID); ?>">	
<input type="hidden" class="form-control" name="user_email" id="user_email" value="<?php echo set_value('user_email', isset($user) ? $user->user_email : $cuEmail); ?>">
<input type="hidden" class="form-control" name="username" id="username" value="<?php echo set_value('username', isset($user) ? $user->username : $cuUsername); ?>">
<input type="hidden" class="form-control" name="wallet_id" id="wallet_id" value="<?php echo set_value('wallet_id', isset($user) ? $user->wallet_id : $walletID); ?>">	
<input type="hidden" class="form-control" name="wallet_type" id="wallet_type" value="<?php echo set_value('wallet_type', isset($user) ? $user->wallet_type : $walletType); ?>">
<input type="hidden" class="form-control" name="purchase_type" id="purchase_type" value="<?php echo set_value('purchase_type', isset($user) ? $user->purchase_type : $purchaseType); ?>">
<input type="hidden" class="form-control" name="account_id" id="account_id" value="<?php echo set_value('account_id', isset($user) ? $user->account_id : $accountID); ?>">	
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Name of Bank</label>
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="bank_name" id="bank_name" placeholder="Ex: Capital One Bank" value="<?php echo set_value('bank_name', isset($user) ? $user->bank_name : $accountBank); ?>">	
	</div>
</div>	
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Account Type</label>
	<div class="col-12">    
        <select name="account_type" class="<?php echo $formSelectPicker; ?>" id="account_type" onchange="showDiv(this)" required="required" style="height: 40px; padding: 10px;">
            <?php
                $account_type_values = array(
                    $accountType                    => $accountType,
                    'N/A'                           => 'Select-An-Option',
                    'Checking'    		            => 'Checking',
                    'Saving'    		            => 'Saving',
                );
                foreach ($account_type_values as $value => $display_text) {
                    $selected = ($value == $this->input->post('account_type')) ? ' selected="selected"' : "";

                    echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                }
            ?>
        </select>
	</div>
</div>
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Is your name on the account?</label>
	<div class="col-12">    
        <select name="bank_account_owner" class="<?php echo $formSelectPicker; ?>" id="bank_account_owner" onchange="showDiv(this)" required="required" style="height: 40px; padding: 10px;">
            <?php
                $bank_account_owner_values = array(
                    $accountOwner                   => $accountOwner,
                    'N/A'                           => 'Select-An-Option',
                    'Yes'    		                => 'Yes',
                    'No'    		                => 'No',
                );
                foreach ($bank_account_owner_values as $value => $display_text) {
                    $selected = ($value == $this->input->post('bank_account_owner')) ? ' selected="selected"' : "";

                    echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                }
            ?>
        </select>
	</div>
</div>
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Routing Number</label>
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="routing_number" id="routing_number" placeholder="Ex: 123456789" value="<?php echo set_value('routing_number', isset($user) ? $user->routing_number : $accountRouting); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Account Number</label>
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="account_number" id="account_number" placeholder="Ex: 012345678910" value="<?php echo set_value('account_number', isset($user) ? $user->account_number : $accountNumber); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Create Nickname for Account</label>
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="nickname" id="nickname" placeholder="Ex: Main Banking Account" value="<?php echo set_value('nickname', isset($user) ? $user->nickname : $accountNickname); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Current Account Balance</label>
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="balance" id="balance" placeholder="Ex: 1500.00" value="<?php echo set_value('balance', isset($user) ? $user->balance : $accountBalance); ?>">	
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
<hr>
<!--
<p style="font-size:0.65rem;">
By proceeding, you acknowledge and agree that your transaction is governed by the Terms of Service, the Terms of Service Addendum for Card Payments and the Privacy Policy. All transactions are final.	
</p>
<p style="font-size:0.65rem;">
Your card-issuing bank may charge a foreign transaction fee or another type of fee. Any fees charged by your bank are separate from and in addition to the card processing fee charged by Bittrex. By proceeding, you also acknowledge that you are solely responsible for paying any fees charged by your bank.
</p>
-->

