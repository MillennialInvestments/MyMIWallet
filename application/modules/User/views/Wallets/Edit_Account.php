<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
// Classify Beta State of Platform
$beta                                   = $this->config->item('beta');

// Define MyMI Gold Cost Configurations
$trans_fee                              = $this->config->item('trans_fee');
$trans_percent                          = $this->config->item('trans_percent');
$user_gas_fee                           = $this->config->item('gas_fee');

// Define User-Defined Variables
$userAccount                            = $_SESSION['allSessionData']['userAccount'];
$cuID                                   = $userAccount['cuID']; 
$cuEmail                                = $userAccount['cuEmail']; 
$cuUsername                             = $userAccount['cuUsername'];
$walletID                               = $userAccount['walletID'];

// Form Error Classes passed to Form View File in $fieldData Array
$errorClass                             = empty($errorClass) ? ' error' : $errorClass;
$controlClass                           = empty($controlClass) ? 'span6' : $controlClass;

// Example of URL: /Wallets/Accounting/Add/Account
$accountType                            = $this->uri->segment(2);
$recordType                             = $this->uri->segment(4);
$accountID                              = $this->uri->segment(5);

// Set Data Arrays & Configurations based on $accountType
if ($recordType === 'Account') {
    $purchaseType                       = 'Manual';
    $redirectURL                        = site_url('/Wallets');
    if ($accountType === 'Accounting') {
        $addModalTitle                  = 'Edit Business ' . $accountType . ' Wallet';
        $pageView                       = 'User/Wallets/Edit_Account/accounting_fields';
        $getUserAccount                 = array();
        // $redirectURL        = site_url('/Wallets');
    } elseif ($accountType === 'Banking') {
        $addModalTitle                  = 'Edit ' . $accountType . ' Wallet';
        $pageView                       = 'User/Wallets/Edit_Account/banking_fields';
        $getUserAccount                 = $this->accounts_model->get_bank_account_info($accountID);
        // $redirectURL        = site_url('/Wallets');
    } elseif ($accountType === 'Credit') {
        $addModalTitle                  = 'Edit ' . $accountType . ' Wallet';
        $pageView                       = 'User/Wallets/Edit_Account/credit_fields';
        $getUserAccount                 = $this->accounts_model->get_credit_account_info($accountID);
        // $redirectURL        = site_url('/Wallets');
    } elseif ($accountType === 'Debt') {
        $addModalTitle                  = 'Edit ' . $accountType . ' Wallet';
        $pageView                       = 'User/Wallets/Edit_Account/debt_fields';
        $getUserAccount                 = $this->accounts_model->get_user_debt_accounts($accountID);
        // print_r($getDebtAccounts->result_array()); 
        // $redirectURL        = site_url('/Wallets');
    } elseif ($accountType === 'eCommerce') {
        $addModalTitle                  = 'Edit ' . $accountType . ' Wallet';
        $pageView                       = 'User/Wallets/Edit_Account/ecommerce_fields';
        $getUserAccount                 = array();
        // $redirectURL        = site_url('/Wallets');
    } elseif ($accountType === 'Investment') {
        $addModalTitle                  = 'Edit ' . $accountType . ' Wallet';
        $pageView                       = 'User/Wallets/Edit_Account/investment_fields';
        $getUserAccount                 = $this->accounts_model->get_invest_account_info($accountID);
        // $redirectURL        = site_url('/Wallets');
    } else {
        $addModalTitle                  = 'Edit Account Wallet';
        $pageView                       = 'User/Wallets/Edit_Account/default_fields';
        $getUserAccount                 = array();
        // $redirectURL        = site_url('/Wallets');
    }
    // echo $accountID . '<br>'; 
    // $this->db->from('bf_users_budgeting');
    // $this->db->where('wallet_id', $accountID);
    // $getAccountTransactions             = $this->db->get();
    $getAccountTransactions             = $this->accounts_model->get_account_transactions($accountID);
    // print_r($getAccountTransactions->result_array());
    $fieldData                          = array(
        'errorClass'                    => $errorClass,
        'controlClass'                  => $controlClass,
        'redirectURL'                   => $redirectURL,
        'beta'                          => $beta,
        'cuID'                          => $cuID,
        'cuEmail'                       => $cuEmail,
        'cuUsername'                    => $cuUsername,
        'walletID'                      => $walletID,
        'beta'                          => $beta,
        'walletType'                    => $accountType,
        'purchaseType'                  => $purchaseType,
        'accountID'                     => $accountID,
        'getUserAccount'                => $getUserAccount,
    );

    $viewData                           = array(
        'accountType'                   => $accountType,
        'getAccountTransactions'        => $getAccountTransactions,
    );
} else {
    $addModalTitle                      = 'Create New Account';
    $redirectURL                        = site_url('/Wallets');
}

