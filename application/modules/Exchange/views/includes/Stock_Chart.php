<span id="chartTitle" class="d-none"><?= $market_pair . '/' . $market;?></span>
<div class="col-12 col-md-9">
	<div class="row">
<!--
		<div class="col-12 col-md-2">
			<div class="mb-3">
				<button class="btn btn-primary" class="d-none d-md-block" id="open" style="display:hidden;"><span>Refresh</span><span class="d-block d-md-none"><em class="icon icon-check"></em></span></button>
				<button class="btn btn-danger" class="d-none d-md-block" id="close"><span>Disconnect</span><span class="d-block d-md-none"><em class="icon icon-close"></em></span></button> 
			</div>
		</div>
-->
		<div class="col-4 col-md-4 text-center">
			<?php
                echo '<strong>Market Cap: </strong>$' . $current_value;
            ?>
		</div>
		<div class="col-4 col-md-4 text-center">
			<?php
                echo '<strong>Growth: </strong>' . $total_growth . '%';
            ?>
		</div>
		<div class="col-4 col-md-4 text-center">
			<?php
                echo '<strong>Total Volume: </strong>' . $total_volume . ' ' . $description;
            ?>
		</div>
		<div class="col-9"></div>
		<div class="col">
			<div class="mb-3 d-block d-md-none">
				<button class="btn btn-primary" id="open"  style="display:hidden;"><span class="d-block d-md-none"><em class="icon icon-check"></em></span></button>
				<button class="btn btn-danger" id="close"><span class="d-block d-md-none"><em class="icon icon-close"></em></span></button> 
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div id="chart-container" style="position: relative; height:30vw">
			   <canvas id="myChart"></canvas>
			</div>
		</div>
	</div>
</div>

