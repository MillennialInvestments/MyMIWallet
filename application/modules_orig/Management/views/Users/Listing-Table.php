<div class="nk-block">
    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered" id="supportRequestOverview">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Location</th>
                        <th>More Details..</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($getActiveUsers->result_array() as $user) {
                        echo '
                        <tr>
                            <td><a href="' . site_url('Management/Users/Profile/' . $user['id']) . '">' . $user['id'] . '</a></td>
                            <td>' . $user['type'] . '</td>
                            <td>' . $user['first_name'] . ' ' . $user['last_name'] . ' ' . $user['name_suffix'] . '</td>
                            <td><a href="mailto:' . $user['email'] . '" target="_blank">' . $user['email'] . '</a></td>
                            <td>' . $user['city'] . ', ' . $user['state'] . '</td>';
                            if ($pageURIB === 'Assets') {
                                echo '
                                <td>
                                    <a href="' . site_url('Management/Users/Profile/' . $user['id']) . '" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="bottom" title="User Profile"><em class="icon ni ni-user"></em></a>
                                    <a href="' . site_url('Management/Users/Assets/' . $user['id']) . '" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="bottom" title="User Assets"><em class="icon ni ni-coin"></em></a>
                                    <a href="' . site_url('Management/Users/Distribute/' . $user['id']) . '" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="bottom" title="Distribute Coins"><em class="icon ni ni-coins"></em></a>
                                </td>
                                '; 
                            } elseif ($pageURIB === 'Users') {
                                echo '
                                <td>
                                    <a href="' . site_url('Management/Users/Profile/' . $user['id']) . '" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="bottom" title="User Profile"><em class="icon ni ni-user"></em></a>
                                    <a href="' . site_url('Management/Users/Assets/' . $user['id']) . '" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="bottom" title="User Assets"><em class="icon ni ni-coin"></em></a>
                                    <a href="' . site_url('Management/Users/Distribute/' . $user['id']) . '" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="bottom" title="Distribute Coins"><em class="icon ni ni-coins"></em></a>
                                    <a class="btn btn-trigger btn-icon" href="mailto:' . $user['email'] . '" target="_blank"><em class="icon ni ni-mail"></em></a>
                                    <a href="' . site_url('Management/Users/Block/' . $user['id']) . '" class="btn btn-trigger btn-icon text-danger"><em class="icon ni ni-na"></em></a>
                                </td>
                                '; 
                            };
                        echo '
                        </tr>
                        ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>