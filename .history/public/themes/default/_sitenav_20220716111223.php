<?php
$currentUserID	 		= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$currentUserRoleID 		= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
$currentUserEmail 		= isset($current_user->email) && ! empty($current_user->email) ? $current_user->email : '';
$marketMovers			= date("F-jS-Y");
$beta                   = $this->config->item('beta'); 
if ($beta === 0) {
    $registrationURL    = site_url('/Free/register'); 
} elseif ($beta === 1) {
    $registrationURL    = site_url('/Beta/register'); 
}
?>

<!-- main header @s -->
