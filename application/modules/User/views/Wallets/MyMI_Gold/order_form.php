<?php
$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
);
?>
<div class="nk-block pt-1">
    <div class="row">
        <div class="col-12 mb-3">
            <?php echo $this->load->view('User/Wallets/MyMI_Gold/header'); ?>
        </div>
    </div>
</div>
<div class="nk-block">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-bordered p-4">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head-sm">
                        <div class="nk-block-head-content"><h5 class="nk-block-title title">Select A Gold Package</h5></div>
                    </div>
                </div>
                <div class="row">
<<<<<<< HEAD
                    <form class="form-horizontal" id="purchase_mymi_gold_b">
=======
                    <form class="form-horizontal" id="purchase_mymi_gold">
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                        <fieldset>
                            <?php
                            Template::block('Purchase_Gold/user_fields', 'Purchase_Gold/user_fields', $fieldData);
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
<<<<<<< HEAD
const purchaseGoldFormB		= document.querySelector("#purchase_mymi_gold_b");
const purchaseGoldSubmit		= {};
if (purchaseGoldFormB) {
    purchaseGoldFormB.addEventListener("submit", async (e) => {
=======
const purchaseGoldForm		= document.querySelector("#purchase_mymi_gold");
const purchaseGoldSubmit		= {};
if (purchaseGoldForm) {
    purchaseGoldForm.addEventListener("submit", async (e) => {
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
<<<<<<< HEAD
		purchaseGoldFormB.querySelectorAll("input").forEach((inputField) => {
=======
		purchaseGoldForm.querySelectorAll("input").forEach((inputField) => {
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
            formData.append(inputField.name,inputField.value);
            purchaseGoldSubmit[inputField.name] = inputField.value;
        });
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        console.log(purchaseGoldSubmit);
        console.log(JSON.stringify(purchaseGoldSubmit));
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('User/Wallets/Purchase_Coins_Transaction'); ?>", {
			
			method: "POST",
			body: JSON.stringify(purchaseGoldSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
            const data = await result;
		    location.href = <?php echo '\'' . site_url('/MyMI-Gold/Complete-Purchase') . '\'';?>;
            console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 
<script type="text/javascript">
function calculatePurchase()
{
	var cost 		= document.getElementById('initial_coin_value').value;
	var amount 		= document.getElementById('package_amount').value;
	var gas	 		= document.getElementById('gas_fee').value;
	var tpercent	= document.getElementById('trans_percent').value; 
	var tfee 		= document.getElementById('trans_fee').value;    
	var gasfee		= amount * gas;  
	//do the math
	var subtotal 	= amount / cost;  
	var total		= subtotal - gasfee;
	var usertfee	= tfee;
	var usertper	= (amount * tpercent) - amount;
	var expenses	= usertper + +tfee;  
	var total_cost	= +amount + +expenses;  
	console.log("cost: " + cost); 
	console.log("amount: " + amount); 
	console.log("gas: " + gas); 
	console.log("tpercent: " + tpercent); 
	console.log("tfee: " + tfee); 
	console.log("gasfee: " + gasfee); 
	console.log("subtotal: " + subtotal); 
	console.log("total: " + total); 
	console.log("usertfee: " + usertfee); 
	console.log("usertper: " + usertper); 
	console.log("expenses: " + expenses); 
	console.log("total_cost: " + total_cost); 
	// Update Inputs
	document.getElementById('total').value 						= total;            
	document.getElementById('total_cost').value 				= total_cost.toFixed(2); 
	document.getElementById('total_fees').value 				= expenses.toFixed(2);  
	document.getElementById('user_gas_fee').value 				= gasfee;     
	document.getElementById('user_trans_fees').value 			= usertfee;
	document.getElementById('user_trans_percent').value 		= usertper;
	// Update Field Displays
	document.getElementById('display_total').innerHTML			= total;
	document.getElementById('display_fees').innerHTML			= expenses.toFixed(2);
	document.getElementById('display_total_cost').innerHTML		= total_cost.toFixed(2);

}
</script> 	
