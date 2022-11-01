<!-- Global site tag (gtag.js) - Google Analytics -->
<?php
$website_directory		= $this->config->item('website_directory');
$website_version		= $this->config->item('website_version');
//~ echo 'http://localhost/MillennialInvest/' . $website_directory . '/' . $website_version;
?>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Z4K51K6RE7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  <?php
  if (site_url() === 'http://localhost/MillennialInvest/' . $website_directory . '/' . $website_version . '/index.php') {
      echo 'gtag(\'config\', \'G-Z4K51K6RE7\',{\'debug_mode\':true});';
  } elseif (site_url() === 'http://192.168.0.3/MillennialInvest/' . $website_directory . '/' . $website_version . '/index.php') {
      echo 'gtag(\'config\', \'G-Z4K51K6RE7\',{\'debug_mode\':true});';
  } else {
      echo 'gtag(\'config\', \'G-Z4K51K6RE7\');';
  }
  ?>
</script>
