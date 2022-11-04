<div class="nk-block">
    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered" id="supportRequestOverview">
                <thead>
                    <tr>
                        <th>Asset</th>
                        <th>Customer</th>
                        <th>Topic</th>
                        <th>Subject</th>
                        <th>More Details..</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($getApprovedAssets as $asset) {
                        echo '
                        <tr>
                            <td>' . $asset['coin_na'] . $asset['symbol'] . '</td>
                            <td>' . $asset['name'] . '</td>
                            <td>' . $asset['topic'] . '</td>
                            <td>' . $asset['subject'] . '</td>
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