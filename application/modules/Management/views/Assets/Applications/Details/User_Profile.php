<?php echo '
<div class="card card-bordered">
    <div class="card-inner">
        <div class="team">
            <div class="team-options">
                <div class="drodown">
                    <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <ul class="link-list-opt no-bdr">
                            <li><a href="' . site_url('Users/Profile/' . $userID) . '"><em class="icon ni ni-eye"></em><span>View Creator</span></a></li>
                            <li><a href="mailto:' . $userEmail . '"><em class="icon ni ni-mail"></em><span>Send Email</span></a></li>
                            <li class="divider"></li>';
                            if ($cuRole === 1) {
                                echo '
                            <li><a href="' . site_url('Management/Asset/Application/' . $appID . '/Approve') . '"><em class="icon ni ni-check"></em><span>Approve Asset</span></a></li>
                            <li><a href="' . site_url('Management/Asset/Application/' . $appID . '/Deny') . '"><em class="icon ni ni-na"></em><span>Deny Asset</span></a></li>
                                ';
                            } else {
                                echo '
                            <li><a href="' . site_url('Management/Asset/Application/' . $appID . '/Request-Approval') . '"><em class="icon ni ni-check"></em><span>Approve Asset</span></a></li>
                            <li><a href="' . site_url('Management/Asset/Application/' . $appID . '/Request-Denial') . '"><em class="icon ni ni-na"></em><span>Deny Asset</span></a></li>
                                ';
                            };
                        echo '
                        </ul>
                    </div>
                </div>
            </div>
            <div class="user-card user-card-s2">
                <div class="user-avatar lg bg-primary">
                    <span>' . $coin_logo . '</span>
                    <div class="status dot dot-lg dot-success"></div>
                </div>
                <div class="user-info">
                    <h6>' . $symbol . '-' . $blockchain . '</h6>
                    <span class="sub-text">' . $coin_name . ' User</span>
                </div>
            </div>
            <ul class="team-info">
                <li><span><strong>Submitted Date</strong></span><span>' . $coinCreationDate . ' - ' . $coinCreationTime . '</span></li>
                <li><span><strong>Amount</strong></span><span>$' . $coin_value . '</span></li>
                <li><span><strong>Coin Amount</strong></span><span>' . $coin_quantity . '</span></li>
            </ul>
            <div class="team-view d-flex">
                <a class="btn btn-primary btn-block mr-2" href="' . site_url('/Management/Assets/Application/Approve/' . $appID) . '">Approve</a>
                <div class="vr"></div>
                <a class="btn btn-danger btn-block ml-2" href="' . site_url('/Management/Assets/Application/Deny/' . $appID) . '">Deny</a>
            </div>
        </div><!-- .team -->
    </div><!-- .card-inner -->
</div><!-- .card -->
';
?>