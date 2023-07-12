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
	<?php echo theme_view('data_distribution', $uriSegmentInfo); ?>
	<div class="nk-app-root">
		<div class="nk-main">
			<!-- partial:partials/_sidebar.html -->
			<!-- partial:partials/_sidebar.html -->
			<div class="nk-wrap">
                <?php echo theme_view('_sitenav'); ?>
				<div class="nk-content content-wrapper mt-0 p-0">
                    <div class="pt-lg-5 mb-3">
                        <div class="row justify-content-center pt-5">
                            <div class="col-12 pr-md-0">
                                <?php
                                echo Template::message();
                                echo isset($content) ? $content : Template::content();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo theme_view('footer'); ?>
                <?php echo theme_view('modals'); ?>
            </div>
        </div>
    </div>
</body>
