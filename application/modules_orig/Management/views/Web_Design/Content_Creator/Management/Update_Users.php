<?php 
$this->db->from('bf_users'); 
// $this->db->where('activate_hash =', NULL);
$this->db->where('active', 1); 
$this->db->where('banned', 0); 
// $this->db->where('cd_id', NULL); 
$this->db->where('force_password_reset', 0); 
$this->db->where('last_login !=', '0000-00-00 00:00:00');
// $this->db->like('email', "99@gm"); 
// $this->db->like('id', "443"); 
// $this->db->like('email', "vi"); 
$getAllUsers                                    = $this->db->get();
foreach ($getAllUsers->result_array() as $userInfo) {
    
    // if ($userInfo['cd_id'] === NULL) {
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, 'https://api.codat.io/companies');
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

    //     $headers = array();
    //     $headers[] = 'Accept: application/json';
    //     $headers[] = 'Authorization: Basic WHRsMnBzZEpRRVU2MU5LS1Z5MnltbWtWMjlSVTk4R3pyUlF5cmJGeQ==';
    //     $headers[] = 'Content-Type: application/json';
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    //     $result = curl_exec($ch);
    //     if (curl_errno($ch)) {
    //         echo 'Error:' . curl_error($ch);
    //     }
    //     curl_close($ch);

    //     $result = json_decode($result, true);
    //     print_r($result); 
    //     echo '<br><br>';
    // }
}
?>
<div class="nk-block">
    <div class="row justify-content-center">
        <div class="col-12">
            <h3 class="title">Users to Ban</h3>
            <table class="table table-default contentCreator">
                <thead>
                    <tr>
                        <th>User Email</th>
                        <th>Active Status</th>
                        <th>Banned Status</th>
                        <th>Reset Status</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                foreach ($getAllUsers->result_array() as $userInfo) {
                    if ($userInfo['cd_id'] === NULL) {
                        // $ch = curl_init();
                        // curl_setopt($ch, CURLOPT_URL, 'https://api.codat.io/companies');
                        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        // curl_setopt($ch, CURLOPT_POST, 1);
                        // curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"name\": " . $userInfo['email'] . ",\n}");

                        // $headers = array();
                        // $headers[] = 'Accept: application/json';
                        // $headers[] = 'Authorization: Basic WHRsMnBzZEpRRVU2MU5LS1Z5MnltbWtWMjlSVTk4R3pyUlF5cmJGeQ==';
                        // $headers[] = 'Content-Type: application/json';
                        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                        // $result = curl_exec($ch);
                        // if (curl_errno($ch)) {
                        //     echo 'Error:' . curl_error($ch);
                        // }
                        // curl_close($ch);

                        // $result = json_decode($result, true);
                        // print_r($result); 
                        // echo '<br><br>';
                    } else {

                    }
                    $userUpdate                             = array(
                        // 'banned'                            => '0',
                        // 'ban_message'                       => NULL, 
                        //
                        // 'banned'                            => '1',
                        // 'ban_message'                       => 'Suspected Spam. Contact support@mymiwallet.com or visit ' . site_url('/Customer-Support'), 
                        // 'force_password_reset'              => '1',
                    );
                    // $this->db->where('id', $userInfo['id']);
                    // $this->db->update('bf_users', $userUpdate);
                    echo '
                    <tr>
                        <td>' . $userInfo['email'] . '</td>
                        <td>' . $userInfo['active'] . '</td>
                        <td>' . $userInfo['banned'] . '</td>
                        <td>' . $userInfo['force_password_reset'] . '</td>
                    </tr>
                    ';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="nk-block">
    <div class="row justify-content-center">
        <div class="col-12">
            <h3 class="title">Banned Users</h3>
            <table class="table table-default contentCreator">
                <thead>
                    <tr>
                        <th>User Email</th>
                        <th>Active Status</th>
                        <th>Banned Status</th>
                        <th>Reset Status</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                $this->db->from('bf_users'); 
                // $this->db->where('activate_hash =', NULL);
                $this->db->where('banned', 1);
                // $this->db->like('email', "99@gm"); 
                // $this->db->like('email', "vi"); 
                $getAllUsers                                = $this->db->get();
                foreach ($getAllUsers->result_array() as $userInfo) {
                    $userUpdate                             = array(
                        'banned'                            => '1',
                        'ban_message'                       => 'Suspected Spam. Contact support@mymiwallet.com or visit ' . site_url('/Customer-Support'), 
                    );
                    $this->db->where('id', $userInfo['id']);
                    $this->db->update('bf_users', $userUpdate);
                    echo '
                    <tr>
                        <td>' . $userInfo['email'] . '</td>
                        <td>' . $userInfo['active'] . '</td>
                        <td>' . $userInfo['banned'] . '</td>
                        <td>' . $userInfo['force_password_reset'] . '</td>
                    </tr>
                    ';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>