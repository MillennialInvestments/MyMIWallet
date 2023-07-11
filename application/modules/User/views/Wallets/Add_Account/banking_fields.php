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
?>
<?php
// Set up Validation for whether or not we accept Third-Party Accounts
?>		                
<h4 class="card-title">Add Account Information</h4>
<p class="card-description"> Please fill out information below</p>			
<hr>
<?php
if ($beta === 1) {
    ?>
<input type="hidden" id="beta" name="beta" value="<?php echo set_value('beta', isset($user) ? $user->beta : 'Yes'); ?>" /> 
<?php
} else {
        ?>             
<input type="hidden" id="beta" name="beta" value="<?php echo set_value('beta', isset($user) ? $user->beta : 'No'); ?>" /> 
<?php
    }
?>
<input type="hidden" name="form_mode" id="form_mode" value="<?php echo set_value('form_mode', isset($user) ? $user->form_mode : 'Add'); ?>">	
<input type="hidden" name="redirectURL" id="redirectURL" value="<?php echo set_value('redirectURL', isset($user) ? $user->redirectURL : $redirectURL); ?>">	
<input type="hidden" name="beta" id="beta" value="<?php echo set_value('beta', isset($user) ? $user->beta : $beta); ?>">	
<input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">	
<input type="hidden" class="form-control" name="user_email" id="user_email" value="<?php echo set_value('user_email', isset($user) ? $user->user_email : $cuEmail); ?>">
<input type="hidden" class="form-control" name="username" id="username" value="<?php echo set_value('username', isset($user) ? $user->username : $cuUsername); ?>">
<input type="hidden" class="form-control" name="wallet_id" id="wallet_id" value="<?php echo set_value('wallet_id', isset($user) ? $user->wallet_id : $walletID); ?>">	
<input type="hidden" class="form-control" name="wallet_type" id="wallet_type" value="<?php echo set_value('wallet_type', isset($user) ? $user->wallet_type : $walletType); ?>">
<input type="hidden" class="form-control" name="purchase_type" id="purchase_type" value="<?php echo set_value('purchase_type', isset($user) ? $user->purchase_type : $purchaseType); ?>">
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Name of Bank</label>
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="bank_name" id="bank_name" placeholder="Ex: Capital One Bank" value="<?php echo set_value('bank_name', isset($user) ? $user->bank_name : ''); ?>">	
	</div>
</div>	
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Account Type</label>
	<div class="col-12">    
        <select name="account_type" class="<?php echo $formSelectPicker; ?>" id="account_type" onchange="showDiv(this)" required="required" style="height: 40px; padding: 10px;">
            <?php
                $account_type_values = array(
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
		<input type="text" class="<?php echo $formControl; ?>" name="routing_number" id="routing_number" placeholder="Last 4 -OR- Full Routing # (Ex: 0123456789)" value="<?php echo set_value('routing_number', isset($user) ? $user->routing_number : ''); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Account Number</label>
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="account_number" id="account_number" placeholder="Last 4 -OR- 16-Digits (Ex: 012345678910)" value="<?php echo set_value('account_number', isset($user) ? $user->account_number : ''); ?>">	
	</div>
</div>
<!-- <div class="<?php //echo $formGroup; ?>">
	<label class="col-12">Re-enter Account Number</label>
	<div class="col-12">        
		<input type="text" class="<?php //echo $formControl; ?>" name="verify_account" id="verify_account" placeholder="Ex: 012345678910" value="<?php //echo set_value('verify_account', isset($user) ? $user->verify_account : ''); ?>">	
	</div>
</div> -->
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Create Nickname for Account</label>
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?>" name="nickname" id="nickname" placeholder="Ex: Main Banking Account" value="<?php echo set_value('nickname', isset($user) ? $user->nickname : ''); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">
	<label class="col-12">Current Account Balance</label>
	<div class="col-12">        
		<input type="text" class="<?php echo $formControl; ?> calculation" onChange="calculateExpression(this); return false;" name="balance" id="balance" placeholder="Ex: 1500.00" value="<?php echo set_value('balance', isset($user) ? $user->balance : ''); ?>">	
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

