<?php
$suggestionForm			    = trim(file_get_contents("php://input"));       //
$suggestionForm			    = json_decode($suggestionForm, true);           //
$isBeta						= $this->config->item('beta');                  //
if ($isBeta === 1) {                                                        //   
    $beta					= 'Yes';                                        //
} else {
    $beta					= 'No';                                         //
}
$status						= 'Incomplete';                                 //
$unix_timestamp				= time();                                       //
$month						= date("n");                                    //
$day						= date("j");                                    //
$year						= date("Y");                                    //
$time 						= date("G:i:s");                                //
$release_type				= $suggestionForm['release_type']; 			    // 
$release_number				= $suggestionForm['release_number']; 			//
$beta					    = $suggestionForm['beta']; 			            //
$user_id					= $suggestionForm['user_id']; 			        //
$username					= $suggestionForm['username']; 			        //
$user_email					= $suggestionForm['user_email']; 			    //
$topic  					= $suggestionForm['topic']; 			        //
$details					= $suggestionForm['details']; 			        //

$suggestionData 			= array(                                        //
    'unix_timestamp'        => $unix_timestamp,                             //
    'month'                 => $month,                                      //
    'day'                   => $day,                                        //
    'year'                  => $year,                                       //
    'time'                  => $time,                                       //
    'release_type'          => $release_type,                               //
    'release_number'        => $release_number,                             //
    'beta'                  => $beta,                                       //
    'user_id'               => $user_id,                                    //
    'username'              => $username,                                   //
    'user_email'            => $user_email,                                 //
    'topic'                 => $topic,                                      //
    'details'               => $details,                                    //
);
        
return $this->db->insert('bf_users_beta_suggestions', $suggestionData);     //
