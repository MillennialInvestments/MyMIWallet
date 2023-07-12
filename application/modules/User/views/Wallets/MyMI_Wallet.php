<?php
$today						= date('h:i A');
// Define User Variables for use in page
$userAccount                = $_SESSION['allSessionData']['userAccount'];
$walletTitle			 	= $userAccount['walletTitle'];
$walletAmount				= $userAccount['walletAmount'];
$walletFunds				= $userAccount['walletFunds'];
$walletGains				= $userAccount['walletGains'];
$depositAmount				= $userAccount['depositAmount'];
$withdrawAmount				= $userAccount['withdrawAmount'];
$lastTradeActivity			= $userAccount['lastTradeActivity'];
$depositActivity			= $userAccount['depositActivity'];
$withdrawActivity			= $userAccount['withdrawActivity'];

$userData                   = array(
    'walletTitle'           => $walletTitle,
    'walletAmount'          => $walletAmount,
    'walletFunds'           => $walletFunds,
    'walletGains'           => $walletGains,
    'depositAmount'         => $depositAmount,
    'withdrawAmount'        => $withdrawAmount,
    'lastTradeActivity'     => $lastTradeActivity,
    'depositActivity'       => $depositActivity,
    'withdrawActivity'      => $withdrawActivity,
);
?>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-md-12 mb-3">  
			<?php $this->load->view('User/Wallets/MyMI_Wallet/header', $userData); ?> 
			
			<div class="nk-block nk-block-lg pb-3">
				<div class="row g-gs">
					<div class="col-12 col-md-4">
						<div class="card card-bordered">
							<div class="card-inner">
								<div class="nk-wg5">
									<div class="nk-wg5-title"><h6 class="title overline-title">Total Gains/Losses</h6></div>
									<div class="nk-wg5-text">
										<div class="nk-wg5-amount">
											<div class="amount"><?php echo $walletGains; ?> <span class="currency currency-btc">USD</span></div>
<!--
											<div class="amount-sm"><?php //echo $myMIGPerChange;?> <span class="currency currency-usd">USD</span></div>
-->
										</div>
									</div>
									<div class="nk-wg5-foot">
										<span class="text-soft">Last Trade at <span class="text-base"><?php echo $lastTradeActivity; ?></span></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="card card-bordered">
							<div class="card-inner">
								<div class="nk-wg5">
									<div class="nk-wg5-title"><h6 class="title overline-title">Total Deposits</h6></div>
									<div class="nk-wg5-text">
										<div class="nk-wg5-amount">
											<div class="amount"><?php echo $depositAmount; ?> <span class="currency currency-btc">USD</span></div>
<!--
											<div class="amount-sm"><?php //echo $lastDepositAmount; ?> <span class="currency currency-usd">USD</span></div>
-->
										</div>
									</div>
									<div class="nk-wg5-foot">
										<span class="text-soft">Last Receive at <span class="text-base"><?php echo $depositActivity; ?></span></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="card card-bordered">
							<div class="card-inner">
								<div class="nk-wg5">
									<div class="nk-wg5-title"><h6 class="title overline-title">Total Withdraw</h6></div>
									<div class="nk-wg5-text">
										<div class="nk-wg5-amount">
											<div class="amount"><?php echo $withdrawAmount; ?> <span class="currency currency-btc">USD</span></div>
<!--
											<div class="amount-sm"><?php //echo $lastWithdrawAmount; ?> <span class="currency currency-usd">USD</span></div>
