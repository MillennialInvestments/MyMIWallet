<?php
// Set Form Config
$formGroup				= $this->config->item('form_container') . ' input-group';
$formLabel				= $this->config->item('form_label');
$formConCol				= $this->config->item('form_control_column');
$formControl			= $this->config->item('form_control');
$formSelect				= $this->config->item('form_select');
$formSelectPicker		= $this->config->item('form_selectpicker');
$formText				= $this->config->item('form_text');
$formCustomText			= $this->config->item('form_custom_text');
?>
<div class="nk-block-head nk-block-head-lg">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Personal Information</h4>
            <div class="nk-block-des">
                <p>Basic info, like your name and address, that you use at MyMI Wallet.</p>
            </div>
        </div>
        <div class="nk-block-head-content align-self-start d-lg-none">
            <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
        </div>
    </div>
</div><!-- .nk-block-head -->
<div class="nk-block">
    <form class="form-horizontal" id="updateInvestorProfileForm">
        <div class="nk-data data-list">
            <div class="data-head">
                <h6 class="overline-title">Basic Contact Information</h6>
            </div>
            <input type="hidden" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">	
            <div class="data-item">
                <div class="data-col" id="col_email">
                    <span class="data-label w-25">Email</span>
                    <span class="data-value w-100" id="email"><?php echo $cuEmail; ?></span>
                    <input type="hidden" name="email" id="email" value="<?php echo set_value('email', isset($user) ? $user->email : $cuEmail); ?>">	
                </div>
                <div class="data-col data-col-end w-15">
                    <span class="data-more" onClick="email_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
                </div>
            </div><!-- Email data-item -->
            <script>
                function email_Switch(e) {
                    let txt                 = document.getElementById('email').innerText;
                    let input               = document.getElementById('email').innerText;
                    let element             = document.getElementById('col_email');

                    element.innerHTML       = `
                        <span class="data-label w-25">Email</span>
                        <span class="data-value w-100">
                            <span class="d-none" id="old-text">${txt}</span>
                            <span class="d-none" id="${input}">${input}</span>
                            <div class="<?php echo $formGroup; ?>">      
                                <div class="<?php echo $formConCol; ?>">       
                                    <input type="text" class="<?php echo $formControl; ?>" name="email" id="email" placeholder="Enter Email" value="<?php echo set_value('email', isset($user) ? $user->email : $cuEmail); ?>">	
                                </div>
                            </div>
                        </span>
                    `;
                    document.getElementsByTagName('input')[0].focus();
                }

                function email_Reset(e) {
                    let txt                 = document.getElementById('old-text').innerHTML;
                    let element             = document.getElementById('col_email');

                    element.innerHTML = `
                    <span class="data-label w-25">Email</span>
                    <span class="data-value w-100" id="email"><?php echo $cuEmail; ?></span>
                    <input type="hidden" name="email" id="email" value="<?php echo set_value('email', isset($user) ? $user->email : $cuEmail); ?>">	
                    `;
                }
            </script>
            <div class="data-item">
                <div class="data-col" id="col_username">
                    <span class="data-label w-25">Display Name</span>
                    <span class="data-value w-100" id="username"><?php echo $cuUsername; ?></span>
                    <input type="hidden" name="username" id="username" value="<?php echo set_value('username', isset($user) ? $user->username : $cuUsername); ?>">	
                </div>
                <div class="data-col data-col-end w-15">
                    <span class="data-more" onClick="username_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
                </div>
            </div><!-- Display data-item -->
            <script>
                function username_Switch(e) {
                    let txt                 = document.getElementById('username').innerText;
                    let input               = document.getElementById('username').innerText;
                    let element             = document.getElementById('col_username');

                    element.innerHTML       = `
                        <span class="data-label w-25">Display Name</span>
                        <span class="data-value w-100">
                            <span class="d-none" id="old-text">${txt}</span>
                            <span class="d-none" id="${input}">${input}</span>
                            <div class="<?php echo $formGroup; ?>">      
                                <div class="<?php echo $formConCol; ?>">       
                                    <input type="text" class="<?php echo $formControl; ?>" name="username" id="username" placeholder="Enter Display Name" value="<?php echo set_value('username', isset($user) ? $user->username : $cuUsername); ?>">	
                                </div>
                            </div>
                        </span>
                    `;
                    document.getElementsByTagName('input')[0].focus();
                }

                function username_Reset(e) {
                    let txt                 = document.getElementById('old-text').innerHTML;
                    let element             = document.getElementById('col_username');

                    element.innerHTML = `
                    <span class="data-label w-25">Display Name</span>
                    <span class="data-value w-100" id="username"><?php echo $cuUsername; ?></span>
                    <input type="hidden" name="username" id="username" value="<?php echo set_value('username', isset($user) ? $user->username : $cuUsername); ?>">	
                    `;
                }
            </script>
            <div class="data-item">
                <div class="data-col" id="col_first_name">
                    <span class="data-label w-25">First Name</span>
                    <span class="data-value w-100" id="first_name"><?php echo $cuFirstName; ?></span>
                    <input type="hidden" name="first_name" id="first_name" value="<?php echo set_value('first_name', isset($user) ? $user->first_name : $cuFirstName); ?>">	
                </div>
                <div class="data-col data-col-end w-15">
                    <span class="data-more" onClick="first_name_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
                </div>
            </div><!-- First Name data-item -->
            <script>
                function first_name_Switch(e) {
                    let txt                 = document.getElementById('first_name').innerText;
                    let input               = document.getElementById('first_name').innerText;
                    let element             = document.getElementById('col_first_name');

                    element.innerHTML       = `
                        <span class="data-label w-25">First Name</span>
                        <span class="data-value w-100">
                            <span class="d-none" id="old-text">${txt}</span>
                            <span class="d-none" id="${input}">${input}</span>
                            <div class="<?php echo $formGroup; ?>">      
                                <div class="<?php echo $formConCol; ?>">       
                                    <input type="text" class="<?php echo $formControl; ?>" name="first_name" id="first_name" placeholder="Enter Display Name" value="<?php echo set_value('first_name', isset($user) ? $user->first_name : $cuFirstName); ?>">	
                                </div>
                            </div>
                        </span>
                    `;
                    document.getElementsByTagName('input')[0].focus();
                }

                function first_name_Reset(e) {
                    let txt                 = document.getElementById('old-text').innerHTML;
                    let element             = document.getElementById('col_first_name');

                    element.innerHTML = `
                    <span class="data-label w-25">First Name</span>
                    <span class="data-value w-100" id="first_name"><?php echo $cuFirstName; ?></span>
                    <input type="hidden" name="first_name" id="first_name" value="<?php echo set_value('first_name', isset($user) ? $user->first_name : $cuFirstName); ?>">	
                    `;
                }
            </script>
            <div class="data-item">
                <div class="data-col" id="col_middle_name">
                    <span class="data-label w-25">Middle Name</span>
                    <span class="data-value w-100" id="middle_name"><?php echo $cuMiddleName; ?></span>
                    <span class="d-none" id="middle_name">middle_name</span>
                </div>
                <div class="data-col data-col-end w-15">
                    <span class="data-more" onClick="middle_name_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
                </div>
            </div><!-- Middle Name data-item -->
            <script>
                function middle_name_Switch(e) {
                    let txt                 = document.getElementById('middle_name').innerText;
                    let input               = document.getElementById('middle_name').innerText;
                    let element             = document.getElementById('col_middle_name');

                    element.innerHTML       = `
                        <span class="data-label w-25">Middle Name</span>
                        <span class="data-value w-100">
                            <span class="d-none" id="old-text">${txt}</span>
                            <span class="d-none" id="${input}">${input}</span>
                            <div class="<?php echo $formGroup; ?>">      
                                <div class="<?php echo $formConCol; ?>">       
                                    <input type="text" class="<?php echo $formControl; ?>" name="middle_name" id="middle_name" placeholder="Enter Display Name" value="<?php echo set_value('middle_name', isset($user) ? $user->middle_name : $cuMiddleName); ?>">	
                                </div>
                            </div>
                        </span>
                    `;
                    document.getElementsByTagName('input')[0].focus();
                }

                function middle_name_Reset(e) {
                    let txt                 = document.getElementById('old-text').innerHTML;
                    let element             = document.getElementById('col_middle_name');

                    element.innerHTML = `
                    <span class="data-label w-25">Middle Name</span>
                    <span class="data-value w-100" id="middle_name"><?php echo $cuMiddleName; ?></span>
                    <input type="hidden" name="middle_name" id="middle_name" value="<?php echo set_value('middle_name', isset($user) ? $user->middle_name : $cuMiddleName); ?>">	
                    `;
                }
            </script>
            <div class="data-item">
                <div class="data-col" id="col_last_name">
                    <span class="data-label w-25">Last Name</span>
                    <span class="data-value w-100" id="last_name"><?php echo $cuLastName; ?></span>
                    <input type="hidden" name="last_name" id="last_name" value="<?php echo set_value('last_name', isset($user) ? $user->last_name : $cuLastName); ?>">	
                </div>
                <div class="data-col data-col-end w-15">
                    <span class="data-more" onClick="last_name_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
                </div>
            </div><!-- Last Name data-item -->
            <script>
                function last_name_Switch(e) {
                    let txt                 = document.getElementById('last_name').innerText;
                    let input               = document.getElementById('last_name').innerText;
                    let element             = document.getElementById('col_last_name');

                    element.innerHTML       = `
                        <span class="data-label w-25">Last Name</span>
                        <span class="data-value w-100">
                            <span class="d-none" id="old-text">${txt}</span>
                            <span class="d-none" id="${input}">${input}</span>
                            <div class="<?php echo $formGroup; ?>">      
                                <div class="<?php echo $formConCol; ?>">       
                                    <input type="text" class="<?php echo $formControl; ?>" name="last_name" id="last_name" placeholder="Enter Display Name" value="<?php echo set_value('last_name', isset($user) ? $user->last_name : $cuLastName); ?>">	
                                </div>
                            </div>
                        </span>
                    `;
                    document.getElementsByTagName('input')[0].focus();
                }

                function last_name_Reset(e) {
                    let txt                 = document.getElementById('old-text').innerHTML;
                    let element             = document.getElementById('col_last_name');

                    element.innerHTML = `
                    <span class="data-label w-25">Last Name</span>
                    <span class="data-value w-100" id="last_name"><?php echo $cuLastName; ?></span>
                    <input type="hidden" name="last_name" id="last_name" value="<?php echo set_value('last_name', isset($user) ? $user->last_name : $cuLastName); ?>">	
                    `;
                }
            </script>
            <div class="data-item">
                <div class="data-col" id="col_name_suffix">
                    <span class="data-label w-25">Suffix</span>
                    <span class="data-value w-100" id="name_suffix"><?php echo $cuNameSuffix; ?></span>
                    <input type="hidden" name="name_suffix" id="name_suffix" value="<?php echo set_value('name_suffix', isset($user) ? $user->name_suffix : $cuNameSuffix); ?>">	
                </div>
                <div class="data-col data-col-end w-15">
                    <span class="data-more" onClick="name_suffix_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
                </div>
            </div><!-- Name Suffix data-item -->
            <script>
                function name_suffix_Switch(e) {
                    let txt                 = document.getElementById('name_suffix').innerText;
                    let input               = document.getElementById('name_suffix').innerText;
                    let element             = document.getElementById('col_name_suffix');

                    element.innerHTML       = `
                        <span class="data-label w-25">Name Suffix</span>
                        <span class="data-value w-100">
                            <span class="d-none" id="old-text">${txt}</span>
                            <span class="d-none" id="${input}">${input}</span>
                            <div class="<?php echo $formGroup; ?>">      
                                <div class="<?php echo $formConCol; ?>">       
                                    <input type="text" class="<?php echo $formControl; ?>" name="name_suffix" id="name_suffix" placeholder="Enter Name Suffix" value="<?php echo set_value('name_suffix', isset($user) ? $user->name_suffix : $cuNameSuffix); ?>">	
                                </div>
                            </div>
                        </span>
                    `;
                    document.getElementsByTagName('input')[0].focus();
                }

                function name_suffix_Reset(e) {
                    let txt                 = document.getElementById('old-text').innerHTML;
                    let element             = document.getElementById('col_name_suffix');

                    element.innerHTML = `
                    <span class="data-label w-25">Suffix</span>
                    <span class="data-value w-100" id="name_suffix"><?php echo $cuNameSuffix; ?></span>
                    <input type="hidden" name="name_suffix" id="name_suffix" value="<?php echo set_value('name_suffix', isset($user) ? $user->name_suffix : $cuNameSuffix); ?>">	
                    `;
                }
            </script>
            <div class="data-item">
                <div class="data-col" id="col_phone">
                    <span class="data-label w-25">Phone</span>
                    <span class="data-value w-100" id="phone"><?php echo $cuPhone; ?></span>
                    <input type="hidden" name="phone" id="phone" value="<?php echo set_value('phone', isset($user) ? $user->phone : $cuPhone); ?>">	
                </div>
                <div class="data-col data-col-end w-15">
                    <span class="data-more" onClick="phone_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
                </div>
            </div><!-- Phone data-item -->
            <script>
                function phone_Switch(e) {
                    let txt                 = document.getElementById('phone').innerText;
                    let input               = document.getElementById('phone').innerText;
                    let element             = document.getElementById('col_phone');

                    element.innerHTML       = `
                        <span class="data-label w-25">Phone</span>
                        <span class="data-value w-100">
                            <span class="d-none" id="old-text">${txt}</span>
                            <span class="d-none" id="${input}">${input}</span>
                            <div class="<?php echo $formGroup; ?>">      
                                <div class="<?php echo $formConCol; ?>">       
                                    <input type="text" class="<?php echo $formControl; ?>" name="phone" id="phone" placeholder="Enter Phone" value="<?php echo set_value('phone', isset($user) ? $user->phone : $cuPhone); ?>">	
                                </div>
                            </div>
                        </span>
                    `;
                    document.getElementsByTagName('input')[0].focus();
                }

                function phone_Reset(e) {
                    let txt                 = document.getElementById('old-text').innerHTML;
                    let element             = document.getElementById('col_phone');

                    element.innerHTML = `
                    <span class="data-label w-25">Phone</span>
                    <span class="data-value w-100" id="phone"><?php echo $cuPhone; ?></span>
                    <input type="hidden" name="phone" id="phone" value="<?php echo set_value('phone', isset($user) ? $user->phone : $cuPhone); ?>">	
                    `;
                }
            </script>
            <?php 
            /**
            <div class="data-item">
                <div class="data-col" id="col_dob">
                    <span class="data-label w-25">Date of Birth</span>
                    <span class="data-value w-100" id="dob"><?php //echo $cuPhone; ?></span>
                    <span class="d-none" id="dob">dob</span>
                </div>
                <div class="data-col data-col-end w-15">
                    <span class="data-more" onClick="dob_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
                </div>
            </div><!-- Address data-item -->
            <script>
                function dob_Switch(e) {
                    let txt                 = document.getElementById('dob').innerText;
                    let input               = document.getElementById('dob').innerText;
                    let element             = document.getElementById('col_dob');

                    element.innerHTML       = `
                        <span class="data-label w-25">Date of Birth</span>
                        <span class="data-value w-100">
                            <span class="d-none" id="old-text">${txt}</span>
                            <span class="d-none" id="${input}">${input}</span>
                            <div class="<?php echo $formGroup; ?>">      
                                <div class="<?php echo $formConCol; ?>">       
                                    <input type="text" class="<?php echo $formControl; ?>" name="dob" id="dob" placeholder="Enter Date of Birth" value="<?php echo set_value('dob', isset($user) ? $user->dob : $cuDOB); ?>">	
                                </div>
                            </div>
                        </span>
                    `;
                    document.getElementsByTagName('input')[0].focus();
                }

                function dob_Reset(e) {
                    let txt                 = document.getElementById('old-text').innerHTML;
                    let element             = document.getElementById('col_dob');

                    element.innerHTML = `
                    <span class="data-label w-25">Date of Birth</span>
                    <span class="data-value w-100" id="dob"><?php //echo $cuPhone; ?></span>
                    <span class="d-none" id="dob">dob</span>
                    `;
                }
            </script>
            */
            ?>
            <div class="data-item">
                <div class="data-col" id="col_address">
                    <span class="data-label w-25">Address</span>
                    <span class="data-value w-100" id="address"><?php echo $cuAddress; ?></span>
                    <input type="hidden" name="address" id="address" value="<?php echo set_value('address', isset($user) ? $user->address : $cuAddress); ?>">	
                </div>
                <div class="data-col data-col-end w-15">
                    <span class="data-more" onClick="address_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
                </div>
            </div><!-- Street Address data-item -->
            <script>
                function address_Switch(e) {
                    let txt                 = document.getElementById('address').innerText;
                    let input               = document.getElementById('address').innerText;
                    let element             = document.getElementById('col_address');

                    element.innerHTML       = `
                        <span class="data-label w-25">Address</span>
                        <span class="data-value w-100">
                            <span class="d-none" id="old-text">${txt}</span>
                            <span class="d-none" id="${input}">${input}</span>
                            <div class="<?php echo $formGroup; ?>">      
                                <div class="<?php echo $formConCol; ?>">       
                                    <input type="text" class="<?php echo $formControl; ?>" name="address" id="address" placeholder="Enter Address" value="<?php echo set_value('address', isset($user) ? $user->address : $cuAddress); ?>">	
                                </div>
                            </div>
                        </span>
                    `;
                    document.getElementsByTagName('input')[0].focus();
                }

                function address_Reset(e) {
                    let txt                 = document.getElementById('old-text').innerHTML;
                    let element             = document.getElementById('col_address');

                    element.innerHTML = `
                    <span class="data-label w-25">Address</span>
                    <span class="data-value w-100" id="address"><?php echo $cuAddress; ?></span>
                    <input type="hidden" name="address" id="address" value="<?php echo set_value('address', isset($user) ? $user->address : $cuAddress); ?>">	
                    `;
                }
            </script>
            <div class="data-item">
                <div class="data-col" id="col_city">
                    <span class="data-label w-25">City</span>
                    <span class="data-value w-100" id="city"><?php echo $cuCity; ?></span>
                    <input type="hidden" name="city" id="city" value="<?php echo set_value('city', isset($user) ? $user->city : $cuCity); ?>">	
                </div>
                <div class="data-col data-col-end w-15">
                    <span class="data-more" onClick="city_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
                </div>
            </div><!-- City data-item -->
            <script>
                function city_Switch(e) {
                    let txt                 = document.getElementById('city').innerText;
                    let input               = document.getElementById('city').innerText;
                    let element             = document.getElementById('col_city');

                    element.innerHTML       = `
                        <span class="data-label w-25">City</span>
                        <span class="data-value w-100">
                            <span class="d-none" id="old-text">${txt}</span>
                            <span class="d-none" id="${input}">${input}</span>
                            <div class="<?php echo $formGroup; ?>">      
                                <div class="<?php echo $formConCol; ?>">       
                                    <input type="text" class="<?php echo $formControl; ?>" name="city" id="city" placeholder="Enter City" value="<?php echo set_value('city', isset($user) ? $user->city : $cuCity); ?>">	
                                </div>
                            </div>
                        </span>
                    `;
                    document.getElementsByTagName('input')[0].focus();
                }

                function city_Reset(e) {
                    let txt                 = document.getElementById('old-text').innerHTML;
                    let element             = document.getElementById('col_city');

                    element.innerHTML = `
                    <span class="data-label w-25">City</span>
                    <span class="data-value w-100" id="city"><?php echo $cuCity; ?></span>
                    <input type="hidden" name="city" id="city" value="<?php echo set_value('city', isset($user) ? $user->city : $cuCity); ?>">	
                    `;
                }
            </script>
            <div class="data-item">
                <div class="data-col" id="col_state">
                    <span class="data-label w-25">State</span>
                    <span class="data-value w-100" id="state"><?php echo $cuState; ?></span>
                    <input type="hidden" name="state" id="state" value="<?php echo set_value('state', isset($user) ? $user->state : $cuState); ?>">	
                </div>
                <div class="data-col data-col-end w-15">
                    <span class="data-more" onClick="state_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
                </div>
            </div><!-- State data-item -->
            <script>
                function state_Switch(e) {
                    let txt                 = document.getElementById('state').innerText;
                    let input               = document.getElementById('state').innerText;
                    let element             = document.getElementById('col_state');

                    element.innerHTML       = `
                        <span class="data-label w-25">State</span>
                        <span class="data-value w-100">
                            <span class="d-none" id="old-text">${txt}</span>
                            <span class="d-none" id="${input}">${input}</span>
                            <div class="<?php echo $formGroup; ?>">      
                                <div class="<?php echo $formConCol; ?>">       
                                    <input type="text" class="<?php echo $formControl; ?>" name="state" id="state" placeholder="Enter State" value="<?php echo set_value('state', isset($user) ? $user->state : $cuState); ?>">	
                                </div>
                            </div>
                        </span>
                    `;
                    document.getElementsByTagName('input')[0].focus();
                }

                function state_Reset(e) {
                    let txt                 = document.getElementById('old-text').innerHTML;
                    let element             = document.getElementById('col_state');

                    element.innerHTML = `
                    <span class="data-label w-25">State</span>
                    <span class="data-value w-100" id="state"><?php echo $cuState; ?></span>
                    <input type="hidden" name="state" id="state" value="<?php echo set_value('state', isset($user) ? $user->state : $cuState); ?>">	
                    `;
                }
            </script>
            <div class="data-item">
                <div class="data-col" id="col_country">
                    <span class="data-label w-25">Country</span>
                    <span class="data-value w-100" id="country"><?php echo $cuCountry; ?></span>
                    <input type="hidden" name="country" id="country" value="<?php echo set_value('country', isset($user) ? $user->country : $cuCountry); ?>">	
                </div>
                <div class="data-col data-col-end w-15">
                    <span class="data-more" onClick="country_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
                </div>
            </div><!-- Country data-item -->
            <script>
                function country_Switch(e) {
                    let txt                 = document.getElementById('country').innerText;
                    let input               = document.getElementById('country').innerText;
                    let element             = document.getElementById('col_country');

                    element.innerHTML       = `
                        <span class="data-label w-25">Country</span>
                        <span class="data-value w-100">
                            <span class="d-none" id="old-text">${txt}</span>
                            <span class="d-none" id="${input}">${input}</span>
                            <div class="<?php echo $formGroup; ?>">      
                                <div class="<?php echo $formConCol; ?>">       
                                    <input type="text" class="<?php echo $formControl; ?>" name="country" id="country" placeholder="Enter Country" value="<?php echo set_value('country', isset($user) ? $user->country : $cuCountry); ?>">	
                                </div>
                            </div>
                        </span>
                    `;
                    document.getElementsByTagName('input')[0].focus();
                }

                function country_Reset(e) {
                    let txt                 = document.getElementById('old-text').innerHTML;
                    let element             = document.getElementById('col_country');

                    element.innerHTML = `
                    <span class="data-label w-25">Country</span>
                    <span class="data-value w-100" id="country"><?php echo $cuCountry; ?></span>
                    <input type="hidden" name="country" id="country" value="<?php echo set_value('country', isset($user) ? $user->country : $cuCountry); ?>">	
                    `;
                }
            </script>
            <div class="data-item">
                <div class="data-col" id="col_zipcode">
                    <span class="data-label w-25">Zip Code</span>
                    <span class="data-value w-100" id="zipcode"><?php echo $cuZipCode; ?></span>
                    <input type="hidden" name="zipcode" id="zipcode" value="<?php echo set_value('zipcode', isset($user) ? $user->zipcode : $cuZipCode); ?>">	
                </div>
                <div class="data-col data-col-end w-15">
                    <span class="data-more" onClick="zipcode_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
                </div>
            </div><!-- Zip Code data-item -->
            <script>
                function zipcode_Switch(e) {
                    let txt                 = document.getElementById('zipcode').innerText;
                    let input               = document.getElementById('zipcode').innerText;
                    let element             = document.getElementById('col_zipcode');

                    element.innerHTML       = `
                        <span class="data-label w-25">Zip Code</span>
                        <span class="data-value w-100">
                            <span class="d-none" id="old-text">${txt}</span>
                            <span class="d-none" id="${input}">${input}</span>
                            <div class="<?php echo $formGroup; ?>">      
                                <div class="<?php echo $formConCol; ?>">       
                                    <input type="text" class="<?php echo $formControl; ?>" name="zipcode" id="zipcode" placeholder="Enter Zip Code" value="<?php echo set_value('zipcode', isset($user) ? $user->zipcode : $cuZipCode); ?>">	
                                </div>
                            </div>
                        </span>
                    `;
                    document.getElementsByTagName('input')[0].focus();
                }

                function zipcode_Reset(e) {
                    let txt                 = document.getElementById('old-text').innerHTML;
                    let element             = document.getElementById('col_zipcode');

                    element.innerHTML = `
                    <span class="data-label w-25">Zip Code</span>
                    <span class="data-value w-100" id="zipcode"><?php echo $cuZipCode; ?></span>
                    <span class="d-none" id="zipcode">zipcode</span>
                    `;
                }
            </script>
            <div class="data-item">
                <div class="data-col" id="col_zipcode">
                    <span class="data-label w-25"></span>
                    <span class="data-value w-100" id="zipcode"></span>
                    <input type="hidden" name="zipcode" id="zipcode" value="<?php echo set_value('zipcode', isset($user) ? $user->zipcode : $cuZipCode); ?>">	
                </div>
                <div class="data-col data-col-end w-15">
                    <input class="btn btn-primary btn-sm" type="submit" name="submit" id="submit" value="Submit" />
                </div>
            </div><!-- Zip Code data-item -->
        </div><!-- data-list -->
        <?php 
            Events::trigger('render_user_form');
        ?>
    </form>
    <?php 
    /** 
    <div class="nk-data data-list">
        <div class="data-head">
            <h6 class="overline-title">Preferences</h6>
        </div>
        <div class="data-item">
            <div class="data-col">
                <span class="data-label w-25">Language</span>
                <span class="data-value w-100">English (United State)</span>
            </div>
            <div class="data-col data-col-end w-15"><a href="#" class="link link-primary">Change Language</a></div>
        </div><!-- data-item -->
        <div class="data-item">
            <div class="data-col">
                <span class="data-label w-25">Date Format</span>
                <span class="data-value w-100">M d, YYYY</span>
            </div>
            <div class="data-col data-col-end w-15"><a href="#" class="link link-primary">Change</a></div>
        </div><!-- data-item -->
        <div class="data-item">
            <div class="data-col">
                <span class="data-label w-25">Timezone</span>
                <span class="data-value w-100">Bangladesh (GMT +6)</span>
            </div>
            <div class="data-col data-col-end w-15"><a href="#" class="link link-primary">Change</a></div>
        </div><!-- data-item -->
    </div><!-- data-list -->
    */
    ?>
