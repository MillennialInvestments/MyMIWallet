<div class="nk-block">
    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered" id="supportRequestOverview">
                <thead>
                    <tr>
                        <th>Asset</th>
                        <th>Creator</th>
                        <th>Asset Type</th>
                        <th>Blockchain</th>
                        <th>Quantity</th>
                        <th>More Details..</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($getActiveUsers->result_array() as $user) {
                        echo '
                        <tr>
                            <td><a href="' . site_url('Management/Users/Profile/' . $user['id']) . '">' . $user['id'] . '</a></td>
                            <td>' . $user['first_name'] . ' ' . $user['last'] . '</td>
                            <td>' . $user['listing_type'] . '</td>
                            <td>' . $user['blockchain'] . ' (' . $user['blockchain_name'] . ')</td>
                            <td>' . $user['coin_quantity'] . '</td>
                            <td></td>
                        </tr>
                        ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>