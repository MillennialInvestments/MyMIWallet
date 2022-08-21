 <?php
$this->load->library('emailer/emailer');
// $this->load->config('site_settings');
// $getCoinValue							    = $this->mymigold->get_coin_value();
$appForm							            = trim(file_get_contents("php://input"));
$appForm							            = json_decode($appForm, true);
$appData                                        = array(
    'user_id'                                   => $appForm['user_id'],
    'referrer_code'                             => $appForm['referrer_code'],
    'active'                                    => $appForm['active'],
    'signup_date'                               => $appForm['signup_date'],
    'user_type'                                 => $appForm['user_type'],
    'first_name'                                => $appForm['first_name'],
    'last_name'                                 => $appForm['last_name'],
    'email'                                     => $appForm['email'],
    'phone'                                     => $appForm['phone'],
    'address'                                   => $appForm['address'],
    'city'                                      => $appForm['city'],
    'state'                                     => $appForm['state'],
    'country'                                   => $appForm['country'],
    'zipcode'                                   => $appForm['zipcode'],
    'wallet_id'                                 => $appForm['wallet_id'],
    'paypal'                                    => $appForm['paypal'],
    'other_payment'                             => $appForm['other_payment'],
);
$this->db->insert('bf_users_referral_program', $appData);
$userData                                       = array(
    'ref_signup_date'                           => $appForm['signup_date'],
    'referrer'                                  => 'Yes',
    'referrer_code'                             => $appForm['referrer_code'],
);
$this->db->where('id', $appForm['user_id']); 
$this->db->update('bf_users', $userData);
$email		= 'admin@mymillennialinvestments.com';
$subject	= 'New Referral Affiliate Application';
$alert = array(
    'from'		=> 'referrals@mymiwallet.com',
    'to'		=> $email,
    'subject'	=> $subject,
    'message'	=> $this->load->view('Referral_Program/Emails/New_Affiliate_Application', $appData, true),
);

$this->emailer->send($alert);
?>

