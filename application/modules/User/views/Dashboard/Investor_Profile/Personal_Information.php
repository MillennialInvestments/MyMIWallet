<style>
.data-item .icon{color: white !important;}
</style>
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
    <div class="nk-data data-list">
        <div class="data-head">
            <h6 class="overline-title">Basics</h6>
        </div>
        <div class="data-item">
            <div class="data-col" id="col_email">
                <span class="data-label">Email</span>
                <span class="data-value" id="email"><?php echo $cuEmail; ?></span>
                <span class="d-none" id="email_inputType">email</span>
            </div>
            <div class="data-col data-col-end">
                <span class="data-more" onClick="email_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
            </div>
        </div><!-- Email data-item -->
        <script>
            function email_Switch(e) {
                let txt                 = document.getElementById('email').innerText;
                let input               = document.getElementById('email_inputType').innerText;
                let element             = document.getElementById('col_email');

                element.innerHTML       = `
                    <span class="data-label">Email</span>
                    <form class="data-value" id="editPersonalInfo">
                        <span class="d-none" id="old-text">${txt}</span>
                        <span class="d-none" id="${input}_inputType">${input}</span>
                        <div class="input-group">
                            <input type="hidden" name="id" id="id" value="<?php echo set_value('id', isset($user) ? $user->id : $cuID); ?>" />
                            <input class="form-control" name="${input}" id="${input}" value='${txt}' />
                            <div class="input-group-append">
                                <input class="btn btn-primary" type="submit" name="register" id="submitUserInfo" value="Submit" />
                                <button class="btn btn-sm btn-danger text-white" type="button" onblur='email_Reset(this)'><i class="icon ni ni-cross-circle"></i></button>
                            </div> 
                        </div>
                        <?php Events::trigger('render_user_form'); ?>
                    </form>
                `;
                document.getElementsByTagName('input')[0].focus();
            }

            function email_Reset(e) {
                let txt                 = document.getElementById('old-text').innerHTML;
                let element             = document.getElementById('col_email');

                element.innerHTML = `
                <span class="data-label">Email</span>
                <span class="data-value" id="email"><?php echo $cuEmail; ?></span>
                <span class="d-none" id="email_inputType">email</span>
                `;
            }
        </script>
        <div class="data-item">
            <div class="data-col" id="col_display_name">
                <span class="data-label">Display Name</span>
                <span class="data-value" id="display_name"><?php echo $cuDisplayName; ?></span>
                <span class="d-none" id="display_name_inputType">display_name</span>
            </div>
            <div class="data-col data-col-end">
                <span class="data-more" onClick="display_name_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
            </div>
        </div><!-- Display data-item -->
        <script>
            function display_name_Switch(e) {
                let txt                 = document.getElementById('display_name').innerText;
                let input               = document.getElementById('display_name_inputType').innerText;
                let element             = document.getElementById('col_display_name');

                element.innerHTML       = `
                    <span class="data-label">Display Name</span>
                    <form class="data-value" id="editPersonalInfo">
                        <span class="d-none" id="old-text">${txt}</span>
                        <span class="d-none" id="${input}_inputType">${input}</span>
                        <div class="input-group">
                            <input type="hidden" name="id" id="id" value="<?php echo set_value('id', isset($user) ? $user->id : $cuID); ?>" />
                            <input class="form-control" name="${input}" id="${input}" value='${txt}' />
                            <div class="input-group-append">
                                <input class="btn btn-primary" type="submit" name="register" id="submitUserInfo" value="Submit" />
                                <button class="btn btn-sm btn-danger text-white" type="button" onblur='display_name_Reset(this)'><i class="icon ni ni-cross-circle"></i></button>
                            </div> 
                        </div>
                        <?php Events::trigger('render_user_form'); ?>
                    </form>
                `;
                document.getElementsByTagName('input')[0].focus();
            }

            function display_name_Reset(e) {
                let txt                 = document.getElementById('old-text').innerHTML;
                let element             = document.getElementById('col_display_name');

                element.innerHTML = `
                <span class="data-label">Display Name</span>
                <span class="data-value" id="display_name"><?php echo $cuDisplayName; ?></span>
                <span class="d-none" id="display_name_inputType">display_name</span>
                `;
            }
        </script>
        <div class="data-item">
            <div class="data-col" id="col_first_name">
                <span class="data-label">First Name</span>
                <span class="data-value" id="first_name"><?php echo $cuFirstName; ?></span>
                <span class="d-none" id="first_name_inputType">first_name</span>
            </div>
            <div class="data-col data-col-end">
                <span class="data-more" onClick="first_name_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
            </div>
        </div><!-- First Name data-item -->
        <script>
            function first_name_Switch(e) {
                let txt                 = document.getElementById('first_name').innerText;
                let input               = document.getElementById('first_name_inputType').innerText;
                let element             = document.getElementById('col_first_name');

                element.innerHTML       = `
                    <span class="data-label">First Name</span>
                    <form class="data-value" id="editPersonalInfo">
                        <span class="d-none" id="old-text">${txt}</span>
                        <span class="d-none" id="${input}_inputType">${input}</span>
                        <div class="input-group">
                            <input type="hidden" name="id" id="id" value="<?php echo set_value('id', isset($user) ? $user->id : $cuID); ?>" />
                            <input class="form-control" name="${input}" id="${input}" value='${txt}' />
                            <div class="input-group-append">
                                <input class="btn btn-primary" type="submit" name="register" id="submitUserInfo" value="Submit" />
                                <button class="btn btn-sm btn-danger text-white" type="button" onblur='first_name_Reset(this)'><i class="icon ni ni-cross-circle"></i></button>
                            </div> 
                        </div>
                        <?php Events::trigger('render_user_form'); ?>
                    </form>
                `;
                document.getElementsByTagName('input')[0].focus();
            }

            function first_name_Reset(e) {
                let txt                 = document.getElementById('old-text').innerHTML;
                let element             = document.getElementById('col_first_name');

                element.innerHTML = `
                <span class="data-label">First Name</span>
                <span class="data-value" id="first_name"><?php echo $cuFirstName; ?></span>
                <span class="d-none" id="first_name_inputType">first_name</span>
                `;
            }
        </script>
        <div class="data-item">
            <div class="data-col" id="col_middle_name">
                <span class="data-label">Middle Name</span>
                <span class="data-value" id="middle_name"><?php echo $cuMiddleName; ?></span>
                <span class="d-none" id="middle_name_inputType">middle_name</span>
            </div>
            <div class="data-col data-col-end">
                <span class="data-more" onClick="middle_name_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
            </div>
        </div><!-- Middle Name data-item -->
        <script>
            function middle_name_Switch(e) {
                let txt                 = document.getElementById('middle_name').innerText;
                let input               = document.getElementById('middle_name_inputType').innerText;
                let element             = document.getElementById('col_middle_name');

                element.innerHTML       = `
                    <span class="data-label">Middle Name</span>
                    <form class="data-value" id="editPersonalInfo">
                        <span class="d-none" id="old-text">${txt}</span>
                        <span class="d-none" id="${input}_inputType">${input}</span>
                        <div class="input-group">
                            <input type="hidden" name="id" id="id" value="<?php echo set_value('id', isset($user) ? $user->id : $cuID); ?>" />
                            <input class="form-control" name="${input}" id="${input}" value='${txt}' />
                            <div class="input-group-append">
                                <input class="btn btn-primary" type="submit" name="register" id="submitUserInfo" value="Submit" />
                                <button class="btn btn-sm btn-danger text-white" type="button" onblur='middle_name_Reset(this)'><i class="icon ni ni-cross-circle"></i></button>
                            </div> 
                        </div>
                        <?php Events::trigger('render_user_form'); ?>
                    </form>
                `;
                document.getElementsByTagName('input')[0].focus();
            }

            function middle_name_Reset(e) {
                let txt                 = document.getElementById('old-text').innerHTML;
                let element             = document.getElementById('col_middle_name');

                element.innerHTML = `
                <span class="data-label">Middle Name</span>
                <span class="data-value" id="middle_name"><?php echo $cuMiddleName; ?></span>
                <span class="d-none" id="middle_name_inputType">middle_name</span>
                `;
            }
        </script>
        <div class="data-item">
            <div class="data-col" id="col_last_name">
                <span class="data-label">Last Name</span>
                <span class="data-value" id="last_name"><?php echo $cuLastName; ?></span>
                <span class="d-none" id="last_name_inputType">last_name</span>
            </div>
            <div class="data-col data-col-end">
                <span class="data-more" onClick="last_name_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
            </div>
        </div><!-- Last Name data-item -->
        <script>
            function last_name_Switch(e) {
                let txt                 = document.getElementById('last_name').innerText;
                let input               = document.getElementById('last_name_inputType').innerText;
                let element             = document.getElementById('col_last_name');

                element.innerHTML       = `
                    <span class="data-label">Last Name</span>
                    <form class="data-value" id="editPersonalInfo">
                        <span class="d-none" id="old-text">${txt}</span>
                        <span class="d-none" id="${input}_inputType">${input}</span>
                        <div class="input-group">
                            <input type="hidden" name="id" id="id" value="<?php echo set_value('id', isset($user) ? $user->id : $cuID); ?>" />
                            <input class="form-control" name="${input}" id="${input}" value='${txt}' />
                            <div class="input-group-append">
                                <input class="btn btn-primary" type="submit" name="register" id="submitUserInfo" value="Submit" />
                                <button class="btn btn-sm btn-danger text-white" type="button" onblur='last_name_Reset(this)'><i class="icon ni ni-cross-circle"></i></button>
                            </div> 
                        </div>
                        <?php Events::trigger('render_user_form'); ?>
                    </form>
                `;
                document.getElementsByTagName('input')[0].focus();
            }

            function last_name_Reset(e) {
                let txt                 = document.getElementById('old-text').innerHTML;
                let element             = document.getElementById('col_last_name');

                element.innerHTML = `
                <span class="data-label">Last Name</span>
                <span class="data-value" id="last_name"><?php echo $cuLastName; ?></span>
                <span class="d-none" id="last_name_inputType">last_name</span>
                `;
            }
        </script>
        <div class="data-item">
            <div class="data-col" id="col_name_suffix">
                <span class="data-label">Suffix</span>
                <span class="data-value" id="name_suffix"><?php echo $cuNameSuffix; ?></span>
                <span class="d-none" id="name_suffix_inputType">name_suffix</span>
            </div>
            <div class="data-col data-col-end">
                <span class="data-more" onClick="name_suffix_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
            </div>
        </div><!-- Name Suffix data-item -->
        <script>
            function name_suffix_Switch(e) {
                let txt                 = document.getElementById('name_suffix').innerText;
                let input               = document.getElementById('name_suffix_inputType').innerText;
                let element             = document.getElementById('col_name_suffix');

                element.innerHTML       = `
                    <span class="data-label">Suffix</span>
                    <form class="data-value" id="editPersonalInfo">
                        <span class="d-none" id="old-text">${txt}</span>
                        <span class="d-none" id="${input}_inputType">${input}</span>
                        <div class="input-group">
                            <input type="hidden" name="id" id="id" value="<?php echo set_value('id', isset($user) ? $user->id : $cuID); ?>" />
                            <input class="form-control" name="${input}" id="${input}" value='${txt}' />
                            <div class="input-group-append">
                                <input class="btn btn-primary" type="submit" name="register" id="submitUserInfo" value="Submit" />
                                <button class="btn btn-sm btn-danger text-white" type="button" onblur='name_suffix_Reset(this)'><i class="icon ni ni-cross-circle"></i></button>
                            </div> 
                        </div>
                        <?php Events::trigger('render_user_form'); ?>
                    </form>
                `;
                document.getElementsByTagName('input')[0].focus();
            }

            function name_suffix_Reset(e) {
                let txt                 = document.getElementById('old-text').innerHTML;
                let element             = document.getElementById('col_name_suffix');

                element.innerHTML = `
                <span class="data-label">Suffix</span>
                <span class="data-value" id="name_suffix"><?php echo $cuNameSuffix; ?></span>
                <span class="d-none" id="name_suffix_inputType">name_suffix</span>
                `;
            }
        </script>
        <div class="data-item">
            <div class="data-col" id="col_phone">
                <span class="data-label">Phone</span>
                <span class="data-value" id="phone"><?php echo $cuPhone; ?></span>
                <span class="d-none" id="phone_inputType">phone</span>
            </div>
            <div class="data-col data-col-end">
                <span class="data-more" onClick="phone_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
            </div>
        </div><!-- Phone data-item -->
        <script>
            function phone_Switch(e) {
                let txt                 = document.getElementById('phone').innerText;
                let input               = document.getElementById('phone_inputType').innerText;
                let element             = document.getElementById('col_phone');

                element.innerHTML       = `
                    <span class="data-label">Phone</span>
                    <form class="data-value" id="editPersonalInfo">
                        <span class="d-none" id="old-text">${txt}</span>
                        <span class="d-none" id="${input}_inputType">${input}</span>
                        <div class="input-group">
                            <input type="hidden" name="id" id="id" value="<?php echo set_value('id', isset($user) ? $user->id : $cuID); ?>" />
                            <input class="form-control" name="${input}" id="${input}" value='${txt}' />
                            <div class="input-group-append">
                                <input class="btn btn-primary" type="submit" name="register" id="submitUserInfo" value="Submit" />
                                <button class="btn btn-sm btn-danger text-white" type="button" onblur='phone_Reset(this)'><i class="icon ni ni-cross-circle"></i></button>
                            </div> 
                        </div>
                        <?php Events::trigger('render_user_form'); ?>
                    </form>
                `;
                document.getElementsByTagName('input')[0].focus();
            }

            function phone_Reset(e) {
                let txt                 = document.getElementById('old-text').innerHTML;
                let element             = document.getElementById('col_phone');

                element.innerHTML = `
                <span class="data-label">Phone</span>
                <span class="data-value" id="phone"><?php echo $cuPhone; ?></span>
                <span class="d-none" id="phone_inputType">phone</span>
                `;
            }
        </script>
        <div class="data-item">
            <div class="data-col" id="col_dob">
                <span class="data-label">Date of Birth</span>
                <span class="data-value" id="dob"><?php //echo $cuPhone; ?></span>
                <span class="d-none" id="dob_inputType">dob</span>
            </div>
            <div class="data-col data-col-end">
                <span class="data-more" onClick="dob_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
            </div>
        </div><!-- Address data-item -->
        <script>
            function dob_Switch(e) {
                let txt                 = document.getElementById('dob').innerText;
                let input               = document.getElementById('dob_inputType').innerText;
                let element             = document.getElementById('col_dob');

                element.innerHTML       = `
                    <span class="data-label">Date of Birth</span>
                    <form class="data-value" id="editPersonalInfo">
                        <span class="d-none" id="old-text">${txt}</span>
                        <span class="d-none" id="${input}_inputType">${input}</span>
                        <div class="input-group">
                            <input type="hidden" name="id" id="id" value="<?php echo set_value('id', isset($user) ? $user->id : $cuID); ?>" />
                            <input class="form-control" name="${input}" id="${input}" value='${txt}' />
                            <div class="input-group-append">
                                <input class="btn btn-primary" type="submit" name="register" id="submitUserInfo" value="Submit" />
                                <button class="btn btn-sm btn-danger text-white" type="button" onblur='dob_Reset(this)'><i class="icon ni ni-cross-circle"></i></button>
                            </div> 
                        </div>
                        <?php Events::trigger('render_user_form'); ?>
                    </form>
                `;
                document.getElementsByTagName('input')[0].focus();
            }

            function dob_Reset(e) {
                let txt                 = document.getElementById('old-text').innerHTML;
                let element             = document.getElementById('col_dob');

                element.innerHTML = `
                <span class="data-label">Date of Birth</span>
                <span class="data-value" id="dob"><?php //echo $cuPhone; ?></span>
                <span class="d-none" id="dob_inputType">dob</span>
                `;
            }
        </script>
        <div class="data-item">
            <div class="data-col" id="col_address">
                <span class="data-label">Address</span>
                <span class="data-value" id="address"><?php echo $cuAddress; ?></span>
                <span class="d-none" id="address_inputType">address</span>
            </div>
            <div class="data-col data-col-end">
                <span class="data-more" onClick="address_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
            </div>
        </div><!-- Street Address data-item -->
        <script>
            function address_Switch(e) {
                let txt                 = document.getElementById('address').innerText;
                let input               = document.getElementById('address_inputType').innerText;
                let element             = document.getElementById('col_address');

                element.innerHTML       = `
                    <span class="data-label">Address</span>
                    <form class="data-value" id="editPersonalInfo">
                        <span class="d-none" id="old-text">${txt}</span>
                        <span class="d-none" id="${input}_inputType">${input}</span>
                        <div class="input-group">
                            <input type="hidden" name="id" id="id" value="<?php echo set_value('id', isset($user) ? $user->id : $cuID); ?>" />
                            <input class="form-control" name="${input}" id="${input}"' value='${txt}' />
                            <div class="input-group-append">
                                <input class="btn btn-primary" type="submit" name="register" id="submitUserInfo" value="Submit" />
                                <button class="btn btn-sm btn-danger text-white" type="button" onblur='address_Reset(this)><i class="icon ni ni-cross-circle"></i></button>
                            </div> 
                        </div>
                        <?php Events::trigger('render_user_form'); ?>
                    </form>
                `;
                document.getElementsByTagName('input')[0].focus();
            }

            function address_Reset(e) {
                let txt                 = document.getElementById('old-text').innerHTML;
                let element             = document.getElementById('col_address');

                element.innerHTML = `
                <span class="data-label">Address</span>
                <span class="data-value" id="address"><?php echo $cuAddress; ?></span>
                <span class="d-none" id="address_inputType">address</span>
                `;
            }
        </script>
        <div class="data-item">
            <div class="data-col" id="col_city">
                <span class="data-label">City</span>
                <span class="data-value" id="city"><?php echo $cuCity; ?></span>
                <span class="d-none" id="city_inputType">city</span>
            </div>
            <div class="data-col data-col-end">
                <span class="data-more" onClick="city_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
            </div>
        </div><!-- City data-item -->
        <script>
            function city_Switch(e) {
                let txt                 = document.getElementById('city').innerText;
                let input               = document.getElementById('city_inputType').innerText;
                let element             = document.getElementById('col_city');

                element.innerHTML       = `
                    <span class="data-label">City</span>
                    <form class="data-value" id="editPersonalInfo">
                        <span class="d-none" id="old-text">${txt}</span>
                        <span class="d-none" id="${input}_inputType">${input}</span>
                        <div class="input-group">
                            <input type="hidden" name="id" id="id" value="<?php echo set_value('id', isset($user) ? $user->id : $cuID); ?>" />
                            <input class="form-control" name="${input}" id="${input}" value='${txt}' />
                            <div class="input-group-append">
                                <input class="btn btn-primary" type="submit" name="register" id="submitUserInfo" value="Submit" />
                                <button class="btn btn-sm btn-danger text-white" type="button" onblur='city_Reset(this)'><i class="icon ni ni-cross-circle"></i></button>
                            </div> 
                        </div>
                        <?php Events::trigger('render_user_form'); ?>
                    </form>
                `;
                document.getElementsByTagName('input')[0].focus();
            }

            function city_Reset(e) {
                let txt                 = document.getElementById('old-text').innerHTML;
                let element             = document.getElementById('col_city');

                element.innerHTML = `
                <span class="data-label">City</span>
                <span class="data-value" id="city"><?php echo $cuCity; ?></span>
                <span class="d-none" id="city_inputType">city</span>
                `;
            }
        </script>
        <div class="data-item">
            <div class="data-col" id="col_state">
                <span class="data-label">State</span>
                <span class="data-value" id="state"><?php echo $cuState; ?></span>
                <span class="d-none" id="state_inputType">state</span>
            </div>
            <div class="data-col data-col-end">
                <span class="data-more" onClick="state_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
            </div>
        </div><!-- State data-item -->
        <script>
            function state_Switch(e) {
                let txt                 = document.getElementById('state').innerText;
                let input               = document.getElementById('state_inputType').innerText;
                let element             = document.getElementById('col_state');

                element.innerHTML       = `
                    <span class="data-label">State</span>
                    <form class="data-value" id="editPersonalInfo">
                        <span class="d-none" id="old-text">${txt}</span>
                        <span class="d-none" id="${input}_inputType">${input}</span>
                        <div class="input-group">
                            <input type="hidden" name="id" id="id" value="<?php echo set_value('id', isset($user) ? $user->id : $cuID); ?>" />
                            <input class="form-control" name="${input}" id="${input}" value='${txt}' />
                            <div class="input-group-append">
                                <input class="btn btn-primary" type="submit" name="register" id="submitUserInfo" value="Submit" />
                                <button class="btn btn-sm btn-danger text-white" type="button" onblur='state_Reset(this)'><i class="icon ni ni-cross-circle"></i></button>
                            </div> 
                        </div>
                        <?php Events::trigger('render_user_form'); ?>
                    </form>
                `;
                document.getElementsByTagName('input')[0].focus();
            }

            function state_Reset(e) {
                let txt                 = document.getElementById('old-text').innerHTML;
                let element             = document.getElementById('col_state');

                element.innerHTML = `
                <span class="data-label">State</span>
                <span class="data-value" id="state"><?php echo $cuState; ?></span>
                <span class="d-none" id="state_inputType">state</span>
                `;
            }
        </script>
        <div class="data-item">
            <div class="data-col" id="col_country">
                <span class="data-label">Country</span>
                <span class="data-value" id="country"><?php echo $cuCountry; ?></span>
                <span class="d-none" id="country_inputType">country</span>
            </div>
            <div class="data-col data-col-end">
                <span class="data-more" onClick="country_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
            </div>
        </div><!-- Country data-item -->
        <script>
            function country_Switch(e) {
                let txt                 = document.getElementById('country').innerText;
                let input               = document.getElementById('country_inputType').innerText;
                let element             = document.getElementById('col_country');

                element.innerHTML       = `
                    <span class="data-label">Country</span>
                    <form class="data-value" id="editPersonalInfo">
                        <span class="d-none" id="old-text">${txt}</span>
                        <span class="d-none" id="${input}_inputType">${input}</span>
                        <div class="input-group">
                            <input type="hidden" name="id" id="id" value="<?php echo set_value('id', isset($user) ? $user->id : $cuID); ?>" />
                            <input class="form-control" name="${input}" id="${input}" value='${txt}' />
                            <div class="input-group-append">
                                <input class="btn btn-primary" type="submit" name="register" id="submitUserInfo" value="Submit" />
                                <button class="btn btn-sm btn-danger text-white" type="button" onblur='country_Reset(this)'><i class="icon ni ni-cross-circle"></i></button>
                            </div> 
                        </div>
                        <?php Events::trigger('render_user_form'); ?>
                    </form>
                `;
                document.getElementsByTagName('input')[0].focus();
            }

            function country_Reset(e) {
                let txt                 = document.getElementById('old-text').innerHTML;
                let element             = document.getElementById('col_country');

                element.innerHTML = `
                <span class="data-label">Country</span>
                <span class="data-value" id="country"><?php echo $cuCountry; ?></span>
                <span class="d-none" id="country_inputType">country</span>
                `;
            }
        </script>
        <div class="data-item">
            <div class="data-col" id="col_zipcode">
                <span class="data-label">Zip Code</span>
                <span class="data-value" id="zipcode"><?php echo $cuZipCode; ?></span>
                <span class="d-none" id="zipcode_inputType">zipcode</span>
            </div>
            <div class="data-col data-col-end">
                <span class="data-more" onClick="zipcode_Switch(this)"><em class="icon ni ni-forward-ios"></em></span>
            </div>
        </div><!-- Zip Code data-item -->
        <script>
            function zipcode_Switch(e) {
                let txt                 = document.getElementById('zipcode').innerText;
                let input               = document.getElementById('zipcode_inputType').innerText;
                let element             = document.getElementById('col_zipcode');

                element.innerHTML       = `
                    <span class="data-label">Zip Code</span>
                    <form class="data-value" id="editPersonalInfo">
                        <span class="d-none" id="old-text">${txt}</span>
                        <span class="d-none" id="${input}_inputType">${input}</span>
                        <div class="input-group">
                            <input type="hidden" name="id" id="id" value="<?php echo set_value('id', isset($user) ? $user->id : $cuID); ?>" />
                            <input class="form-control" name="${input}" id="${input}" value='${txt}' />
                            <div class="input-group-append">
                                <input class="btn btn-primary" type="submit" name="register" id="submitUserInfo" value="Submit" />
                                <button class="btn btn-sm btn-danger text-white" type="button" onblur='zipcode_Reset(this)'><i class="icon ni ni-cross-circle"></i></button>
                            </div> 
                        </div>
                        <?php Events::trigger('render_user_form'); ?>
                    </form>
                `;
                document.getElementsByTagName('input')[0].focus();
            }

            function zipcode_Reset(e) {
                let txt                 = document.getElementById('old-text').innerHTML;
                let element             = document.getElementById('col_zipcode');

                element.innerHTML = `
                <span class="data-label">Zip Code</span>
                <span class="data-value" id="zipcode"><?php echo $cuZipCode; ?></span>
                <span class="d-none" id="zipcode_inputType">zipcode</span>
                `;
            }
        </script>
    </div><!-- data-list -->
    <?php 
    /** 
    <div class="nk-data data-list">
        <div class="data-head">
            <h6 class="overline-title">Preferences</h6>
        </div>
        <div class="data-item">
            <div class="data-col">
                <span class="data-label">Language</span>
                <span class="data-value">English (United State)</span>
            </div>
            <div class="data-col data-col-end"><a href="#" class="link link-primary">Change Language</a></div>
        </div><!-- data-item -->
        <div class="data-item">
            <div class="data-col">
                <span class="data-label">Date Format</span>
                <span class="data-value">M d, YYYY</span>
            </div>
            <div class="data-col data-col-end"><a href="#" class="link link-primary">Change</a></div>
        </div><!-- data-item -->
        <div class="data-item">
            <div class="data-col">
                <span class="data-label">Timezone</span>
                <span class="data-value">Bangladesh (GMT +6)</span>
            </div>
            <div class="data-col data-col-end"><a href="#" class="link link-primary">Change</a></div>
        </div><!-- data-item -->
    </div><!-- data-list -->
    */
    ?>
</div><!-- .nk-block -->
<script type="text/javascript"> 
const userInfoForm		    = document.querySelector("#editPersonalInfo");
const submitUserInfo	    = {};
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