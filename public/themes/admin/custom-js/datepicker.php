<script>
$(function() {
    $("#date").datepicker({
    
    });
  });
</script>

<script>
$(function() {
  $('input[id="date"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('MM-DD-YYYY'));
  });
});
</script>