-->
										</div>
									</div>
									<div class="nk-wg5-foot">
										<span class="text-soft">Last Withdraw at <span class="text-base"><?php echo $withdrawActivity; ?></span></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="nk-block pt-3">
				<div class="nk-block-between-md g-4">
					<div class="nk-block-content">
						<div class="nk-wg1">
							<div class="nk-wg1-group g-2">
								<div class="nk-block-head-sm">
									<div class="nk-block-head-content"><h5 class="nk-block-title title text-soft">Active Trading Log</h5></div>
								</div>
							</div>
						</div>
					</div>
					<div class="nk-block-content">
						<ul class="nk-block-tools gx-3">
							<li class="btn-wrap">
								<a href="<?php echo site_url('/Trade-Tracker/Search'); ?>" class="btn btn-icon btn-xl btn-dark"><em class="icon ni ni-plus"></em></a><span class="btn-extext">Add Trade</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="nk-block nk-block-lg">
				<div class="row g-gs">
					<div class="col-12">
						<table class="table display" id="walletTradeOverviewDatatable" role="grid" aria-describedby="DataTables_Table_0_info">
							<thead>
								<tr>     
									<th class="text-center">Date Submitted</th>
									<th class="text-center">Status</th>
									<th class="text-center">Type</th>
									<th class="text-center">Stock</th>
									<th class="text-center">Trade Cost</th>
									<th class="text-center">Position</th>
									<th class="text-center">P/L</th>
									<th class="text-center">% Change</th>
									<th class="text-center">More Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
                                //~ $getTrades	= 	$this->mymigold_model->mymicoin_transfers($cuID);
                                //~ foreach ($getTrades->result_array() as $trade) {
                                    //~ $status					= $trade['status'];
                                    //~ $purchase_type			= $trade['purchase_type'];
                                    //~ if ($status === 'Opened' && $purchase_type === 'Buy') {
                                        //~ $trade_id				= $trade['id'];
                                        //~ $submitted_date			= $trade['submitted_date'];
                                        //~ $trade_type				= $trade['trade_type'];
                                        //~ if ($purchase_type === 'Buy') {
                                            //~ $purchase_type				= '<span class="text-success">' . $purchase_type . '</span>';
                                        //~ } elseif ($purchase_type === 'Sold') {
                                            //~ $purchase_type				= '<span class="text-danger">' . $purchase_type . '</span>';
                                        //~ }
                                        //~ $symbol_type			= $trade['symbol_type'];
                                        //~ $exchange				= $trade['exchange'];
                                        //~ $symbol					= $trade['symbol'];
                                        //~ $stockURL				= $symbol_type . '/' . $exchange . '/' . $symbol;
                                        //~ $cost					= number_format($trade['total_trade_cost'], 2, '.', '');
                                        //~ $position_size			= $trade['position_size'];
                                        //~ $remaining_position		= $trade['remaining_position'];
                                        //~ $getNetGains			= $this->tracker_model->get_net_gains($trade_id);
                                        //~ foreach($getNetGains->result_array() as $tradeLog) {
                                            //~ $net_gains			= round($tradeLog['net_gains'],2);
                                            //~ if ($net_gains > 0) {
                                                //~ $net_gains				= '<span class="text-success">$' . $net_gains . '</span>';
                                            //~ } elseif ($net_gains < 0) {
                                                //~ $net_gains				= '<span class="text-danger">$' . $net_gains . '</span>';
                                            //~ }
                                        //~ }
                                        //~ $getPercentChange		= $this->tracker_model->get_percent_change($trade_id);
                                        //~ foreach($getPercentChange->result_array() as $tradeLog) {
                                            //~ $percent_change		= round($tradeLog['percent_change'],2);
                                            //~ if ($percent_change > 0) {
                                                //~ $percent_change	= '<span class="text-success">' . $percent_change . '%</span>';
                                            //~ } elseif ($percent_change < 0) {
                                                //~ $percent_change	= '<span class="text-danger">' . $percent_change . '%</span>';
                                            //~ }
                                        //~ }
                                        //~ // ----------------------------- //
                                        //~ $getRemainingPosition	= $this->tracker_model->get_remaining_position($trade_id);
                                        //~ foreach ($getRemainingPosition->result_array() as $tradeLog) {
                                            //~ $remaining_position	= $tradeLog['remaining_position'];
                                        //~ }
                                        //~ $getRemainingPosition	= $this->tracker_model->get_last_remaining_position($trade_id);
                                        //~ foreach ($getRemainingPosition->result_array() as $tradeLog) {
                                            //~ $remaining_position	= $tradeLog['remaining_position'];
                                        //~ }
                                        
                                        //~ echo '
                                        //~ <tr>
                                            //~ <td class="text-center">' . $submitted_date . '</td>
                                            //~ <td class="text-center">' . $purchase_type . '</td>
                                            //~ <td class="text-center">' . $trade_type . '</td>
                                            //~ <td class="text-center">' . $symbol . '</td>
                                            //~ <td class="text-center">$' . $cost . '</td>
                                            //~ <td class="text-center">' . $remaining_position . '</td>
                                            //~ <td class="text-center">' . $net_gains . '</td>
                                            //~ <td class="text-center">' . $percent_change . '</td>
                                            //~ <td class="text-center">';
                                                //~ if ($position_size > 0) {
                                                    //~ echo '
                                                    //~ <a class="mr-2" href="' . site_url($stockURL) . '" data-toggle="tooltip" data-placement="bottom" title="View Chart Log"><i class="icon-chart"></i></a>
                                                    //~ <a class="mr-2" href="' . site_url('Trade-Tracker/Log/' . $symbol . '/' . $trade_id) . '" data-toggle="tooltip" data-placement="bottom" title="View Trade Log"><i class="icon-notebook"></i></a>
                                                    //~ <!--
                                                    //~ <a class="mr-2" href="' . site_url('Trade-Tracker/Update/' . $symbol . '/' . $trade_id) . '" data-toggle="tooltip" data-placement="bottom" title="Update Trade Log"><i class="icon-note"></i></a>
                                                    //~ -->
                                                    //~ <a class="mr-2 text-danger" href="' . site_url('Trade-Tracker/Sell/' . $symbol . '/' . $trade_id) . '" data-toggle="tooltip" data-placement="bottom" title="Record Position Sell"><i class="icon ni ni-tranx" style="font-size:1rem !important;"></i></a>
                                                    //~ <a class="mr-2 text-danger" href="' . site_url('Trade-Tracker/Close/' . $symbol . '/' . $trade_id) . '" data-toggle="tooltip" data-placement="bottom" title="Close Trade Log"><i class="icon ni ni-wallet-out" style="font-size:1rem !important;"></i></a>
                                                    //~ <a class="text-danger" data-toggle="modal" data-target="#deleteModal' . $info['id'] . '" data-toggle="tooltip" data-placement="bottom" title="Delete Trade Log"><i class="icon ni ni-file-remove" style="font-size:1rem !important;"></i></a>
                                                    //~ ';
                                                //~ } else {
                                                    //~ echo'
                                                    //~ <a class="mr-2" href="' . site_url($stockURL) . '" data-toggle="tooltip" data-placement="bottom" title="View Chart Log"><i class="icon-chart"></i></a>
                                                    //~ <!--
                                                    //~ <a class="mr-2" href="' . site_url('Trade-Tracker/Log/' . $symbol . '/' . $trade_id) . '" data-toggle="tooltip" data-placement="bottom" title="View Trade Log"><i class="icon-notebook"></i></a>
                                                    //~ -->
                                                    //~ ';
                                                //~ }
                                            //~ echo '
                                            //~ </td>
                                        //~ </tr>';
                                    //~ }
                                //~ }

                                ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<hr>
			<div class="nk-block pt-3">
				<div class="nk-block-between-md g-4">
					<div class="nk-block-content">
						<div class="nk-wg1">
							<div class="nk-wg1-group g-2">
								<div class="nk-block-head-sm">
									<div class="nk-block-head-content"><h5 class="nk-block-title title text-soft">Closed Trading Log</h5></div>
								</div>
							</div>
						</div>
					</div>
					<div class="nk-block-content">
						<ul class="nk-block-tools gx-3">
							<li class="btn-wrap">
								<a href="<?php echo site_url('/Trade-Tracker/Search'); ?>" class="btn btn-icon btn-xl btn-dark"><em class="icon ni ni-plus"></em></a><span class="btn-extext">Add Trade</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="nk-block nk-block-lg">
				<div class="row g-gs">
					<div class="col-12">
						<table class="table display" id="walletTradeOverviewDatatable" role="grid" aria-describedby="DataTables_Table_0_info">
							<thead>
								<tr>     
									<th class="text-center">Date Submitted</th>
									<th class="text-center">Status</th>
									<th class="text-center">Type</th>
									<th class="text-center">Stock</th>
									<th class="text-center">Trade Cost</th>
									<th class="text-center">Position</th>
									<th class="text-center">P/L</th>
									<th class="text-center">% Change</th>
									<th class="text-center">More Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
                                //~ foreach ($getTrades->result_array() as $trade) {
                                    //~ $status					= $trade['status'];
                                    //~ if ($status === 'Closed') {
                                        //~ $trade_id				= $trade['id'];
                                        //~ $submitted_date			= $trade['submitted_date'];
                                        //~ $trade_type				= $trade['trade_type'];
                                        //~ $trade_status			= '<span class="text-danger">Sold</span>';
                                        //~ $symbol_type			= $trade['symbol_type'];
                                        //~ $exchange				= $trade['exchange'];
                                        //~ $symbol					= $trade['symbol'];
                                        //~ $stockURL				= $symbol_type . '/' . $exchange . '/' . $symbol;
                                        //~ $cost					= number_format($trade['total_trade_cost'], 2, '.', '');
                                        //~ $position_size			= $trade['position_size'];
                                        //~ $remaining_position		= $trade['remaining_position'];
                                        //~ $getNetGains			= $this->tracker_model->get_net_gains($trade_id);
                                        //~ foreach($getNetGains->result_array() as $tradeLog) {
                                            //~ $net_gains			= round($tradeLog['net_gains'],2);
                                            //~ if ($net_gains > 0) {
                                                //~ $net_gains				= '<span class="text-success">$' . $net_gains . '</span>';
                                            //~ } elseif ($net_gains < 0) {
                                                //~ $net_gains				= '<span class="text-danger">$' . $net_gains . '</span>';
                                            //~ }
                                        //~ }
                                        //~ $getPercentChange		= $this->tracker_model->get_percent_change($trade_id);
                                        //~ foreach($getPercentChange->result_array() as $tradeLog) {
                                            //~ $percent_change		= round($tradeLog['percent_change'],2);
                                            //~ if ($percent_change > 0) {
                                                //~ $percent_change	= '<span class="text-success">' . $percent_change . '%</span>';
                                            //~ } elseif ($percent_change < 0) {
                                                //~ $percent_change	= '<span class="text-danger">' . $percent_change . '%</span>';
                                            //~ }
                                        //~ }
                                        //~ // ----------------------------- //
                                        // $getRemainingPosition	= $this->tracker_model->get_remaining_position($trade_id);
                                        // foreach ($getRemainingPosition->result_array() as $tradeLog) {
                                        //     $remaining_position	= $tradeLog['remaining_position'];
                                        // }
                                        
                                        //~ echo '
                                        //~ <tr>
                                            //~ <td class="text-center">' . $submitted_date . '</td>
                                            //~ <td class="text-center">' . $trade_status . '</td>
                                            //~ <td class="text-center">' . $trade_type . '</td>
                                            //~ <td class="text-center">' . $symbol . '</td>
                                            //~ <td class="text-center">$' . $cost . '</td>
                                            //~ <td class="text-center">' . $position_size . '</td>
                                            //~ <td class="text-center">' . $net_gains . '</td>
                                            //~ <td class="text-center">' . $percent_change . '</td>
                                            //~ <td class="text-center">
                                                //~ <a class="mr-2" href="' . site_url($stockURL) . '" data-toggle="tooltip" data-placement="bottom" title="View Chart Log"><i class="icon-chart"></i></a>
                                                //~ <a class="mr-2" href="' . site_url('Trade-Tracker/Log/' . $symbol . '/' . $trade_id) . '" data-toggle="tooltip" data-placement="bottom" title="View Trade Log"><i class="icon-notebook"></i></a>
                                                //~ <a class="text-danger" data-toggle="modal" data-target="#deleteModal' . $trade_id . '" data-toggle="tooltip" data-placement="bottom" title="Delete Trade Log"><i class="icon ni ni-file-remove" style="font-size:1rem !important;"></i></a>
                                            //~ </td>
                                        //~ </tr>';
                                    //~ }
                                //~ }

                                ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
