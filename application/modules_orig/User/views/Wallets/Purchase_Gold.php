<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
);
$beta           = $this->config->item('beta');
$pageURIA		= $this->uri->segment(1);
$pageURIB		= $this->uri->segment(2);
$pageURIC		= $this->uri->segment(3);
$pageURID		= $this->uri->segment(4);
$userAccount    = $_SESSION['allSessionData']['userAccount'];
$cuID           = $userAccount['cuID'];
$this->mymilogger
     ->user($cuID) //Set UserID, who created this  Action
     ->beta($beta) //Set whether in Beta or nto
     ->type('Assets - Coin Purchase') //Entry type like, Post, Page, Entry
     ->controller($this->router->fetch_class())
     ->method($this->router->fetch_method())
     ->url($this->uri->uri_string())
     ->full_url(current_url())
     ->comment('MyMIG') //Token identify Action
     ->log(); //Add Database Entry
?>
<form class="form-horizontal" id="purchase_mymi_gold">
    <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Purchase MyMI Gold</h3>

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
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
const purchaseGoldForm		= document.querySelector("#purchase_mymi_gold");
const purchaseGoldSubmit		= {};
if (purchaseGoldForm) {
    purchaseGoldForm.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		purchaseGoldForm.querySelectorAll("input").forEach((inputField) => {
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
	document.getElementById('display_total').innerHTML			= total + " MyMIG";
	document.getElementById('display_fees').innerHTML			= "$" + expenses.toFixed(2);
	document.getElementById('display_total_cost').innerHTML		= "$" + total_cost.toFixed(2);

}
</script> 								
