<!doctype html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>  
<?php
//echo theme_view('preload-data');
echo theme_view('metadata-information');
echo theme_view('header-information');
echo theme_view('css-links');
echo Assets::css();
<<<<<<< HEAD
if ($this->uri->segment(2) === 'register') {
    echo '<script src="https://www.google.com/recaptcha/api.js?render=' . $this->config->item('recaptcha_site_key') . '"></script>'; 
}
?>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
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

=======
?>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
</head>
