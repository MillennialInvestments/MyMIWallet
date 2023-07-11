<?php
/** 
    
 */
$cuID			= $_SESSION['allSessionData']['userAccount']['cuID'];
?>
<style>
	.symbol-picker {
		width: 50% !important;
	}
    .hideThis {
        display: none !important;
    }
    .scrollable-section .custom-group-width {
        min-width: 100px;
    }
    .datatable-wrap {
        border: none !important;    
    }
<<<<<<< HEAD
=======
    .tt-edit-user-preferences {
        display: none; 
    }
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    .tt-trade-window {
        background-color: transparent !important;
    }
</style>
<?php
//~ print_r($getOrdersJSON);
?>
<div class="nk-block">
    <div class="nk-block-head">
        <?php echo theme_view('navigation_breadcrumbs'); ?>
        <div class="nk-block-between-md g-4">
            <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-bold"><span class="d-none d-md-block">Trade Tracker / Holdings</span><span class="d-block d-md-none">Trade Tracker</span></h2>
                <div class="nk-block-des"><p>Here is the list of your most recent trades!</p></div>
            </div>
            <div class="nk-block-head-content">
                <ul class="nk-block-tools gx-3">
                    <div class="opt-menu-md dropdown tt-new-trade">
<<<<<<< HEAD
                        <a class="btn btn-primary tt-spawn mr-2" href="<?php echo site_url('/Wallets'); ?>">
                            <em class="icon ni ni-plus"></em><span>New Account</span>
                        </a>
                        <button class="btn btn-primary tt-spawn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <em class="icon ni ni-plus"></em><span>New Trade</span>
=======
                        <button class="btn btn-primary tt-spawn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <em class="icon icon-plus"></em><span>New Trade</span>
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                        </button>
                        <div class="d-none" id="trade-list">
                            <?php
                                $getTrades 		= $this->tracker_model->get_user_trades($cuID);
                                $tradeList		= json_encode($getTrades, JSON_PRETTY_PRINT);
                                echo $tradeList;
                            ?>
                        </div>
                        <div class="d-none" id="symbol-list">
                            <?php
                                //[{"id":"01","text":"SPY","tag":"stocks"},{"id":"02","text":"AAPL","tag":"crypto"},{"id":"03","text":"AMZN","tag":"stocks"}]
                                $getSym 		= $this->tracker_model->get_symbol_tickers('symbol');
                                $copy 			= $getSym;
                                echo '[';
                                foreach ($getSym as $ticker) {
                                    echo '{"id":"' . $ticker['id'] . '","value":"'  . $ticker['symbol'] . '","tag":"' . $ticker['type'] . '"}';
                                    if (next($copy)) {
                                        echo ','; // Add comma for all elements instead of last
                                    }
                                }
                                echo ']';
                            ?>
                        </div>
                        <div class="d-none" id="wallet-list">
                            <?php
                                $getWallets	 	= $this->tracker_model->get_user_wallets($cuID);
                                // echo json_encode($getWallets);
                                $walletCopy	 	= $getWallets;
                                echo '[';
                                foreach ($getWallets as $wallet) {
                                    echo '{"id":"' . $wallet['id'] . '","value":"'  . $wallet['nickname'] . '","tag":"' . $wallet['broker'] . '"}';
                                    if (next($walletCopy)) {
                                        echo ',';
                                    }
                                }
                                echo ']';
                            ?>
<<<<<<< HEAD
                        </div>           
=======
                        </div>
                        <div class="tt-type-selector dropdown-menu dropdown-menu-right text-center" arial-labelledby="option_button">
                            <ul class="link-list-plain full-width">
                                <li class="dropdown-item"><strong>Equity</strong></li>
                                <li class="p-1" data-type="long" data-category="equity">Long</li>
                                <li class="p-1" data-type="short" data-category="equity">Short</li>
                                <li class="p-1"><strong>Buy Options</strong></li>
                                <li class="p-1" data-type="call" data-category="option_buy">Call</li>
                                <li class="p-1" data-type="put" data-category="option_buy">Put</li>
                                <li class="p-1"><strong>Sell Options</strong></li>
                                <li class="p-1" data-type="call" data-category="option_sell">Call</li>
                                <li class="p-1" data-type="put" data-category="option_sell">Put</li>
                            </ul>
                        </div>
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                    </div>
                    <!-- <div class="form-group">
                        <input type="text" name="search" id="normal-search" placeholder="Search...">
                    </div> -->
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="nk-block">												
    <div class="card card-preview">
        <div class="card-inner pt-0"> 
            <div class="dt-bootstrap4 no-footer">
                <div class="my-3">
<<<<<<< HEAD
                    <div class="new-target"></div>
                    <div class="origin" style="width: 50%;"></div>
                    <div class="current" style="width: 50%;"></div>
                    <div class="tt-edit-user-preferences container-fluid px-0">
                        <button class="close-button" style="z-index:10 ;">✕</button>
                        <div class="menu-bar">

                        </div>
                        <div class="page-section card card-bordered p-4">

                            <div class="page columns-editor flex-column">

                            </div>

                            <div class="page custom-columns flex-column">
                                <h1>Custom columns</h1>
                            </div>
                            <div class="save-slide ">

                                <button type="button" class="btn btn-primary" id="saveBtn" disabled>Save</button>
                                <button type="button" class="btn btn-primary" id="resetBtn" disabled>Reset</button>
                                <button type="button" class="btn btn-primary" id="exportBtn" disabled>⭳</button>
                                <button type="button" class="btn btn-primary" id="importBtn" disabled>⭱</button>
                            </div>
                        </div>
                    </div>
                    <div class="tt-alert-box">
                    </div>
=======
                    <div class="new-target p-0"></div>
                    <div class="origin" style="width: 50%;"></div>
                    <div class="current" style="width: 50%;"></div>
                    <div class="tt-edit-user-preferences">
                        <button class="close-button">✕</button>
                        <div class="menu-bar"></div>
                        <div class="page-section">

                            <div class="page columns-editor">



                            </div>

                            <div class="page custom-columns"> </div>
                        </div>
                    </div>
                    <div class="tt-alert-box">
                    </div>	
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                </div>
            </div>
        </div>
    </div>
    <hr>
</div>