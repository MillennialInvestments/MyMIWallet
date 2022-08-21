<?php 
$cuID                                                               = $_SESSION['allSessionData']['userAccount']['cuID'];
$today                                                              = date("Y-m-d");
// $this->db->select('net_gains'); 
$this->db->from('bf_users_trades'); 
$this->db->where('user_id', $cuID); 
$this->db->where('submitted_date', $today); 
$this->db->where('trading_account_tag', 'TD Ameritrade'); 
// $this->db->where('order_status', 'OPENING'); 
$getOpeningTrades                                                   = $this->db->get(); 
// echo $today . '<br><br>'; 
// print_r($getOpeningTrades);
// echo '<br><br>';
ini_set('max_execution_time', '300');
?>
<div class="row">
        <div class="col-12 col-md-4">
            <div class="nk-block">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <div class="card-title-group mb-1">
                            <div class="card-title">
                                <h6 class="title">Investment Overview</h6>
                                <p>The investment overview of your platform. <a href="#">All Investment</a></p>
                            </div>
                        </div>
                        <ul class="nav nav-tabs nav-tabs-card nav-tabs-xs">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#overview">Overview</a></li>
                            <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#thisyear">This Year</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#alltime">All Time</a></li> -->
                        </ul>
                        <div class="tab-content mt-0">
                            <div class="tab-pane active" id="overview">
                                <div class="invest-ov gy-2">
                                    <?php
                                    foreach($getOpeningTrades->result_array() as $allTrades) {
                                        if ($allTrades['order_status'] === 'OPENING') {
                                            $option_sum         = 0; 
                                            while ($allTrades['category'] === 'option_buy' OR $allTrades['category'] === 'option_sell') {
                                                $tradeNetGains      = $allTrades['net_gains'];
                                                $option_amount      = $option_sum + $tradeNetGains;
                                            }
                                            echo $option_amount; 
                                        }
                                    }
                                    ?>
                                    <div class="subtitle">Total Trades</div>
                                    <div class="invest-ov-details">
                                        <div class="invest-ov-info">
                                            <div class="amount">49,395.395  <span class="currency currency-usd">USD</span></div>
                                            <div class="title">Amount</div>
                                        </div>
                                        <div class="invest-ov-stats">
                                            <div><span class="amount">56</span><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span></div>
                                            <div class="title">Plans</div>
                                        </div>
                                    </div>
                                    <div class="invest-ov-details">
                                        <div class="invest-ov-info">
                                            <div class="amount">49,395.395  <span class="currency currency-usd">USD</span></div>
                                            <div class="title">Paid Profit</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="invest-ov gy-2">
                                    <div class="subtitle">Investment in this Month</div>
                                    <div class="invest-ov-details">
                                        <div class="invest-ov-info">
                                            <div class="amount">49,395.395  <span class="currency currency-usd">USD</span></div>
                                            <div class="title">Amount</div>
                                        </div>
                                        <div class="invest-ov-stats">
                                            <div><span class="amount">23</span><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span></div>
                                            <div class="title">Plans</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="tab-pane" id="thisyear">
                                <div class="invest-ov gy-2">
                                    <div class="subtitle">Currently Actived Investment</div>
                                    <div class="invest-ov-details">
                                        <div class="invest-ov-info">
                                            <div class="amount">89,395.395  <span class="currency currency-usd">USD</span></div>
                                            <div class="title">Amount</div>
                                        </div>
                                        <div class="invest-ov-stats">
                                            <div><span class="amount">96</span><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span></div>
                                            <div class="title">Plans</div>
                                        </div>
                                    </div>
                                    <div class="invest-ov-details">
                                        <div class="invest-ov-info">
                                            <div class="amount">99,395.395  <span class="currency currency-usd">USD</span></div>
                                            <div class="title">Paid Profit</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="invest-ov gy-2">
                                    <div class="subtitle">Investment in this Month</div>
                                    <div class="invest-ov-details">
                                        <div class="invest-ov-info">
                                            <div class="amount">149,395.395  <span class="currency currency-usd">USD</span></div>
                                            <div class="title">Amount</div>
                                        </div>
                                        <div class="invest-ov-stats">
                                            <div><span class="amount">83</span><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span></div>
                                            <div class="title">Plans</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="alltime">
                                <div class="invest-ov gy-2">
                                    <div class="subtitle">Currently Actived Investment</div>
                                    <div class="invest-ov-details">
                                        <div class="invest-ov-info">
                                            <div class="amount">249,395.395  <span class="currency currency-usd">USD</span></div>
                                            <div class="title">Amount</div>
                                        </div>
                                        <div class="invest-ov-stats">
                                            <div><span class="amount">556</span><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>1.93%</span></div>
                                            <div class="title">Plans</div>
                                        </div>
                                    </div>
                                    <div class="invest-ov-details">
                                        <div class="invest-ov-info">
                                            <div class="amount">149,395.395  <span class="currency currency-usd">USD</span></div>
                                            <div class="title">Paid Profit</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="invest-ov gy-2">
                                    <div class="subtitle">Investment in this Month</div>
                                    <div class="invest-ov-details">
                                        <div class="invest-ov-info">
                                            <div class="amount">249,395.395  <span class="currency currency-usd">USD</span></div>
                                            <div class="title">Amount</div>
                                        </div>
                                        <div class="invest-ov-stats">
                                            <div><span class="amount">223</span><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>1.93%</span></div>
                                            <div class="title">Plans</div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div> 
            </div>      
        </div>
    </div>
</div>