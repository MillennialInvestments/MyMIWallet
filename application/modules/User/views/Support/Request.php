<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
    $errorClass                 = empty($errorClass) ? ' error' : $errorClass;
    $controlClass               = empty($controlClass) ? 'span6' : $controlClass;
    $fieldData = array(
        'errorClass'            => $errorClass,
        'controlClass'          => $controlClass,
    );
?>

<div class="nk-block-head nk-block-head-lg wide-md">
    <div class="nk-block-head-content">
        <div class="nk-block-head-sub"><span>Customer Support</span></div>
        <h2 class="nk-block-title fw-normal">Submit Request</h2>
        <div class="nk-block-des">
            <p class="lead"></p>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-inner p-0">
        <div class="nk-block-content">
            <div class="row justify-content-center">
                <div class="col-12">
                    <form class="form-horizontal" id="customer_support_request">
                        <fieldset>
                            <?php Template::block('Request/user_fields', 'Request/user_fields', $fieldData); ?>
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
                    <?php echo form_close(); ?>	
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-error fade in">
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>	
        </div>
    </div><!-- .card-inner -->
</div><!-- .card -->
<script type="text/javascript">
const customerSupportRequest		= document.querySelector("#customer_support_request");
const customerSupportRequestSubmit	= {};
if (customerSupportRequest) {
    customerSupportRequest.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		customerSupportRequest.querySelectorAll(".form-control").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            customerSupportRequestSubmit[inputField.name] = inputField.value;
        });
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        console.log(customerSupportRequestSubmit);
        console.log(JSON.stringify(customerSupportRequestSubmit));
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?php echo site_url('Support/Communication-Manager'); ?>", {
			
			method: "POST",
			body: JSON.stringify(customerSupportRequestSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
           const data = await result;
           location.href('Support/My-Requests'); 
           console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 
