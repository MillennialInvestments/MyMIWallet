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
    ?>
</div>