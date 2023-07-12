<?php
// Assets::add_css(array(
//     //'bootstrap.css',
//      //'bootstrap-grid.min.css',
//      //'bootstrap-reboot.min.css',
//     //'bootstrap-responsive.css',
// ));
// if (isset($shortcut_data) && is_array($shortcut_data['shortcut_keys'])) {
//     Assets::add_js($this->load->view('ui/shortcut_keys', $shortcut_data, true), 'inline');
// }

$uriSegmentInfo         = array(
    'pageURIA'          => $pageURIA,
    'pageURIB'          => $pageURIB,
    'pageURIC'          => $pageURIC,
    'pageURID'          => $pageURID,
    'pageURIE'          => $pageURIE,
);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="ISO-8859-1">
	<?php echo theme_view('metadata-information', $uriSegmentInfo); ?>
	<!-- <title><?php
        // echo isset($toolbar_title) ? "{$toolbar_title} : " : '';
        // e($this->settings_lib->item('site.title'));
    ?></title> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="robots" content="noindex" />
	<meta http-equiv="cache-control" content="no-cache">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.plaid.com/link/v2/stable/link-initialize.js" async defer></script>    
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3"></script>

    <style>
        .grecaptcha-badge{visibility: hidden}
    </style>
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo RECAPTCHA_SITE_KEY; ?>"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('<?php echo RECAPTCHA_SITE_KEY; ?>', {action: 'form_submission'}).then(function(token) {
                document.querySelector('.g-recaptcha-response').value = token;
            });
        });
    </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2FS4BNS0SL"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-2FS4BNS0SL');
    </script>
    <?php
    /* Modernizr is loaded before CSS so CSS can utilize its features */
    ?>
	<?php //echo Assets::css(null, true); ?>
	<?php
        echo theme_view('css-links', $uriSegmentInfo);
    ?>
	
	<link rel="shortcut icon" href="<?php echo base_url('favicon.ico'); ?>" type="image/x-icon">
</head>
<body class="desktop">
	
