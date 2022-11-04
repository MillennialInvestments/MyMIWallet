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
        echo isset($toolbar_title) ? "{$toolbar_title} : " : '';
        e($this->settings_lib->item('site.title'));
    ?></title> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex" />
	<meta http-equiv="cache-control" content="no-cache">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
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
	