// Log User Activity Activation
$this->mymilogger
->user($cuID) //Set UserID, who created this  Action
->beta($beta) //Set whether in Beta or nto
->type('Wallets') //Entry type like, Post, Page, Entry
->controller($this->router->fetch_class())
->method($this->router->fetch_method())
->url($this->uri->uri_string())
->full_url(current_url())
->comment('Add') //Token identify Action
->log(); //Add Database Entry

// Configuration Preview
if ($this->uri->segment(1) === 'Content-Creator') {

    // $accountType Testing Fields
    $recordType                 = 'Account';
    // $accountType                = 'Banking';
    $accountType                = 'Investment';
    // $accountType                = 'Accounting';
    // $accountType                = 'eCommerce';
    echo '
    <div class="row justify-content-center pb-5">
        <div class="col-12 col-sm-4">   
            <div class="card card-bordered pricing">
                <div class="card-header">
                    <div class="card-title">
                        <h6>Current Testing Configuration</h6>
                    </div>
                </div>
                <div class="card-body">
                    <strong>$recordType:</strong> ' . $recordType . '
                    <br>
                    <strong>$accountType:</strong> ' . $accountType . '
                </div>
            </div>
        </div>
    </div>
    ';
    }
?>


<div class="modal-header">
	<h3 class="modal-title" id="useCoinModalLabel"><?= $addModalTitle; ?></h3>
	<a type="button" class="close" href="<?php echo site_url('/Wallets'); ?>">
	  <em class="icon ni ni-arrow-from-left"></em>
	</a>
</div> 
<div class="modal-body">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-4">
            <div class="card card-bordered pricing">
                <div class="card-body">
                    <form class="form-horizontal" id="add_user_wallet">
                        <fieldset>
                            <?php
                            Template::block($pageView, $pageView, $fieldData);
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
                        <!-- <fieldset>
                            <div class="control-group">
                                <div class="controls ml-3">
                                    <input class="btn btn-primary" type="submit" name="register" id="addNewWalletSubmit" value="Submit" />
                                </div>
                            </div>
                        </fieldset> -->
                    <?php echo form_close(); ?>	
                    <?php if (validation_errors()) : ?>
                    <div class="alert alert-error fade in">
                        <?php echo validation_errors(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-sm-8 col-12">
            <?php $this->load->view('User/Wallets/Edit_Account/transaction_history', $viewData); ?>
        </div>
    </div>
</div>
<script type="text/javascript"> 
const addNewWalletForm		    = document.querySelector("#add_user_wallet");
const addNewWalletSubmit	    = {};
if (addNewWalletForm) { 
    addNewWalletForm.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		addNewWalletForm.querySelectorAll("input").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            addNewWalletSubmit[inputField.name] = inputField.value;
        });  
        addNewWalletForm.querySelectorAll("select").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            addNewWalletSubmit[inputField.name] = inputField.value;
        });  
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        // console.log(addNewWalletSubmit);
        // console.log(JSON.stringify(addNewWalletSubmit));
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('User/Wallets/Wallet_Manager'); ?>", {
			
			method: "POST",
			body: JSON.stringify(addNewWalletSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
            const data = await result;
		    location.href = <?php echo '\'' . $redirectURL . '\'';?>;
            console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 
