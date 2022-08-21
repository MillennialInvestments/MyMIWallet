<?php
$brokerage_type             = $this->uri->segment(4);
$this->db->from('bf_users_wallet_brokerages'); 
$this->db->where('type', $brokerage_type);
$getBrokerages          = $this->db->get();
?>
<div class="row justify-content-center pt-5">
    <?php 
    foreach($getBrokerages->result_array() as $brokerage) {
    echo '
    <span class="col-2 text-center">
        <a class="btn btn-outline-light btn-lg text-white p-1" id="automatedAccountCreation" href="' . $brokerage['redirect_url'] . '">
            <img class="full-width" src="' . base_url('assets/images/Brokerages/' . $brokerage['logo']) . '"/>
        </a>
        <!-- <a class="btn btn-primary btn-lg text-white" id="automatedAccountCreation" data-toggle="modal" data-target="#automatedAccountModal">Automated Entry</a> -->
    </span>
    ';
    }
    // http://192.168.0.3/MillennialInvest/Site-v7/v1.5/public/index.php/Wallets/Link-Account/Brokerage/https%3A%2F%2Fauth.tdameritrade.com%2Fauth%3Fresponse_type%3Dcode%26redirect_uri%3Dhttps%3A%2F%2Fwww.mymiwallet.com%2Findex.php%2FWallets%2FLink-Account%2F1%26client_id%3DXGCE3NA1BXIGQG2NHDTLHZ6OUSIZTITF%40AMER.OAUTHAP
    // https://auth.tdameritrade.com/auth?response_type=code&redirect_uri=https%3A%2F%2Fwww.mymiwallet.com%2Findex.php%2FLink-Account%2FTD-Ameritrade%2F1&client_id=XGCE3NA1BXIGQG2NHDTLHZ6OUSIZTITF%40AMER.OAUTHAP
    ?>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/ccxt@1.91.15/dist/ccxt.browser.js"></script>
<script>
    console.log (ccxt.exchanges) // print all available exchanges
</script>
