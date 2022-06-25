<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass   			= empty($errorClass) ? ' error' : $errorClass;
$controlClass 			= empty($controlClass) ? 'span6' : $controlClass;
$cuID   				= $_SESSION['allSessionData']['userAccount']['cuID'];
$cuEmail				= $_SESSION['allSessionData']['userAccount']['cuEmail'];
$cuKYC  				= $_SESSION['allSessionData']['userAccount']['cuKYC'];
$fieldData = array(
    'errorClass'    	=> $errorClass,
    'controlClass'  	=> $controlClass,
    'cuID'				=> $cuID,
    'cuEmail'			=> $cuEmail,
);

$pageURIA				= $this->uri->segment(1);
$pageURIB				= $this->uri->segment(2);
$pageURIC				= $this->uri->segment(3);
$pageURID				= $this->uri->segment(4);
?>
<form class="form-horizontal" id="coin_listing_request">
	<div class="modal-header">
		<h3 class="modal-title" id="coinListingModal">Asset Creator - Application</h3>
		<button type="button" class="close closeModalBtn" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="nk-block pt-1">
			<div class="row">
				<div class="col-lg-12">
					<fieldset>
						<?php
                        if ($cuKYC === 'No') {
                            Template::block('Exchange/Coin_Listing_Request/contact_fields', 'Exchange/Coin_Listing_Request/contact_fields', $fieldData);
                        } else {
                            Template::block('Exchange/Coin_Listing_Asset_Information/new_fields', 'Exchange/Coin_Listing_Asset_Information/new_fields', $fieldData);
                        }
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
</form>
<script type="text/javascript">
const coinApplicationForm		= document.querySelector("#coin_listing_request");
const coinApplicationSubmit		= {};
if (coinApplicationForm) {
    coinApplicationForm.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		coinApplicationForm.querySelectorAll(".form-control").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            coinApplicationSubmit[inputField.name] = inputField.value;
        });
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        // console.log(coinApplicationSubmit);
        // console.log(JSON.stringify(coinApplicationSubmit));
        // console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('Exchange/Application-Manager/' . $cuID); ?>", {
			
			method: "POST",
			body: JSON.stringify(coinApplicationSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
           const data = await result;
		   location.href = <?php echo '\'' . site_url('/Exchange/Coin-Listing/Asset-Information') . '\'';?>;
           console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 								
