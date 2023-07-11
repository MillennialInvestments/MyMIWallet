<?php
if ($pageURIB === 'Assets') {
    $dashboardTitle                 = 'Assets /';
    $dashboardSubtitle              = 'Support Management'; 
}
?>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-lg-12 col-xl-12">
			<div class="nk-block">
				<div class="nk-block-head-xs">
					<div class="nk-block-head-content">
						<h1 class="nk-block-title title"><?php echo $dashboardTitle; ?></h1>
                        <h2 class="nk-block-title subtitle"><?php echo $dashboardSubtitle; ?></h2>
						<p id="private_key"></p>
						<p id="address"></p>
						<a href="<?php echo site_url('/Trade-Tracker'); ?>">Back to Dashboard</a>							
					</div>
				</div>
			</div>
			<div class="nk-block">
                <div class="row">

                </div>
            </div>
        </div>
    </div>
</div>