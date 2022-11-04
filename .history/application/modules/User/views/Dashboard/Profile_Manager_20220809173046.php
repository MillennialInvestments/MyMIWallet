<?php
$profileForm								= trim(file_get_contents("php://input"));
$profileForm								= json_decode($profileForm, true);

$user_id                                    = $profileForm['id'];

$userData
$this->db->where('id', $user_id);
return $this->db->update('bf_users', $profileForm);