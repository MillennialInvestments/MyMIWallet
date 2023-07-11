<div class="nk-block">
    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered" id="supportRequestOverview">
                <thead>
                    <tr>
                        <th>Severity</th>
                        <th>Customer</th>
                        <th>Topic</th>
                        <th>Subject</th>
                        <th>More Details..</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($getSupportRequests as $support) {
                        echo '
                        <tr>
                            <td>' . $support['level'] . '</td>
                            <td>' . $support['name'] . '</td>
                            <td>' . $support['topic'] . '</td>
                            <td>' . $support['subject'] . '</td>
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