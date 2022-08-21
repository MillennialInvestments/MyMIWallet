<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass  			= empty($errorClass) ? ' error' : $errorClass;
$controlClass 			= empty($controlClass) ? 'span6' : $controlClass;
$pageURIA				= $this->uri->segment(1);
$pageURIB				= $this->uri->segment(2);
$pageURIC				= $this->uri->segment(3);
$pageURID				= $this->uri->segment(4);
$cuID					= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$cuEmail				= isset($current_user->email) && ! empty($current_user->email) ? $current_user->email : '';
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
						<div class="nk-block-head-content">
							<h2 class="nk-block-title fw-bold">Customer Support</h2>
							<div class="nk-block-des">
								<p>
									<span class="d-none d-md-block">Need Additional Support? Contact Us Now!</span>
									<span class="d-block d-md-none">Contact Us Below!</span>
								</p>
							</div>
						</div>
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
		<div class="col-12 mb-3">
			<div class="nk-block">	
				<form class="form-horizontal" id="customer_support_request">
					<div class="nk-block pt-1">
						<div class="row">
							<div class="col-lg-12">
								<fieldset>
									<?php
                                        Template::block('Support/Member_Customer_Support_Request/user_fields', 'Support/Member_Customer_Support_Request/user_fields', $fieldData);
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
	</div>
</div>
<script type="text/javascript">
const customerSupportForm		= document.querySelector("#customer_support_request");
const customerSupportSubmit		= {};
if (customerSupportForm) {
    customerSupportForm.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		customerSupportForm.querySelectorAll(".form-control").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            customerSupportSubmit[inputField.name] = inputField.value;
        });
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        console.log(customerSupportSubmit);
        console.log(JSON.stringify(customerSupportSubmit));
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('Exchange/Application-Manager/' . $cuID); ?>", {
			
			method: "POST",
			body: JSON.stringify(customerSupportSubmit),
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
