<?php
$pageURIA	= $this->uri->segment(1);
$pageURIB	= $this->uri->segment(2);
$pageURIC	= $this->uri->segment(3);
$pageURID	= $this->uri->segment(4);
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">  
<link rel="stylesheet" href="<?php echo base_url('assets/css/website.css'); ?>">    
<link rel="stylesheet" href="<?php echo base_url('assets/css/dashlink.css'); ?>">    
<?php
if ($pageURIA === 'Trade-Tracker') {
    echo '<link rel="stylesheet" href="' . base_url('assets/css/Trade_Tracker/style.css') . '">';
}
?>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">  -->
<!-- 
<link rel="stylesheet" href="<?php //echo base_url('assets/css/vendor.bundle.base.css'); ?>">   
<link rel="stylesheet" href="<?php //echo base_url('assets/css/daterangepicker.css'); ?>">   
<link rel="stylesheet" href="<?php //echo base_url('assets/css/chartist.min.css'); ?>">   
<link rel="stylesheet" href="<?php //echo base_url('assets/css/style.css'); ?>"> -->    
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.11.0/b-2.0.0/sl-1.3.3/datatables.min.css"/> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url('assets/css/datatables/editor.bootstrap4.min.css');?>">  -->
<!--
<link rel="stylesheet" href="<?php //echo base_url('assets/css/website.css'); ?>"> 
-->
<!--
<link rel="stylesheet" href="<?php //echo base_url('assets/css/dashlink.css'); ?>"> 
-->
<!-- <link rel="stylesheet" href="<?php //echo base_url('assets/css/dashlite.css?ver=3.0.2'); ?>">
<link id="skin-default" rel="stylesheet" href="<?php //echo base_url('assets/css/theme.css?ver=3.0.2'); ?>"> -->
