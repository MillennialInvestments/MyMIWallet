<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$walletType         = $this->uri->segment(2);
$fieldData = array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
    'walletType'	=> $walletType,
);
?>
<div class="modal-header">
	<h3 class="modal-title" id="useCoinModalLabel">Select Wallet Integration</h3>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  <span aria-hidden="true">&times;</span>
	</button>
</div> 
<div class="modal-body">
	<div class="row justify-content-center">
		<span class="col-12 text-center">
			<a class="btn btn-primary btn-lg text-white" id="addFiatWalletBtn" data-toggle="modal" data-target="#transactionModal">Manual Entry</a>
		</span>
    </div>
    <div class="row justify-content-center">
		<span class="col-12 text-center">
			<h4 class="py-3">-OR-</h4>
		</span>
    </div>
    <div class="row justify-content-center">
		<span class="col-6 text-center">
			<?php echo '<a class="btn btn-outline-light btn-lg text-white p-1" id="automatedAccountCreation" href="https://auth.tdameritrade.com/auth?response_type=code&redirect_uri=https%3A%2F%2Fwww.mymiwallet.com%2Fpublic%2Findex.php%2FWallets%2FLink-Account%2F1&client_id=XGCE3NA1BXIGQG2NHDTLHZ6OUSIZTITF%40AMER.OAUTHAP">
                <img class="full-width" src="' . base_url('assets/images/Brokerages/TD-Ameritrade.png') . '"/>
            </a>'; ?>
			<!-- <a class="btn btn-primary btn-lg text-white" id="automatedAccountCreation" data-toggle="modal" data-target="#automatedAccountModal">Automated Entry</a> -->
		</span>
        <span class="col-6 text-center">
			<?php echo '<a class="btn btn-primary btn-lg text-white" id="automatedAccountCreation" href="https://auth.tdameritrade.com/auth?response_type=code&redirect_uri=https%3A%2F%2Fwww.mymiwallet.com%2Fpublic%2Findex.php%2FWallets%2FLink-Account%2F1&client_id=XGCE3NA1BXIGQG2NHDTLHZ6OUSIZTITF%40AMER.OAUTHAP">Automated Entry</a>'; ?>
			<!-- <a class="btn btn-primary btn-lg text-white" id="automatedAccountCreation" data-toggle="modal" data-target="#automatedAccountModal">Automated Entry</a> -->
		</span> 
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
	  Close
	</button>
</div>


<div class="modal fade" id="automatedAccountModal" tabindex="-1" aria-labelledby="trackDepositsModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="useCoinModalLabel">Connect TD Ameritrade Account</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div> 
			<div class="modal-body">
				<div class="row justify-content-center">
					<div class="col-12">
						
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
				Close
				</button>
			</div>
		</div>
	</div>
</div>
<!-- </div>
<script src="https://cdn.plaid.com/link/v2/stable/link-initialize.js"></script>
<script>
	const handler = Plaid.create({
		token: 'GENERATED_LINK_TOKEN',
		onSuccess: (public_token, metadata) => {},
		onLoad: () => {},
		onExit: (err, metadata) => {},
		onEvent: (eventName, metadata) => {},
		//required for OAuth; if not using OAuth, set to null or omit:
		receivedRedirectUri: window.location.href,
	});
</script> -->
<!-- ------------------------------- OLD ------------------------------------- -->

<script type="text/javascript">
const addWalletForm		= document.querySelector("#purchase_order_form");
const addWalletSubmit	= {};
if (addWalletForm) {
    addWalletForm.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		addWalletForm.querySelectorAll("input").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            addWalletSubmit[inputField.name] = inputField.value;
        });
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        console.log(addWalletSubmit);
        console.log(JSON.stringify(addWalletSubmit));
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('User/Wallets/Wallet_Manager'); ?>", {
			
			method: "POST",
			body: JSON.stringify(addWalletSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
           	const data = await result;
			// $.ajax({
			// 	type: 'get',
			// 	url: <?php //echo '\'' . site_url('Add-Wallet/Fiat') . '\'';?>,
			// 	dataType: 'html',
			// 	beforeSend: function() {
			// 		$('#loading-content').show(); 
			// 		$('#transactionContainer').hide(); 
			// 	},
			// 	// complete: function(){
			// 	// 	$('#loading-content').hide(); 
			// 	// },
			// 	success: function (html) {
			// 	// success callback -- replace the div's innerHTML with
			// 	// the response from the server.
			// 		$('#loading-content').hide(); 
			// 		$('#transactionContainer').show(); 
			// 		$('#transactionContainer').html(html);
			// 	}
			// });
           console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 
