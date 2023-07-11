<table class="table" id="myReferralsDatatable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Name</th>
            <th>Email</th>
            <th>City/State</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($getTotalActiveReferrals->result_array() as $referral) {
                echo '
                <tr>
                    <td>' . $referral['id'] . '</td>
                    <td>' . $referral['referral_code'] . '</td>
                    <td>' . $referral['first_name'] . ' ' . $referral['last_name'] .'</td>
                    <td>' . $referral['email'] . '</td>
                    <td>' . $referral['city'] . ', ' . $referral['state'] . ', ' . $referral['country'] .'</td>
                </td>
                ';
            } 
        ?>
    </tbody>
</table>