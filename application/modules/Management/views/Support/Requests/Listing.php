
    <div class="nk-block">
        <div class="row gy-gs">
            <div class="col-lg-12 col-xl-12">
                <div class="nk-block">
                    <div class="nk-block-head-xs">
                        <div class="nk-block-head-content">
                            <h1 class="nk-block-title title"><?php echo $dashboardTitle; ?></h1>
                            <h2 class="nk-block-title subtitle"><?php echo $dashboardSubtitle; ?></h2>
                            <p id="private_key"></p>
                            <p id="address"></p>
                            <a href="<?php echo site_url('/Trade-Tracker'); ?>">Back to Dashboard</a>							
                        </div>
                    </div>
                </div>
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
                                            <td><a href="' . site_url('Management/' . $pageURIB . '/Support/Requests/' . $support['id']) . '"><i class="icon icon-details"></i></a></td>
                                        </tr>
                                        ';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>