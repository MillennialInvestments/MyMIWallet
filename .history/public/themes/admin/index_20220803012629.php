<?php
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
echo theme_view('header', $uriSegmentInfo);
//~ echo theme_view('navbar');
$thisController         = $this->router->fetch_class();
$thisMethod             = $this->router->fetch_method();
$thisURL                = $this->uri->uri_string();
$this->logger
     ->user(1) //Set UserID, who created this  Action
     ->type('Page Visit') //Entry type like, Post, Page, Entry
     ->id(1) //Entry ID
     ->controller($this->router->fetch_class())
     ->method($thisURL)
     ->url($thisURL)
     ->comment($cuID . 'delete') //Token identify Action
     ->log(); //Add Database Entry
?>
<body class="nk-body npc-crypto bg-white has-sidebar"> 
	<?php echo theme_view('data_distribution', $uriSegmentInfo); ?>
	<div class="nk-app-root py-5">
		<div class="nk-main">
			<?php echo theme_view('sidebar', $uriSegmentInfo); ?>
			<!-- partial:partials/_sidebar.html -->
			<div class="nk-wrap">
				<?php echo theme_view('navbar', $uriSegmentInfo); ?>
				<div class="content-wrapper p-0">
					<div class="row justify-content-center">
						<div class="col-11 grid-margin stretch-card pt-5 mb-0">
							<div class="card" style="background-color:transparent;">
								<div class="card-body pt-0">
									<div class="row justify-content-center">
										<div class="col-12">
											<?php
                                            echo Template::message();
                                            echo isset($content) ? $content : Template::content();
                                            ?>
										</div>            
									</div>            
								</div>            
							</div>            
						</div>            
					</div>            
				</div>            
				<?php echo theme_view('footer', $uriSegmentInfo); ?>
			</div>
		</div>
	</div>
</div>
