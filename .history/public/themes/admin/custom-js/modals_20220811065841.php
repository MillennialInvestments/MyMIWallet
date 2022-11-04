<?php
$pageURIA                               = $this->uri->segment(1);
$pageURIB                               = $this->uri->segment(2);
$pageURIC                               = $this->uri->segment(3);
$pageURID                               = $this->uri->segment(4);
$pageURIE                               = $this->uri->segment(5);

if ($pageURIA === 'Investor-Profile') {
    $this->load->view('User/Dashboard/Investor_Profile/Security/Reset_Pas');
    $this->load->view('User/Wallets/Create_Bank_Account');
}