<?php if (! isset($show) || $show == true) : ?>
    <?php $todaysDateLink = date("F-jS-Y"); ?>
    <section class="extFooter cid-s0IHE6SmPb pt-0 pb-0" id="extFooter8-4">
		<div class="container" style="display:none !important;">
			<div class="row justify-content-center pt-5 pb-5">
				<h3 class="mbr-section-header mbr-bold mbr-fonts-style display-5">Links &amp; Resources</h3>
			</div>
			<div class="row justify-content-center d-none">
				<div class="col-sm-12 col-md-3 border-right"> 
					<h6>Millennial Investments</h6>
					<ul class="list-group list-group-flush">
						<li class="list-group-item">  
							<a href="<?php echo site_url('/Home'); ?>">Home</a>
						</li>
						<li class="list-group-item">
							<a href="<?php echo site_url('/News'); ?>">News</a>
						</li>
						<li class="list-group-item">
							<a href="<?php echo site_url('/Customer-Support'); ?>">Contact Us</a>
						</li>
					</ul>
				</div> 
				<div class="col-sm-12 col-md-3 border-right">
					<h6>Daily Market Movers</h6>
					<ul class="list-group list-group-flush">
						<li class="list-group-item">
							<a href="<?php echo site_url('/News/Pre-Market-Movers/' . $todaysDateLink); ?>">Pre-Market Movers</a>
						</li>
						<li class="list-group-item">
							<a href="<?php echo site_url('/News/Market-Movers/' . $todaysDateLink); ?>">Market Movers</a>
						</li>
						<li class="list-group-item">
							<a href="<?php echo site_url('/News/After-Hours-Movers/' . $todaysDateLink); ?>">After-Hour Movers</a>
						</li>
					</ul>
				</div> 
				<div class="col-sm-12 col-md-3 border-right">
					<h6>Community</h6>
					<ul class="list-group list-group-flush">
						<li class="list-group-item">
							<a href="<?php echo site_url('/Community'); ?>">Our Community</a>
						</li>
						<li class="list-group-item">
							<a href="<?php echo site_url('/Blog'); ?>">Blog</a>
						</li>
<!--
						<li class="list-group-item">
							<a href="<?php echo site_url('/Testimonials'); ?>">Testimonials</a>
						</li>
-->
					</ul>
				</div>
				<div class="col-sm-12 col-md-3">
					<h6>Resources &amp; Tools</h6>
					<ul class="list-group list-group-flush">
<!--
						<li class="list-group-item">
							<a href="<?php echo site_url('/Stock-Screener'); ?>">Stock Screener</a>
						</li>
-->
						<li class="list-group-item">
							<a href="<?php echo site_url('/Search-Stocks'); ?>">Search Stocks</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="container text-center">
            <div class="col-md-12 col-sm-12">
				 <img class="footer-image half-width" src="<?php echo base_url('assets/images/Millennial-Investments-Twitter.png'); ?>" alt="Millennial Investments - The Best in Investments">              
            </div>
            <div class="social-media col-md-12 col-sm-12">
                <ul>
                    <li>
						<a class="icon-transition" href="https://www.facebook.com/MyMillennialInvestments/">
							<span class="mbr-iconfont socicon-facebook socicon"></span>
						</a>
                    </li>
                    <li>
						<a class="icon-transition" href="https://twitter.com/MyMillennialPro">
							<span class="mbr-iconfont socicon-twitter socicon"></span>
						</a>
                    </li>
                    <li>
						<a class="icon-transition" href="https://www.linkedin.com/company/my-millennial-investments">
							<span class="mbr-iconfont socicon-linkedin socicon"></span>
						</a>
                    </li>
                    <li>
						<a class="icon-transition" href="https://www.youtube.com/channel/UCtWWy71LQpea_tHkb7fIL7A">
							<span class="mbr-iconfont socicon-youtube socicon"></span>
						</a>
                    </li>
                    <li>
						<a class="icon-transition" href="https://discord.gg/UUMexvA">
							<span class="mbr-iconfont socicon-discord socicon"></span>
						</a>
                    </li>
