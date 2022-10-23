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
                    foreach($getPendingAssets->result_array() as $asset) {
                        if (!empty($asset['company_name'])) {
                            $creator                = $asset['company_name'];
                        } else {
                            $creator                = $asset['first_name'] . ' ' . $asset['last_name'] . ' ' . $asset['name_suffix']; 
                        }
                        echo '
                        <tr>
                            <td><img class="icon" src="' . $asset['coin_logo'] . '"/>' . $asset['coin_name'] . ' (' . $asset['symbol'] . ')</td>
                            <td>' . $creator . '</td>
                            <td>' . $asset['listing_type'] . '</td>
                            <td>' . $asset['blockchain'] . ' (' . $asset['blockchain_name'] . ')</td>
                            <td>' . $asset['coin_quantity'] . '</td>
                            <td><a href="' . site_url('Management/' . $pageURIB . '/Application/Details/' . $asset['id']) . '"><i class="icon icon-list"></i></a></td>
                        </tr>
                        ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>