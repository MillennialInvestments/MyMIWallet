<?php 
$beta                                   = $this->config->item('beta');  
$date                                   = $this->config->item('date');  
$hostTime                               = $this->config->item('hostTime');  
$time                                   = $this->config->item('time');  
$redirectURL                            = $this->agent->referrer(); 
$errorClass                             = empty($errorClass) ? ' error' : $errorClass;
$controlClass                           = empty($controlClass) ? 'span6' : $controlClass;
// print_r($_SESSION);
// $userFlashData                          = $_SESSION['allSessionData']['userFlashData']; 
// $cuID                                   = $userFlashData['cuID']; 

if (!empty($_SESSION['cuID'])) {
    $cuID                           = $_SESSION['cuID']; 
} elseif (!empty($_SESSION['user_id'])) {
    $cuID                           = $_SESSION['user_id'];
} else {
    if (!empty($this->auth->user_id())) {
        $cuID                       = $this->auth->user_id(); 
    } elseif (!empty($this->input->ip_address())) {
        $cuID                       = $this->input->ip_address();
    } elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $cuID                       = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $cuID                       = $_SERVER['HTTP_X_FORWARDED_FOR']; 
    } elseif (!empty($_SERVER['REMOTE_ADDR'])) { 
        $cuID                       = $_SERVER['REMOTE_ADDR'];
    }
    
}
$fieldData = array(
    'errorClass'                        => $errorClass,
    'controlClass'                      => $controlClass,
    'redirectURL'                       => $redirectURL,
);
?>
<?php echo form_open('#',array('class' => 'form-horizontal', 'id' => 'email_subscribe_form'), array('category' => $this->uri->segment(1), 'subject' => $this->uri->segment(2), 'topic' => $this->uri->segment(3), 'beta' => $beta, 'date' => $date, 'hostTime' => $hostTime, 'time' => $time, 'user_id' => $cuID, 'user_ip' => $this->input->ip_address())); ?>    
    <fieldset>
        <?php
        Template::block('Blog/Subscribe/form_fields', 'Blog/Subscribe/form_fields', $fieldData);
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
        <div class="pricing-action mt-0">
            <p class="sub-text"></p>
            <input class="btn btn-primary" type="submit" name="register" id="subscribeSubmit" value="Subscribe!" />
        </div>
    </fieldset>
<?php echo form_close(); ?>
<script>
const subscribeForm		                = document.querySelector("#email_subscribe_form");
const subscribeSubmit	                = {};
if (subscribeForm) { 
    subscribeForm.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		subscribeForm.querySelectorAll("input").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            subscribeSubmit[inputField.name] = inputField.value;
        });  
        subscribeForm.querySelectorAll("select").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            subscribeSubmit[inputField.name] = inputField.value;
        });  
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        // console.log(subscribeSubmit);
        // console.log(JSON.stringify(subscribeSubmit));
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('Blog/Email/Subscription/Account-Manager'); ?>", {			
                method: "POST",
                body: JSON.stringify(subscribeSubmit),
                headers: { "Content-Type": "application/json" },
                credentials: "same-origin",
                redirect: "manual",
            });
            const data                  = await result;
            location.href               = <?php echo '\'' . $redirectURL . '\'';?>;
            console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script>