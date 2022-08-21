<?php
$walletGeneratorForm					= trim(file_get_contents("php://input"));
$walletGenerator						= json_decode($walletGeneratorForm, true);

// GET Request Defined Variables
$user_id								= $walletGenerator['user_id'];
$isBeta									= $this->config->item('beta');
if ($isBeta === 1) {
    $beta 								= 'Yes';
} else {
    $beta								= 'No';
}
$private_key							= $walletGenerator['private_key'];
$public_key								= $walletGenerator['public_key'];

$user									= array(
    'user_id'							=> $user_id,
    'private_key'						=> $private_key,
    'public_key'						=> $public_key,
);

$this->db->update('bf_users', $user);
return Template::set_message('Wallet Address Updated Successfully!', 'success');
?>

