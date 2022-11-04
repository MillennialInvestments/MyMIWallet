<?php
echo theme_view('custom-js/Digibyte-js');
echo theme_view('custom-js/datatables');
// echo theme_view('custom-js/Datatable_Editor');
//~ echo theme_view('custom-js/Google_Analytics');
//~ echo theme_view('custom-js/selectpicker');
//~ echo theme_view('custom-js/wonderpush');
if ($this->uri->segment(1) === 'Wallets' PR)
?>
<!-- <script>
$("[data-toggle=popover]").popover();
</script> -->
<script>
	$(document).ready(function(){
		$(this).scrollTop(0);
	});
</script>
<script>
	$( document ).ready(function() {
		$('.selectpicker').selectpicker({
		  style: 'btn-default',
		  size: 5
		});
});
</script>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
  $('collapse').collapse();
  $.fn.datepicker.defaults.autoclose = true;
  $.fn.datepicker.defaults.todayHighlight = true;
  $('.datepicker').datepicker({ 
	clearBtn: true,  
	format: "dd/mm/yyyy",
  });
})
</script>
