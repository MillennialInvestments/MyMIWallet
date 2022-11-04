<!doctype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>  
<?php
//echo theme_view('preload-data');
echo theme_view('metadata-information');
echo theme_view('header-information');
echo theme_view('css-links');
echo Assets::css();
?>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
</head>
    <body class="nk-body npc-invest bg-lighter ">
        <div class="nk-app-root">
            <!-- wrap @s -->
            <div class="nk-wrap ">
