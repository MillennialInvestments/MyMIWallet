<?php
// Get Page Segments
$pageURIA =	$this->uri->segment(1);
$pageURIB =	$this->uri->segment(2);
$pageURIC =	$this->uri->segment(3);
$pageURID =	$this->uri->segment(4);
$pageURIE =	$this->uri->segment(5);
$uriSegmentInfo         = array(
    'pageURIA'          => $pageURIA,
    'pageURIB'          => $pageURIB,
    'pageURIC'          => $pageURIC,
    'pageURID'          => $pageURID,
    'pageURIE'          => $pageURIE,
);
?>                 
<?php echo theme_view('header'); ?>
<body class="nk-body npc-landing bg-white intro">
    <?php echo theme_view('data_distribution'); ?>
    <div class="nk-app-root">
        <div class="nk-main">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- Start of Main Container -->
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
            ?>
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- app-root @e -->
    <?php echo theme_view('modals'); ?>
</body>
