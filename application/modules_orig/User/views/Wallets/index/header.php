<div class="nk-block">
	<div class="nk-block-head">
		<?php echo theme_view('navigation_breadcrumbs'); ?>
		<div class="nk-block-between-md g-4">
			<div class="nk-block-head-content">
				<h2 class="nk-block-title fw-bold">My Wallets</h2>
				<!-- <h2 class="nk-block-title fw-bold">My Wallets <small class="fw-light">(Trading Accounts)</small></h2> -->
				<div class="nk-block-des"><p>View Your Financial Growth All In One Place!</p></div>
                <?php 
                if (!empty($this->uri->segment(2))) {
                    echo '<a class="btn btn-primary" `href="' . site_url('/Wallets') . '">View All Wallets</a>';
                }
                ?>
			</div>
			<?php //$this->load->view('User/Wallets/index/header-tools');?>
		</div>
	</div>
</div>
