<?php
    $supportRequestForm					    = trim(file_get_contents("php://input"));
    $supportRequest						    = json_decode($supportRequestForm, true);

    // GET Request Defined Variables
    $score                                  = $supportRequest['g-recaptcha-response']; 

    if ($score > RECAPTCHA_ACCEPTABLE_SPAM_SCORE) {
    $date								    = date("n/j/Y");
    $time								    = date("g:i A");
    $redirect_url                           = $supportRequest['redirect_url'];
    $user_id								= $supportRequest['user_id'];
    $name                                   = $supportRequest['name'];
    $email                                  = $supportRequest['email'];
    $topic                                  = $supportRequest['topic'];
    $subject                                = $supportRequest['subject'];
    $details                                = $supportRequest['details'];
    $level                                  = 'Normal';

    $userRequestData                        = array(
        'date'                              => $date,
        'time'                              => $hostTime,
        'user_id'                           => $user_id,
        'name'                              => $name, 
        'email'                             => $email, 
        'topic'                             => $topic, 
        'subject'                           => $subject, 
        'details'                           => $details, 
        'level'                             => $level,
    );

    return $this->db->insert('bf_support_requests', $userRequestData);
} else {
    header('Location: ' . site_url('/Customer-Support'));
    // header("Location: http://www.redirect.to.url.com/");
}
?>
