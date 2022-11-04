<?php
$pageURIA                                   = $this->uri->segment(1);
$pageURIB                                   = $this->uri->segment(2);
$pageURIC                                   = $this->uri->segment(3);
$pageURID                                   = $this->uri->segment(4);
$pageURIE                                   = $this->uri->segment(5);
$userID                                     = $pageURID; 
$redirect_url                               = current_url();
$dashboardTitle                             = 'Users /';
$dashboardSubtitle                          = 'Distribute Coins'; 
$userAccount                            
?>
<div class="nk-block">
    <div class="row gy-gs">
        <div class="col-lg-12 col-xl-12">
            <div class="nk-block">
                <div class="nk-block-head-xs">
                    <div class="nk-block-head-content">
                        <h1 class="nk-block-title title"><?php echo $dashboardTitle; ?></h1>
                        <h2 class="nk-block-title subtitle"><?php echo $dashboardSubtitle; ?></h2>
                        <p id="private_key"></p>
                        <p id="address"></p>
                        <a href="<?php echo site_url('/Management'); ?>">Back to Dashboard</a>							
                    </div>
                </div>
            </div>
            <div class="nk-block">
                <div class="row">
                    <div class="col-sm-6 col-lg-8 col-xxl-9">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">Distribute Coins</h5>
                                </div>
                                <form action="#">
                                    <input class="" type="hidden" id="redirect_url" name="redirect_url" value="<?php echo set_value('redirect_url', isset($user) ? $user->redirect_url : $redirect_url); ?>" /> 
                                    <?php
                                    if ($userAccount['cuUserType'] === 'Beta') {
                                        ?>
                                    <input class="" type="hidden" id="beta" name="beta" value="<?php echo set_value('beta', isset($user) ? $user->beta : 'Yes'); ?>" /> 
                                    <?php
                                    } else {
                                            ?>             
                                    <input class="" type="hidden" id="beta" name="beta" value="<?php echo set_value('beta', isset($user) ? $user->beta : 'No'); ?>" /> 
                                    <?php
                                        }
                                    ?>
                                    <input class="" type="hidden" id="user_id" name="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $userAccount['cuID']); ?>" /> 
                                    <input class="" type="hidden" id="user_email" name="user_email" value="<?php echo set_value('user_email', isset($user) ? $user->user_email : $userAccount['cuEmail']); ?>" />  
                                    <input class="" type="hidden" id="initial_value" name="initial_value" value="<?php echo set_value('initial_value', isset($user) ? $user->initial_value : $initial_value); ?>" />
                                    <input class="" type="hidden" id="available_coins" name="available_coins" value="<?php echo set_value('available_coins', isset($user) ? $user->available_coins : $available_coins); ?>" />
                                    <input class="" onChange="calculateByCoinAmount(); return false;" type="hidden" id="initial_coin_value" name="initial_coin_value" value="<?php echo set_value('initial_coin_value', isset($user) ? $user->initial_coin_value : $coin_value); ?>" />    
                                    <!-- <input class="" onChange="calculateByCoinAmount(); return false;" type="hidden" id="total" name="total" value="<?php //echo set_value('total', isset($user) ? $user->total : ''); ?>" />   -->
                                    <input class="" onChange="calculateByCoinAmount(); return false;" type="hidden" id="total_cost" name="total_cost" value="<?php echo set_value('total_cost', isset($user) ? $user->total_cost : ''); ?>" />
                                    <input class="" onChange="calculateByCoinAmount(); return false;" type="hidden" id="total_fees" name="total_fees" value="<?php echo set_value('total_fees', isset($user) ? $user->total_fees : ''); ?>" />
                                    <input class="" onChange="calculateByCoinAmount(); return false;" type="hidden" id="gas_fee" name="gas_fee" value="<?php echo set_value('gas_fee', isset($user) ? $user->gas_fee : $gas_fee); ?>" />                 
                                    <input class="" onChange="calculateByCoinAmount(); return false;" type="hidden" id="trans_fee" name="trans_fee" value="<?php echo set_value('trans_fee', isset($user) ? $user->trans_fee : $trans_fee); ?>" />  
                                    <input class="" onChange="calculateByCoinAmount(); return false;" type="hidden" id="trans_percent" name="trans_percent" value="<?php echo set_value('trans_percent', isset($user) ? $user->trans_percent : $trans_percent); ?>" />      
                                    <input class="" onChange="calculateByCoinAmount(); return false;" type="hidden" id="user_gas_fee" name="user_gas_fee" value="<?php echo set_value('user_gas_fee', isset($user) ? $user->user_gas_fee : ''); ?>" />  
                                    <input class="" onChange="calculateByCoinAmount(); return false;" type="hidden" id="user_trans_fees" name="user_trans_fees" value="<?php echo set_value('user_trans_fees', isset($user) ? $user->user_trans_fees : ''); ?>" />  
                                    <input class="" onChange="calculateByCoinAmount(); return false;" type="hidden" id="user_trans_percent" name="user_trans_percent" value="<?php echo set_value('user_trans_percent', isset($user) ? $user->user_trans_percent : ''); ?>" />      
                                    <div class="row g-4">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label" for="full-name-1">Asset</label>
                                                <div class="form-control-wrap">
                                                <?php
                                                    echo '
                                                    <select class="form-control" name="coin" id="coin" required="required">
                                                        <option>Select-Coin-Package</option>
                                                        <option value="MYMI">MYMI</option>
                                                        ';
                                                        foreach($getExchanges->result_array() as $exchange) {
                                                            $type_values                    = array(
                                                                $exchange['market_pair']    => $exchange['market_pair'],
                                                            );
                                                            foreach ($type_values as $value => $display_text) {
                                                                $selected = ($value == $this->input->post('amount')) ? ' selected="selected"' : "";
                                                                ;
    
                                                                echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                                                            }
                                                        }
                                                    echo '</select>';
                                                ?>						
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label" for="email-address-1">In Coin</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="total" id="total" value="<?php echo set_value('total', isset($user) ? $user->total : ''); ?>" onChange="calculateByCoinAmount(); return false;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label" for="email-address-1">In Currency</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="amount" id="amount" value="<?php echo set_value('amount', isset($user) ? $user->amount : ''); ?>" onChange="calculateByCoinAmount(); return false;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="email-address-1">Subtotal: <p class="mb-0" id="display_subtotal" onChange="calculateByCoinAmount(); return false;"></p></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="email-address-1">Fees: <p class="mb-0" id="display_fees" onChange="calculateByCoinAmount(); return false;"></p></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="email-address-1">Total: <p class="mb-0" id="display_total_costs" onChange="calculateByCoinAmount(); return false;"></p> </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="email-address-1">Total Coins: <p class="mb-0" id="display_total_coins" onChange="calculateByCoinAmount(); return false;"></p>  </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-lg btn-primary">Save Informations</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- .card --> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>