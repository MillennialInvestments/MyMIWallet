<?php
echo theme_view('custom-js/Digibyte-js');
echo theme_view('custom-js/datatables');
// echo theme_view('custom-js/Datatable_Editor');
//~ echo theme_view('custom-js/Google_Analytics');
//~ echo theme_view('custom-js/selectpicker');
//~ echo theme_view('custom-js/wonderpush');
if ($this->uri->segment(1) === 'Support' OR $this->uri->segment(2) === 'register') {
?>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo RECAPTCHA_SITE_KEY; ?>"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('<?php echo RECAPTCHA_SITE_KEY; ?>', {action: 'form_submission'}).then(function(token) {
            document.querySelector('.g-recaptcha-response').value = token;
        });
    });
</script>
<?php 
}
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

})
</script>
<script>
    function calculate(inputElement) {
        var input = inputElement.value;
        var resultElement = inputElement.parentNode.getElementsByClassName('calculation')[0];
        
        if(input.startsWith('=')) {
            try {
            var result = eval(input.substring(1));
            resultElement.value = result;
            } catch(e) {
            console.log(e.message);
            // Handle any potential errors from eval
            }
        }
    }
</script>
