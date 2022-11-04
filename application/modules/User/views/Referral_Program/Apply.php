<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
    $errorClass   = empty($errorClass) ? ' error' : $errorClass;
    $controlClass = empty($controlClass) ? 'span6' : $controlClass;
    $fieldData = array(
        'errorClass'    => $errorClass,
        'controlClass'  => $controlClass,
    );
?>
<?php
    $this->db->from('bf_quantities');
    $quantities = $this->db->get();
?>
<div class="nk-block">
    <div class="row gy-gs">
        <div class="col-lg-12 col-xl-12">
            <div class="nk-block">
                <div class="nk-block-head-xs">
                    <div class="nk-block-head-content">
                        <h1 class="nk-block-title title">Referral Program Application</h1>
                        <a href="<?php echo site_url('/Dashboard'); ?>">Return to Dashboard</a>							
                    </div>
                </div>
            </div>
            <div class="nk-block">
                <div class="row">
                    <div class="d-none d-md-block col-md-7 col-lg-7 pr-5 border-right">
                        <?php $this->load->view('Referral_Program/Apply/Referral_Policy'); ?>
                    </div>  
                    <div class="col-12 col-md-5 col-lg-5 px-5"> 
                        <form class="form-horizontal" id="referral-program-application-form">
                            <fieldset>
                                <?php Template::block('Apply/user_fields', 'Apply/user_fields', $fieldData); ?>
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
                                        <input class="btn btn-primary" type="submit" name="register" id="submit" value="Submit" />
                                    </div>
                                </div>
                            </fieldset>
                        </form>	
                        <?php if (validation_errors()) : ?>
                            <div class="alert alert-error fade in">
                                <?php echo validation_errors(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="d-block d-md-none col-12">
                        <?php $this->load->view('Referral_Program/Apply/Referral_Policy'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
const applicationForm		    = document.querySelector("#referral-program-application-form");
const applicationSubmit	    = {};
if (applicationForm) { 
    applicationForm.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		applicationForm.querySelectorAll("input").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            applicationSubmit[inputField.name] = inputField.value;
        });  
        applicationForm.querySelectorAll("select").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            applicationSubmit[inputField.name] = inputField.value;
        });  
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        // console.log(applicationSubmit);
        // console.log(JSON.stringify(applicationSubmit));
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('User/Referral_Program/Application_Manager'); ?>", {
			
			method: "POST",
			body: JSON.stringify(applicationSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
            const data = await result;
		    location.href = <?php echo '\'' . site_url('Referral-Program/Application/Success') . '\'';?>;
            console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 