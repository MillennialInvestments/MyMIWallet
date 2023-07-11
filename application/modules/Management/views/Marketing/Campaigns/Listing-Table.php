

<div class="card card-bordered h-100" id="active-assets-overview">
    <div class="card-inner-group">
        <div class="card-inner card-inner-md">
            <div class="card-title-group">
                <div class="card-title">
                    <h6 class="title">Active Marketing Campaigns</h6>
                </div>
                <div class="card-tools me-n1">
                    <div class="row">
                        <span class="col">
                            <a class="link py-3" href="<?php echo site_url('Management/Marketing/Campaigns/Create'); ?>"><i class="icon ni ni-plus-circle"></i> <span class="pl-0" style="padding-top:3px;">Add Campaign</span></a>
                        </span>
                        <span class="col">
                            <div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger pt-3 full-width" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                        <li><a href="#"><em class="icon ni ni-setting"></em><span>Action Settings</span></a></li>
                                        <li><a href="#"><em class="icon ni ni-notify"></em><span>Push Notification</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-inner">
            <div class="nk-block">
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-bordered" id="supportRequestOverview">
                            <thead>
                                <tr>
                                    <th>Campaign</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Assigned To</th>
                                    <th>Shared?</th>
                                    <th>Shared To?</th>
                                    <th>Notes</th>
                                    <th>Escalated?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach($getActiveCampaigns->result_array() as $campaigns) {
                                    echo '
                                    <tr>
                                        <td><a href="">' . $campaigns['status'] . '</a></td>
                                        <td><a href="">' . $campaigns['name'] . '</a></td>
                                        <td><a href="">' . $campaigns['created_by'] . '</a></td>
                                        <td><a href="">' . $campaigns['assigned_to'] . '</a></td>
                                        <td><a href="">' . $campaigns['shared'] . '</a></td>
                                        <td><a href="">' . $campaigns['shared_users'] . '</a></td>
                                        <td><a href="">' . $campaigns['notes'] . '</a></td>
                                        <td><a href="">' . $campaigns['escalated'] . '</a></td>
                                    </tr>
                                    ';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- .card-inner -->
    </div><!-- .card-inner-group -->
</div><!-- .card -->