<!--
                    <li>
						<a class="icon-transition" href="#">
							<span class="mbr-iconfont socicon-rss socicon" style=""></span>
						</a>
                    </li>
-->
                 </ul>
            </div>
            <div class="row justify-content-center">
                <ul class="foot-menu">
					<li class="foot-menu-item mbr-fonts-style display-7">
                        <a href="<?php echo site_url('/'); ?>" class="text-warning">
                            HOME
                        </a>
                    </li>
                    <li class="foot-menu-item mbr-fonts-style display-7">
                        <a href="<?php echo site_url('/Memberships'); ?>" class="text-warning">
                            MEMBERSHIPS
                        </a>
                        <div class="rhombus"></div>
                    </li>
                    <li class="foot-menu-item mbr-fonts-style display-7">
                        <a href="<?php echo base_url('assets/documents/Policies/MyMI-2020-Privacy-Policy.pdf'); ?>" class="text-warning">
                            PRIVACY POLICY
                        </a>
                        <div class="rhombus"></div>
                    </li>
                    <li class="foot-menu-item mbr-fonts-style display-7">
                        <a href="<?php echo base_url('assets/documents/Policies/MyMI-2020-Terms-And-Conditions.pdf'); ?>" class="text-warning">
                            TERMS &amp; CONDITIONS
                        </a>
                        <div class="rhombus"></div>
                    </li>
                    <li class="foot-menu-item mbr-fonts-style display-7">
                        <a href="<?php echo site_url('/Customer-Support'); ?>" class="text-warning">
                            SUPPORT
                        </a>
                        <div class="rhombus"></div>
                    </li>    
<!--
                    <li class="foot-menu-item mbr-fonts-style display-7">
                        <a href="#" class="text-warning">
                            MY CLIENTS
                        </a>
                        <div class="rhombus"></div>
                    </li>
                    <li class="foot-menu-item mbr-fonts-style display-7">
                        <a href="#" class="text-warning">
                            MY BLOG
                        </a>
                        <div class="rhombus"></div>
                    </li>
-->
                </ul>
            </div>
			<div class="row justify-content-center">
<!--
				<div class="col-sm-2">
					<img class="footer-image full-width" src="<?php echo base_url('assets/images/Millennial-Investments-The-Best-In-Investments-Logo-Only-White-BGB.png'); ?>" alt="Millennial Investments - The Best in Investments">
				</div>
-->
				<div class="col-sm-8">
					<p
						<strong>DISCLAIMER:</strong><br>
						Results may not be typical and may vary from person to person. Making money trading stocks takes time, dedication, and hard work. There are inherent risks involved with investing in the stock market, including the loss of your investment. Past performance in the market is not indicative of future results. Any investment is at your own risk.
					</p>
				</div>
			</div>
            <div class="row justify-content-center">
				<p class="footer-text col-md-12 col-sm-12 mbr-fonts-style mbr-text display-7">
					Millennial Investments, Inc.                 
					<br>
					Powered by <a href="https://timothyburks.com" class="text-primary">TimothyBurks.com</a>
                </p>
            </div>
       </div>
	</section>
	<?php
    if ($this->agent->is_mobile()) {
        ?>
	<footer class="footer fixed-bottom bg-white">
		<div class="row justify-content-center text-center mbr-black">
			<div class="col-6 border-white">
				<a class="btn btn-default btn-sm text-black" href="<?php echo site_url('/Dashboard'); ?>">My Dashboard</a>
			</div>
			<div class="col-6">
				<a class="btn btn-default btn-sm text-black" href="<?php echo site_url('/Connect-With-Us'); ?>">Connect With Us</a>
			</div>
		</div>
	</footer>
	<?php
    }
    ?>
    <?php endif; ?>

    <?php
    echo theme_view('js-links');
    echo theme_view('custom-js');
    echo theme_view('page_views');
    echo Assets::js();
    ?>
</body>
</html>
