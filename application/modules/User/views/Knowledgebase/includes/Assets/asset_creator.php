<div class="row" id="mymy-asset-creator"></div>
<div class="row g-gs">
    <div class="col-xl-12">
        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
            <div class="nk-block-head-content">
                <div class="card">
                    <div class="card-inner text-left">
                        <h5 class="nk-block-title fw-normal pb-3">MyMI Asset Creator</h5>
                        <div class="nk-block-des">
                            <p class="lead fs-14px">
                                With our <strong>MyMI Asset Creator</strong>, Investors gain the ability to create their own investment projects and pools tailored to whatever use-case they could possibly imagine. 
                                You can <strong>auction/sell</strong> your investment data direct to business by utilizing our <strong>MyMI Exchange & Marketplace</strong>.
                            </p>
                            <p class="lead fs-14px">
                                With the MyMI Exchange/Marketplace, Investors gain the ability to profit from their own Investment Data. 
                                Big Box Companies are consisting polling your user data every second of the day, as long as anything you do is online. 
                                At MyMI Wallet, we feel that you should take advantage in the value of your data by allowing Investors to opt-in our <strong>Auctionable Assets</strong>.
                                <?php
                                if ($this->uri->segment(1) === 'Assets') {
                                    echo '
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><a href="' . site_url('Knowledge-Base/Assets') . '">What are Assets?</a></li>
                                    </ul>
                                    ';
                                }; 
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>