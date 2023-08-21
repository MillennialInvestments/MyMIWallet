<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$cuID				= $_SESSION['allSessionData']['userAccount']['cuID'];
$cuEmail			= $_SESSION['allSessionData']['userAccount']['cuEmail'];
$errorClass   		= empty($errorClass) ? ' error' : $errorClass;
$controlClass 		= empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
    'cuID'			=> $cuID,
    'cuEmail'		=> $cuEmail,
);

$pageURIA			= $this->uri->segment(1);
$pageURIB			= $this->uri->segment(2);
$pageURIC			= $this->uri->segment(3);
$pageURID			= $this->uri->segment(4);
$listing_type       = $pageURID;
?>
<div class="modal-header">
    <div class="nk-block pt-1">
        <div class="row gy-gs">
            <div class="col-md-12 mb-3">  
                <div class="nk-block">
                    <div class="nk-block-head">
                        <?php echo theme_view('navigation_breadcrumbs'); ?>
                        <div class="nk-block-between-md g-4">
                            <div class="nk-block-head-content">
                                <h2 class="nk-block-title fw-bold">Digital Asset Listing</h2>
                                <div class="nk-block-des">
                                    <p>
                                        <span class="d-none d-md-block">List Your DigiAsset By Completing The Information Below!</span>
                                        <span class="d-block d-md-none">List Your DigiAsset Below!</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
	<button type="button" class="close closeModalBtn" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<div class="modal-body">	
    <div class="nk-block pt-1">
            <div class="col-md-12 mb-3">
                <div class="nk-block">	
                    <form class="form-horizontal" id="coin_listing_asset_information">
                        <div class="nk-block pt-1">
                            <div class="row">
                                <div class="col-lg-12">
                                    <fieldset>
                                        <?php
                                            Template::block('Exchange/Coin_Listing_Asset_Information/list_fields', 'Exchange/Coin_Listing_Asset_Information/list_fields', $fieldData);
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
                    </form>
                </div>
            </div>
            <!-- <div class="col-md-12 mb-3">
                <div class="nk-block pt-1">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="nk-block-subtitle fw-bold">Additional Information &amp; Instructions</h4>
                            <!-- <h5 class="card-title mt-3">Listing Type</h5>		
                            <p class="card-text">
                                The listing type to determine whether you will be adding an existing digital asset to the MyMI Exchange or creating a new digital asset using our Asset Creator.
                            </p> --
                            <h5 class="card-title mt-3">Blockchain</h5>
                            <p class="card-text">
                                Select the blockchain that your digital asset currently exist on or the blockchain that you wish to utilize to create your new digital asset.
                            </p>
                            <h5 class="card-title mt-3">Asset Name</h5>
                            <p class="card-text">
                                Select the name of your existing digital asset or the name you would like to designate to your new digital asset.
                            </p>
                            <h5 class="card-title mt-3">Symbol</h5>
                            <p class="card-text">
                                Provide the symbol ticker that is or will be assigned to your digital asset.
                            </p>
                            <h5 class="card-title mt-3">Coin Quantity</h5>
                            <p class="card-text">
                                Provide the number of coins you would like to assign to the MyMI Exchange or will need to create for the new digital asset.
                            </p>
                            <h5 class="card-title mt-3">Type of Token</h5>
                            <p class="card-text">
                                The type of token is the purpose of the digital asset is what you will be utilizing the digital asset for whether it's fundraising for a project, sharing equity or ownership for a project, product or service, etc. For more information on Type of Tokens, click <a data-toggle="modal" data-target="#tokenTypesModal">here</a>!
                            </p>
                            <h5 class="card-title mt-3">Description of Asset</h5>
                            <p class="card-text">
                                Provide a short description of the digital asset that you will add or create on the MyMI Exchange to let others know additional details in your mission of having the coin listed at MyMI Exchange.
                            </p>
                            <h5 class="card-title mt-3">Asset Logo</h5>
                            <p class="card-text">
                                Provide an Icon to represent your new Asset on our MyMI Exchange.
                            </p>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>
<script type="text/javascript">
const coinApplicationForm		= document.querySelector("#coin_listing_asset_information");
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