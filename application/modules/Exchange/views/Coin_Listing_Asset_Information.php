<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass  			= empty($errorClass) ? ' error' : $errorClass;
$controlClass 			= empty($controlClass) ? 'span6' : $controlClass;
$pageURIA				= $this->uri->segment(1);
$pageURIB				= $this->uri->segment(2);
$pageURIC				= $this->uri->segment(3);
$pageURID				= $this->uri->segment(4);
$pageURIE				= $this->uri->segment(5);
$cuID					= $_SESSION['allSessionData']['userAccount']['cuID'];
$cuEmail				= $_SESSION['allSessionData']['userAccount']['cuEmail'];
$getAppInfo 			= $this->exchange_model->get_open_listing_app($cuID, $pageURID)->result_array();
if (!empty($pageURID)) {
    $listing_type		= $pageURID;
    $appID              = $pageURIE;
} elseif (!empty($getAppInfo)) {
    foreach ($getAppInfo as $appInfo) {
        $appID 	        = $appInfo['id'];
        $listing_type 	= $appInfo['listing_type'];
    }
}
$fieldData = array(
    'errorClass'    	=> $errorClass,
    'controlClass' 	 	=> $controlClass,
    'cuID'				=> $cuID,
    'cuEmail'			=> $cuEmail,
    'appID'				=> $appID,
);
?>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-md-12 mb-3">  
			<div class="nk-block">
				<div class="nk-block-head">
					<?php echo theme_view('navigation_breadcrumbs'); ?>
					<div class="nk-block-between-md g-4">
						<?php
                            if ($listing_type === 'Existing') {
                                echo '
								<div class="nk-block-head-content">
									<h2 class="nk-block-title fw-bold">Digital Asset Listing</h2>
									<div class="nk-block-des">
										<p>
											<span class="d-none d-md-block">List Your DigiAsset By Completing The Information Below!</span>
											<span class="d-block d-md-none">List Your DigiAsset Below!</span>
										</p>
									</div>
								</div>
                                <div class="nk-block-head-content">
                                    <ul class="nk-block-tools gx-3">
                                        <li>
                                            <a href="' . site_url('Assets') . '" class="btn btn-primary"><span>My Assets</span> <em class="icon icon-arrow-right"></em></a>	
                                        </li>
                                        <li>
                                            <a href="' . site_url('Support') . '" class="btn btn-primary"><span>Support</span> <em class="icon icon-arrow-right"></em></a>	
                                        </li>
                                    </ul>
                                </div>
								';
                            } elseif ($listing_type === 'New') {
                                echo '
								<div class="nk-block-head-content">
									<h2 class="nk-block-title fw-bold">Digital Asset Creator</h2>
									<div class="nk-block-des">
										<p>
											<span class="d-none d-md-block">Create Your DigiAsset By Completing The Information Below!</span>
											<span class="d-block d-md-none">Create Your DigiAsset Below!</span>
										</p>
									</div>
								</div>
                                <div class="nk-block-head-content">
                                    <ul class="nk-block-tools gx-3">
                                        <li>
                                            <a href="' . site_url('Assets') . '" class="btn btn-primary"><span>My Assets</span> <em class="icon icon-arrow-right"></em></a>	
                                        </li>
                                        <li>
                                            <a href="' . site_url('Support') . '" class="btn btn-primary"><span>Support</span> <em class="icon icon-arrow-right"></em></a>	
                                        </li>
                                    </ul>
                                </div>
								';
                            }
                        ?>
						<!-- <div class="nk-block-head-content">
							<ul class="nk-block-tools gx-3">
								<li>
									<a href="#" class="btn btn-primary text-white depositFundsBtn" role="button" data-toggle="modal" data-target="#transactionModal">
										<span>Deposit Funds</span> <em class="icon icon-arrow-right"></em>
									</a>
								</li>
								<li>
									<a href="#" class="btn btn-primary text-white withdrawFundsBtn" role="button" data-toggle="modal" data-target="#transactionModal">
										<span>Withdraw Funds</span> <em class="icon icon-arrow-right"></em>
									</a>
								</li>
							</ul>
						</div> -->
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-5 mb-3">
			<div class="nk-block">	
				<form class="form-horizontal" id="coin_listing_asset_information">
					<div class="nk-block pt-1">
						<div class="row">
							<div class="col-lg-12">
								<fieldset>
									<?php
                                    if ($listing_type === 'Existing') {
                                        Template::block('Exchange/Coin_Listing_Asset_Information/list_fields', 'Exchange/Coin_Listing_Asset_Information/list_fields', $fieldData);
                                    } elseif ($listing_type === 'New') {
                                        Template::block('Exchange/Coin_Listing_Asset_Information/create_fields', 'Exchange/Coin_Listing_Asset_Information/create_fields', $fieldData);
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
				</form>
			</div>
		</div>
		<div class="col-md-6 offset-md-1 mb-3">
			<div class="nk-block pt-1">
				<div class="row">
					<div class="col-lg-12">
						<h4 class="nk-block-subtitle fw-bold">Additional Information &amp; Instructions</h4>
						<!-- <h5 class="card-title mt-3">Listing Type</h5>		
						<p class="card-text">
							The listing type to determine whether you will be adding an existing digital asset to the MyMI Exchange or creating a new digital asset using our Asset Creator.
						</p> -->
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
		</div>
	</div>
</div>
<div class="modal fade" id="tokenTypesModal" tabindex="-1" aria-labelledby="tokenTypesModal" aria-hidden="true">
  	<div class="modal-dialog">
   		<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title">Types of Asset Tokens</h5>
       			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
         		 	<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
				<ul class="list-group list-group-flush">
					<li class="list-group-item">
						<p class="card-text fw-bold">Asset Token</p>
						<p class="card-text">Asset Tokens are digital assets that are backed by real asset such as gold, real estate, or bonds. These digital assets represent the value of real assets that can be used for buying and selling the assets they back.</p>
					</li>
					<li class="list-group-item">
						<p class="card-text fw-bold">Currency Token</p>
						<p class="card-text">Currency Tokens are designed to allow product & service providers the ability to conduct transactions by accepting and sending payments. These assets can also be traded for other cryptocurrencies and fiat currencies.</p>
					</li>
					<li class="list-group-item">
						<p class="card-text fw-bold">Equity/Security Token</p>
						<p class="card-text">Equity Tokens can provide investors with the ability to own a portion of equity in a project, product or service in the same manner of traditional securities.</p>
					</li>
					<li class="list-group-item">
						<p class="card-text fw-bold">NFT Token</p>
						<p class="card-text">NFT Tokens are digital assets that contain unique digital content and artwork which can be traded on blockchains and can't be replicated. </p>
					</li>	
					<li class="list-group-item">
						<p class="card-text fw-bold">Reward Token</p>
						<p class="card-text">Reward tokens are used to provide rewards for an application, platform, or service where members are awarded for conducting a specific action.</p>
					</li>	
					<li class="list-group-item">
						<p class="card-text fw-bold">Utility Token</p>
						<p class="card-text">Utility Tokens are used for purchases made within a specific application/platform that allow users to purchase services & products within that application/platform.</p>
					</li>
				</ul>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     	 	</div>
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
        console.log(coinApplicationSubmit);
        console.log(JSON.stringify(coinApplicationSubmit));
        console.log(...formData);
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
		   location.href = <?php echo '\'' . site_url('/Exchange/Coin-Listing/Request-Complete') . '\'';?>;
           console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 								
