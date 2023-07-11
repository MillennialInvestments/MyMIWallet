<?php
$this->load->helper('date');
$orderForm								                = trim(file_get_contents("php://input"));
$orderForm								                = json_decode($orderForm, true);

// GET Request Defined Variables
$appType                                                = $orderForm['app_type'];
$status									                = 1;
$beta									                = $orderForm['beta'];
$referral_code									        = $orderForm['referral_code'];
$first_name									            = $orderForm['first_name'];
$middle_name									        = $orderForm['middle_name'];
$last_name									            = $orderForm['last_name'];
$name_suffix									        = $orderForm['name_suffix'];
$phone									                = $orderForm['phone'];
$address									            = $orderForm['address'];
$city									                = $orderForm['city'];
$state									                = $orderForm['state'];
$country									            = $orderForm['country'];
$zipcode									            = $orderForm['zipcode'];
if ($appType === 'Advisor') {

} elseif ($appType === 'Client') {
    $occupation									        = $orderForm['occupation'];
    $employer									        = $orderForm['employer'];
    $industry									        = $orderForm['industry'];
    $income									            = $orderForm['income'];
    $employment_duration						        = $orderForm['employment_duration'];
    $expected_retirement_age					        = $orderForm['expected_retirement_age'];
    
    $accountData							            = array(
        'status'							            => $status,
        'beta'								            => $beta,
        'first_name'                                    => $first_name,
        'middle_name'                                   => $middle_name,
        'last_name'                                     => $last_name,
        'name_suffix'                                   => $name_suffix,
        'phone'                                         => $phone,
        'address'                                       => $address,
        'city'                                          => $city,
        'state'                                         => $state,
        'country'                                       => $country,
        'zipcode'                                       => $zipcode,
        'occupation'                                    => $occupation,
        'employer'                                      => $employer,
        'industry'                                      => $industry,
        'income'                                        => $income,
        'employment_duration'                           => $employment_duration,
        'expected_retirement_age'                       => $expected_retirement_age,
    );
    
    return $this->db->insert('bf_cfa_analysis', $accountData);
}
?>