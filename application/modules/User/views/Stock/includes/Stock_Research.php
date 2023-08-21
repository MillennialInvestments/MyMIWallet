<?php
$symbol = $this->uri->segment(3);
$getMostRecentResearch = $this->diligence_model->get_most_recent_stock_research($symbol);

foreach ($getMostRecentResearch->result_array() as $info) {
    echo '
	<div class="row py-5">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h1>' . $info['topic'] . '</h1>
					<p>
						' . $info['details'] . '
					</p>
					<div class="row">
						<div class="col-2">
							<span class="badge badge-secondary">Posted ' . $info['submitted_date'] . '</span>
						</div>
						<div class="col-10">
							<div class="float-right">
								<a class="btn btn-primary btn-sm" href="' . $info['url_link'] . '">Read More..</a>
							</div> 
						</div>        
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	';
}
