<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
// Classify Beta State of Platform
$beta                               = $this->config->item('beta');

// Define MyMI Gold Cost Configurations
$trans_fee                          = $this->config->item('trans_fee');
$trans_percent                      = $this->config->item('trans_percent');
$user_gas_fee                       = $this->config->item('gas_fee');
// print_r($_SESSION);
// Define User-Defined Variables
// print_r($_SESSION);
if (!empty($_SESSION['allSessionData'])) {
    $userAccount                    = $_SESSION['allSessionData']['userAccount']; 
}
// echo '<br>' . $cuID; 
// $userInfo                   = $this->mymiuser->get_user_information($cuID); 
if (!empty($userAccount)) {
    $cuID                           = $userAccount['cuID'];
    $cuEmail                        = $userAccount['cuEmail'];
    $cuUsername                     = $userAccount['cuUsername'];
    $walletID                       = $userAccount['walletID']; 
} else {
    $cuID                           = $_SESSION['user_id'];
    $this->db->from('bf_users');
    $this->db->where('id', $cuID); 
    $getUserInfo                    = $this->db->get(); 
    if (!empty($getUserInfo->result_array())) {
        echo '<script>console.log("Using Direct Connection in Add Wallet");</script>';
        foreach ($getUserInfo->result_array() as $userInfo) {
            $cuEmail                = $userInfo['email'];
            $cuUsername             = $userInfo['username'];
            $walletID               = $userInfo['wallet_id'];
        }

    }
}
// Form Error Classes passed to Form View File in $fieldData Array
$errorClass                         = empty($errorClass) ? ' error' : $errorClass;
$controlClass                       = empty($controlClass) ? 'span6' : $controlClass;

// Example of URL: /Wallets/Accounting/Add/Account
$accountType                        = $this->uri->segment(2);
$recordType                         = $this->uri->segment(4);

// Set Data Arrays & Configurations based on $accountType
if ($recordType === 'Account') {
    $purchaseType                   = 'Manual';
    $redirectURL                    = site_url('/Wallets');
    if ($accountType === 'Accounting') {
        $addModalTitle              = 'Create Business ' . $accountType . ' Wallet';
        $pageView                   = 'User/Wallets/Add_Account/accounting_fields';
        // $redirectURL        = site_url('/Wallets');
    } elseif ($accountType === 'Banking') {
        $addModalTitle              = 'Create ' . $accountType . ' Wallet';
        $connectModalTitle          = 'Bank Account';
        $pageView                   = 'User/Wallets/Add_Account/banking_fields';
        // $redirectURL        = site_url('/Wallets');
    } elseif ($accountType === 'Credit') {
        $addModalTitle              = 'Create ' . $accountType . ' Wallet';
        $pageView                   = 'User/Wallets/Add_Account/credit_fields';
        $connectModalTitle          = 'Credit Card';
        // $redirectURL        = site_url('/Wallets');
    } elseif ($accountType === 'eCommerce') {
        $addModalTitle              = 'Create ' . $accountType . ' Wallet';
        $connectModalTitle          = 'eCommerce Account';
        $pageView                   = 'User/Wallets/Add_Account/ecommerce_fields';
        // $redirectURL        = site_url('/Wallets');
    } elseif ($accountType === 'Investment') {
        $addModalTitle              = 'Create ' . $accountType . ' Wallet';
        $connectModalTitle          = 'Brokerage Account';
        $pageView                   = 'User/Wallets/Add_Account/investment_fields';
        // $redirectURL        = site_url('/Wallets');
    } else {
        $addModalTitle              = 'New Account';
        $pageView                   = 'User/Wallets/Add_Account/default_fields';
        // $redirectURL        = site_url('/Wallets');
    }
} else {
    $addModalTitle                  = 'Create New Account';
    $connectModalTitle              = 'Connect Account';
    $pageView                       = 'User/Wallets/Add_Account/default_fields';
    $purchaseType                   = 'Manual';
    $redirectURL                    = site_url('/Wallets');
}
$fieldData = array(     
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
);
// print_r($fieldData);
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
    $recordType                     = 'Account';
    // $accountType                     = 'Banking';
    $accountType                    = 'Investment';
    // $accountType                     = 'Accounting';
    // $accountType                     = 'eCommerce';
    echo '
    <div class="row justify-content-center pb-5">
        <div class="col-4">   
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
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  <span aria-hidden="true">&times;</span>
	</button>
</div> 
<div class="modal-body">
    <!-- <div class="row justify-content-center pb-3">
        <div class="col-12">
            <div class="card card-bordered pricing">
                <div class="card-body">
                    <h4 class="card-title">Connect Your <?php //echo $connectModalTitle; ?></h4>
                    <p class="card-description">Search for your bank</p>	
                    <div class="text-center">
                        <button class="btn btn-primary text-white" id="link-button">Search Institutions</button>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="row justify-content-center">
        <div class="col-12">
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
                        </fieldset>
                    <?php echo form_close(); ?>	
                    <?php if (validation_errors()) : ?>
                    <div class="alert alert-error fade in">
                        <?php echo validation_errors(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
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