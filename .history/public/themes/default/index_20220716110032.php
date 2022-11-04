<?php
// Get Page Segments
$pageURIA 				= $this->uri->segment(1);
$pageURIB 				= $this->uri->segment(2);
$pageURIC 				= $this->uri->segment(3);
?>                 
<?php echo theme_view('header'); ?>
<!-- Start of Main Container -->
	<?php echo theme_view('data_distribution'); ?>
    <?php
    echo theme_view('_sitenav');
    //~ if ($pageURIA === NULL OR $pageURIA === 'News' OR $pageURIA === 'Weekly-Performance-Report' OR $pageURIA === 'Tools' OR $pageURIA === 'Stock' OR $pageURIA === 'ETF' OR $pageURIA === 'Community') {
    //~ $this->load->view('Widgets/Ticker_Tape');
    //~ } else {
        //~ echo '<div class="pb-5 mb-5"></div>';
    //~ }
    echo '    
    ';
    echo Template::message();
    echo isset($content) ? $content : Template::content();

    echo theme_view('footer');
    echo theme_view('modals');
    ?>
