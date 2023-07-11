<div class="nk-block">
    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered" id="supportRequestOverview">
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Contact</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>Zipcode</th>
                        <th>More Details..</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($getActivePartners->result_array() as $partner) {
                        if ($partner['partner'] === 1) {
                            echo '
                            <tr>
                                <td>' . $partner['organization'] . '</td>
                                <td>' . $partner['first_name'] . ' ' . $partner['last_name'] . ' ' . $partner['name_suffix'] . '</td>
                                <td>' . $partner['phone'] . '</td>
                                <td>' . $partner['email'] . '</td>
                                <td>' . $partner['address'] . '</td>
                                <td>' . $partner['city'] . '</td>
                                <td>' . $partner['state'] . '</td>
                                <td>' . $partner['country'] . '</td>
                                <td>' . $partner['zipcode'] . '</td>
                                <td>
                                </td>
                            </tr>
                            ';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>