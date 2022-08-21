<?php echo '
<div class="card">
    <div class="card-inner">
        <div class="team">
            <div class="team-options">
                <div class="drodown">
                    <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <ul class="link-list-opt no-bdr">
                            <li><a href="#"><em class="icon ni ni-focus"></em><span>Quick View</span></a></li>
                            <li><a href="' . site_url('Users/Profile/' . $userID) . '"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                            <li><a href="mailto:' . $userEmail . '"><em class="icon ni ni-mail"></em><span>Send Email</span></a></li>
                            <li class="divider"></li>
                            <li><a href="' . site_url('Users/Force-Reset/' . $userID) . '"><em class="icon ni ni-shield-star"></em><span>Reset Pass</span></a></li>
                            <!--<li><a href="#"><em class="icon ni ni-shield-off"></em><span>Reset 2FA</span></a></li>-->
                            <li><a href="' . site_url('Users/Block/' . $userID) . '"><em class="icon ni ni-na"></em><span>Suspend User</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="team-info">
                <li class="pb-3"><strong>Referral Information</strong></li>
                <li><span><strong># of Referrals</strong></span><span>**COMING SOON**</span></li>
                <li><span><strong>Active Referrals</strong></span><span>**COMING SOON**</span></li>
                <li><span><strong>Referral Lifespan</strong></span><span>**COMING SOON**</span></li>
                <li><span><strong>Referral Revenue</strong></span><span>**COMING SOON**</span></li>
                <li><span><strong>Additional Referrals</strong></span><span>**COMING SOON**</span></li>
                <li><span><strong>Add. Referral Revenue</strong></span><span>**COMING SOON**</span></li>
            </ul>
        </div><!-- .team -->
    </div><!-- .card-inner -->
</div><!-- .card -->
';
?>