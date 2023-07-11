<?php
?>
<div class="nk-block">
	<div class="nk-block-head">
		<?php echo theme_view('navigation_breadcrumbs'); ?>
		<div class="nk-block-between-md g-4">
			<div class="nk-block-head-content">
                <?php 
                if (!empty($this->uri->segment(2))) {
                    if ($this->uri->segment(2) === 'Credit') {
                        echo '
                <h2 class="nk-block-title fw-bold">My Credit</h2>
                <!-- <h2 class="nk-block-title fw-bold">My Wallets <small class="fw-light">(Trading Accounts)</small></h2> -->
                <div class="nk-block-des pb-3"><p>Analyze &amp; Manage Your Financial Credit All In One Place!</p></div>
                        ';
                    } elseif ($this->uri->segment(2) === 'Debt') {
                        echo '
                <h2 class="nk-block-title fw-bold">My Debt</h2>
                <!-- <h2 class="nk-block-title fw-bold">My Wallets <small class="fw-light">(Trading Accounts)</small></h2> -->
                <div class="nk-block-des pb-3"><p>Analyze &amp; Manage Your Financial Debt All In One Place!</p></div>
                        ';
                    } else {
                        echo '
                <h2 class="nk-block-title fw-bold">My Wallets</h2>
                <!-- <h2 class="nk-block-title fw-bold">My Wallets <small class="fw-light">(Trading Accounts)</small></h2> -->
                <div class="nk-block-des pb-3"><p>View Your Financial Growth All In One Place!</p></div>
                        ';
                    }
                    echo '<a class="btn btn-primary text-white" href="' . site_url('/Wallets') . '">View All Wallets</a>';
                } else {
                    echo '
                <h2 class="nk-block-title fw-bold">My Wallets</h2>
                <!-- <h2 class="nk-block-title fw-bold">My Wallets <small class="fw-light">(Trading Accounts)</small></h2> -->
                <div class="nk-block-des pb-3"><p>View Your Financial Growth All In One Place!</p></div>
                    ';
                }
                ?>
			</div>
			<?php //$this->load->view('User/Wallets/index/header-tools');?>
		</div>
	</div>
</div>
