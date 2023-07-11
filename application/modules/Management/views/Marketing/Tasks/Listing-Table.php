<div class="card card-bordered h-100" id="active-assets-overview">
    <div class="card-inner-group">
        <div class="card-inner card-inner-md">
            <div class="card-title-group">
                <div class="card-title">
                    <h6 class="title">Active Marketing Tasks</h6>
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
                                    <th>Task</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach($getTasksByDepartment->result_array() as $tasks) {
                                    echo '
                                    <tr>
                                        <td><a href="' . site_url('/Management/Marketing/Tasks/Details/' . $tasks['id']) . '">' . $tasks['title'] . '</a></td>
                                        <td>' . $tasks['status'] . '</td>
                                        <td>' . $tasks['task'] . '</td>
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