<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
    'trade_type'	=> 'Buy',
);

$pageURIA		= $this->uri->segment(1);
$pageURIB		= $this->uri->segment(2);
$pageURIC		= $this->uri->segment(3);
$pageURID		= $this->uri->segment(4);
?>      
<?php
//~ echo form_open('Exchange/Buy', array('class' => "form-horizontal", 'id' => "ask-question-form", 'autocomplete' => 'off'));
?>
<form class="form-horizontal" id="exchange_buy_order_form">
	<fieldset>
		<?php
        Template::block('Exchange/Buy/user_fields', 'Exchange/Buy/user_fields', $fieldData);
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
const buyForm		= document.querySelector("#exchange_buy_order_form");
const buySubmit		= {};
if (buyForm) {
    buyForm.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		buyForm.querySelectorAll("input").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            buySubmit[inputField.name] = inputField.value;
        });
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        console.log(buySubmit);
        console.log(JSON.stringify(buySubmit));
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('Exchange/Order_Buy_Manager'); ?>", {
			
			method: "POST",
			body: JSON.stringify(buySubmit),
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
