<?php 
$cuID               = $this->uri->segment(2);
$this->db->from('bf_users');
$this->db->where('id', $cuID); 
$getUserInfo        = $this->db->get(); 

?>

<div class="col-12 col-md-5 border-right pr-5 mr-5">
    <h2 class="nk-header">Account Information</h2>
    <table class="table table-borderless">
        <tbody>
            <?php
            foreach($getUserInfo->result_array() as $userInfo) {
                $email          = $userInfo['email']; 
                $first_name     = $userInfo['first_name'];
                $middle_name    = $userInfo['middle_name']; 
                $last_name      = $userInfo['last_name'];
                $name_suffix    = $userInfo['name_suffix'];
                $phone          = $userInfo['phone'];
                $address        = $userInfo['address']; 
                $city           = $userInfo['city'];
                $state          = $userInfo['state'];
                $country        = $userInfo['country'];
                $zipcode        = $userInfo['zipcode']; 
                $wallet_id      = $userInfo['wallet_id'];
                echo '
                <tr>
                    <th>Email:</th>
                    <td>' . $email . '</td>
                </tr>
                <tr>
                    <th>Name:</th>
                    <td>' . $first_name . ' ' . $last_name . ' '  . $name_suffix . '</td>
                </tr>
                <tr>
                    <th>Phone:</th>
                    <td>' . $phone . '</td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td>' . $address . '</td>
                </tr>
                <tr>
                    <th>City/State:</th>
                    <td>' . $city . ', ' . $state . ', ' . $country . ' ' . $zipcode . '</td>
                </tr>
                ';
            } 
            ?>
        </tbody>
    </table>
</div>
<div class="col-12 col-md-5">
    <h2 class="nk-header">MyMI Wallet Information</h2>
    <table class="table table-borderless">
        <tbody>
            <?php 
            foreach($getUserInfo->result_array() as $userInfo) {
                echo '
                <tr>
                    <th>Wallet Address:</th>
                    <td>' . $userInfo['wallet_id'] . '</td>
                </tr>
                <tr>
                    <th>Balance:</th>
                    <td>$0.00</td>
                </tr>
                <tr></tr>
                ';
            }
            ?>
        </tbody>
    </table>
</div>