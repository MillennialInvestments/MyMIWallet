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
									<h2 class="nk-block-title fw-bold myfs-md"><?php echo $recordName; ?></h2>
									<div class="nk-block-des">
										<p class="sub-text">View Your Financial Growths</p>
									</div>
								</div>
							</div>
						</div>
						<?php
                        // if ($walletExchange === 'Yes') {
                            ?>
						<div class="nk-block-head-content">
							<ul class="nk-block-tools gx-3">
								<li class="opt-menu-md dropdown">
									<a href="<?php //echo site_url('/Exchange/Market/' . $walletMarketPair . '/' . $walletMarket); ?>" class="btn btn-primary"><span>Trade <?php // echo $walletMarket; ?></span> <em class="icon icon-arrow-right"></em></a>
								</li>
							</ul>
						</div>
						<?php
                        // }
                        ?>
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
										<div class="amount"><?php echo $recordBalance; ?> <small class="currency currency-usd">USD</small></div>
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
                            <?php
                                if ($this->uri->segment(3) === 'Details') {
                                    echo '
                                    <li class="btn-wrap dropdown">
                                        <a class="btn btn-icon btn-lg btn-dark dropdown-toggle" style="color: white;" type="button"  data-toggle="dropdown"><em class="icon ni ni-setting"></em></a><span class="btn-extext">Wallet Settings</span>
                                        <div class="dropdown-menu">
                                            <ul class="link-list-opt">
                                                <li>
                                                    <a href="' . site_url('/Budget/Edit/' . $recordID) . '">Edit</a>
                                                </li>
                                                <li>
                                                    <a id="deleteWalletBtn" href="#" data-toggle="modal" data-target="#transactionModal">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    ';
                                } elseif ($this->uri->segment(3) === 'Edit') {
                                    echo '                                   
                                    <li class="btn-wrap">
                                        <a id="deleteWalletBtn" href="#" data-toggle="modal" data-target="#transactionModal">Delete</a>
                                    </li>
                                    ';
                                }
                            ?>
							<li class="btn-wrap dropdown">
								<a class="btn btn-icon btn-lg btn-dark dropdown-toggle" style="color: white;" type="button"  data-toggle="dropdown"><em class="icon ni ni-plus"></em></a><span class="btn-extext">Trade</span>
								<div class="dropdown-menu">
									<ul class="link-list-opt">
										<li>
											<a data-toggle="modal" data-target="#quickEquityTradeModel">Equity Trade</a>
										</li>
										<li>
											<a data-toggle="modal" data-target="#quickOptionTradeModel">Option Trade</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="btn-wrap">
								<a href="<?php echo site_url('/Wallets/Track-Deposit/' . $recordID); ?>" class="btn btn-icon btn-lg btn-dark"><em class="icon ni ni-plus"></em></a><span class="btn-extext">Deposit</span>
							</li>
							<li class="btn-wrap">
								<a href="<?php echo site_url('/Wallets/Track-Withdraw/' . $recordID); ?>" class="btn btn-icon btn-lg btn-primary"><em class="icon ni ni-arrow-to-right"></em></a><span class="btn-extext">Withdraw</span>
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
									<div class="nk-wg5-title"><h6 class="title overline-title myfs-xs">Total Gains/Losses</h6></div>
									<div class="nk-wg5-text">
										<div class="nk-wg5-amount">
											<div class="amount"><?php //echo $walletGains; ?> <span class="currency currency-btc">USD</span></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card card-bordered">
							<div class="card-inner">
								<div class="nk-wg5">
									<div class="nk-wg5-title"><h6 class="title overline-title myfs-xs">Total Trades</h6></div>
									<div class="nk-wg5-text">
										<div class="nk-wg5-amount">
											<div class="amount"><?php //echo $totalTrades; ?> <span class="currency currency-btc">Trades</span></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card card-bordered">
							<div class="card-inner">
								<div class="nk-wg5">
									<div class="nk-wg5-title"><h6 class="title overline-title myfs-xs">Deposits/Withdraw</h6></div>
									<div class="nk-wg5-text">
										<div class="nk-wg5-amount">
											<div class="amount"><?php //echo $transferBalance; ?> <span class="currency currency-btc">USD</span></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <?php 
    if ($this->uri->segment(3) === 'Details') {
    ?>
	<div class="row gy-gs">
		<div class="col-md-12">
			<div class="nk-block">	  									
                <div class="card card-bordered card-preview">
                    <div class="card-inner">     
                        <div class="nk-block-head-xs">
                            <div class="nk-block-head-content">
                                <h5 class="nk-block-title title"><?php echo $recordName; ?></h5>
                                <p class="card-description">Related Records</p>
                        </div>
                        </div>	
                        <div class="dt-bootstrap4 no-footer">
                            <div class="my-3">
                                <table class="table display" id="userBudgetingDatatable" role="grid" aria-describedby="DataTables_Table_0_info">
                                    <thead>
                                        <?php
                                        if ($this->agent->is_mobile()) {
                                            echo '
                                            <tr>
                                                <th class="d-none"></th>
                                                <th>Account</th>
                                                <th>Amount</th>
                                                <th>Subtotal</th>
                                            </tr>';
                                        } elseif ($this->agent->is_browser()) {
                                            echo '<tr>
                                                <th class="d-none"></th>
                                                <th>Due Date</th>
                                                <th>Account</th>
                                                <th>Source</th>
                                                <th>Wallet</th>
                                                <th>Amount</th>
                                                <th>Subtotal</th>
                                                <th>Actions</th>
                                            </tr>';
                                        }
                                        ?>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // print_r($budgetRelatedRecords); 
                                        $this->db->from('bf_users_wallet');
                                        $this->db->where('user_id', $cuID);
                                        $this->db->where('active', 'Yes');
                                        $getUserWallets                         = $this->db->get();
                                        foreach ($budgetRelatedRecords as $relatedRecords) {
                                            $sum                                = 0;
                                            if ($relatedRecords['account_type'] === 'Income') {
                                                $accountNetAmount               = $relatedRecords['net_amount'];
                                                $accountNetAmountDisplay        = number_format($accountNetAmount,2);
                                            } elseif ($relatedRecords['account_type'] === 'Expense') {
                                                $accountNetAmount               = '-' . $relatedRecords['net_amount'];
                                                $accountNetAmountDisplay        = '<span class="statusRed">' . number_format($accountNetAmount,2). '</span>';
                                            }
                                            if ($relatedRecords['paid'] == 0) {
                                                $accountPaidStatus              = '<a href="' . site_url('Budget/Status/Paid/' . $relatedRecords['id']) . '"><i class="icon myfs-md ni ni-check-thick"></i></a>';
                                                $sum                            += $accountNetAmount;
                                            } elseif ($relatedRecords['paid'] === 1) {
                                                $accountPaidStatus              = '<a class="statusGreen" href="' . site_url('Budget/Status/Unpaid/' . $relatedRecords['id']) . '"><i class="icon myfs-md ni ni-check-thick"></i></a>';
                                                $sum                            += 0;
                                            } else {
                                                $accountPaidStatus              = '<a class="statusGreen" href="' . site_url('Budget/Status/Unpaid/' . $relatedRecords['id']) . '"><i class="icon myfs-md ni ni-check-thick"></i></a>';
                                                $sum                            += $accountNetAmount;
                                            }
                                            if ($sum >= 0) {
                                                $sumDisplay                     = '$' . number_format($sum,2);
                                            } elseif ($sum < 0) {
                                                $sumDisplay                     = '<span class="statusRed">$' . number_format(($sum * -1),2) . '</span>';
                                            }
                                            echo '
                                            <tr>
                                                <td class="d-none">' . date("Y-m-d", strtotime($relatedRecords['year'] . '-' . $relatedRecords['month'] . '-' . $relatedRecords['day'])) . '</td>
                                                <td>' . date("F jS, Y", strtotime($relatedRecords['year'] . '-' . $relatedRecords['month'] . '-' . $relatedRecords['day'])) . '</td>
                                                <td><a href="' . site_url('Budget/Details/' . $relatedRecords['id']) . '">' . $relatedRecords['name'] . '</a></td>
                                                <td>' . $relatedRecords['source_type'] . '</td>
                                                <td>';    
                                                    if (!empty($relatedRecords['id'])) {
                                                        foreach ($getUserWallets->result_array() as $userWallets) {
                                                            if (!empty($userWallets['wallet_type'] === 'Banking')) {
                                                                if ($getUserWallet->num_rows() > 0) {
                                                                    echo '
                                                                        <a href="' . site_url('Wallets/' . $relatedRecords['account_type'] . '/Details/' . $relatedRecords['id']) . '/' . $userWallets['id'] . '"><span>' . $userWallets['nickname'] . '</span></a>
                                                                    ';
                                                                }
                                                            }
                                                        } 
                                                    } else {     
                                                        echo '
                                                        <div class="dropdown">      
                                                            <a class="badge badge-sm badge-dim rounded-pill bg-primary text-white dropdown-toggle" href="#" type="button" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em> Wallet</a>      
                                                            <div class="dropdown-menu">
                                                                <ul class="link-list-opt">
                                                                    <li class="p-1 fw-bold">Bank Accounts</li>
                                                                ';
                                                                foreach ($getUserWallets->result_array() as $userWallets) {
                                                                    if (!empty($userWallets['wallet_type'] === 'Banking')) {
                                                                        if ($getUserWallets->num_rows() > 0) {
                                                                            echo '
                                                                            <li><a href="' . site_url('Wallets/Attach-Account/' . $relatedRecords['account_type'] . '/' . $relatedRecords['id']) . '/' . $userWallets['id'] . '"><span>' . $userWallets['nickname'] . '</span></a></li>    
                                                                            ';
                                                                        }
                                                                    }
                                                                }      
                                                            echo '
                                                                </ul>   
                                                                <ul class="link-list-opt">
                                                                    <li class="p-1 fw-bold">Credit Accounts</li>
                                                                ';
                                                                foreach ($getUserWallets->result_array() as $userWallets) {
                                                                    if (!empty($userWallets['wallet_type'] === 'Credit')) {
                                                                        if ($getUserWallets->num_rows() > 0) {
                                                                            echo '
                                                                            <li><a href="' . site_url('Wallets/Attach-Account/' . $relatedRecords['account_type'] . '/' . $relatedRecords['id']) . '/' . $userWallets['id'] . '"><span>' . $userWallets['nickname'] . '</span></a></li>    
                                                                            ';
                                                                        }
                                                                    }
                                                                }            
                                                            echo '  
                                                                    <li><a href="' . site_url('Wallets') . '"><span><em class="icon icon-xs ni ni-plus"></em> Create Wallet</span></a></li>    
                                                                </ul>      
                                                            </div>    
                                                        </div>';
                                                    }
                                                echo '
                                                </td>
                                                <td>' . $accountNetAmountDisplay . '</td>
                                                <td>' . $sumDisplay . '</td>
                                                <td>
                                                    ' . $accountPaidStatus . '
                                                    <a href="' . site_url('Budget/Edit/' . $relatedRecords['id']) . '"><i class="icon  myfs-md ni ni-edit"></i></a>
                                                    <a href="' . site_url('Budget/Copy/' . $relatedRecords['id']) . '"><i class="icon  myfs-md ni ni-copy"></i></a>
                                                    <a class="text-red" href="' . site_url('Budget/Delete-Account/' . $relatedRecords['id']) . '"><i class="icon myfs-md ni ni-trash"></i></a>
                                                </td>
                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
    <?php
    }
    ?>
</div>