<?php /* /users/views/user_fields.php */
$cuID 								= $_SESSION['allSessionData']['userAccount']['cuID'];
$cuEmail					        = $_SESSION['allSessionData']['userAccount']['cuEmail'];
$cuUsername					        = $_SESSION['allSessionData']['userAccount']['cuUsername'];
date_default_timezone_set('America/Chicago');
$date = date("F jS, Y");
$hostTime = date("g:i A");
$time = date("g:i A", strtotime($hostTime) - 60 * 60 * 5);
$currentMethod = $this->router->fetch_method();

$errorClass     = empty($errorClass) ? ' error' : $errorClass;
$controlClass   = empty($controlClass) ? 'span4' : $controlClass;
$registerClass  = $currentMethod == 'register' ? ' required' : '';
$editSettings   = $currentMethod == 'edit';
// Set Form Config
$formGroup				= $this->config->item('form_container');
$formLabel				= $this->config->item('form_label');
$formConCol				= $this->config->item('form_control_column');
$formControl			= $this->config->item('form_control');
$formSelect				= $this->config->item('form_select');
$formSelectPicker		= $this->config->item('form_selectpicker');
$formText				= $this->config->item('form_text');
$formCustomText			= $this->config->item('form_custom_text');

$category_url			= $this->uri->segment(3);
// Get Crypto & Stock Symbols
$getSym					= $this->tracker_model->get_all_symbols();
// Get Only Stock Symbols
//~ $getSym					= $this->investor_model->get_stock_symbols();
?>

<div class="row">
	<div class="col">
		<h4 class="card-title float-left d-none d-sm-block">Search for ETF/Stock Information</h4>
		<a class="btn btn-primary btn-sm mb-3 float-right d-none d-sm-block" href="<?php echo site_url('Trade-Tracker/Add-Stock'); ?>">Add New Stock</a>
		<br>	
		<br>	
		<h4 class="card-title d-xs-block d-sm-none">Search for ETF/Stock</h4>
		<p class="card-description d-none d-sm-block"> Please fill out information below</p>	
		<p class="card-description d-xs-block d-sm-none"> Search Stock Ticker to Create Alert</p>	
	</div>
</div>
<input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo set_value('user_id', isset($user) ? $user->user_id : $cuID); ?>">	
<input type="hidden" class="form-control" name="user_email" id="user_email" value="<?php echo set_value('user_email', isset($user) ? $user->user_email : $cuEmail); ?>">	
<input type="hidden" class="form-control" name="username" id="username" value="<?php echo set_value('username', isset($user) ? $user->username : $cuUsername); ?>">	
<div class="<?php echo $formGroup; ?>">
	<label for="stock_one" class="<?php echo $formLabel; ?>">Stock</label>
	<div class="<?php echo $formConCol; ?>">
		<?php
            echo '
			<select name="stock" class="' . $formSelectPicker . '" data-actions-box="true"  data-live-search="true" id="stock" required="required">
				<option>Select-A-Stock</option>
				';
                foreach ($getSym->result_array() as $symInfo) {
                    $symbol_values = array(
                        $symInfo['symbol'] => $symInfo['symbol'] . ' | ' . $symInfo['market'],
                    );
                    foreach ($symbol_values as $value => $display_text) {
                        $selected = ($value == $this->input->post('stock')) ? ' selected="selected"' : "";
                        ;

                        echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                    }
                }
            echo '</select>';
        ?>						
	</div>
</div>
<div class="control-group">
	<div class="controls ml-3">
		<input class="btn btn-primary" type="submit" name="register" id="submit" value="Search" />
	</div>
</div>
