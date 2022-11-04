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
                            <td><img class="icon" src="' . $user['coin_logo'] . '"/>' . $user['coin_name'] . ' (' . $user['symbol'] . ')</td>
                            <td>' . $creator . '</td>
                            <td>' . $user['listing_type'] . '</td>
                            <td>' . $user['blockchain'] . ' (' . $user['blockchain_name'] . ')</td>
                            <td>' . $asset['coin_quantity'] . '</td>
                            <td><a href="' . site_url('Management/' . $pageURIB . '/Support/Requests/' . $support['id']) . '"><i class="icon icon-plus"></i></a></td>
                        </tr>
                        ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>