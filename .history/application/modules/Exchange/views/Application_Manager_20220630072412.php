<?php
$applicationForm					= trim(file_get_contents("php://input"));
$applicationForm					= json_decode($applicationForm, true);
$cuID 								= $_SESSION['user_id'];
$this->load->library('MyMIUser');
// $this->mymiuser->user_account_info($cuID);
$userAccount	        			= $this->mymiuser->user_account_info($cuID);
// $lastAccountID                      = $this->mymiuser->last_account_id(); 
$userEmail 							= $userAccount['cuEmail'];

$stage								= $applicationForm['stage'];
if ($stage === 'Contact') {
    $status							= 'Started';
    $unix_timestamp					= time();
    $date 							= date("m/d/Y");
    $time 							= date("h:i:s A");
    $cuKYC							= $applicationForm['kyc'];
    $user_id						= $cuID;
    $user_email						= $userEmail;
    $first_name						= $applicationForm['first_name'];
    $middle_name					= $applicationForm['middle_name'];
    $last_name						= $applicationForm['last_name'];
    $name_suffix					= $applicationForm['name_suffix'];
    $phone							= $applicationForm['phone'];
    $company_name					= $applicationForm['company_name'];
    $address						= $applicationForm['address'];
    $city							= $applicationForm['city'];
    $state							= $applicationForm['state'];
    $country						= $applicationForm['country'];
    $zipcode						= $applicationForm['zipcode'];
    $listing_type   				= 'New';
    if ($cuKYC === 'No') {
        $userData					= array(
            'kyc'					=> 'Yes',
            'first_name'			=> $first_name,
            'middle_name'			=> $middle_name,
            'last_name'				=> $last_name,
            'name_suffix'			=> $name_suffix,
            'phone'					=> $phone,
            'organization'          => $company_name,
            'address'				=> $address,
            'city'					=> $city,
            'state'					=> $state,
            'country'				=> $country,
            'zipcode'				=> $zipcode,
        );
        $this->db->where('id', $user_id);
        $this->db->update('bf_users', $userData);

        $contactData					= array(
            'status'					=> $status,
            'unix_timestamp'			=> $unix_timestamp,
            'date'						=> $date,
            'time'						=> $time,
            'partne'
            'user_id'					=> $user_id,
            'user_email'				=> $user_email,
            'first_name'				=> $first_name,
            'middle_name'				=> $middle_name,
            'last_name'					=> $last_name,
            'name_suffix'				=> $name_suffix,
            'phone'						=> $phone,
            'company_name'				=> $company_name,
            'address'					=> $address,
            'city'						=> $city,
            'state'						=> $state,
            'country'					=> $country,
            'zipcode'					=> $zipcode,
            'listing_type'              => $listing_type,
        );
        return $this->db->insert('bf_exchanges_listing_request', $contactData);
    } else {
        $contactData					= array(
            'status'					=> $status,
            'unix_timestamp'			=> $unix_timestamp,
            'date'						=> $date,
            'time'						=> $time,
            'user_id'					=> $user_id,
            'user_email'				=> $user_email,
            'first_name'				=> $first_name,
            'middle_name'				=> $middle_name,
            'last_name'					=> $last_name,
            'name_suffix'				=> $name_suffix,
            'phone'						=> $phone,
            'company_name'				=> $company_name,
            'address'					=> $address,
            'city'						=> $city,
            'state'						=> $state,
            'country'					=> $country,
            'zipcode'					=> $zipcode,
            'listing_type'              => $listing_type,
        );
        return $this->db->insert('bf_exchanges_listing_request', $contactData);
    }
    
} elseif ($stage === 'Asset') {
    if ($applicationForm['redirect_url'] === 'Management/Assets') {
        $status							= 'Approved';
        $unix_timestamp					= time();
        $date 							= date("m/d/Y");
        $time 							= date("h:i:s A");
        $user_id						= $cuID;
        $user_email						= $userEmail;
        $first_name						= $applicationForm['first_name'];
        $middle_name					= $applicationForm['middle_name'];
        $last_name						= $applicationForm['last_name'];
        $name_suffix					= $applicationForm['name_suffix'];
        $phone							= $applicationForm['phone'];
        $company_name					= $applicationForm['company_name'];
        $address						= $applicationForm['address'];
        $city							= $applicationForm['city'];
        $state							= $applicationForm['state'];
        $country						= $applicationForm['country'];
        $zipcode						= $applicationForm['zipcode'];
        $listing_type   				= 'New';
        $blockchain						= $applicationForm['blockchain'];
        $this->db->from('bf_exchanges_blockchains');
        $this->db->where('id', $blockchain);
        $getBlockchain					= $this->db->get();
        foreach ($getBlockchain->result_array() as $blockchainInfo) {
            $blockchain_name			= $blockchainInfo['name'];
        }
        $coin_name						= $applicationForm['coin_name'];
        $symbol							= $applicationForm['symbol'];
        $coin_quantity					= $applicationForm['coin_quantity'];
        $purpose						= $applicationForm['purpose'];
        $description					= $applicationForm['description'];
        $assetData						= array(
            'status'					=> $status,
            'blockchain'				=> $blockchain,
            'blockchain_name'			=> $blockchain_name,
            'coin_name'					=> $coin_name,
            'symbol'					=> $symbol,
            'coin_quantity'				=> $coin_quantity,
            'purpose'					=> $purpose,
            'description'				=> $description,
            'coin_file'				    => $coin_file,
            'coin_logo'					=> $coin_logo,
        );

        $this->db->where('id', $application_id);
        return $this->db->update('bf_exchanges_assets', $assetData);
        
    } else {
        $application_id					= $applicationForm['application_id'];
        $status							= 'Pending';
        $blockchain						= $applicationForm['blockchain'];
        $this->db->from('bf_exchanges_blockchains');
        $this->db->where('id', $blockchain);
        $getBlockchain					= $this->db->get();
        foreach ($getBlockchain->result_array() as $blockchainInfo) {
            $blockchain_name			= $blockchainInfo['name'];
        }
        $coin_name						= $applicationForm['coin_name'];
        $symbol							= $applicationForm['symbol'];
        $coin_quantity					= $applicationForm['coin_quantity'];
        $purpose						= $applicationForm['purpose'];
        $description					= $applicationForm['description'];
        
        // $this->load->library('upload');
        // $config['upload_path'] 			= './assets/documents/Exchange/Assets/';
        // $config['allowed_types']		= '*';
        // $config['encrypt_name']			= false;
        // $config['overwrite']			= true;
        
        // $this->upload->initialize($config);

        // $fileUploadData                 = $this->upload->data();
        // $coin_file 						= $fileUploadData['file_name'];
        
        // $config['upload_path'] 			= './assets/images/Exchange/Asset_Logos/';
        // $config['allowed_types']		= '*';
        // $config['encrypt_name']			= false;
        // $config['overwrite']			= true;
        
        // $this->upload->initialize($config);

        // $logoUploadData                 = $this->upload->data();
        // $coin_logo 						= $logoUploadData['file_name'];

        $assetData						= array(
            'status'					=> $status,
            'blockchain'				=> $blockchain,
            'blockchain_name'			=> $blockchain_name,
            'coin_name'					=> $coin_name,
            'symbol'					=> $symbol,
            'coin_quantity'				=> $coin_quantity,
            'purpose'					=> $purpose,
            'description'				=> $description,
            'coin_file'				    => $coin_file,
            'coin_logo'					=> $coin_logo,
        );

        $this->db->where('id', $application_id);
        return $this->db->update('bf_exchanges_listing_request', $assetData);
    }
}
