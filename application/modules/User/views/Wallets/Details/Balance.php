<div class="col-md-12">
    <div class="nk-block">
        <div class="nk-block-between-md g-4">
            <div class="nk-block-content">
                <div class="nk-wg1">
                    <div class="nk-wg1-group g-2">
                        <div class="nk-wg1-item mr-xl-4">
                            <div class="nk-wg1-title text-soft">Available Balance</div>
                            <div class="nk-wg1-amount">
                                <div class="amount"><?php //echo $walletTotalAmount; ?> <small class="currency currency-usd">USD</small></div>
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
                        <a class="btn btn-icon btn-xl btn-dark dropdown-toggle" style="color: white;" type="button"  data-toggle="dropdown"><em class="icon ni ni-setting"></em></a><span class="btn-extext">Wallet Settings</span>
                        <div class="dropdown-menu">
                            <ul class="link-list-opt">
                                <li>
                                    <a href="<?php echo site_url('/Edit-Wallet/' . $walletID); ?>">Edit Wallet</a>
                                </li>
                                <li>
                                    <a href="" data-toggle="modal" data-target="#deleteWalletModal<?= $walletID; ?>">Delete Wallet</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="btn-wrap dropdown">
                        <a class="btn btn-icon btn-xl btn-dark dropdown-toggle" style="color: white;" type="button"  data-toggle="dropdown"><em class="icon ni ni-plus"></em></a><span class="btn-extext">Quick Trade</span>
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
                        <a href="<?php echo site_url('/Add-Wallet-Deposit/' . $walletID); ?>" class="btn btn-icon btn-xl btn-dark"><em class="icon ni ni-plus"></em></a><span class="btn-extext">Deposit Funds</span>
                    </li>
                    <li class="btn-wrap">
                        <a href="<?php echo site_url('/Add-Wallet-Withdraw/' . $walletID); ?>" class="btn btn-icon btn-xl btn-primary"><em class="icon ni ni-arrow-to-right"></em></a><span class="btn-extext">Withdraw Funds</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>