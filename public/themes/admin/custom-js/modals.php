<?php
$pageURIA                               = $this->uri->segment(1);
$pageURIB                               = $this->uri->segment(2);
$pageURIC                               = $this->uri->segment(3);
$pageURID                               = $this->uri->segment(4);
$pageURIE                               = $this->uri->segment(5);

if ($pageURIA === 'Investor-Profile') {
    $this->load->view('User/Dashboard/Investor_Profile/Security/Reset_Password');
<<<<<<< HEAD
    // echo '
    // <div class="modal fade" id="createBankAccountModal" tabindex="-1" aria-labelledby="createBankAccountModal" aria-hidden="true">
    //     <div class="modal-dialog">
    //         <div class="modal-content">
    // ';
    // $this->load->view('User/Wallets/Create_Bank_Account');
    // echo '
    //         </div>
    //     </div>
    // </div>
    // ';
=======
    $this->load->view('User/Wallets/Create_Bank_Account');
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
}