<?php
$pageURIA                                   = $this->uri->segment(1);
$pageURIB                                   = $this->uri->segment(2);
$pageURIC                                   = $this->uri->segment(3);
$pageURID                                   = $this->uri->segment(4);
$pageURIE                                   = $this->uri->segment(5);
$userID                                     = $pageURID; 
$redirect_url                               = current_url();
$initial_value								= $_SESSION['allSessionData']['userGoldData']['myMIGInitialValue'];
$available_coins							= $_SESSION['allSessionData']['userGoldData']['coinSum'];
$coin_value									= $this->config->item('mymig_coin_value');
$gas_fee									= $this->config->item('gas_fee');
$trans_percent								= $this->config->item('trans_percent');
$trans_fee									= $this->config->item('trans_fee');
$this->db->from('bf_exchanges'); 
$this->db->where('alt_cur', 'No');
$this->db->where('int_cur', 'No'); 
$this->db->order_by('market_pair', 'ASC'); 
$getExchanges                               = $this->db->get(); 
if ($pageURIB === 'Assets') {
    $dashboardTitle                             = 'Users /';
    $dashboardSubtitle                          = 'Distribute Coins'; 
    $viewFileData                               = array(
        'userID'                                => $userID,
        
    );
    $this->load->view('Management/Assets/Distribute/Overview', $viewFileData); 
} elseif ($pageURIB === 'Users') {
    $this->load->view('Management/Assets/Distribute/By_User', $viewFileData); 
}
?>