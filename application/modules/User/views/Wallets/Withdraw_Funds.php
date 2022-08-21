<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass   				= empty($errorClass) ? ' error' : $errorClass;
$controlClass 				= empty($controlClass) ? 'span6' : $controlClass;
$redirectURL                = 'Exchange';
$cuID                       = $_SESSION['allSessionData']['userAccount']['cuID'];
$cuEmail                    = $_SESSION['allSessionData']['userAccount']['cuEmail'];
$walletID                   = $_SESSION['allSessionData']['userDefaultWalletInfo']['walletID'];
$walletBroker               = $_SESSION['allSessionData']['userDefaultWalletInfo']['walletBroker'];
$walletNickname             = $_SESSION['allSessionData']['userDefaultWalletInfo']['walletNickname'];
$walletFunds                = $_SESSION['allSessionData']['userDefaultWalletInfo']['walletFunds'];
$walletAmount               = $_SESSION['allSessionData']['userDefaultWalletInfo']['walletAmount'];
$walletInitialAmount        = $_SESSION['allSessionData']['userDefaultWalletInfo']['walletInitialAmount'];
$depositAmount              = $_SESSION['allSessionData']['userDefaultWalletInfo']['depositAmount'];
$withdrawAmount             = $_SESSION['allSessionData']['userDefaultWalletInfo']['withdrawAmount'];
$fieldData = array(
    'errorClass'   			=> $errorClass,
    'controlClass'  		=> $controlClass,
    'redirectURL'			=> $redirectURL,
    'cuID'					=> $cuID,
    'cuEmail'				=> $cuEmail,
    'walletID'				=> $walletID,
    'walletBroker'			=> $walletBroker,
    'walletNickname'	    => $walletNickname,
    'walletFunds'			=> $walletFunds,
    'walletAmount'			=> $walletAmount,
    'walletInitialAmount'	=> $walletInitialAmount,
    'depositAmount'			=> $depositAmount,
    'withdrawAmount'		=> $withdrawAmount,
);
?>  
<?php echo form_open('Withdraw-Funds', array('class' => "form-horizontal", 'id' => "withdraw-funds-form", 'autocomplete' => 'off')); ?>  

			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Withdraw Funds (USD)</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"> 
				<div class="nk-block">
					<div class="row gy-gs">
						<div class="col-lg-12 col-xl-12">
							<div class="nk-block">
								<div class="nk-block-head-xs">
									<div class="nk-block-head-content">
										<p>
											<strong>About Electronic (ACH) Connections</strong> 
										</p>
										<ul style="list-style:circle; font-size:0.75rem">
											<li>Are needed to transfer money to or from your bank</li>
											<li>Include a validation step for your security</li>
											<li>Take 2-3 Business Days in total</li>
											<li>Can be done with joint bank accounts</li>
											<li>Learn more about connecting a bank account for electronic (ACH) transfers</li>
										</ul>	 						
									</div>
								</div>
							</div>
							<div class="nk-block pt-1">
								<div class="row">
									<div class="col-lg-12">
										<fieldset>
											<?php
                                            Template::block('User/Wallets/Withdraw_Funds/user_fields', 'User/Wallets/Withdraw_Funds/user_fields', $fieldData);
                                            ?>
										</fieldset>
										<fieldset>
											<?php
                                            // Allow modules to render custom fields. No payload is passed
                                            // since the user has not been created, yet.
                                            Events::trigger('render_user_form');
                                            ?>
											<!-- Start of User Meta -->
											<?php //$this->load->view('users/user_meta', array('frontend_only' => true));?>
											<!-- End of User Meta -->
										</fieldset>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> 
		</div>
	</div>
</div>	
<?php echo form_close(); ?>	
<?php if (validation_errors()) : ?>
	<div class="alert alert-error fade in">
		<?php echo validation_errors(); ?>
	</div>
<?php endif; ?>
<?php $this->load->view('User/Wallets/Create_Bank_Accounts'); ?>
<script>
function calculateWithdraw()
{
	// Get Variables
	//var account_balance												= <?php //$walletAmount;?>;
	var withdraw_amount												= document.getElementById('withdraw_amount').value;
	var remaining_balance											= account_balance - withdraw_amount;   
	var alertText 													= "Amount must be $" + account_balance + " or less!";
	
	console.log(account_balance);
	console.log(withdraw_amount);
	console.log(remaining_balance);
	if (isNaN(withdraw_amount) || withdraw_amount > account_balance) {
		alert(alertText);
		document.getElementById("withdraw_amount").value 			= 0;
	 }
	
	document.getElementById('account_balance').innerHTML			= account_balance; 
	document.getElementById('withdraw_amount_display').innerHTML	= withdraw_amount; 
	document.getElementById('remaining_balance').innerHTML			= remaining_balance; 
}   
</script>
<script>
function openCreateBankAccountModal()
{
	$('#create_bank_account').modal('show');
}
</script>
