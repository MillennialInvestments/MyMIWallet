<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Page SEO Overview</h4>
				<p class="card-subtitle">Information Overview of Current Page SEO Configurations</p>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-hover" id="dashboardDatatable">
							<thead>
								<tr>
									<th>Page Name</th>
									<th>Page Title</th>
									<th>Page URL</th>
								</tr>
							</thead>
							<tbody>
								<?php
                                $this->db->from('bf_page_seo');
                                $seoQuery = $this->db->get();
                                
                                foreach ($seoQuery->result_array() as $seoInfo) {
                                    echo '
								<tr>
									<td class="textAreaConvert">' . $seoInfo['page_name'] . '</td>
									<td class="textAreaConvert">' . $seoInfo['page_title'] . '</td>
									<td class="textAreaConvert">' . $seoInfo['page_url'] . '</td>
								</tr>	
									';
                                }
                                ?>
							</tbody>
						</table>
					</div>
				</div>				
			</div>
		</div>
	</div>
</div>		
