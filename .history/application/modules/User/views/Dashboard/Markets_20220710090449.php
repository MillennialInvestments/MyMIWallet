<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-lg-12 col-xl-12">
			<div class="nk-block">
				<div class="nk-block-head-xs">
					<div class="nk-block-head-content">
						<h1 class="nk-block-title title">Web Development - Test Page</h1>
						<p id="private_key"></p>
						<p id="address"></p>
						<a href="<?php echo site_url('/Trade-Tracker'); ?>">Test Page Environment</a>							
					</div>
				</div>
			</div>
			<div class="nk-block">
				<?php
                //$this->load->view('Management/Web_Design/Test_Page/data-distribution', $testInfo);
                // $this->load->view('Management/Web_Design/Test_Page/trade_tracker', $testInfo);
                ?>
			</div>
			<div class="nk-block">
                <?php print_r($_SESSION['allSessionData']); ?>
			</div>     
		</div>
	</div>
</div>