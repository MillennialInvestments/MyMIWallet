<?php
$currentMethod 		= $this->router->method;
$errorClass     	= empty($errorClass) ? ' error' : $errorClass;
$registerClass  	= $currentMethod == 'register' ? ' required' : '';
$editSettings   	= $currentMethod == 'edit';
$defaultLanguage	= isset($user->language) ? $user->language : strtolower(settings_item('language'));
$defaultTimezone 	= isset($user->timezone) ? $user->timezone : strtoupper(settings_item('site.default_user_timezone'));
// Input Field Settings
$controlGroup 		= 'control-group form-row pb-3';
$controlLabel 		= 'control-label col-12 pt-2 required';
$controlClass 		= 'controls col-12';
$controlInput   	= 'form-control full-width';
$pageURIC			= $this->uri->segment(3);
$orderID			= $pageURIC;
if (!empty($orderID)) {
    $getOrderInformation		= $this->investment_model->get_order_information($orderID);
    foreach ($getOrderInformation->result_array() as $order) {
        $wallet_id				= $order['wallet_id'];
    }
} else {
    $wallet_id      = '';
}
?>    
<div class="<?php e($controlGroup); ?> <?php echo form_error('wallet_id') ? $errorClass : ''; ?>">
    <label class="<?php e($controlLabel); ?>" for="wallet_id">Wallet Address</label>
    <div class="<?php e($controlClass); ?>">
        <input class="<?php echo $controlInput; ?>" type="text" id="wallet_id" name="wallet_id" value="<?php echo set_value('wallet_id', isset($user) ? $user->wallet_id : ''); ?>" />
        <span class="help-inline"><?php echo form_error('wallet_id'); ?></span>
        <?php
        if (empty($wallet_id)) {
            echo '<a class="btn btn-primary btn-sm" data-toggle="modal" data-target="">Generate Wallet</a>';
        }
        ?>
    </div>
</div>
