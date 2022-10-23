<?php echo '
<div class="card">
    <div class="card-inner">
        <div class="team">
            <ul class="team-info">
                <li class="pb-3"><strong>Contact Information</strong></li>
                <li><span><strong>Join Date</strong></span><span>' . $userSignupDate . '</span></li>
                <li><span><strong>Name</strong></span><span>' . $userFirstName . ' ' . $userMiddleName . ' ' . $userLastName . ' ' . $userNameSuffix . '</span></li>
                <li><span><strong>Email</strong></span><span><a href="mailto:' . $userEmail . '">' . $userEmail . '</a></span></li>
                <li><span><strong>Contact</strong></span><span><a href="tel:+' . $userPhone . '">' . $userPhone . '</a></span></li>
                <li><span><strong>Address</strong></span><span>' . $userAddress . '</span></li>
                <li><span><strong>City/State</strong></span><span>' . $userCity . ', ' . $userState . '</span></li>
                <li class="py-3"><strong>Additional Information</strong></li>
                <li><span><strong>KYC?</strong></span><span>' . $userKYC . '</span></li>
                <li><span><strong>Partner?</strong></span><span>' . $userPartner . '</span></li>
                <li><span><strong>Referrer?</strong></span><span>' . $userPartner . '</span></li>
            </ul>
        </div><!-- .team -->
    </div><!-- .card-inner -->
</div><!-- .card -->
';
?>