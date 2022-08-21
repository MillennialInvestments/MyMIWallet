<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>   
<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
    'trade_type'	=> 'Sell',
);

$pageURIA		= $this->uri->segment(1);
$pageURIB		= $this->uri->segment(2);
$pageURIC		= $this->uri->segment(3);
$pageURID		= $this->uri->segment(4);
?>      
<?php
//~ echo form_open('Exchange/Buy', array('class' => "form-horizontal", 'id' => "ask-question-form", 'autocomplete' => 'off'));
?>
<form class="form-horizontal" id="exchange_sell_order_form">
	<fieldset>
		<?php
        Template::block('Exchange/Sell/user_fields', 'Exchange/Sell/user_fields', $fieldData);
        ?>
	</fieldset>
	<fieldset>
		<?php
        // Allow modules to render custom fields. No payload is passed
        // since the user has not been created, yet.
        Events::trigger('render_user_form');
        ?>
		<!-- Start of User Meta -->
		<!-- End of User Meta -->
	</fieldset>
<?php
//~ echo form_close();
echo '</form>';
?>	

<?php if (validation_errors()) : ?>
	<div class="alert alert-error fade in">
		<?php echo validation_errors(); ?>
	</div>
<?php endif; ?>

<script type="text/javascript">
const sellForm		= document.querySelector("#exchange_sell_order_form");
const sellSubmit	= {};
if (sellForm) {
    sellForm.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		sellForm.querySelectorAll("input").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            sellSubmit[inputField.name] = inputField.value;
        });
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        console.log(sellSubmit);
        console.log(JSON.stringify(sellSubmit));
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('Exchange/Order_Sell_Manager'); ?>", {
			
			method: "POST",
			body: JSON.stringify(sellSubmit),
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
