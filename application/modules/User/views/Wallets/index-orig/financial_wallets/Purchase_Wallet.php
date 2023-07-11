<?php
echo '
<div class="col-md-6 col-lg-4 mt-3">
	<div class="card card-bordered dashed h-100">
		<div class="nk-wgw-add">
			<div class="nk-wgw-inner">
				<a class="' . $btnID . '" data-toggle="modal" data-target="#transactionModal">
					<div class="add-icon"><i class="icon ni ni-plus"></i></div>
					<h6 class="title">' . $elementTitle . '</h6>
				</a>
				<span class="sub-text">
					' . $elementText . '
				</span>
			</div>
		</div>
	</div>
</div>
';
?>


