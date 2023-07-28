<?php 
$formData               = array(
    'registerType'      => $registerType,
    'title'             => $title,
);
$thisURL                = $this->uri->uri_string();
?>
<?php echo form_open(site_url('/register'), array('class' => "form-horizontal", 'autocomplete' => 'off', 'id' => 'user_register_form')); ?>
    <fieldset>
        <h1 class="mbr-section-title mbr-bold mb-1 pb-3 mbr-fonts-style card-title display-7 text-center">Get Started With Your Account</h1>			
        <?php /* /users/views/user_fields.php */
        date_default_timezone_set('America/Chicago');
        $currentMethod 			= $this->router->method;
        $errorClass     		= empty($errorClass) ? ' error' : $errorClass;
        $registerClass  		= $currentMethod == 'register' ? ' required' : '';
        $editSettings   		= $currentMethod == 'edit';
        $isBeta					= $this->config->item('beta');
        $signup_date 			= date("n/j/Y");
        $registerType 			= $this->uri->segment(1);
        $preRegisterType 		= $this->uri->segment(2);
        if (empty($this->uri->segment(1))) {
            // Input Field Settings
            $controlGroup 			= 'control-group form-row pb-3';
            $controlLabel 			= 'control-label col-6 pt-2 required';
            $controlClass 			= 'controls col-6';
            $controlInput   		= 'form-control full-width';
            $passwordLabel          = 'Password';
            $referralLabel          = 'Referral Code';
        } else {
            // Input Field Settings
            $controlGroup 			= 'control-group form-row pb-3';
            $controlLabel 			= 'control-label col-12 pt-2 required';
            $controlClass 			= 'controls col-12';
            $controlInput   		= 'form-control full-width';
            $passwordLabel          = 'Password <small>(Confirm)</small>';
            $referralLabel          = 'Referral Code <small>(Optional)</small>';
        }
        $getLastID 				= $this->user_model->get_last_id();
        foreach ($getLastID->result_array() as $last) {
            $lastID				= $last['id'] + 1;
        }
        ?>
        <div class="<?php echo $controlGroup; ?> <?php echo form_error('account_type') ? $errorClass : ''; ?>">
            <label class="<?php e($controlLabel); ?>">Account Type</label>
            <div class="<?php e($controlClass); ?>">    
                <select class="<?php echo $controlInput; ?>" id="account_type" name="account_type" required style="height:40px;padding:10px">
                    <?php
                        $account_type_values = array(
                            'Personal'    		            => 'Personal',
                            'Business'    		            => 'Business',
                        );
                        foreach ($account_type_values as $value => $display_text) {
                            $selected = ($value == $this->input->post('account_type')) ? ' selected="selected"' : "";

                            echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                        }
                    ?>
                </select>
            </div>
        </div>
        <?php 
            if ($isBeta === 1) {
            ?>                                                                                                                  
            <input type="hidden" id="id" name="id" value="<?php echo set_value('id', isset($user) ? $user->id : $lastID); ?>" />
            <input type="hidden" id="type" name="type" value="<?php echo set_value('type', isset($user) ? $user->type : 'Beta'); ?>" />
            <input type="hidden" id="partner" name="partner" value="<?php echo set_value('partner', isset($user) ? $user->partner : '0'); ?>" />			
            <input type="hidden" id="investor" name="investor" value="<?php echo set_value('investor', isset($user) ? $user->investor : '0'); ?>" />
            <input type="hidden" id="organization" name="organization" value="<?php echo set_value('organization', isset($user) ? $user->organization : '0'); ?>" />
        <?php
            } elseif ($registerType === 'Partner') {
                ?>
            <input type="hidden" id="id" name="id" value="<?php echo set_value('id', isset($user) ? $user->id : $lastID); ?>" />
            <input type="hidden" id="type" name="type" value="<?php echo set_value('type', isset($user) ? $user->type : 'Free'); ?>" />
            <input type="hidden" id="partner" name="partner" value="<?php echo set_value('partner', isset($user) ? $user->partner : '1'); ?>" />
            <input type="hidden" id="investor" name="investor" value="<?php echo set_value('investor', isset($user) ? $user->investor : '0'); ?>" />
            <div class="<?php e($controlGroup); ?> <?php echo form_error('organization') ? $errorClass : ''; ?> d-none" id="organizationDiv">
                <label class="<?php e($controlLabel); ?>" for="organization">Name of Organization</label>
                <div class="<?php e($controlClass); ?>">
                    <input class="<?php echo $controlInput; ?>" type="text" id="organization" name="organization" value="<?php echo set_value('organization', isset($user) ? $user->organization : ''); ?>" />
                    <span class="help-inline"><?php echo form_error('organization'); ?></span>
                </div>
            </div>
        <?php
            } elseif ($registerType === 'Investor') {
                ?>
            <input type="hidden" id="id" name="id" value="<?php echo set_value('id', isset($user) ? $user->id : $lastID); ?>" />
            <input type="hidden" id="type" name="type" value="<?php echo set_value('type', isset($user) ? $user->type : 'Free'); ?>" />
            <input type="hidden" id="partner" name="partner" value="<?php echo set_value('partner', isset($user) ? $user->partner : '1'); ?>" />
            <input type="hidden" id="investor" name="investor" value="<?php echo set_value('investor', isset($user) ? $user->investor : '0'); ?>" />
            <div class="<?php e($controlGroup); ?> <?php echo form_error('organization') ? $errorClass : ''; ?> d-none" id="organizationDiv">
                <label class="<?php e($controlLabel); ?>" for="organization">Name of Organization</label>
                <div class="<?php e($controlClass); ?>">
                    <input class="<?php echo $controlInput; ?>" type="text" id="organization" name="organization" value="<?php echo set_value('organization', isset($user) ? $user->organization : ''); ?>" />
                    <span class="help-inline"><?php echo form_error('organization'); ?></span>
                </div>
            </div>
        <?php
            } elseif ($registerType === 'Team') {
                ?>                                          		
            <input type="hidden" id="id" name="id" value="<?php echo set_value('id', isset($user) ? $user->id : $lastID); ?>" />		
            <input type="hidden" id="type" name="type" value="<?php echo set_value('type', isset($user) ? $user->type : 'Team'); ?>" />				
            <input type="hidden" id="partner" name="partner" value="<?php echo set_value('partner', isset($user) ? $user->partner : '1'); ?>" />																						
            <input type="hidden" id="investor" name="investor" value="<?php echo set_value('investor', isset($user) ? $user->investor : '1'); ?>" />
            <input type="hidden" id="organization" name="organization" value="<?php echo set_value('organization', isset($user) ? $user->organization : '0'); ?>" />
        <?php
            } else {
                ?>
            <input type="hidden" id="id" name="id" value="<?php echo set_value('id', isset($user) ? $user->id : $lastID); ?>" />		
            <input type="hidden" id="type" name="type" value="<?php echo set_value('type', isset($user) ? $user->type : 'Free'); ?>" />
            <input type="hidden" id="partner" name="partner" value="<?php echo set_value('partner', isset($user) ? $user->partner : '0'); ?>" />			
            <input type="hidden" id="investor" name="investor" value="<?php echo set_value('investor', isset($user) ? $user->investor : '0'); ?>" />
            <input type="hidden" id="organization" name="organization" value="<?php echo set_value('organization', isset($user) ? $user->organization : '0'); ?>" />
        <?php
            }
        ?>
        <style>
            .form-control {min-height: 40px !important; margin-top: 0px !important; background-color: #ededed !important;}
        </style>
        <input type="hidden" id="signup_date" name="signup_date" value="<?php echo set_value('signup_date', isset($user) ? $user->signup_date : $signup_date); ?>" />
        <div class="<?php e($controlGroup); ?> <?php echo form_error('email') ? $errorClass : ''; ?>">
            <label class="<?php e($controlLabel); ?>" for="email"><?php echo lang('bf_email'); ?> Address</label>
            <div class="<?php e($controlClass); ?>">
                <input class="<?php echo $controlInput; ?>" type="text" id="email" name="email" value="<?php echo set_value('email', isset($user) ? $user->email : ''); ?>" />
                <span class="help-inline"><?php echo form_error('email'); ?></span>
            </div>
        </div>
        <?php if (settings_item('auth.login_type') !== 'email' || settings_item('auth.use_usernames')) : ?>
        <div class="<?php e($controlGroup); ?><?php echo form_error('username') ? $errorClass : ''; ?>">
            <label class="<?php e($controlLabel); ?>" for="username"><?php echo lang('bf_username'); ?></label>
            <div class="<?php e($controlClass); ?>">
                <input class="<?php echo $controlInput; ?>" type="text" id="username" name="username" value="<?php echo set_value('username', isset($user) ? $user->username : ''); ?>" />
                <span class="help-inline"><?php echo form_error('username'); ?></span>
            </div>
        </div>
        <?php endif; ?>
        <div class="<?php e($controlGroup); ?> <?php echo form_error('password') ? $errorClass : ''; ?>">
            <label class="<?php e($controlLabel); ?> <?php echo $registerClass; ?>" for="password"><?php echo lang('bf_password'); ?></label>
            <div class="<?php e($controlClass); ?>">
                <input class="<?php echo $controlInput; ?>" type="password" id="password" name="password" value="" />
                <span class="help-inline"><?php echo form_error('password'); ?></span>
                <p class="help-block"><?php echo isset($password_hints) ? $password_hints : ''; ?></p>        
            </div>
        </div>
        <div class="<?php e($controlGroup); ?> <?php echo form_error('pass_confirm') ? $errorClass : ''; ?>">
            <label class="<?php e($controlLabel); ?> <?php echo $registerClass; ?>" for="pass_confirm"><?= $passwordLabel; ?></label>
            <div class="<?php e($controlClass); ?>">
                <input class="<?php echo $controlInput; ?>" type="password" id="pass_confirm" name="pass_confirm" value="" />
            </div>
        </div>
        <?php if ($editSettings) : ?>
        <div class="<?php e($controlGroup); ?> <?php echo form_error('force_password_reset') ? $errorClass : ''; ?>">
            <div class="controls col-sm-9">
                <label class="checkbox" for="force_password_reset">
                    <input type="checkbox" id="force_password_reset" name="force_password_reset" value="1" <?php echo set_checkbox('force_password_reset', empty($user->force_password_reset)); ?> />
                    <?php echo lang('us_force_password_reset'); ?>
                </label>
            </div>
        </div>
        <?php
        endif;
        ?>
        <div class="<?php e($controlGroup); ?> <?php echo form_error('referral_code') ? $errorClass : ''; ?>">
            <label class="<?php e($controlLabel); ?>" for="referral_code"><?= $referralLabel; ?></label>
            <div class="<?php e($controlClass); ?>">
                <?php 
                if (!empty($this->uri->segment(3))) {
                ?>
                <input class="<?php echo $controlInput; ?>" type="text" id="referral_code" name="referral_code" value="<?php echo set_value('referral_code', isset($user) ? $user->referral_code : $this->uri->segment(3)); ?>" />
                <?php 
                } else {
                ?>
                <input class="<?php echo $controlInput; ?>" type="text" id="referral_code" name="referral_code" value="<?php echo set_value('referral_code', isset($user) ? $user->referral_code : ''); ?>" />
                <?php
                }
                ?>
                <span class="help-inline"><?php echo form_error('referral_code'); ?></span>
            </div>
        </div>
        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">

        <!-- <div class="g-recaptcha" data-sitekey="6Ld-35olAAAAAKfXFhwLJ6RYLZuYcuVN5NLUqBTF" data-action="your_action"></div> -->


        <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const accountTypeSelect = document.getElementById('account_type');
            const organizationDiv = document.getElementById('organization').parentNode.parentNode;

            accountTypeSelect.addEventListener('change', (e) => {
                if(e.target.value === 'Business') {
                    organizationDiv.classList.remove('d-none');
                } else {
                    if(!organizationDiv.classList.contains('d-none')) {
                        organizationDiv.classList.add('d-none');
                    }
                }
            });
        });
        </script>
	
        <div class="control-group form-row pt-3">
            <div class="controls col-12 pl-0">
                <div class="accordion-item">            
                    <a href="#" class="accordion-head border-bottom collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-2-2">           
                        <strong>Sign-In With...</strong>                   
                        <span class="accordion-icon"></span>            
                    </a>            
                    <div class="accordion-body collapse" id="accordion-item-2-2" data-bs-parent="#accordion-2" >              
                        <div class="accordion-inner text-center">           
                            <a class="btn btn-primary btn-md" href="<?php echo base_url('auth/login/Google'); ?>"><em class="icon ni ni-google"></em></a>
                            <a class="btn btn-primary btn-md" href="<?php echo base_url('auth/login/Facebook'); ?>"><em class="icon ni ni-facebook-fr"></em></a>
                            <a class="btn btn-primary btn-md" href="<?php echo base_url('auth/login/LinkedIn'); ?>"><em class="icon ni ni-linkedin"></em></a>            
                        </div>            
                    </div>    
                </div> 
            </div>
        </div>
	
        <div class="control-group form-row pt-3">
            <div class="controls col-sm-4 pl-0">
                <input class="btn btn-primary btn-block display-4 g-recaptcha" type="submit" name="register" id="submit" value="<?php echo lang('us_register'); ?>"/>
            </div>
            <div class="col-sm-8 pt-1 pl-5">
                <p class='already-registered pl-5'>
                    <?php echo lang('us_already_registered'); ?>
                    <?php echo anchor(LOGIN_URL, lang('bf_action_login')); ?>
                </p>
            </div>
        </div>	
        <div class="control-group form-row pt-3">
            <div class="controls col-12 pl-0">
                <div class="accordion-item">            
                    <a href="#" class="accordion-head border-bottom collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-2-2">           
                        <strong>Service Disclosure</strong>                   
                        <span class="accordion-icon"></span>            
                    </a>            
                    <div class="accordion-body collapse" id="accordion-item-2-2" data-bs-parent="#accordion-2" >              
                        <div class="accordion-inner">           
                            <small class="text-muted">
                            We are committed to complying with all U.S. regulations that help prevent, detect and remediate unlawful behavior by customers and virtual currency developers when using Millennial Investment's MyMI Wallet trading platform or any of the company’s other services. 
                            MyMI Wallet is also not a regulated exchange under U.S. securities laws. 
                            </small>           
                        </div>            
                    </div>    
                    <div class="accordian-footer py-2 pl-4">
                        <small>By registering an account, you are agreeing to our <br><a href="<?php echo site_url('/Legal/Terms-And-Conditions'); ?>">Terms &amp; Conditions</a> and <a href="<?php echo site_url('/Legal/Privacy-Policy'); ?>">Privacy Policy</a> at MyMI Wallet, LLC.</small>
                    </div>    
                </div> 
            </div>
        </div>
    </fieldset>
    <fieldset>
        <?php
        // Allow modules to render custom fields. No payload is passed
        // since the user has not been created, yet.
        Events::trigger('render_user_form');
        ?>
        <!-- Start of User Meta -->
        <?php
        //$this->load->view('users/user_meta', array('frontend_only' => true));
        ?>
        <!-- End of User Meta -->
    </fieldset>
<?php echo form_close(); ?>	
<!-- <script>
   function onSubmit(token) {
     document.getElementById("user_register_form").submit();
   }
 </script>
<script>
window.onload = function() {
    if (typeof grecaptcha !== 'undefined') {
        grecaptcha.ready(function() {
            grecaptcha.execute("<?php //echo $this->config->item('recaptcha_site_key'); ?>", {action: "submit"}).then(function(e) {
                document.getElementById("g-recaptcha-response").value = e;
            })
        });
    } else {
        console.error("grecaptcha is not defined. Check if the reCAPTCHA script is correctly loaded.");
    }
}
</script> -->