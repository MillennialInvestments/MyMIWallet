<?php
$this->load->helper('date');
$orderForm								                = trim(file_get_contents("php://input"));
$orderForm								                = json_decode($orderForm, true);

// GET Request Defined Variables
$status									                = 1;
$beta									                = $orderForm['beta'];

$accountData                                            = array(
    'beta'                                              => $beta,
); 
return $this->db->insert('bf_cfa_analysis', $accountData);
?>