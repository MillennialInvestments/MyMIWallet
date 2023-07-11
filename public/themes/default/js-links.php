<?php
/* Modernizr is loaded before CSS so CSS can utilize its features */
//~ echo Assets::js('modernizr-2.5.3.js');

?>
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script> -->
<script src="<?php echo base_url('assets/js/bundle.js?ver=3.0.3'); ?>"></script>
<script>(function($) {var $win = $(window),$body = $('body'),$introNav = $('.intro-navbar'),_navbar_fixed = 'navbar-fixed',$link = $('.link-to');$link.on('click', function() {var href = $(this).attr('href'),$toHash = $(href);if ($toHash.length) {$('html, body').scrollTop($toHash.offset().top - $introNav.innerHeight());return false;}});$win.on('scroll', function() {if ($win.scrollTop() > 0) {if (!$introNav.hasClass(_navbar_fixed)) {$introNav.addClass(_navbar_fixed);}} else {if ($introNav.hasClass(_navbar_fixed)) {$introNav.removeClass(_navbar_fixed);}}});})(jQuery);</script>
<!-- <script src="https://www.google.com/recaptcha/enterprise.js?render=6Ld-35olAAAAAKfXFhwLJ6RYLZuYcuVN5NLUqBTF"></script> -->
<!-- <script src="https://www.google.com/recaptcha/enterprise.js?render=6LerppslAAAAANJWKaHjV4daQsStXWL8J-j4IxFb"></script> -->
<!-- <script type="text/javascript" defer>var subscribersSiteId='f3fb5b07-28e0-4002-8862-a8b876827b56';</script>
<script type="text/javascript" src="https://cdn.subscribers.com/assets/subscribers.js" defer></script>
<script type="text/javascript" src="https://rawgithub.com/mozilla/localForage/master/dist/localforage.js" defer></script> -->
<!--
<script type="text/javascript" src="<?php //echo base_url('assets/js/Level_Two/script.js');?>"></script>
-->

<!-- Initialize Firebase -->
<!--
<script src="/__/firebase/init.js"></script>
-->
