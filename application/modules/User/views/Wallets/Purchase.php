<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$client                 = new \GuzzleHttp\Client(); 
$errorClass             = empty($errorClass) ? ' error' : $errorClass;
$controlClass           = empty($controlClass) ? 'span6' : $controlClass;
$featureType            = $this->uri->segment(1); 
$walletType			    = $this->uri->segment(2);
$cuUserType             = $_SESSION['allSessionData']['userAccount']['cuUserType'];
$cuID           		= $_SESSION['allSessionData']['userAccount']['cuID'];
$cuRealizeID    		= $_SESSION['allSessionData']['userAccount']['cuRealizeID'];
if ($featureType        === 'Purchase-Wallet' && $walletType === 'Fiat') {
    $featureRedirectURL = 'Wallets/Link-Account/Brokerage/Fiat';
} elseif ($featureType  === 'Purchase-Wallet' && $walletType === 'Digital') {
    $featureRedirectURL = 'Wallets/Link-Account/Brokerage/Digital';
}
if ($cuUserType === 'Beta') {
    // $bearer             = 'sk_test_whXrPvWLNuzLTqzwsbF0wQUwlRQS1c9v5YqpDSUMwcVhwD4m7FZuO0Z1jbyJxBXVj1eOYTyQq5F5JWiC6CK8TnWlHPcd5hmHLbTONbsu4HTrB29gG8Dp2GcjGVodTnQk';
    $bearer             = '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';
} else {
    $bearer             = 'sk_test_whXrPvWLNuzLTqzwsbF0wQUwlRQS1c9v5YqpDSUMwcVhwD4m7FZuO0Z1jbyJxBXVj1eOYTyQq5F5JWiC6CK8TnWlHPcd5hmHLbTONbsu4HTrB29gG8Dp2GcjGVodTnQk';
    // $bearer             = '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';
}
$response = $client->request('POST', 'https://www.realizefi.com/api/users/' . $cuRealizeID . '/auth_portals', [
    'body' => '{"scopes":["institution_link:read_and_trade"],"redirects":{"success":"http://localhost/MillennialInvest/Site-v7/v1.5/public/index.php/Wallets/Link-Account/Details","failure":"http://localhost/MillennialInvest/Site-v7/v1.5/public/index.php/Wallets/Link-Account/Details"}}',
    'headers' => [
      'Accept' => 'application/json',
      'Authorization' => 'Bearer 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',
      'Content-Type' => 'application/json',
    ],
]);
  
$clientAuth             = json_decode($response->getBody(), true); 
$redirect_url           = $clientAuth['url']; 
$fieldData = array(
    'errorClass'        => $errorClass,
    'controlClass'      => $controlClass,
    'featureType'	    => $featureType,
    'walletType'	    => $walletType,
    'redirect_url'      => $redirect_url,
);
?>
<!-- User/views/Wallets/Purchase Form -->
<div class="modal-body">
<form class="form-horizontal" id="purchase_order_form">
	<fieldset>
		<?php
        Template::block('User/Wallets/Purchase/user_fields', 'User/Wallets/Purchase/user_fields', $fieldData);
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
	
	<fieldset>
		<div class="modal-footer">
			<input class="btn btn-primary" type="submit" name="purchaseWalletSubmit" id="purchaseWalletSubmit" value="Purchase" />
		</div>
	</fieldset>
<?php echo form_close(); ?>	
<?php if (validation_errors()) : ?>
	<div class="alert alert-error fade in">
		<?php echo validation_errors(); ?>
	</div>
<?php endif; ?>
</div>
<script type="text/javascript">
const purchaseWalletForm		= document.querySelector("#purchase_order_form");
const purchaseWalletSubmit		= {};
if (purchaseWalletForm) {
    purchaseWalletForm.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		purchaseWalletForm.querySelectorAll("input").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            purchaseWalletSubmit[inputField.name] = inputField.value;
        });
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        console.log(purchaseWalletSubmit);
        console.log(JSON.stringify(purchaseWalletSubmit));
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('User/Wallets/Feature_Manager'); ?>", {
			
			method: "POST",
			body: JSON.stringify(purchaseWalletSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
           	const data = await result;
		    location.href = <?php echo '\'' . $featureRedirectURL . '\'';?>;
            console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 
