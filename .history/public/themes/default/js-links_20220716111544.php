<?php
/* Modernizr is loaded before CSS so CSS can utilize its features */
//~ echo Assets::js('modernizr-2.5.3.js');
?>
<script src="<?php echo /assets/js/bundle.js?ver=3.0.3"></script><script>(function($) {var $win = $(window),$body = $('body'),$introNav = $('.intro-navbar'),_navbar_fixed = 'navbar-fixed',$link = $('.link-to');$link.on('click', function() {var href = $(this).attr('href'),$toHash = $(href);if ($toHash.length) {$('html, body').scrollTop($toHash.offset().top - $introNav.innerHeight());return false;}});$win.on('scroll', function() {if ($win.scrollTop() > 0) {if (!$introNav.hasClass(_navbar_fixed)) {$introNav.addClass(_navbar_fixed);}} else {if ($introNav.hasClass(_navbar_fixed)) {$introNav.removeClass(_navbar_fixed);}}});})(jQuery);</script>
<script type="text/javascript" defer>var subscribersSiteId='f3fb5b07-28e0-4002-8862-a8b876827b56';</script>
<script type="text/javascript" src="https://cdn.subscribers.com/assets/subscribers.js" defer></script>
<script type="text/javascript" src="https://rawgithub.com/mozilla/localForage/master/dist/localforage.js" defer></script>
<!--
<script type="text/javascript" src="<?php //echo base_url('assets/js/Level_Two/script.js');?>"></script>
-->

<!-- Initialize Firebase -->
<!--
<script src="/__/firebase/init.js"></script>
-->
