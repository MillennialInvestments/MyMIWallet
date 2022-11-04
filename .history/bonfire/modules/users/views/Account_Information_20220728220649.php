<?php
$client             = new \GuzzleHttp\Client();
$userID             = $this->uri->segment(2); 
$response           = $client->request('POST', 'https://www.realizefi.com/api/users', [
  'headers'         => [
    'Accept'        => 'application/json',
    'Authorization' => 'Bearer sk_test_whXrPvWLNuzLTqzwsbF0wQUwlRQS1c9v5YqpDSUMwcVhwD4m7FZuO0Z1jbyJxBXVj1eOYTyQq5F5JWiC6CK8TnWlHPcd5hmHLbTONbsu4HTrB29gG8Dp2GcjGVodTnQk',
  ],
]);
$realizeData        = json_decode($response->getBody(), true); 
$errorClass  		= empty($errorClass) ? ' error' : $errorClass;
$controlGroup       = 'control-group form-row pb-3';
$controlLabel       = 'control-label col-sm-12 pt-2 mb-0';
$controlClass       = 'controls col-sm-12';
$controlInput       = 'form-control full-width';
$fieldData 			= array(
    'controlGroup'  => $controlGroup,
    'controlClass'  => $controlClass,
    'controlInput'  => $controlInput,
    'controlLabel'  => $controlLabel,
    'errorClass'    => $errorClass,
    'realizeID'     => $realizeData['id'],
    'frontend_only' => true,
);
$registerType 		= $this->uri->segment(1);
$cuID	 			= $this->uri->segment(2);
?>
<?php
if ($registerType 	=== 'Investor') {
    $title			= 'Investor Account Information';
} else {
    $title			= 'Account Information';
}
?>
<style scoped='scoped'>
#register p.already-registered {
    text-align: center;
}
	@media (max-width: 375px) {
	#header01-m {padding-top: 15px !important;}	
	}
	@media (min-width: 767px) {
	#header01-m {padding-top: 1rem !important;}
	}
</style>
<div class="intro-section intro-feature bg-white pb-0" id="features">
    <div class="container container-ld pt-5">
        <div class="row justify-content-center pt-3">
            <div class="col-lg-9 col-xl-7">
                <div class="intro-section-title text-center">
                    <span class="overline-title">Account Information</span>
                    <h2 class="intro-heading-lead title">Complete Your Account Information</h2>
                    <div class="intro-section-desc">
                        <p>
                            Provide your account information to complete you registra to verify your email address to to join our Community of Investors and Partners, while enjoying the benefits of our Investment Accounting/Analytical Software and Crypto Asset Marketplace & Exchange.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="intro-section intro-feature bg-white pt-0" id="registration-form">
    <div class="container-fluid px-0">
        <div class="row justify-content-center py-0">
            <div class="mbr-black col-sm-12 col-md-12 col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body py-5 px-0">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-12 col-sm-12 col-md-7">
                                <h1 class="mbr-section-title mbr-bold mb-1 pb-3 mbr-fonts-style card-title display-7"><?php echo $title; ?></h1>	
                                <?php echo form_open('Account-Information/' . $cuID, array('class' => "form-horizontal", 'autocomplete' => 'off')); ?>
                                    <fieldset>
                                        <?php
                                        // Allow modules to render custom fields. No payload is passed
                                        // since the user has not been created, yet.
                                        Events::trigger('render_user_form');
                                        ?>
                                        <!-- Start of User Meta -->
                                        <?php $this->load->view('users/user_meta', $fieldData); ?>
                                        <!-- End of User Meta -->
                                    </fieldset>
                                    <fieldset>
                                        <div class="control-group form-row pt-3">
                                            <div class="controls col-sm-4 pl-0">
                                                <input class="btn btn-primary btn-block display-4" type="submit" name="register" id="submit" value="Complete" />
                                            </div>
                                        </div>	
                                    </fieldset>
                                <?php echo form_close(); ?>	    
                            </div>
                            <div class="col-md-1 border-right px-5"></div>		
                            <div class="col-12 col-sm-12 col-md-3 pl-5">                    
                                <h2 class="mbr-section-title mb-5 pb-3 mbr-fonts-style card-title display-7">My Progress</h2>
                                <div class="stepper d-flex flex-column mt-5 ml-2">
                                    <?php
                                    $step				= 1;
                                    ?>
                                    <div class="d-flex mb-1">
                                        <div class="d-flex flex-column pr-4 align-items-center">
                                            <div class="rounded-circle border py-2 px-3 btn bg-default btn-sm text-default mb-1"><?php echo $step; ?></div>
                                            <div class="line h-100"></div>
                                        </div>
                                        <div class="pt-3">
                                            <h6 class="text-dark">Register Account</h6>
                                        </div>
                                    </div>
                                    <?php
                                    $step				= $step + 1;
                                    ?>
                                    <div class="d-flex mb-1">
                                        <div class="d-flex flex-column pr-4 align-items-center">
                                            <div class="rounded-circle border py-2 px-3 btn bg-default btn-sm text-default mb-1"><?php echo $step; ?></div>
                                            <div class="line h-100"></div>
                                        </div>
                                        <div class="pt-3">
                                            <h6 class="text-dark">Verify Email Address</h6>
                                        </div>
                                    </div>
                                    <?php
                                    $step				= $step + 1;
                                    ?>
                                    <div class="d-flex mb-1">
                                        <div class="d-flex flex-column pr-4 align-items-center">
                                            <div class="rounded-circle border py-2 px-3 btn bg-primary btn-sm text-white mb-1"><?php echo $step; ?></div>
                                            <div class="line h-100"></div>
                                        </div>
                                        <div class="pt-3">
                                            <h6 class="text-dark">Account Information</h6>
                                        </div>
                                    </div>
                                    <?php
                                    //~ $step				= $step + 1;
                                    ?>
<!--
                                    <div class="d-flex mb-1">
                                        <div class="d-flex flex-column pr-4 align-items-center">
                                            <div class="rounded-circle border py-2 px-3 btn bg-default btn-sm text-default mb-1"><?php echo $step; ?></div>
                                            <div class="line h-100"></div>
                                        </div>
                                        <div class="pt-3">
                                            <h6 class="text-dark">Additional Information (Optional)</h6>
                                        </div>
                                    </div>
-->
                                    <?php
                                    $step				= $step + 1;
                                    ?>
                                    <div class="d-flex mb-1">
                                        <div class="d-flex flex-column pr-4 align-items-center">
                                            <div class="rounded-circle border py-2 px-3 btn bg-default btn-sm text-default mb-1"><?php echo $step; ?></div>
                                        </div>
                                        <div class="pt-3">
                                            <h6 class="text-dark">Registration Complete</h6>
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
</div>
<script src="<?php echo base_url('assets/js/BitcoinJS-lib/bitcoinjs.min.js'); ?>"></script>								
<script type="text/javascript">
const generateWalletAddress		    = document.querySelector("#generateWalletAddressSubmit");
const generateWalletAddressSubmit	= {};
if (generateWalletAddress) {
    generateWalletAddress.addEventListener("click", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		generateWalletAddress.querySelectorAll("input").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            generateWalletAddressSubmit[inputField.name] = inputField.value;
        });
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        console.log(generateWalletAddressSubmit);
        console.log(JSON.stringify(generateWalletAddressSubmit));
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('User/Wallets/Wallet_Generator'); ?>", {
			
			method: "POST",
			body: JSON.stringify(generateWalletAddressSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
           const data = await result;
           console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 
