<div class="col-md-12 mb-3">  
    <div class="nk-block">
        <div class="nk-block-head">
            <?php echo theme_view('navigation_breadcrumbs'); ?>
            <div class="nk-block-between-md g-4">
                <div class="nk-block-head-content">
                    <div class="nk-wgwh">
                        <em class="icon-circle icon-circle-lg icon ni ni-sign-usd" style="margin-top: -35px;"></em>
                        <div class="nk-wgwh-title h5">
                            <h2 class="nk-block-title fw-bold"><?php echo $walletNickname; ?></h2>
                            <div class="nk-block-des">
                                <p>
                                    <span class="d-block d-md-none">View Your Financial Growth</span>
                                    <span class="d-none d-md-block">View Your Financial Growth All In One Place!</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                //if ($exchange_wallet === 'Yes') {
                    ?>
                <!-- <div class="nk-block-head-content">
                    <ul class="nk-block-tools gx-3">
                        <li class="opt-menu-md dropdown">
                            <a href="<?php //echo site_url('/Exchange/Market/' . $wallet_market_pair . '/' . $wallet_market); ?>" class="btn btn-primary"><span>Trade <?= $wallet_market; ?></span> <em class="icon icon-arrow-right"></em></a>
                        </li>
                    </ul>
                </div> -->
                <?php
                //}
                ?>
            </div>
        </div>
    </div>
</div>