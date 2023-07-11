  <?php
  $sophtronAPI              = $this->config->item('sophtron_api_key');
  ?>
  <!-- Load the Sophtron widget script -->
  <script src="<?php echo base_url('assets/js/Sophtron_Integration/js/full_example.js'); ?>"></script>
  
  <!-- Initialize the Sophtron widget -->
  <script>
    SophtronWidget.init({
      api_key: <?php echo '\'' . $sophtronAPI . '\''; ?>
    });
  </script>