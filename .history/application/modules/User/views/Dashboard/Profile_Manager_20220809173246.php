<?php
$profileForm								= trim(file_get_contents("php://input"));
$profileForm								= json_decode($profileForm, true);

$user_id                                    = $profileForm['id'];
$email                                      = $profileForm['email'];
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
    'email'                                 => $email,
    'email'                                 => $email,
    'email'                                 => $email,
    'email'                                 => $email,
    'email'                                 => $email,
    'email'                                 => $email,
    'email'                                 => $email,
);
$this->db->where('id', $user_id);
return $this->db->update('bf_users', $profileForm);