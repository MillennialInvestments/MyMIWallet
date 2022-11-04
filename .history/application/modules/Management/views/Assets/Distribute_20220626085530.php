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
$initial_value								= $_SESSION['allSessionData']['userGoldData']['myMIGInitialValue'];
$available_coins							= $_SESSION['allSessionData']['userGoldData']['coinSum'];
$coin_value									= $this->config->item('mymig_coin_value');
$gas_fee									= $this->config->item('gas_fee');
$trans_percent								= $this->config->item('trans_percent');
$trans_fee									= $this->config->item('trans_fee');
$this->db->from('bf_exchanges'); 
$this->db->where('alt_cur', 'No');
$this->db->where('int_cur', 'No'); 
$this->db->order_by('market_pair', 'ASC'); 
$getExchanges                               = $this->db->get(); 
if ($pageURIB === 'Assets') {
    $this->load->view('Management/Assets/Distribute/Overview'); 
} elseif ($pageURIB === 'Users') {
    $this->load-.v
}
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
                    <?php 
                    $userAccount            = $this->mymiuser->user_account_info($userID); 
                    // print_r($_SESSION);
                    echo '
                    <div class="col-sm-6 col-lg-4 col-xxl-3">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="team">
                                    <div class="team-options">
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#"><em class="icon ni ni-focus"></em><span>Quick View</span></a></li>
                                                    <li><a href="' . site_url('Users/Profile/' . $userAccount['cuID']) . '"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                    <li><a href="mailto:' . $userAccount['cuEmail'] . '"><em class="icon ni ni-mail"></em><span>Send Email</span></a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="' . site_url('Users/Force-Reset/' . $userAccount['cuID']) . '"><em class="icon ni ni-shield-star"></em><span>Reset Pass</span></a></li>
                                                    <!--<li><a href="#"><em class="icon ni ni-shield-off"></em><span>Reset 2FA</span></a></li>-->
                                                    <li><a href="' . site_url('Users/Block/' . $userAccount['cuID']) . '"><em class="icon ni ni-na"></em><span>Suspend User</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-card user-card-s2">
                                        <div class="user-avatar lg bg-primary">
                                            <span>' . $userAccount['cuFirstName'][0] . $userAccount['cuLastName'][0] . '</span>
                                            <div class="status dot dot-lg dot-success"></div>
                                        </div>
                                        <div class="user-info">
                                            <h6>' . $userAccount['cuFirstName'] . ' ' . $userAccount['cuLastName'] . '</h6>
                                            <span class="sub-text">' . $userAccount['cuUserType'] . ' User</span>
                                        </div>
                                    </div>
                                    <ul class="team-info">
                                        <li><span><strong>Join Date</strong></span><span>' . $userAccount['cuSignupDate'] . '</span></li>
                                        <li><span><strong>Contact</strong></span><span>' . $userAccount['cuPhone'] . '</span></li>
                                        <li><span><strong>Email</strong></span><span><a href="mailto:' . $userAccount['cuEmail'] . '">' . $userAccount['cuEmail'] . '</a></span></li>
                                    </ul>
                                    <div class="team-view">
                                        <a href="' . site_url('Management/Users/Profile/' . $userAccount['cuID']) . '" class="btn btn-block btn-dim btn-primary text-white"><span>View Profile</span></a>
                                    </div>
                                </div><!-- .team -->
                            </div><!-- .card-inner -->
                        </div><!-- .card -->
                    </div><!-- .col -->
                    ';
                    ?>
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
    <div class="row gy-gs">
        <div class="col-lg-12 col-xl-12">
            <div class="nk-block">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-bordered card-preview">
                            <table class="table table-orders">
                                <thead class="tb-odr-head">
                                    <tr class="tb-odr-item">
                                        <th class="tb-odr-info">
                                            <span class="tb-odr-id">Order ID</span>
                                            <span class="tb-odr-date d-none d-md-inline-block">Date</span>
                                        </th>
                                        <th class="tb-odr-amount">
                                            <span class="tb-odr-total">Amount</span>
                                            <span class="tb-odr-status d-none d-md-inline-block">Status</span>
                                        </th>
                                        <th class="tb-odr-action">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="tb-odr-body">
                                    <?php
                                    $this->db->from('bf_exchanges_orders'); 
                                    $this->db->where('user_id', $userAccount['cuID']);
                                    $getUserOrders              = $this->db->get();
                                    foreach($getUserOrders->result_array() as $userOrder) {
                                    echo '                                    
                                    <tr class="tb-odr-item">
                                        <td class="tb-odr-info">
                                            <span class="tb-odr-id"><a href="#">#' . $userOrder['id'] . '</a></span>
                                            <span class="tb-odr-date">' . date("F", strtotime($userOrder['month'])) . ' ' . date("jS", strtotime($userOrder['day'])) . ', ' . $userOrder['year'] . ' - ' . $userOrder['time'] .'</span>
                                        </td>
                                        <td class="tb-odr-amount">
                                            <span class="tb-odr-total">
                                                <span class="amount">$' . number_format($userOrder['amount'],2) . '</span>
                                            </span>
                                            <span class="tb-odr-status">
                                                <span class="badge badge-dot bg-warning">' . $userOrder['status'] . '</span>
                                            </span>
                                        </td>
                                        <td class="tb-odr-action">
                                            <div class="tb-odr-btns d-none d-md-inline">
                                                <a href="' . site_url('Management/Users/Orders/' . $userOrder['id']) . '" class="btn btn-sm btn-primary">View</a>
                                            </div>
                                            <div class="dropdown">
                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" data-offset="-8,0"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                    <ul class="link-list-plain">
                                                        <li><a href="#" class="text-primary">Edit</a></li>
                                                        <li><a href="#" class="text-danger">Remove</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    ';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div><!-- .card-preview -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function calculateByCoinAmount()
{
	var coin                                                            = document.getElementById('coin').value;    // Coin Market
    console.log(coin); 
    if (coin === "MYMI") {
            var total                                                   = document.getElementById('total').value;   // Number of Coins
            var amount                                                  = document.getElementById('amount').value;   // Number of Coins
        if (isNaN(amount)) {
            console.log("Coin-Based Transaction");
            // var amount                                                  = document.getElementById('amount').value;  // Number of Currency
            var coin_value 	                                            = <?php echo $_SESSION['allSessionData']['userCoinData']['mymic_coin_value']; ?>;
            var gas	 		                                            = document.getElementById('gas_fee').value; // Gas Fee Multiplier
            var tpercent	                                            = document.getElementById('trans_percent').value; // Subtotal Amount Multpilier 
            var trans_fee	                                            = document.getElementById('trans_fee').value;
            var tfee                                                    = parseInt(trans_fee); 
            var gasfee                                                  = total * gas; 
            var subtotal                                                = total - gasfee;
            var subAmount                                               = subtotal * coin_value;
            var transPercent                                            = (subAmount * tpercent) - subAmount;
            var transFees                                               = transPercent + tfee;
            var transFeesDisplay                                        = transFees.toFixed(2);
            var totalAmount                                             = parseInt(subAmount) + parseInt(transFeesDisplay);
            var totalAmountDisplay                                      = totalAmount.toFixed(2);
            var subTotalAmount                                          = subAmount.toFixed(2);
            var totalCoinAmount                                         = subtotal; 
            
            document.getElementById('amount').value                     = subTotalAmount; 
            document.getElementById('display_subtotal').innerHTML       = "$" + subTotalAmount; 
            document.getElementById('display_fees').innerHTML           = "$" + transFeesDisplay;
            document.getElementById('display_total_costs').innerHTML    = "$" + totalAmountDisplay;
            document.getElementById('display_total_coins').innerHTML    = totalCoinAmount + " MYMI";
            document.getElementById('initial_coin_value').value         = coin_value;
            document.getElementById('total_cost').value                 = totalAmountDisplay;
            document.getElementById('total_fees').value                 = transFees;
            document.getElementById('user_gas_fee').value               = gasfee;
            document.getElementById('user_trans_fees').value            = transFees;
            document.getElementById('user_trans_percent').value         = transPercent;


            //update
            // document.getElementById('display_total').innerHTML          = amount + " MYMI";
            // document.getElementById('total').value                      = amount;
            // document.getElementById('display_user_gas_fee').innerHTML   = gasfee;
            // document.getElementById('user_gas_fee').value               = gasfee;
            // document.getElementById('fees').value                       = expenses.toFixed(2);
            // document.getElementById('total_cost').value                 = total_cost.toFixed(2);
            // Validation
            var available_coins		                                    = <?php echo $_SESSION['allSessionData']['userCoinData']['myMICAvailableCoins']; ?>;
            var amount_avail		                                    = coin_value * available_coins;
            var amount_available	                                    = amount_avail.toFixed(2);
            // var total_costs			                                    = (coin_value * amount) + expenses.toFixed(8);
            console.log("total: " + total); 
            console.log("gas: " + gas); 
            console.log("tpercent: " + tpercent); 
            console.log("tfee: " + tfee); 
            console.log("gasfee: " + gasfee); 
            console.log("subtotal: " + subtotal); 
            console.log("subamount: " + subAmount); 
            console.log("transFees: " + transFees); 
            console.log("transFeesDisplay: " + transFeesDisplay); 
            console.log("totalAmount: " + totalAmount); 
            console.log("totalAmountDisplay: " + totalAmountDisplay); 
            console.log("subTotalAmount: " + subTotalAmount); 
            console.log("totalCoinAmount: " + totalCoinAmount); 
        } else if (isNaN(total)) {
            console.log("Amount-Based Transaction");
            var amount                                                  = document.getElementById('amount').value;  // Number of Currency
            // var total                                                   = document.getElementById('total').value;   // Number of Coins
            var coin_value 	                                            = <?php echo $_SESSION['allSessionData']['userCoinData']['mymic_coin_value']; ?>;
            var total                                                   = amount / coin_value;
            var gas	 		                                            = document.getElementById('gas_fee').value; // Gas Fee Multiplier
            var tpercent	                                            = document.getElementById('trans_percent').value; // Subtotal Amount Multpilier 
            var trans_fee	                                            = document.getElementById('trans_fee').value;
            var tfee                                                    = parseInt(trans_fee); 
            var gasfee                                                  = total * gas; 
            var subtotal                                                = total - gasfee;
            var subAmount                                               = total;
            var transPercent                                            = (subAmount * tpercent) - subAmount;
            var transFees                                               = transPercent + tfee;
            var transFeesDisplay                                        = transFees.toFixed(2);
            var totalAmount                                             = parseInt(subAmount) + parseInt(transFeesDisplay);
            var totalAmountDisplay                                      = totalAmount.toFixed(2);
            var subTotalAmount                                          = subAmount.toFixed(2);
            var totalCoinAmount                                         = subtotal; 
            
            document.getElementById('total').value                      = subTotalAmount; 
            document.getElementById('display_subtotal').innerHTML       = "$" + subTotalAmount; 
            document.getElementById('display_fees').innerHTML           = "$" + transFeesDisplay;
            document.getElementById('display_total_costs').innerHTML    = "$" + totalAmountDisplay;
            document.getElementById('display_total_coins').innerHTML    = totalCoinAmount + " MYMI";
            document.getElementById('initial_coin_value').value         = coin_value;
            document.getElementById('total_cost').value                 = totalAmountDisplay;
            document.getElementById('total_fees').value                 = transFees;
            document.getElementById('user_gas_fee').value               = gasfee;
            document.getElementById('user_trans_fees').value            = transFees;
            document.getElementById('user_trans_percent').value         = transPercent;


            //update
            // document.getElementById('display_total').innerHTML          = amount + " MYMI";
            // document.getElementById('total').value                      = amount;
            // document.getElementById('display_user_gas_fee').innerHTML   = gasfee;
            // document.getElementById('user_gas_fee').value               = gasfee;
            // document.getElementById('fees').value                       = expenses.toFixed(2);
            // document.getElementById('total_cost').value                 = total_cost.toFixed(2);
            // Validation
            var available_coins		                                    = <?php echo $_SESSION['allSessionData']['userCoinData']['myMICAvailableCoins']; ?>;
            var amount_avail		                                    = coin_value * available_coins;
            var amount_available	                                    = amount_avail.toFixed(2);
            // var total_costs			                                    = (coin_value * amount) + expenses.toFixed(8);
            console.log("total: " + total); 
            console.log("gas: " + gas); 
            console.log("tpercent: " + tpercent); 
            console.log("tfee: " + tfee); 
            console.log("gasfee: " + gasfee); 
            console.log("subtotal: " + subtotal); 
            console.log("subamount: " + subAmount); 
            console.log("transFees: " + transFees); 
            console.log("transFeesDisplay: " + transFeesDisplay); 
            console.log("totalAmount: " + totalAmount); 
            console.log("totalAmountDisplay: " + totalAmountDisplay); 
            console.log("subTotalAmount: " + subTotalAmount); 
            console.log("totalCoinAmount: " + totalCoinAmount); 
        }
    } else if (coin === "MYMIG") {
        var coin_value 	        = 1;
        var amount 		        = document.getElementById('amount').value;
        var gas	 		        = document.getElementById('gas_fee').value;
        var tpercent	        = document.getElementById('trans_percent').value;
        var tfee 		        = document.getElementById('trans_fee').value;
        var gasfee		        = amount * gas;
        //do the math
        var subtotal 	        = amount;
        var total		        = subtotal - gasfee;
        var expenses	        = amount * tpercent + +tfee;
        var total_cost	        = +amount + +expenses;
        // Validation
        var amount_avail		= coin_value * available_coins;
        var amount_available	= amount_avail.toFixed(2);
        var total_coins			= amount / coin_value;
        console.log("Amount: " + amount); 
        console.log("Available Coins: " + available_coins); 
        console.log("Coin Value: " + coin_value); 
        console.log("Amount Available: " + amount_available); 
        console.log("Total Coins: " + total_coins); 
        console.log("Min Alert Text: " + minText); 
        console.log("Max Alert Text: " + maxText); 
        
        // console.log("Adj. Coin Value: " + adj_coin_value); 
        // console.log("Adj. Amount: " + adj_amount); 
        // console.log("Adj. Gas: " + adj_gas); 
        // console.log("Adj. Trans Percent: " + adj_tpercent); 
        // console.log("Adj. Trans Fee: " + adj_tfee); 
        // console.log("Adj. Gas Fee: " + adj_gasfee); 
        // console.log("Adj. Subtotal: " + adj_subtotal); 
        // console.log("Adj. Total: " + adj_total); 
        // console.log("Adj. Expenses: " + adj_expenses); 
        // console.log("Adj. Total Cost: " + adj_total_cost); 
    }
    // if (coin != 'MYMI' || coin != 'MYMIG') {

    // }
    // var coin_value 	= document.getElementById('coin_value').value;
	// var amount 		= document.getElementById('amount').value;
	// var gas	 		= document.getElementById('gas_fee').value;
	// var tpercent	= document.getElementById('trans_percent').value;
	// var tfee 		= document.getElementById('trans_fee').value;
	// var gasfee		= amount * gas;
	// //do the math
	// var subtotal 	= amount / coin_value;
	// var total		= subtotal - gasfee;
	// var expenses	= amount * tpercent + +tfee;
	// var total_cost	= +amount + +expenses;
	// //update
	// document.getElementById('display_total').innerHTML = total.toFixed(0) + " MYMI";
	// document.getElementById('total').value = total;
	// document.getElementById('display_user_gas_fee').innerHTML = gasfee;
	// document.getElementById('user_gas_fee').value = gasfee;
	// document.getElementById('display_fees').innerHTML = "$" + expenses.toFixed(2);
	// document.getElementById('fees').value = expenses.toFixed(2);
	// document.getElementById('display_total_cost').innerHTML = "$" + total_cost.toFixed(2);
	// document.getElementById('total_cost').value = total_cost.toFixed(2);
	// // Validation
	// var available_coins		= ;
	// var minimum				= ;
	// var amount_avail		= coin_value * available_coins;
	// var amount_available	= amount_avail.toFixed(2);
	// var total_coins			= amount / coin_value;
	// var minText 			= "Minimum Amount must be $" + minimum + ".00 or more!";;
	// var maxText 			= "Maximum Amount of MyMI Coin must be $" + amount_available + " or less! Only " + available_coins + " MyMI Coins available to purchase.";

	// // If x is Not a Number or less than one or greater than 10
	// if (isNaN(amount) || amount < ) {
	// 	alert(minText);
	// 	document.getElementById("amount").value = minimum;
	// }
	// // If x is Not a Number or less than one or greater than 10
	// if (isNaN(total_coins) || total_coins > available_coins) {
	// 	alert(maxText);
	// 	document.getElementById("amount").value = amount_available;
	// 	var adj_coin_value 	= document.getElementById('coin_value').value;
	// 	var adj_amount 		= document.getElementById('amount').value;
	// 	var adj_gas	 		= document.getElementById('gas_fee').value;
	// 	var adj_tpercent	= document.getElementById('trans_percent').value;
	// 	var adj_tfee 		= document.getElementById('trans_fee').value;
	// 	var adj_gasfee		= amount * gas;
	// 	//do the math
	// 	var adj_subtotal 	= adj_amount / adj_coin_value;
	// 	var adj_total		= adj_subtotal - adj_gasfee;
	// 	var adj_expenses	= adj_amount * adj_tpercent + +adj_tfee;
	// 	var adj_total_cost	= +adj_amount + +adj_expenses;
	// 	//update
	// 	document.getElementById('display_total').innerHTML = adj_total.toFixed(0) + " MYMI";
	// 	document.getElementById('total').value = adj_total;
	// 	document.getElementById('display_user_gas_fee').innerHTML = adj_gasfee;
	// 	document.getElementById('user_gas_fee').value = gasfee;
	// 	document.getElementById('display_fees').innerHTML = "$" + adj_expenses.toFixed(2);
	// 	document.getElementById('fees').value = adj_expenses.toFixed(2);
	// 	document.getElementById('display_total_cost').innerHTML = "$" + adj_total_cost.toFixed(2);
	// 	document.getElementById('total_cost').value = adj_total_cost.toFixed(2);
	// }
	// console.log("Amount: " + amount); 
	// console.log("Available Coins: " + available_coins); 
	// console.log("Coin Value: " + coin_value); 
	// console.log("Amount Available: " + amount_available); 
	// console.log("Total Coins: " + total_coins); 
	// console.log("Min Alert Text: " + minText); 
	// console.log("Max Alert Text: " + maxText); 
	
	// console.log("Adj. Coin Value: " + adj_coin_value); 
	// console.log("Adj. Amount: " + adj_amount); 
	// console.log("Adj. Gas: " + adj_gas); 
	// console.log("Adj. Trans Percent: " + adj_tpercent); 
	// console.log("Adj. Trans Fee: " + adj_tfee); 
	// console.log("Adj. Gas Fee: " + adj_gasfee); 
	// console.log("Adj. Subtotal: " + adj_subtotal); 
	// console.log("Adj. Total: " + adj_total); 
	// console.log("Adj. Expenses: " + adj_expenses); 
	// console.log("Adj. Total Cost: " + adj_total_cost); 
	
}
function calculateByCurrency() {

}
</script>