//~ foreach ($getTrades->result_array() as $trade) {
    //~ $trade_id							= $trade['id'];
    //~ echo '
//~ <div class="modal fade" id="deleteModal' . $trade_id . '" tabindex="-1" role="dialog" aria-labelledby="deleteModal' . $trade_id . '" aria-hidden="true">
    //~ <div class="modal-dialog" role="document">
        //~ <div class="modal-content">
            //~ <div class="modal-header">
                //~ <h3 class="modal-title" id="exampleModalLabel">Delete Trade?</h3>
                //~ <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    //~ <span aria-hidden="true">&times;</span>
                //~ </button>
            //~ </div>
            //~ <div class="modal-body">
                //~ Are you sure you want to delete this trade from the trade tracker?
            //~ </div>
            //~ <div class="modal-footer">
                //~ <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                //~ <a type="button" class="btn btn-primary" href="' . site_url('Trade-Tracker/Delete/' . $trade_id . '/' . $redirect_url) . '">Yes</a>
            //~ </div>
        //~ </div>
    //~ </div>
//~ </div>
//~ ';
//~ }
?>
<div class="modal fade" id="quickEquityTradeModel" tabindex="-1" role="dialog" aria-labelledby="quickTradeModel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Add Quick Trade</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pt-1">
				<?php
                $walletTranfer[]			= 'Equity';
                $walletTransfer				= array(
                    'wallet_id'				=> $wallet_id,
                    'walletTitle'			=> $walletTitle,
                    'current_trade_type'	=> 'Option',
                );
                $this->load->view('User/Trade_Tracker/Quick_Trade', $walletTransfer);
                ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
				<div class="control-group">
					<div class="controls ml-3">
						<input class="btn btn-primary" type="submit" name="register" id="submit" value="Submit" />
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="quickOptionTradeModel" tabindex="-1" role="dialog" aria-labelledby="quickTradeModel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Add Quick Trade</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pt-1">
				<?php
                $walletTransfer				= array(
                    'wallet_id'				=> $wallet_id,
                    'walletTitle'			=> $walletTitle,
                    'current_trade_type'	=> 'Option',
                );
                $this->load->view('User/Trade_Tracker/Quick_Trade', $walletTransfer);
                ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
				<div class="control-group">
					<div class="controls ml-3">
						<input class="btn btn-primary" type="submit" name="register" id="submit" value="Submit" />
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

