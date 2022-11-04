<?php
$profileForm								= trim(file_get_contents("php://input"));
$profileForm								= json_decode($profileForm, true);
$thisController                             = $this->router->fetch_class();
$thisMethod                     = $this->router->fetch_method();
$thisURL                        = $this->uri->uri_string();
$thisFullURL                    = $this->uri->current_url();

$user_id                                    = $profileForm['user_id'];
$email                                      = $profileForm['email'];
$username                                   = $profileForm['username'];
$first_name                                 = $profileForm['first_name'];
$middle_name                                = $profileForm['middle_name'];
$last_name                                  = $profileForm['last_name'];
$name_suffix                                = $profileForm['name_suffix'];
$phone                                      = $profileForm['phone'];
$address                                    = $profileForm['address'];
$city                                       = $profileForm['city'];
$state                                      = $profileForm['state'];
$country                                    = $profileForm['country'];
$zipcode                                    = $profileForm['zipcode'];

$userData                                   = array(
    'email'                                 => $email,
    'username'                              => $username,
    'first_name'                            => $first_name,
    'middle_name'                           => $middle_name,
    'last_name'                             => $last_name,
    'name_suffix'                           => $name_suffix,
    'phone'                                 => $phone,
    'address'                               => $address,
    'city'                                  => $city,
    'state'                                 => $state,
    'country'                               => $country,
    'zipcode'                               => $zipcode,
);
$this->db->where('id', $user_id);
if($this->db->update('bf_users', $userData)) {
    $cuID                           = $user_id;
    $betaStatus                     = $this->config->item('beta');
    if ($betaStatus === 0) {
        $beta                       = 'No';
    } else {
        $beta                       = 'Yes';
    }
    $thisComment                    = 'User (' . $cuID . ') successfully viewed the following page: ' . $thisURL;
    $this->mymilogger
        ->user($cuID) //Set UserID, who created this  Action
        ->beta($beta) //Set whether in Beta or nto
        ->type('User Profile Update') //Entry type like, Post, Page, Entry
        ->controller($thisController)
        ->method($thisMethod)
        ->url($thisURL)
        ->full_url($thisFullURL)
        ->comment($thisComment) //Token identify Action
        ->log(); //Add Database Entry
} else {

}
?>