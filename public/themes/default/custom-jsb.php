
<!-- Global site tag (gtag.js) - Google Analytics -->

<?php
$pageURISegmentA = $this->uri->segment(1);
$pageURISegmentB = $this->uri->segment(2);
// Get Datatables
echo theme_view('custom-js/Datatables');
// Get Page Schemas
echo theme_view('custom-js/Schema');
// Get Paypal Buttons
if ($pageURISegmentA === 'Free-Trial' or $pageURISegmentA === 'Memberships'or $pageURISegmentA === 'Membership-Upgrade' or $pageURISegmentA === 'Membership-Downgrades') {
    echo theme_view('custom-js/Paypal');
}
//Get Investor Sentiment
if ($pageURISegmentB === 'Investor-Sentiment') {
    echo theme_view('custom-js/' . $pageURISegmentB);
}

// Analytic Tracking
echo theme_view('custom-js/Tawk-To');
echo theme_view('custom-js/Charts');
echo theme_view('custom-js/Google_Analytics');
echo theme_view('custom-js/selectpicker');
//~ echo theme_view('custom-js/Facebook_Analytics');
?>

<script>
window.onload = function() {
  $("#navbarSupportedContent").hide();
};
</script>

<!-- <script src="https://www.google.com/recaptcha/api.js?render=<?php //echo RECAPTCHA_SITE_KEY; ?>"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('<?php //echo RECAPTCHA_SITE_KEY; ?>', {action: 'form_submission'}).then(function(token) {
            document.querySelector('.g-recaptcha-response').value = token;
        });
    });
</script> -->
<?php if ($pageURISegmentA === 'Dashboard') { ?>
	
	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>

<?php
}
?>
<script type="text/javascript">
    $(document).ready(function() {
        // Get the user's timezone offset in minutes
        var timezoneOffset = new Date().getTimezoneOffset();
        
        // Send the timezone offset to the server
        $.ajax({
            url: 'YourController/setUserTimezone',
            method: 'POST',
            data: {
                timezoneOffset: timezoneOffset
            },
            success: function(response) {
                console.log('User timezone set');
            },
            error: function(error) {
                console.error('Error setting user timezone:', error);
            }
        });
    });
</script>