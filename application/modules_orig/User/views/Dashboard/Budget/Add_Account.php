<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass         = empty($errorClass) ? ' error' : $errorClass;
$controlClass       = empty($controlClass) ? 'span6' : $controlClass;
$accountType        = $this->uri->segment(2);
$addModalTitle      = 'Add an ' . $accountType . ' Account'; 
$fieldData = array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
    'accountType'	=> $accountType,
);
?>

<div class="nk-block">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-bordered h-100">
                <div class="card-inner">
                    <div class="card-title-group align-start mb-3">
                        <div class="card-title">
                            <h6 class="title"><?php echo $addModalTitle; ?></h6>
                            <p>Track your Financial <?php echo $addModalTitle; ?> Account.</p>
                        </div>
                        <div class="card-tools mt-n1 me-n1">
                            <div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger full-width" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                        <li><a href="#" class="active"><span>15 Days</span></a></li>
                                        <li><a href="#"><span>30 Days</span></a></li>
                                        <li><a href="#"><span>3 Months</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card-title-group -->
                    <div class="nk-order-ovwg">
                        <div class="row g-4 align-end">
                            <div class="col-12">
                                <form class="form-horizontal" id="add_user_budget_account">
                                    <fieldset>
                                        <?php
                                        Template::block('User/Dashboard/Budget/Add_Account/user_fields', 'User/Dashboard/Budget/Add_Account/user_fields', $fieldData);
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
                                                <input class="btn btn-primary" type="submit" name="register" id="addWalletSubmit" value="Submit" />
                                            </div>
                                        </div>
                                    </fieldset>
                                <?php echo form_close(); ?>	
                                <?php if (validation_errors()) : ?>
                                <div class="alert alert-error fade in">
                                    <?php echo validation_errors(); ?>
                                </div>
                                <?php endif; ?>
                            </div><!-- .col -->
                        </div>
                    </div><!-- .nk-order-ovwg -->
                </div><!-- .card-inner -->
            </div><!-- .card -->
        </div>
    </div>
</div>
<script type="text/javascript"> 
const addWalletForm		    = document.querySelector("#add_user_budget_account");
const addWalletSubmit	    = {};
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
        addWalletForm.querySelectorAll("select").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            addWalletSubmit[inputField.name] = inputField.value;
        });  
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        // console.log(addWalletSubmit);
        // console.log(JSON.stringify(addWalletSubmit));
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('User/Dashboard/Budget/Account_Manager'); ?>", {
			
			method: "POST",
			body: JSON.stringify(addWalletSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
            const data = await result;
		    location.href = <?php echo '\'' . site_url('/Budget/Income') . '\'';?>;
            console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 
