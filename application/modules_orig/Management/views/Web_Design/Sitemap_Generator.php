<div class="row">
	<div class="col-sm-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Sitemap Generator</h5>
				<p class="card-description">Sitemap Generator Information for All Webpages</p>
				
					<?php
                    $this->db->from('bf_marketing_page_seo');
                    $getPageInfo = $this->db->get();
                    //~ foreach ($getPageInfo->result_array() as $pageInfo) {
                        //~ header('Content-Type: application/xml');
                        //~ $pageLink = $pageInfo['page_url'];
                        //~ $output '<url><loc>' . $pageLink . '</loc></url>';
                        //~ print_r($output);
                    //~ }
                    foreach ($getPageInfo->result_array() as $pageInfo) {
                        $pageLink = $pageInfo['page_url'];
                        echo $pageLink;
                    }
                    ?>
			</div>
		</div>
	</div>
</div>
