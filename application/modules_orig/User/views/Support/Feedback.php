<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass                 = empty($errorClass) ? ' error' : $errorClass;
$controlClass               = empty($controlClass) ? 'span6' : $controlClass;
$thisURL                    = $this->uri->uri_string(); 
$fieldData = array(
    'errorClass'        => $errorClass,
    'controlClass'      => $controlClass,
    'thisURL'           => $thisURL, 
);
?>
<form class="form-horizontal" id="add_user_feedback">
    <fieldset>
        <?php
        Template::block('User/Support/Feedback/user_fields', 'User/Support/Feedback/user_fields', $fieldData);
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
        <div class="control-group">
            <div class="controls ml-3">
                <input class="btn btn-primary" type="submit" name="register" id="addFeedbackSubmit" value="Submit" />
            </div>
        </div>
    </fieldset>
<?php echo form_close(); ?>	
<?php if (validation_errors()) : ?>
<div class="alert alert-error fade in">
    <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<script type="text/javascript"> 
const addFeedbackForm		= document.querySelector("#add_user_feedback");
const addFeedbackSubmit	    = {};
if (addFeedbackForm) { 
    addFeedbackForm.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		addFeedbackForm.querySelectorAll("input").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            addFeedbackSubmit[inputField.name] = inputField.value;
        });  
        addFeedbackForm.querySelectorAll("select").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            addFeedbackSubmit[inputField.name] = inputField.value;
        });  
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        // console.log(addFeedbackSubmit);
        // console.log(JSON.stringify(addFeedbackSubmit));
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('User/Support/Communication_Manager'); ?>", {
			
			method: "POST",
			body: JSON.stringify(addFeedbackSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
            const data = await result;
		    location.href = <?php echo '\'' . site_url('/Wallets/Link-Account/Confirm') . '\'';?>;
            console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 
