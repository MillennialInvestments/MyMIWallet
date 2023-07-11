<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass                         = empty($errorClass) ? ' error' : $errorClass;
$controlClass                       = empty($controlClass) ? 'span6' : $controlClass;
$beta                               = $this->config->item('beta');
$userAccount                        = $_SESSION['allSessionData']['userAccount'];
$cuID                               = $userAccount['cuID']; 
$cuEmail                            = $userAccount['cuEmail']; 
$walletID                           = $userAccount['walletID'];
$accountType                        = $this->uri->segment(1);
$accountID                          = $this->uri->segment(3);
if ($accountType === 'Bank-Account') {
    $accountTypeText        = 'Bank Account';
    $addModalTitle          = 'Edit Bank Account';
    $pageView               = 'User/Wallets/Edit_Bank_Account/user_fields';
    $redirectURL            = site_url('/Wallets');
    $this->db->from('bf_users_bank_accounts');
    $this->db->where('id', $accountID); 
    $getBankAccountInfo     = $this->db->get();
    foreach ($getBankAccountInfo->result_array() as $accountInfo) {
        $accountStatus      = $accountInfo['status'];
        $accountType        = $accountInfo['account_type'];
        $accountBank        = $accountInfo['bank_name'];
        $accountOwner       = $accountInfo['bank_account_owner'];
        $accountRoutNum     = $accountInfo['routing_number'];
        $accountNumber      = $accountInfo['account_number'];
        $accountName        = $accountInfo['nickname'];
        $accountBalance     = $accountInfo['balance'];
    }
    $fieldData = array(
        'errorClass'        => $errorClass,
        'controlClass'      => $controlClass,
        'redirectURL'       => $redirectURL,
        'cuID'              => $cuID,
        'cuEmail'           => $cuEmail,
        'accountID'         => $accountID,
        'accountType'       => $accountType,
        'accountTypeText'   => $accountTypeText,
        'accountBank'       => $accountBank,
        'accountOwner'      => $accountOwner,
        'accountRoutNum'    => $accountRoutNum,
        'accountNumber'     => $accountNumber,
        'accountName'       => $accountName,
        'accountBalance'            => $accountBalance,
    );
} elseif ($accountType === 'Wallet') {
    $accountTypeText                = 'Wallet';
    $purchaseType                   = $this->uri->segment(2);
    $pageView                       = 'User/Wallets/Edit/user_fields';
    $tutorialView                   = 'User/Wallets/Details/wallets';
    $beta                           = $this->config->item('beta');
    $walletID					    = $this->uri->segment(3);
    $userWalletInfo                 = $this->mymiwallets->get_wallet_info($cuID, $walletID);
    $walletType                     = $userWalletInfo['walletType'];
    $walletBroker                   = $userWalletInfo['walletBroker'];
    $walletAccountID                = $userWalletInfo['walletAccountID'];
    $walletAccessCode               = $userWalletInfo['walletAccessCode'];
    $walletPremium                  = $userWalletInfo['walletPremium'];
    $walletInitialAmount            = $userWalletInfo['walletInitialAmount'];
    $walletTitle                    = $userWalletInfo['walletTitle'];
    $walletNickname                 = $userWalletInfo['walletNickname'];
    $walletDefault                  = $userWalletInfo['walletDefault'];
    $walletExchange                 = $userWalletInfo['walletExchange'];
    $walletMarketPair               = $userWalletInfo['walletMarketPair'];
    $walletMarket                   = $userWalletInfo['walletMarket'];
    if ($userWalletInfo['walletAmount'] > 0) {
        $walletAmount               = '$' . number_format($userWalletInfo['walletAmount']);
    } elseif ($userWalletInfo['walletAmount'] < 0) {
        $walletAmount               = '-$' . number_format($userWalletInfo['walletAmount']);
    } else {
        $walletAmount               = '$0.00';
    }
    if ($userWalletInfo['walletTotalAmount'] > 0) {
        $walletTotalAmount          = '$' . number_format($userWalletInfo['walletTotalAmount']);
    } elseif ($userWalletInfo['walletTotalAmount'] < 0) {
        $walletTotalAmount          = '-$' . number_format($userWalletInfo['walletTotalAmount']);
    } else {
        $walletTotalAmount          = '$0.00';
    }
    if ($userWalletInfo['walletGains'] > 0) {
        $walletGains                = '$' . number_format($userWalletInfo['walletGains']);
    } elseif ($userWalletInfo['walletGains'] < 0) {
        $walletGains                = '-$' . number_format($userWalletInfo['walletGains']);
    } else {
        $walletGains                = '$0.00';
    }
    if ($userWalletInfo['depositAmount'] > 0) {
        $depositAmount              = '$' . number_format($userWalletInfo['depositAmount']);
    } elseif ($userWalletInfo['depositAmount'] < 0) {
        $depositAmount              = '-$' . number_format($userWalletInfo['depositAmount']);
    } else {
        $depositAmount              = '$0.00';
    }
    if ($userWalletInfo['withdrawAmount'] > 0) {
        $withdrawAmount             = '$' . number_format($userWalletInfo['withdrawAmount']);
    } elseif ($userWalletInfo['withdrawAmount'] < 0) {
        $withdrawAmount             = '-$' . number_format($userWalletInfo['withdrawAmount']);
    } else {
        $withdrawAmount             = '$0.00';
    }
    if ($userWalletInfo['percentChange'] > 0) {
        $percentChange              = '$' . number_format($userWalletInfo['percentChange']);
    } elseif ($userWalletInfo['percentChange'] < 0) {
        $percentChange              = '-$' . number_format($userWalletInfo['percentChange']);
    } else {
        $percentChange              = '$0.00';
    }
    $transferBalance                = $userWalletInfo['depositAmount'] - $userWalletInfo['withdrawAmount'];
    if ($transferBalance > 0) {
        $transferBalance            = '$' . number_format($transferBalance);
    } elseif ($transferBalance < 0) {
        $transferBalance            = '-$' . number_format($transferBalance);
    } else {
        $transferBalance            = '$0.00';
    }
    $totalTrades                    = number_format($userWalletInfo['totalTrades'],0);
    
    $this->db->select_sum('closed_perc');
    $this->db->from('bf_users_trades');
    $this->db->where('wallet', $walletID);
    $getAllPercentChange		    = $this->db->get();
    foreach ($getAllPercentChange->result_array() as $walletTrades) {
        $percent_change			    = $walletTrades['closed_perc'];
        if ($percent_change === null) {
            $percentChange		    = '<span">0%</span>';
        } elseif ($percent_change >= 0) {
            $percentChange		    = '<span class="text-success">' . $percent_change . '%</span>';
        } else {
            $percentChange		    = '<span class="text-danger">' . $percent_change . '%</span>';
        }
    }
    $addModalTitle                  = 'Edit ' . $walletNickname . ' Wallet';
    $tutorialData                   = array(
        'walletID'                  => $walletID,
        'walletBroker'              => $walletBroker,
        'walletAccountID'           => $walletAccountID,
        'walletAccessCode'          => $walletAccessCode,
        'walletPremium'             => $walletPremium,
        'walletTitle'			    => $walletTitle,
        'walletNickname'		    => $walletNickname,
        'walletDefault'		        => $walletDefault,
        'walletExchange'			=> $walletExchange,
        'walletMarketPair'  	    => $walletMarketPair,
        'walletMarket'			    => $walletMarket,
        'walletGains'   		    => $walletGains,
        'walletAmount'  		    => $walletAmount,
        'depositAmount'             => $depositAmount,
        'withdrawAmount'            => $withdrawAmount,
        'transferBalance'           => $transferBalance,
        'percentChange'             => $percentChange,
        'totalTrades'               => $totalTrades,
    );
    $fieldData                      = array(
        'errorClass'                => $errorClass,
        'controlClass'              => $controlClass,
        'purchaseType'	            => $purchaseType,
        'accountTypeText'           => $accountTypeText,
        'walletID'                  => $accountID,
        'walletType'	            => $walletType,
        'walletBroker'	            => $walletBroker,
        'walletNickname'            => $walletNickname,
        'walletAmount'	            => $walletAmount,
        'walletInitialAmount'	    => $walletInitialAmount,
        'walletAccountID'           => $walletAccountID,
        'walletAccessCode'          => $walletAccessCode,
    );
    
}
$this->mymilogger
     ->user($cuID) //Set UserID, who created this  Action
     ->beta($beta) //Set whether in Beta or nto
     ->type($accountTypeText) //Entry type like, Post, Page, Entry
     ->controller($this->router->fetch_class())
     ->method($this->router->fetch_method())
     ->url($this->uri->uri_string())
     ->full_url(current_url())
     ->token($accountID)
     ->comment('Edit') //Token identify Action
     ->log(); //Add Database Entry
