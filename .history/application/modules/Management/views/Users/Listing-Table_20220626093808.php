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
                            <td>' . $user['city'] . ', ' . $user['state'] . '</td>
                            <td>
                                <a href="' .'site_url('Management/Users/Distribute/' . $userAccount['cuID']); ?>" class="btn btn-trigger btn-icon"><em class="icon ni ni-coins"></em></a>
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