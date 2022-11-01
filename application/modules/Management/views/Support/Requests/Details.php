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
                    <?php 
                    $this->db->from('bf_support_requests'); 
                    $this->db->where('id', $pageURIE); 
                    $getRequestInfo = $this->db->get();
                    foreach ($getRequestInfo->result_array() as $request) {
                        $this->db->from('bf_users');
                        $this->db->where('id', $request['user_id']); 
                        $getUserInfo    = $this->db->get(); 
                        // print_r($getUserInfo); 
                        foreach($getUserInfo->result_array() as $userInfo) {
                            echo '
                            <div class="col-sm-6 col-lg-4 col-xxl-3">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="team">
                                            <div class="team-options">
                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><em class="icon ni ni-focus"></em><span>Quick View</span></a></li>
                                                            <li><a href="' . site_url('Users/Profile/' . $userInfo['id']) . '"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                            <li><a href="mailto:' . $userInfo['email'] . '"><em class="icon ni ni-mail"></em><span>Send Email</span></a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="' . site_url('Users/Force-Reset/' . $userInfo['id']) . '"><em class="icon ni ni-shield-star"></em><span>Reset Pass</span></a></li>
                                                            <!--<li><a href="#"><em class="icon ni ni-shield-off"></em><span>Reset 2FA</span></a></li>-->
                                                            <li><a href="' . site_url('Users/Block/' . $userInfo['id']) . '"><em class="icon ni ni-na"></em><span>Suspend User</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="user-card user-card-s2">
                                                <div class="user-avatar lg bg-primary">
                                                    <span>' . $userInfo['first_name'][0] . $userInfo['last_name'][0] . '</span>
                                                    <div class="status dot dot-lg dot-success"></div>
                                                </div>
                                                <div class="user-info">
                                                    <h6>' . $userInfo['first_name'] . ' ' . $userInfo['last_name'] . '</h6>
                                                    <span class="sub-text">' . $userInfo['type'] . ' User</span>
                                                </div>
                                            </div>
                                            <ul class="team-info">
                                                <li><span><strong>Join Date</strong></span><span>' . $userInfo['signup_date'] . '</span></li>
                                                <li><span><strong>Contact</strong></span><span>' . $userInfo['phone'] . '</span></li>
                                                <li><span><strong>Email</strong></span><span><a href="mailto:' . $userInfo['email'] . '">' . $userInfo['email'] . '</a></span></li>
                                            </ul>
                                            <div class="team-view">
                                                <a href="' . site_url('Management/Users/Profile/' . $userInfo['id']) . '" class="btn btn-block btn-dim btn-primary text-white"><span>View Profile</span></a>
                                            </div>
                                        </div><!-- .team -->
                                    </div><!-- .card-inner -->
                                </div><!-- .card -->
                            </div><!-- .col -->
                            <div class="col-sm-6 col-lg-8 col-xxl-9">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                    }; 
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>