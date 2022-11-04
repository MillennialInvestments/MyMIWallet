<?php
$month										= date("m");
$day										= date("d");
$year										= date("Y");
$time										= date("h:i:s A");
$currentMethod 								= $this->router->method;
$errorClass     							= empty($errorClass) ? ' error' : $errorClass;
$registerClass  							= $currentMethod == 'register' ? ' required' : '';
$editSettings   							= $currentMethod == 'edit';
$defaultLanguage							= isset($user->language) ? $user->language : strtolower(settings_item('language'));
$defaultTimezone 							= isset($user->timezone) ? $user->timezone : strtoupper(settings_item('site.default_user_timezone'));
// Input Field Settings
$controlGroup 								= 'control-group form-row py-1';
$controlLabel 								= 'control-label col-sm-4 col-md-4 col-lg-4 pt-2';
$controlClass 								= 'controls col-sm-8 col-md-8 col-lg-8 pl-3';
$controlInput   							= 'form-control full-width';
$getUserCoinTotal 							= $this->mymicoin_model->get_user_coin_total($cuID);
if (empty($getUserCoinTotal)) {
    $totalValue 							= '$0.00';
} else {
    foreach ($getUserCoinTotal->result_array() as $userCoins) {
        $coinSum 							= number_format($userCoins['total'], 0);
    }
}
?>                
<input class="<?php e($controlInput); ?>" type="hidden" id="redirectURL" name="redirectURL" value="<?php echo set_value('redirectURL', isset($user) ? $user->redirectURL : $this->uri->uri_string()); ?>" /> 
<input class="<?php e($controlInput); ?>" type="hidden" id="trade_type" name="trade_type" value="<?php echo set_value('trade_type', isset($user) ? $user->trade_type : 'Sell'); ?>" /> 
<input class="<?php e($controlInput); ?>" type="hidden" id="month" name="month" value="<?php echo set_value('month', isset($user) ? $user->month : $month); ?>" /> 
<input class="<?php e($controlInput); ?>" type="hidden" id="day" name="day" value="<?php echo set_value('day', isset($user) ? $user->day : $day); ?>" /> 
<input class="<?php e($controlInput); ?>" type="hidden" id="year" name="year" value="<?php echo set_value('year', isset($user) ? $user->year : $year); ?>" /> 
<input class="<?php e($controlInput); ?>" type="hidden" id="time" name="time" value="<?php echo set_value('time', isset($user) ? $user->time : $time); ?>" />     
<?php
if ($cuType === 'Beta') {
    ?>
<input class="<?php e($controlInput); ?>" type="hidden" id="beta" name="beta" value="<?php echo set_value('beta', isset($user) ? $user->beta : 'Yes'); ?>" /> 
<?php
} else {
        ?>             
<input class="<?php e($controlInput); ?>" type="hidden" id="beta" name="beta" value="<?php echo set_value('beta', isset($user) ? $user->beta : 'No'); ?>" /> 
<?php
    }
?>
<input class="<?php e($controlInput); ?>" type="hidden" id="user_id" name="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>" /> 
<input class="<?php e($controlInput); ?>" type="hidden" id="user_email" name="user_email" value="<?php echo set_value('user_email', isset($user) ? $user->user_email : $cuEmail); ?>" />  
<div class="<?php e($controlGroup); ?> <?php echo form_error('wallet_id') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> mb-1" for="zipcode">
		Wallet ID <a data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><i class="icon-question"></i></a>
    </label>
    <label class="controls col-sm-8 col-md-8 col-lg-8 pl-0 pt-2 mb-1 no-font-weight">
		<?php
        if ($cuWalletID !== null) {
            echo '<small style="font-size: 70%">' . $cuWalletID . '</small>'; ?>
		<input type="hidden" id="wallet_id" name="wallet_id" value="<?php echo set_value('wallet_id', isset($user) ? $user->wallet_id : $cuWalletID); ?>" />	
		<?php
        } else {
            ?>
			<a class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#coinModal"><em class="icon ni ni-wallet-saving"></em><span>Generate Wallet</span></a>
		<?php
        }
        ?>
    </label>
