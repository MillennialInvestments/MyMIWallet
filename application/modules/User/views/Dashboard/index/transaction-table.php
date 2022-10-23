<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between g-3">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Transactions</h3>
            <div class="nk-block-des text-soft">
                <!-- <p>You have total 12,835 orders.</p> -->
            </div>
        </div><!-- .nk-block-head-content -->
        <?php /** 
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
        */ ?> 
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<?php
    if ($this->uri->segment(1) === 'Investor-Profile') {
        // print_r($userAccount);               
        $this->load->view('User/Dashboard/index/transactions/total_investor_transactions', $userAccount);
    }; 
?>