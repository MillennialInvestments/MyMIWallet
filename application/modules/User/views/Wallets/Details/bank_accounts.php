<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-md-12 mb-3">  
			<div class="nk-block">
				<div class="nk-block-head">
					<?php echo theme_view('navigation_breadcrumbs'); ?>
					<div class="nk-block-between-md g-4">
						<div class="nk-block-head-content">
							<div class="nk-wgwh">
								<em class="icon-circle icon-circle-lg icon ni ni-sign-usd" style="margin-top: -35px;"></em>
								<div class="nk-wgwh-title h5">
									<h2 class="nk-block-title fw-bold"><?php echo $accountTitle; ?></h2>
									<div class="nk-block-des">
										<p>
											<span class="d-block d-md-none">Review Account Details</span>
											<span class="d-none d-md-block">Review Your <?php echo $accountBankName; ?> Account Information and Details</span>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="nk-block">
				<div class="nk-block-between-md g-4">
					<div class="nk-block-content">
						<div class="nk-wg1">
							<div class="nk-wg1-group g-2">
								<div class="nk-wg1-item mr-xl-4">
									<div class="nk-wg1-title text-soft">Available Balance</div>
									<div class="nk-wg1-amount">
										<div class="amount"><?php echo $accountBalance; ?> <small class="currency currency-usd">USD</small></div>
										<div class="amount-sm">
											Total Growth <span><?php //echo $walletGains; ?> <span class="currency currency-usd">USD</span></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="nk-block-content">
						<ul class="nk-block-tools gx-3">
							<li class="btn-wrap dropdown">
								<a class="btn btn-icon btn-xl btn-dark" style="color: white;" type="button"  data-toggle="modal" href="#accountSettingsModule"><em class="icon ni ni-setting"></em></a><span class="btn-extext">Account Settings</span>
							</li>
							<li class="btn-wrap">
								<a href="<?php echo site_url('/Add-Wallet-Deposit/' . $accountID); ?>" class="btn btn-icon btn-xl btn-dark"><em class="icon ni ni-plus"></em></a><span class="btn-extext">Deposit Funds</span>
							</li>
							<li class="btn-wrap">
								<a href="<?php echo site_url('/Add-Wallet-Deposit/' . $accountID); ?>" class="btn btn-icon btn-xl btn-dark"><em class="icon ni ni-plus"></em></a><span class="btn-extext">Transfer Funds</span>
							</li>
							<li class="btn-wrap">
								<a href="<?php echo site_url('/Add-Wallet-Withdraw/' . $accountID); ?>" class="btn btn-icon btn-xl btn-primary"><em class="icon ni ni-arrow-to-right"></em></a><span class="btn-extext">Withdraw Funds</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="nk-block nk-block-lg pb-3">
				<div class="row g-gs">
					<div class="col-md-4">
						<div class="card card-bordered">
							<div class="card-inner">
								<div class="nk-wg5">
									<div class="nk-wg5-title"><h6 class="title overline-title">Total Transactions</h6></div>
									<div class="nk-wg5-text pb-2">
										<div class="nk-wg5-amount">
											<div class="amount"><?php //echo $walletGains; ?> <span class="currency currency-btc">Transactions</span></div>
											<!-- <div class="amount-sm"><?php //echo $percentChange; ?> <span class="currency currency-usd">USD</span></div> -->
										</div>
									</div>
									<div class="nk-wg5-foot">
										<!-- <span class="text-soft"><strong>Last Trade at</strong> <span class="text-base"><?php //print_r($$_SESSION['allSessionData']['userLastActivity']); ?></span></span> -->
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card card-bordered">
							<div class="card-inner">
								<div class="nk-wg5">
									<div class="nk-wg5-title"><h6 class="title overline-title">Total Received</h6></div>
									<div class="nk-wg5-text pb-2">
										<div class="nk-wg5-amount">
											<div class="amount"><?php //echo $walletGains; ?> <span class="currency currency-btc">USD</span></div>
											<!-- <div class="amount-sm"><?php //echo $percentChange; ?> <span class="currency currency-usd">USD</span></div> -->
										</div>
									</div>
									<div class="nk-wg5-foot">
										<!-- <span class="text-soft"><strong>Last Trade at</strong> <span class="text-base"><?php //print_r($$_SESSION['allSessionData']['userLastActivity']); ?></span></span> -->
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card card-bordered">
							<div class="card-inner">
								<div class="nk-wg5">
									<div class="nk-wg5-title"><h6 class="title overline-title">Total Spent</h6></div>
									<div class="nk-wg5-text pb-2">
										<div class="nk-wg5-amount">
											<div class="amount"><?php //echo $walletGains; ?> <span class="currency currency-btc">USD</span></div>
											<!-- <div class="amount-sm"><?php //echo $percentChange; ?> <span class="currency currency-usd">USD</span></div> -->
										</div>
									</div>
									<div class="nk-wg5-foot">
										<!-- <span class="text-soft"><strong>Last Trade at</strong> <span class="text-base"><?php //print_r($$_SESSION['allSessionData']['userLastActivity']); ?></span></span> -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row gy-gs">
		<div class="col-md-12">
			<div class="nk-block">	  									
                <div class="card card-preview">
                    <div class="card-inner">     
                        <div class="nk-block-head-xs">
                            <div class="nk-block-head-content"><h5 class="nk-block-title title">Transaction History</h5></div>
                        </div>	
                        <div class="dt-bootstrap4 no-footer">
                            <div class="my-3">
                                <table class="table display" id="bankAccountTransactionHistory" role="grid" aria-describedby="DataTables_Table_0_info">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Subtotal</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            // $sum                        = 0;
                                            // $getBankAccountTransactions = $this->wallet_model->get_bank_account_transactions($accountID);
                                            // foreach ($getBankAccountTransactions->result_array() as $trans) {
                                            //     $transDate              = $trans['date'];
                                            //     $transDescription       = $trans['description'];
                                            //     $transSubtotal          = $trans['subtotal'];
                                            //     $transSummary           += $sum; 
                                            //     echo '<tr>
                                            //         <td>' . date('F jS, Y', strtotime($transDate)) . '</td>
                                            //         <td>' . $transDescription . '</td>
                                            //         <td>' . $transSubtotal . '</td>
                                            //         <td>' . $transSummary . '</td>
                                            //     </tr>';
                                            // }
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
 <div class="modal fade" id="accountSettingsModule" tabindex="-1" aria-labelledby="accountSettingsModule" aria-hidden="true">
 	<div class="modal-dialog modal-md">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h3 class="modal-title" id="exampleModalLabel">Edit Account</h3>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
     				<span aria-hidden="true">&times;</span>
     			</button>
 			</div>
            <div class="form-horizontal" id="editAccountSettings">
                <div class="modal-body">
                </div>             
                <div class="modal-footer">                                                    
                    <a type="button" class="btn btn-success" href="' . site_url('Delete-Wallet/' . $accountID) . '">Yes</a>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                </div>
             </div>
 		</div>
 	</div>
 </div>
