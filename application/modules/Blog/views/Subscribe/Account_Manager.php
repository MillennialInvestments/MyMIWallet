<?php
$this->load->helper('date');
$orderForm								                = trim(file_get_contents("php://input"));
$orderForm								                = json_decode($orderForm, true);

// GET Request Defined Variables
$status									                = 1;
$beta									                = $orderForm['beta'];
$date									                = $orderForm['date'];
$hostTime								                = $orderForm['hostTime'];
$time									                = $orderForm['time'];
$category                                               = $orderForm['category'];
$subject                                                = $orderForm['subject'];
$topic                                                  = $orderForm['topic'];
$user_id									            = $orderForm['user_id'];
$user_ip									            = $orderForm['user_ip'];
$user_email									            = $orderForm['email'];

// Prep & Create Array to Send To Database
$accountData                                            = array(
    'status'                                            => 1,
    'beta'                                              => $beta,
    'date'                                              => $date,
    'hostTime'                                          => $hostTime,
    'time'                                              => $time,
    'category'                                          => $category,
    'subject'                                           => $subject,
    'topic'                                             => $topic,
    'user_id'                                           => $user_id,
    'user_ip'                                           => $user_ip,
    'user_email'                                        => $user_email,
); 

// Send $accountData Array to Database
$insertResult                                           = $this->db->insert('bf_users_email_subscriptions', $accountData);

// If data was inserted into the database, send an email to the team
if ($insertResult) {

    $this->email->message($message);

    $alert = array(
        'from'		=> 'no-reply@mymiwallet.com',
        'to'		=> 'team@mymiwallet.com',
        'subject'	=> 'New Mailing List Subscription | MyMI Wallet',
        'message'	=> $message,
    );

    $this->emailer->send($alert);
     // Send the email
     if ($this->email->send()) {
        Template::set_message('Email sent successfully', 'success');
    } else {
        Template::set_message('Email sending failed', 'error');
    }
}
?>