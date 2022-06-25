<?php
$currentUserID	 		= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$currentUserRoleID 		= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
$currentUserEmail 		= isset($current_user->email) && ! empty($current_user->email) ? $current_user->email : '';
$marketMovers			= date("F-jS-Y");
$beta                   = $this->config->item('beta'); 
if ($beta === 0) {
    $registrationURL    = site_url('/Free/register'); 
} elseif ($beta === 1) {
    $registrationURL    = site_url('/Beta/register'); 
}
?>
<style>
@media (max-width: 375px) {
	.navbar.opened {
		height: 100%;
	}
	.navbar.opened>#mobile-navbar-container {
		top: -6rem;
	}
	.cid-s8gg6zVyQD .nav-dropdown .link {
		padding: 0rem 1rem !important;
	}
	.cid-s8gg6zVyQD .icons-menu {
		width: 250px;
	}
}
@media (min-width: 768px) {
	.icons-menu {width: 20rem;}
}
</style>
<section class="menu cid-s8gg6zVyQD mb-3" once="menu" id="menu1-k">
	<nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
		<div class="container-fluid" id="mobile-navbar-container">
			<div class="navbar-brand">
				<span class="navbar-logo">
					<a href="<?php echo site_url('/'); ?>">
						<img src="<?php echo base_url('assets/images/Millennial-Investments-The-Best-In-Investments-Logo-Only-White-BG.png'); ?>" alt="" title="" style="height: 3.8rem;">
					</a>
				</span>
			
			</div>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<div class="hamburger">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</div>
			</button>
            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-dropdown justify-content-center" data-app-modern-menu="true">
					<li class="nav-item">
                        <a class="nav-link link text-white display-4" href="<?php echo site_url('/'); ?>">Home</a>
                    </li>
<!--
					<li class="nav-item">
                        <a class="nav-link link text-white display-4" href="<?php echo site_url('/Memberships'); ?>">Memberships</a>
                    </li>
-->
					<li class="nav-item">
                        <a class="nav-link link text-white display-4" href="<?php echo site_url('/Invest'); ?>">MyMI Coins</a>
                    </li>
                    <li class="nav-item">
						<a class="nav-link link text-white display-4" href="<?php echo site_url('/Customer-Support'); ?>">Support</a>
					</li>
                    
					<?php
                    if ($this->session->userdata('logged_in')) {
                        echo '
						<style>
							#notLoggedInNavBtns {
								display: none;
							}
						</style>
						<li class="nav-item d-xs-block d-sm-none d-md-none d-lg-none" id="LoggedInNavBtns">
							<!--<a class="nav-link link text-white display-4" href="' . site_url('/Profile/' . $currentUserID) . '">My Profile</a>-->
						</li>
						<li class="nav-item d-xs-block d-sm-none d-md-none d-lg-none" id="LoggedInNavBtns">
							<a class="nav-link link text-white display-4" href="' . site_url('/Dashboard') . '">Dashboard</a>
							<a class="nav-link link text-white display-4" href="' . site_url('/logout') . '">Log Out</a>
						</li>
						';
                    } else {
                        echo '	
						<li class="nav-item d-xs-block d-sm-none d-md-none d-lg-none" id="notLoggedInNavBtns">
							<a class="nav-link link btn btn-white display-1" href="' . site_url('/login') . '">Login</a>
						</li>
						<li class="nav-item d-xs-block d-sm-none d-md-none d-lg-none" id="notLoggedInNavBtns">
							<a class="nav-link link btn btn-primary display-1" href="' . $registrationURL . '">SIGN UP</a>
						</li>		
						';
                    }
                    ?>
				</ul>
				
				<div class="icons-menu" style="width:20rem;">
					<a href="https://www.facebook.com/MyMillennialInvestments/" target="_blank">
						<span class="p-2 mbr-iconfont socicon-facebook"></span>
					</a>
					<a href="https://twitter.com/MyMillennialPro" target="_blank">
						<span class="p-2 mbr-iconfont socicon-twitter"></span>
					</a>
					<a href="https://www.youtube.com/channel/UCtWWy71LQpea_tHkb7fIL7A" target="_blank">
						<span class="p-2 mbr-iconfont socicon-youtube"></span>
					</a>
					<a href="https://discord.gg/UUMexvA" target="_blank">
						<span class="p-2 mbr-iconfont socicon-discord"></span>
					</a>
<!--
					<a href="#" target="_blank">
						<span class="p-2 mbr-iconfont icon54-v1-youtube-1"></span>
					</a>
-->
				</div>
				<div class="d-xs-none" id="logInContainer">
				<?php
                if ($this->session->userdata('logged_in')) {
                    echo '
					<style>
						#notLoggedInNavBtns {
							display: none;
						}
					</style>
					<div class="navbar-buttons btn-group mbr-section-btn px-3" id="LoggedInNavBtns">
						<!--<a class="btn btn-sm btn-default btn-block btn-rounded" href="' . site_url('/Profile/' . $currentUserID) . '">My Profile</a>-->
						<a class="btn btn-sm btn-primary btn-block btn-rounded" href="' . site_url('/Dashboard') . '">Dashboard</a>	
						<a class="btn btn-sm btn-default btn-block btn-rounded" href="' . site_url('/logout') . '">Log Out</a>			
					</div>
					';
                } else {
                    echo '					
					<div class="navbar-buttons btn-group mbr-section-btn px-3" id="notLoggedInNavBtns">
						<a class="btn btn-sm btn-default btn-block btn-rounded" href="' . site_url('/login') . '">LOGIN</a>
						<a class="btn btn-sm btn-primary btn-block btn-rounded" href="' . $registrationURL . '">SIGN UP</a>
					</div>
					';
                }
                ?>
				</div>
            </div>
        </div>
    </nav>
</section>