<?php
// foreach ($getTrades->result_array() as $trade) {
//                                                 $trade_id							= $trade['id'];
//                                                 echo '
// <div class="modal fade" id="deleteModal' . $trade_id . '" tabindex="-1" role="dialog" aria-labelledby="deleteModal' . $trade_id . '" aria-hidden="true">
// 	<div class="modal-dialog" role="document">
// 		<div class="modal-content">
// 			<div class="modal-header">
// 				<h3 class="modal-title" id="exampleModalLabel">Delete Trade?</h3>
// 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
// 					<span aria-hidden="true">&times;</span>
// 				</button>
// 			</div>
// 			<div class="modal-body">
// 				Are you sure you want to delete this trade from the trade tracker?
// 			</div>
// 			<div class="modal-footer">
// 				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
// 				<a type="button" class="btn btn-primary" href="' . site_url('Trade-Tracker/Delete/' . $trade_id . '/' . $redirect_url) . '">Yes</a>
// 			</div>
// 		</div>
// 	</div>
// </div>
// ';
//                                             }
?>
<!-- <div class="modal fade" id="quickEquityTradeModel" tabindex="-1" role="dialog" aria-labelledby="quickTradeModel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Add Quick Trade</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pt-1">
				<?php
                // $walletTranfer[]			= 'Equity';
                // $walletTransfer				= array(
                //     'wallet_id'				=> $wallet_id,
                //     'walletTitle'			=> $pageTitle,
                //     'current_trade_type'	=> 'Option',
                // );
                // $this->load->view('User/Trade_Tracker/Quick_Trade', $walletTransfer);
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
</div> -->
<!-- <div class="modal fade" id="quickOptionTradeModel" tabindex="-1" role="dialog" aria-labelledby="quickTradeModel" aria-hidden="true">
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
                // $walletTransfer				= array(
                //     'wallet_id'				=> $wallet_id,
                //     'walletTitle'			=> $pageTitle,
                //     'current_trade_type'	=> 'Option',
                // );
                // $this->load->view('User/Trade_Tracker/Quick_Trade', $walletTransfer);
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
</div> -->
<?php
// echo '
// <div class="modal fade" id="deleteWalletModal' . $accountID . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
// 	<div class="modal-dialog modal-md">
// 		<div class="modal-content">
// 			<div class="modal-header">
// 				<h3 class="modal-title" id="exampleModalLabel">Delete This Wallet?</h3>
// 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
// 				<span aria-hidden="true">&times;</span>
// 			</button>
// 			</div>
// 			<div class="modal-body">
// 				<p>Are you sure you want to delete this wallet? </p>
// 				<table class="table table-borderless pt-3">
// 					<tbody>
// 						<tr>
// 							<th>Wallet Name:</th>
// 							<td>' . $pageTitle . '</td>
// 						</tr>
// 					</tbody>
// 				</table>
// 			</div>             
// 			<div class="modal-footer">                                                    
// 				<a type="button" class="btn btn-success" href="' . site_url('Delete-Wallet/' . $accountID) . '">Yes</a>
// 				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
// 			</div>
// 		</div>
// 	</div>
// </div>
// ';
?>
<?php 
// if ($walletPremium === 'Yes') {
//     if ($walletBroker === 'TD Ameritrade') {
//         if($this->exchange_model->update_wallet_records($cuID, $cuEmail, $cuUsername, $accountID, $walletAccountID, $walletAccessCode, $walletBroker)) {
//             Template::set_message('Account successfully updated and up-to-date!', 'success'); 
//         } else {
//             Template::set_message('ERROR: Account could not be updated successfully', 'error'); 
//         }
//     }
// }
?>