?>
<div class="nk-block">
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card card-bordered pricing">
                <div class="pricing-head">
                    <div class="pricing-title">
                        <h4 class="card-title title"><?= $addModalTitle; ?></h4>
                        <p class="sub-text">Please fill out information below</p>
                    </div>
                </div>
                <div class="pricing-body">
                    <form class="form-horizontal" id="edit_user_wallets_account">
                        <fieldset>
                            <?php Template::block($pageView, $pageView, $fieldData); ?>
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
                        <fieldset>
                            <div class="pricing-action mt-0">
                                <div class="row pt-3">
                                    <div class="col-md-4"></div>
                                    <div class="col-12 col-md-8">
                                        <div class="row">
                                            <div class="col-6 px-1">                   
                                                <a type="button" class="btn btn-secondary btn-block" href="<?php echo site_url('/Wallets'); ?>?">Cancel</a>
                                            </div>
                                            <div class="col-6 px-1">                   
                                                <input class="btn btn-primary btn-block" type="submit" name="register" id="submit" value="Submit" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        <div class="col-12 col-md-8">
            <div class="row">
                <div class="col-12">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered pricing">
                            <div class="pricing-body">
                                <?php $this->load->view($tutorialView, $tutorialData); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
const editWalletsAccountForm		    = document.querySelector("#edit_user_wallets_account");
const editWalletsAccountSubmit	        = {};
if (editWalletsAccountForm) { 
    editWalletsAccountForm.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		editWalletsAccountForm.querySelectorAll("input").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            editWalletsAccountSubmit[inputField.name] = inputField.value;
        });  
        editWalletsAccountForm.querySelectorAll("select").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            editWalletsAccountSubmit[inputField.name] = inputField.value;
        });  
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        // console.log(editWalletsAccountSubmit);
        // console.log(JSON.stringify(editWalletsAccountSubmit));
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('User/Wallets/Wallet_Manager'); ?>", {
			
			method: "POST",
			body: JSON.stringify(editWalletsAccountSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
            const data = await result;
		    location.href = <?php echo '\'' . site_url('/Wallets/Link-Account/Confirm') . '\'';?>;
            console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 
