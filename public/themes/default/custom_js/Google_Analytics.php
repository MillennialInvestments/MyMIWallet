<!-- Global site tag (gtag.js) - Google Analytics -->
<?php
$website_directory		= $this->config->item('website_directory');
$website_version		= $this->config->item('website_version');
//~ echo 'http://localhost/MillennialInvest/' . $website_directory . '/' . $website_version;
?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-2FS4BNS0SL"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-2FS4BNS0SL');
</script>