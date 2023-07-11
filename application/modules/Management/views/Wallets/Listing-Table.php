<div class="nk-block">
    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered" id="supportRequestOverview">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Owner</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Balance</th>
                        <th>More Details..</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($getTotalActiveWallets as $wallet) {
                        echo '
                        <tr>
                            <td><a href="' . site_url('Management/Wallets/Details/' . $wallet['id']) . '">' . $wallet['id'] . '</a></td>
                            <td>' . $wallet['wallet_type'] . '</td>
                            <td>' . $wallet['username'] . '</td>
                            <td><a href="' . site_url('Management/Users/Profile/' . $wallet['user_id']) . '" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="bottom" title="User Profile"><em class="icon ni ni-user"></em> ' . $wallet['nickname'] . '</a></td>
                            <td><a href="mailto:' . $wallet['user_email'] . '" target="_blank">' . $wallet['user_email'] . '</a></td>
                            <td>' . $wallet['amount'] . '</td>
                            <td>
                                <a href="' . site_url('Management/Users/Profile/' . $wallet['user_id']) . '" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="bottom" title="User Profile"><em class="icon ni ni-user"></em></a>
                                <a href="' . site_url('Management/Users/Assets/' . $wallet['id']) . '" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="bottom" title="User Assets"><em class="icon ni ni-coin"></em></a>
                                <a href="' . site_url('Management/Users/Distribute/' . $wallet['id']) . '" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="bottom" title="Distribute Coins"><em class="icon ni ni-coins"></em></a>
                            </td>
                        </tr>
                        ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>