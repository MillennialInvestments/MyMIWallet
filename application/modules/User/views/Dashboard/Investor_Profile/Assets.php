<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between g-3">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">My Assets</h3>
            <div class="nk-block-des text-soft">
                <p>You have total 12,835 orders.</p>
            </div>
        </div><!-- .nk-block-head-content -->
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                        <li><a href="#" class="btn btn-white btn-dim btn-outline-light"><em class="icon ni ni-download-cloud"></em><span>Export</span></a></li>
                        <li class="nk-block-tools-opt">
                            <div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                        <li><a href="#"><span>Add Tranx</span></a></li>
                                        <li><a href="#"><span>Add Deposit</span></a></li>
                                        <li><a href="#"><span>Add Withdraw</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<div class="nk-block">
    <div class="card">
        <div class="card-inner-group">
            <div class="card-inner">
                <div class="card-title-group">
                    <div class="card-title">
                        <h5 class="title">Asset Overview</h5>
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
            <div class="card-inner">
                <table class="table table-responsive" id="userActivityDatatable">
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
                            $getUserAssets = $this->investor_model->get_user_assets($cuID); 
                            foreach($getUserAssets->result_array() as $userAsset) {
                                echo '                
                        <tr>
                            <td class="d-none">' . $userAsset['id'] . '</td>
                            <td class="">
                                <div class="nk-tnx-type">
                                    <div class="nk-tnx-type-icon bg-success-dim text-success">
                                        <em class="icon ni ni-arrow-up-right"></em>
                                    </div>
                                    <div class="nk-tnx-type-text">
                                        <span class="tb-lead">Created Asset</span><br>
                                        <span class="tb-date"><small>' . $userAsset['date'] . '</small></span>
                                    </div>
                                </div>
                            </td>
                            <td class="">
                                <span class="tb-lead-sub">' . $userAsset['symbol'] . '</span><br>
                            </td>
                            <td class="">
                                <span class="tb-lead-sub">MA' . $userAsset['id'] . '</span><br>
                            </td>
                            <td class="text-end">
                                <span class="tb-amount-sm">' . number_format(($userAsset['coin_value'] * $userAsset['coin_quantity']), 0) . '</span><br>
                            </td>
                            <td class="text-end tb-col-sm">
                                <span class="tb-amount">' . number_format($userAsset['coin_quantity'], 2) . '</span><br>
                                <span class="tb-amount-sm"><small>101290.49 USD</small></span>
                            </td>
                            <td class="nk-tb-col-status text-center">
                                <span class="badge badge-sm badge-dim bg-outline-success d-none d-md-inline-flex">' . $userAsset['status'] . '</span>
                            </td>
                            <td class="nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-2">
                                    <li class="nk-tb-action-hidden">
                                        <a href="#" class="bg-white btn btn-sm btn-outline-light btn-icon full-width" data-bs-toggle="tooltip" data-bs-placement="top" title="Approve"><em class="icon ni ni-done"></em></a>
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
</div><!-- .nk-block -->