<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" defer></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.11.0/b-2.0.0/sl-1.3.3/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/MillennialInvestments/v6/dist/admin/js/misc.js"></script>  
<script src="<?php echo base_url('assets/js/bundle.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/scripts.js?ver=3.0.2'); ?>"></script>
<script src="<?php echo base_url('assets/js/charts/gd-default.js?ver=3.0.2'); ?>"></script> 
<script src="https://cdn.jsdelivr.net/gh/MillennialInvestments/v6/dist/js/bootstrap-select.min.js" defer></script>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>  
<!-- <script type="text/javascript" src="<?php //echo base_url('assets/js/datatables/dataTables.editor.min.js');?>"></script
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>ipt> -->
<!--
<script type="text/javascript" defer>var subscribersSiteId='a64db8cf-6372-4bea-bcb2-71af343eb816';</script>
<script type="text/javascript" src="https://cdn.subscribers.com/assets/subscribers.js" defer></script>  
-->
<?php
if ($this->uri->segment(1) === 'Trade-Tracker') {
    echo '
		<script type="text/javascript" src="' . base_url('assets/js/Trade_Tracker/script.js') . '" async defer></script>
	';
}
if ($this->uri->segment(1) === 'Exchange' and $this->uri->segment(2) === 'Market') {
    echo '
		<script src="' . base_url('assets/js/Level_Two/script.js') . '" async defer></script>
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	';
}
if ($this->uri->segment(2) === 'register' OR $this->uri->segment(1) === 'Customer-Support' OR $this->uri->segment(1) ==)
?>
