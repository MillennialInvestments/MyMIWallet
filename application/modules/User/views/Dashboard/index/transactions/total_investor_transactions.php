<div class="nk-block">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner">
                <div class="card-title-group">
                    <div class="card-title">
                        <h5 class="title">Coin Purchases</h5>
                    </div>
                    <div class="card-tools me-n1">
                        <ul class="btn-toolbar gx-1">
                            <li>
                                <a href="#" class="search-toggle toggle-search btn btn-icon" data-target="search"><em class="icon ni ni-search"></em></a>
                            </li><!-- li -->
                            <li class="btn-toolbar-sep"></li><!-- li -->
                            <li>
                                <div class="dropdown">
                                    <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                        <div class="badge badge-circle bg-primary">4</div>
                                        <em class="icon ni ni-filter-alt"></em>
                                    </a>
                                    <div class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-end">
                                        <div class="dropdown-head">
                                            <span class="sub-title dropdown-title">Advance Filter</span>
                                            <div class="dropdown">
                                                <a href="#" class="link link-light">
                                                    <em class="icon ni ni-more-h"></em>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="dropdown-body dropdown-body-rg">
                                            <div class="row gx-6 gy-4">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="overline-title overline-title-alt">Type</label>
                                                        <select class="form-select js-select2">
                                                            <option value="any">Any Type</option>
                                                            <option value="deposit">Deposit</option>
                                                            <option value="buy">Buy Coin</option>
                                                            <option value="sell">Sell Coin</option>
                                                            <option value="transfer">Transfer</option>
                                                            <option value="withdraw">Withdraw</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="overline-title overline-title-alt">Status</label>
                                                        <select class="form-select js-select2">
                                                            <option value="any">Any Status</option>
                                                            <option value="pending">Pending</option>
                                                            <option value="cancel">Cancel</option>
                                                            <option value="process">Process</option>
                                                            <option value="completed">Completed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="overline-title overline-title-alt">Pay Currency</label>
                                                        <select class="form-select js-select2">
                                                            <option value="any">Any Coin</option>
                                                            <option value="bitcoin">Bitcoin</option>
                                                            <option value="ethereum">Ethereum</option>
                                                            <option value="litecoin">Litecoin</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="overline-title overline-title-alt">Method</label>
                                                        <select class="form-select js-select2">
                                                            <option value="any">Any Method</option>
                                                            <option value="paypal">PayPal</option>
                                                            <option value="bank">Bank</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-control-sm custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="includeDel">
                                                            <label class="custom-control-label" for="includeDel"> Including Deleted</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-secondary">Filter</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-foot between">
                                            <a class="clickable" href="#">Reset Filter</a>
                                            <a href="#savedFilter" data-bs-toggle="modal">Save Filter</a>
                                        </div>
                                    </div><!-- .filter-wg -->
                                </div><!-- .dropdown -->
                            </li><!-- li -->
                            <li>
                                <div class="dropdown">
                                    <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                        <em class="icon ni ni-setting"></em>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                        <ul class="link-check">
                                            <li><span>Show</span></li>
                                            <li class="active"><a href="#">10</a></li>
                                            <li><a href="#">20</a></li>
                                            <li><a href="#">50</a></li>
                                        </ul>
                                        <ul class="link-check">
                                            <li><span>Order</span></li>
                                            <li class="active"><a href="#">DESC</a></li>
                                            <li><a href="#">ASC</a></li>
                                        </ul>
                                    </div>
                                </div><!-- .dropdown -->
                            </li><!-- li -->
                        </ul><!-- .btn-toolbar -->
                    </div><!-- .card-tools -->
                    <div class="card-search search-wrap" data-search="search">
                        <div class="search-content">
                            <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                            <input type="text" class="form-control border-transparent form-focus-none" placeholder="Quick search by transaction">
                            <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                        </div>
                    </div><!-- .card-search -->
                </div><!-- .card-title-group -->
            </div><!-- .card-inner -->
            <div class="card-inner p-5">
                <table class="table" id="userActivityDatatable">
                    <thead>
                        <tr>
                            <th>Details</th>
                            <th>Source</th>
                            <th>Order #</th>
                            <th>Amount</th>
                            <th>Balance</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $getUserCoinPurchases = $this->investor_model->get_user_coin_purchases($cuID); 
                            foreach($getUserCoinPurchases->result_array() as $coinPurchase) {
                                echo '                
                        <tr>
                            <td class="d-none">' . $coinPurchase['id'] . '</td>
                            <td class="">
                                <div class="nk-tnx-type">
                                    <div class="nk-tnx-type-icon bg-success-dim text-success">
                                        <em class="icon ni ni-arrow-up-right"></em>
                                    </div>
                                    <div class="nk-tnx-type-text">
                                        <span class="tb-lead">Deposited Funds</span><br>
                                        <span class="tb-date"><small>' . $coinPurchase['month'] . '/' . $coinPurchase['day'] . '/' . $coinPurchase['year'] . ' ' . $coinPurchase['time'] . '</small></span>
                                    </div>
                                </div>
                            </td>
                            <td class="">
                                <span class="tb-lead-sub">Using MyMI Wallet</span><br>
                            </td>
                            <td class="">
                                <span class="tb-lead-sub">EO' . $coinPurchase['id'] . '</span><br>
                            </td>
                            <td class="text-end">
                                <span class="tb-amount">' . number_format($coinPurchase['total_cost'], 2) . '<span>USD</span></span><br>
                                <span class="tb-amount-sm"><small>' . number_format($coinPurchase['total_fees'], 2) . ' USD</small></span>
                            </td>
                            <td class="text-end tb-col-sm">
                                <span class="tb-amount">' . $coinPurchase['total'] . ' <span>' . $coinPurchase['coin'] . '</span></span><br>
                                <span class="tb-amount-sm"><small>' . $coinPurchase['initial_coin_value'] . ' USD</small></span>
                            </td>
                            <td class="nk-tb-col-status text-center">
                                <div class="dot dot-success d-md-none"></div><br>
                                <span class="badge badge-sm badge-dim bg-outline-success d-none d-md-inline-flex">' . $coinPurchase['status'] . '</span>
                            </td>
                            <td class="nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-2">
                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt">
                                                    <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                    <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div><!-- .card-inner-group -->
    </div><!-- .card -->
</div><!-- .nk-block -->
<div class="nk-block">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner">
                <div class="card-title-group">
                    <div class="card-title">
                        <h5 class="title">Exchange Orders</h5>
                    </div>
                    
                    <div class="card-search search-wrap" data-search="search">
                        <div class="search-content">
                            <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                            <input type="text" class="form-control border-transparent form-focus-none" placeholder="Quick search by transaction">
                            <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                        </div>
                    </div><!-- .card-search -->
                </div><!-- .card-title-group -->
            </div><!-- .card-inner -->
            <div class="card-inner p-5">
                <table class="table" id="userActivityDatatable">
                    <thead>
                        <tr>
                            <th>Details</th>
                            <th>Source</th>
                            <th>Order #</th>
                            <th>Amount</th>
                            <th>Balance</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $getUserExchangeOrders = $this->investor_model->get_user_exchange_orders($cuID); 
                            foreach($getUserExchangeOrders->result_array() as $exchangeOrder) {
                                echo '                
                        <tr>
                            <td class="d-none">' . $exchangeOrder['id'] . '</td>
                            <td class="">
                                <div class="nk-tnx-type">
                                    <div class="nk-tnx-type-icon bg-success-dim text-success">
                                        <em class="icon ni ni-arrow-up-right"></em>
                                    </div>
                                    <div class="nk-tnx-type-text">
                                        <span class="tb-lead">Deposited Funds</span><br>
                                        <span class="tb-date"><small>' . $exchangeOrder['month'] . '/' . $exchangeOrder['day'] . '/' . $exchangeOrder['year'] . ' ' . $exchangeOrder['time'] . '</small></span>
                                    </div>
                                </div>
                            </td>
                            <td class="">
                                <span class="tb-lead-sub">Using MyMI Wallet</span><br>
                                <span class="tb-sub"><small>' . $exchangeOrder['user_email'] . '</small></span>
                            </td>
                            <td class="">
                                <span class="tb-lead-sub">CP' . $exchangeOrder['id'] . '</span><br>
                            </td>
                            <td class="text-end">
                                <span class="tb-amount">+ 0.010201 <span>BTC</span></span><br>
                                <span class="tb-amount-sm"><small>' . number_format($exchangeOrder['total_cost'], 2) . ' USD</small></span>
                            </td>
                            <td class="text-end tb-col-sm">
                                <span class="tb-amount">1.30910201 <span>BTC</span></span><br>
                                <span class="tb-amount-sm"><small>101290.49 USD</small></span>
                            </td>
                            <td class="nk-tb-col-status text-center">
                                <div class="dot dot-success d-md-none"></div><br>
                                <span class="badge badge-sm badge-dim bg-outline-success d-none d-md-inline-flex">' . $exchangeOrder['status'] . '</span>
                            </td>
                            <td class="nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-2">
                                    <li class="nk-tb-action-hidden">
                                        <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
                                    </li>
                                    <li class="nk-tb-action-hidden">
                                        <a href="#tranxDetails" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                    </li>
                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt">
                                                    <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                    <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div><!-- .card-inner-group -->
    </div><!-- .card -->
<<<<<<< HEAD
</div><!-- .nk-block -->
<div class="nk-block">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner">
                <div class="card-title-group">
                    <div class="card-title">
                        <h5 class="title">Service Orders</h5>
                    </div>
                    
                    <div class="card-search search-wrap" data-search="search">
                        <div class="search-content">
                            <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                            <input type="text" class="form-control border-transparent form-focus-none" placeholder="Quick search by transaction">
                            <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                        </div>
                    </div><!-- .card-search -->
                </div><!-- .card-title-group -->
            </div><!-- .card-inner -->
            <div class="card-inner p-5">
                <table class="table" id="userActivityDatatable">
                    <thead>
                        <tr>
                            <th>Details</th>
                            <th>Source</th>
                            <th>Order #</th>
                            <th>Amount</th>
                            <th>Balance</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $getUserExchangeOrders = $this->investor_model->get_user_exchange_orders($cuID); 
                            foreach($getUserExchangeOrders->result_array() as $exchangeOrder) {
                                echo '                
                        <tr>
                            <td class="d-none">' . $exchangeOrder['id'] . '</td>
                            <td class="">
                                <div class="nk-tnx-type">
                                    <div class="nk-tnx-type-icon bg-success-dim text-success">
                                        <em class="icon ni ni-arrow-up-right"></em>
                                    </div>
                                    <div class="nk-tnx-type-text">
                                        <span class="tb-lead">Deposited Funds</span><br>
                                        <span class="tb-date"><small>' . $exchangeOrder['month'] . '/' . $exchangeOrder['day'] . '/' . $exchangeOrder['year'] . ' ' . $exchangeOrder['time'] . '</small></span>
                                    </div>
                                </div>
                            </td>
                            <td class="">
                                <span class="tb-lead-sub">Using MyMI Wallet</span><br>
                                <span class="tb-sub"><small>' . $exchangeOrder['user_email'] . '</small></span>
                            </td>
                            <td class="">
                                <span class="tb-lead-sub">CP' . $exchangeOrder['id'] . '</span><br>
                            </td>
                            <td class="text-end">
                                <span class="tb-amount">+ 0.010201 <span>BTC</span></span><br>
                                <span class="tb-amount-sm"><small>' . number_format($exchangeOrder['total_cost'], 2) . ' USD</small></span>
                            </td>
                            <td class="text-end tb-col-sm">
                                <span class="tb-amount">1.30910201 <span>BTC</span></span><br>
                                <span class="tb-amount-sm"><small>101290.49 USD</small></span>
                            </td>
                            <td class="nk-tb-col-status text-center">
                                <div class="dot dot-success d-md-none"></div><br>
                                <span class="badge badge-sm badge-dim bg-outline-success d-none d-md-inline-flex">' . $exchangeOrder['status'] . '</span>
                            </td>
                            <td class="nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-2">
                                    <li class="nk-tb-action-hidden">
                                        <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
                                    </li>
                                    <li class="nk-tb-action-hidden">
                                        <a href="#tranxDetails" data-bs-toggle="modal" class="bg-white btn btn-sm btn-outline-light btn-icon btn-tooltip" title="Details"><em class="icon ni ni-eye"></em></a>
                                    </li>
                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt">
                                                    <li><a href="#"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-cross-round"></em><span>Reject</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-repeat"></em><span>Check</span></a></li>
                                                    <li><a href="#tranxDetails" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div><!-- .card-inner-group -->
    </div><!-- .card -->
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
</div><!-- .nk-block -->