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
<style>
@media only screen and (min-width: 1920px) {
	.nk-quick-nav {
		margin-left: 450px; 
	}
	.logo-img {
		max-height: 100%;
		width: 50%;
		margin-left: 10%;
		max-height: 100%;
	}
}
@media (min-width: 1540px) {
	.nk-sidebar {
		width: 250px !important;
	}
	.nk-sidebar .nk-sidebar-head {
		width:100%;
	}
	.nk-sidebar-head {
		justify-content: unset;
	}
}

@media only screen and (min-width: 1440px) {
	#user-profile-dropdown {
		 left: -100px !important;
	}
}
@media only screen and (min-width: 1200px) {  
	.nk-sidebar-brand {
		width: 100%;
		margin-left:0%;
		height: 100%;
	}
	.logo-img { 
		max-height: 100%; 
	}
	.nk-sidebar {
		display: block !important;
		width: 290px !important;
	}
	.nk-sidebar-brand {
		width: 100%;
		height: 100%; 
	}
	.logo-img {    
		max-height: 100% !important;
		width: 60%;
		margin-left: 5%;
	}
	#user-profile-dropdown {
		left: -120px !important;
	}	

}
@media only screen and (max-width: 991px) {
	.nk-header-tools {
		margin-left: auto;
	}
	.nk-sidebar-brand {
		width: 75% !important;
		margin-left: 10% !important;
		height: 100% !important;
	}
	.nk-sidebar-head{
		display:flex;
		align-items:center;
		justify-content:unset;
		padding:14px 24px;
		min-width:100%;
		height:65px;
		border-bottom:1px solid #e5e9f2;
	}
	.nk-sidebar{
		position:absolute;
		background:#f5f6fa;
		height:100%;
		min-height:100vh;
		top:-45px;
		left:290px;
		border-right:1px solid #e5e9f2;
		transform:translateX(-100%);
		z-index:999;
		width:290px;
		transition:transform 450ms ease,width 450ms ease
	}
	.nk-sidebar-logo {
		 width: 100%; 
	}
	.logo-img {
		width: 100%;
		height: 100%;
	}
	.nk-sidebar-logo .logo-img:not(:first-child) {
		top: 50%;
		height: 100%;
		max-height: 75%;
		width: 75%; 
	}
	#chart-container {
		max-height: 600px;
	}
}
@media only screen and (max-width: 768px) {   
	.nk-sidebar {
		width: 240px;
	}

}
@media only screen and (max-width: 375px) {
	.nk-sidebar {
		left: 240px;
	}
	.nk-header-wrap { 
		max-height: 65px !important;
		height: 100% !important; 
	}
	.nk-header-brand {
		width: 35%;
	}
	.nk-header-tools {
		margin-left: 15%;
	}
	#user-profile-dropdown {
		left: -35px !important; 
	}
	.logo-img {
		width: 100%;
		height: 100%;
	}
	.nk-menu-trigger {
		padding-left: 0px !important;
	} 	
	.nk-profile-content {
		background: transparent;
	}
	.nk-sidebar-logo .logo-img:not(:first-child) {
		height: 100%;
		width: 100%;
		margin: 0;
		max-height: 75%;
	}
	.dropdown-menu-s1 {
		margin-left: -235px !important;
	}
	#chart-container {
		height: 300px;
		margin-bottom: 1rem;
	}
}
.disabled-edt {
	border: none;
	background: none;
  }
  
.bootstrap-select{width: 100%; padding-top: 5px;}
.openSidebar {
	transform: none !important;
}
.nk-sidebar-head {
	padding: 0% !important;
}
.nk-sidebar-logo {
	width: 100% !important;
	height: 100% !important;
}
.nk-sidebar-logo .logo-img:not(:first-child) {
	top: 55%; 
}
.nk-menu-link {
	font-weight: 500;
	padding-left: 1rem;
	padding-right: 1rem;
}
.nk-profile-content {
	background: transparent;
}
select {width:100%;}

.inner .show {
	min-height: inherit !important;
	max-height: inherit !important;
}
.bootstrap-select .dropdown-menu.inner {
	margin-bottom: 0px !important;
}
.bootstrap-select .dropdown-menu.inner {
	position: relative !important;
}
.tt-input {
	display: block;
	height: calc(2.125rem + 2px);
	padding: .4375rem 1rem;
	font-size: .8125rem;
	font-weight: 400;
	line-height: 1.25rem;
	color: #3c4d62;
	background-color: #fff;
	background-clip: padding-box;
	border: 1px solid #dbdfea;
	border-radius: 4px;
	transition: border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out;
}
</style>
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