</div>    
<input class="<?php e($controlInput); ?>" type="hidden" id="market_pair" name="market_pair" value="<?php echo set_value('market_pair', isset($user) ? $user->market_pair : $market_pair); ?>" /> 
<input class="<?php e($controlInput); ?>" type="hidden" id="market" name="market" value="<?php echo set_value('market', isset($user) ? $user->market : $market); ?>" /> 
<input class="<?php e($controlInput); ?>" type="hidden" id="initial_value" name="initial_value" value="<?php echo set_value('initial_value', isset($user) ? $user->initial_value : $current_value); ?>" />     
<input class="<?php e($controlInput); ?>" type="hidden" id="available_coins" name="available_coins" value="<?php echo set_value('available_coins', isset($user) ? $user->available_coins : $coins_available); ?>" /> 
<input class="<?php e($controlInput); ?>" onChange="calculateSell(); return false;" onClick="clearSellContent();" type="hidden" id="current_coin_value" name="current_coin_value" value="<?php echo set_value('current_coin_value', isset($user) ? $user->current_coin_value : $current_coin_value); ?>" />
<div class="<?php e($controlGroup); ?> <?php echo form_error('buy_total_coins') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> mb-1" for="buy_total">Coin Value</label>
    <label class="<?php e($controlClass); ?> pt-2 mb-1 no-font-weight">
		<p class="mb-0" id="sell_coin_value" onChange="calculateSell(); return false;" onClick="clearSellContent();"></p>
		<input class="<?php e($controlInput); ?>" onChange="calculateSell(); return false;" onClick="clearSellContent();" type="hidden" id="sell_coin_value" name="coin_value" value="<?php echo set_value('coin_value', isset($user) ? $user->coin_value : $current_coin_value); ?>" />
    </label>
</div> 
<div class="<?php e($controlGroup); ?> <?php echo form_error('sell_amount') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> mb-1" for="sell_amount">Quantity</label>
    <div class="<?php e($controlClass); ?> pt-2 mb-1">
		<input type="text" id="sell_amount" name="sell_amount" onChange="calculateSell(); return false;" value="<?php echo set_value('sell_amount', isset($user) ? $user->sell_amount : ''); ?>" />
    </div>
</div>                     
<input class="<?php e($controlInput); ?>" onChange="calculateSell(); return false;" onClick="clearSellContent();" type="hidden" id="minimum_purchase" name="minimum_purchase" value="<?php echo set_value('minimum_purchase', isset($user) ? $user->minimum_purchase : $minimum_purchase); ?>" /> 
<div class="<?php e($controlGroup); ?> <?php echo form_error('sell_total_coins') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> mb-1" for="sell_total">Total Coins</label>
    <label class="<?php e($controlClass); ?> pt-2 mb-1 no-font-weight">
		<p class="mb-0" id="sell_total_coins" onChange="calculateSell(); return false;" onClick="clearSellContent();"></p>
		<input type="hidden" id="sell_total" name="sell_total" onChange="calculateSell(); return false;" onClick="clearSellContent();" value="<?php echo set_value("sell_total", isset($user) ? $user->sell_total : ''); ?>" />
    </label>
</div>   
<input class="<?php e($controlInput); ?>" onChange="calculateSell(); return false;" onClick="clearSellContent();" type="hidden" id="sell_trans_percent" name="sell_trans_percent" value="<?php echo set_value('sell_trans_percent', isset($user) ? $user->sell_trans_percent : $trans_percent); ?>" /> 
<input class="<?php e($controlInput); ?>" onChange="calculateSell(); return false;" onClick="clearSellContent();" type="hidden" id="sell_trans_fee" name="sell_trans_fee" value="<?php echo set_value('sell_trans_fee', isset($user) ? $user->sell_trans_fee : $trans_fee); ?>" /> 
<input type="hidden" onChange="calculateSell(); return false;" onClick="clearSellContent();" id="sell_user_gas_fee" name="sell_user_gas_fee" value="<?php echo set_value('sell_user_gas_fee', isset($user) ? $user->sell_user_gas_fee : $gas_fee); ?>" /> 
<div class="<?php e($controlGroup); ?> <?php echo form_error('sell_fees') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> mb-1" for="zipcode">Fees</label>
    <label class="<?php e($controlClass); ?> pt-2 mb-1 no-font-weight"> 
		<p class="mb-0" id="sell_fees_display" onChange="calculateSell(); return false;" onClick="clearSellContent();"></p>
		<input type="hidden" onChange="calculateSell(); return false;" onClick="clearSellContent();" id="sell_fees" name="sell_fees" value="<?php echo set_value('sell_fees', isset($user) ? $user->sell_fees : ''); ?>" />  
    </label>
</div>                                        
<div class="<?php e($controlGroup); ?> <?php echo form_error('sell_total_cost') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?> mb-1" for="zipcode">Subtotal</label>
    <label class="<?php e($controlClass); ?> pt-2 mb-1 no-font-weight"> 
		<p class="mb-0" id="sell_total_cost_display" onChange="calculateSell(); return false;" onClick="clearSellContent();"></p>
		<input type="hidden" id="sell_total_cost" name="sell_total_cost" onChange="calculateSell(); return false;" onClick="clearSellContent();" value="<?php echo set_value('sell_total_cost', isset($user) ? $user->sell_total_cost : ''); ?>" />
    </label>
</div>    
<div class="control-group" style="border:none;">
	<div class="controls ml-3">
		<input class="btn btn-primary" type="submit" name="register" id="sellSubmit" value="Sell Now!" />
		<button class="btn btn-secondary" type="button" name="clear_values" id="clear_values" onclick="clearSellContent();">Clear</button>
	</div>
</div>   
