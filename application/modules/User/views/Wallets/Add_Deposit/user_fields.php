<?php /* /users/views/user_fields.php */
$this->load->library('MyMIUser');
date_default_timezone_set('America/Chicago');
$date                   = date("F jS, Y");
$hostTime               = date("g:i A");
$time                   = date("g:i A", strtotime($hostTime) - 60 * 60 * 5);
$currentMethod          = $this->router->fetch_method();

$errorClass             = empty($errorClass) ? ' error' : $errorClass;
$controlClass           = empty($controlClass) ? 'span4' : $controlClass;
$registerClass          = $currentMethod == 'register' ? ' required' : '';
$editSettings           = $currentMethod == 'edit';
// Set Form Config
$formGroup				= $this->config->item('form_container');
$formLabel				= $this->config->item('form_label');
$formConCol				= $this->config->item('form_control_column');
$formControl			= $this->config->item('form_control');
$formSelect				= $this->config->item('form_select');
$formSelectPicker		= $this->config->item('form_selectpicker');
$formText				= $this->config->item('form_text');
$formCustomText			= $this->config->item('form_custom_text');
$redirectURL            = $this->uri->uri_string();
$cuID					= $userAccount['cuID'];
$cuEmail                = $userAccount['cuEmail'];
$walletType             = $userAccount[''];
$walletBroker           = '';
$walletNickname         = '';
// $getWallets				= $userAccountInfo['getWallets'];
?>
<?php
print_r($userAccount); 
$getAllWallets			= $this->wallet_model->get_all_wallets($cuID)->result_array();
$getWalletJSON			= json_encode($getAllWallets);
?>
<style>
.table th, .table td {
    font-size: 0.6rem;
    font-weight: bold;
}
</style>
<span style="display:none;" id="userWalletFetch">
	[
		<?= print_r($getAllWallets); ?>
	]
</span>
<h4 class="card-title">Add Deposit Information</h4>
<p class="card-description"> Please fill out information below</p>			
<hr>
<input type="hidden" class="form-control" name="trans_mode" id="trans_mode" value="<?php echo set_value('trans_mode', isset($user) ? $user->trans_mode : 'Track Deposit'); ?>">	
<input type="hidden" class="form-control" name="redirectURL" id="redirectURL" value="<?php echo set_value('redirectURL', isset($user) ? $user->redirectURL : $redirectURL); ?>">	
<input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">	
<input type="hidden" class="form-control" name="user_email" id="user_email" value="<?php echo set_value('user_email', isset($user) ? $user->user_email : $cuEmail); ?>">	
<input type="hidden" class="form-control" name="type" id="type" value="<?php echo set_value('type', isset($user) ? $user->type : $walletType); ?>">
<input type="hidden" class="form-control" name="broker" id="broker" value="<?php echo set_value('broker', isset($user) ? $user->broker : $walletBroker); ?>">
<div class="<?php echo $formGroup; ?>">    
	<label class="<?php echo $formLabel; ?>" for="default-01">Date</label>    
	<div class="<?php echo $formConCol; ?>">        
		<input type="date" class="<?php echo $formControl; ?>" name="trans_date" id="trans_date" placeholder="Enter Deposit Wallet" value="<?php echo set_value('trans_date', isset($user) ? $user->trans_date : ''); ?>">	
	</div>
</div>
<div class="<?php echo $formGroup; ?>">    
	<label for="wallet_id" class="<?php echo $formLabel; ?>">Account</label>
	<div class="<?php echo $formConCol; ?>">
		<?php
            echo '
			<select class="' . $formSelectPicker . '" name="wallet_id" id="wallet_id" data-live-search="true" required="required">			
				<option>Select-Account</option>
				';
                            
                foreach ($getAllWallets as $allWallets) {
                    $getNickname					= $allWallets['nickname'];
                    if (!empty($getNickname)) {
                        $nickname					= ' - ' . $getNickname;
                    } else {
                        $nickname					= '';
                    }
                    $wallet_id_values = array(
                        $allWallets['id'] => $allWallets['broker'] . $nickname,
                    );
                    foreach ($wallet_id_values as $value => $display_text) {
                        $selected = ($value == $this->input->post('wallet_id')) ? ' selected="selected"' : "";
    
                        echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                    }
                }
            echo '</select>';
        ?>		  
	</div>
</div>
<div class="<?php echo $formGroup; ?>">    
	<label class="<?php echo $formLabel; ?>" for="default-01">Deposit Amount</label>    
	<div class="<?php echo $formConCol; ?>">        
		<input type="text" class="<?php echo $formControl; ?>" name="amount" id="amount" placeholder="Enter Wallet Amount" value="<?php echo set_value('amount', isset($user) ? $user->amount : ''); ?>">	
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
				<input class="btn btn-primary btn-block" type="submit" name="register" id="trackDepositSubmit" value="Submit" />
			</div>
		</div>
	</div>
</div>
<input type="hidden" class="form-control" name="nickname" id="nickname" value="<?php echo set_value('nickname', isset($user) ? $user->nickname : $walletNickname); ?>">