</div><!-- .nk-block -->
<script type="text/javascript"> 
const userInfoForm		    = document.querySelector("#updateInvestorProfileForm");
const userInfoSubmit	    = {};
if (userInfoForm) { 
    userInfoForm.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();
		const formData 		= new FormData(); 
        //Get Form data in object OR
		userInfoForm.querySelectorAll("input").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            userInfoSubmit[inputField.name] = inputField.value;
        });  
        userInfoForm.querySelectorAll("select").forEach((inputField) => {
            formData.append(inputField.name,inputField.value);
            userInfoSubmit[inputField.name] = inputField.value;
        });  
        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });
        //Console log to show you how it looks
        // console.log(userInfoSubmit);
        // console.log(JSON.stringify(userInfoSubmit));
        console.log(...formData);
        //Fetch
        try {
            const result = await fetch("<?= site_url('Profile-Manager'); ?>", {
			
			method: "POST",
			body: JSON.stringify(userInfoSubmit),
            headers: { "Content-Type": "application/json" },
			credentials: "same-origin",
			redirect: "manual",
            });
            const data = await result;
		    location.href = <?php echo '\'' . site_url('/Investor-Profile') . '\'';?>;
            console.log(data);
        } catch (err) {
            //If fetch doesn't work, maker 
            console.log(err);
        }
    });
}
</script> 