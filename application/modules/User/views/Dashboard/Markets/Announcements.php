<div class="card-head">
	<div class="card-title mb-0 py-3"><h5 class="title">Financial News & Updates</h5></div>
	<div class="card-tools">
		<ul class="card-tools-nav">
		</ul>
	</div>
</div>
<div class="tranx-list card card-bordered mt-2">
	<div class="tranx-item mb-1">
		<div class="tranx-col col-12">
			<div class="tranx-info">
				<div class="tranx-data row">
					<div class="tranx-details col-12 full-width text-center" style="display:block;">
                        <?php 
                        // ***** Create Custom News API for Future Use Here *****
                        if ($marketType === 'US-Markets') {
                            $this->load->view('User/Dashboard/Markets/US_Market_News'); 
                        } elseif ($marketType === 'US-Additional-Markets') {
                            $this->load->view('User/Dashboard/Markets/US_Market_News'); 
                        } elseif ($marketType === 'International-Markets') {
                            $this->load->view('User/Dashboard/Markets/US_Market_News'); 
                        } elseif ($marketType === 'Crypto-Markets') {
                            $this->load->view('User/Dashboard/Markets/Crypto_Market_News'); 
                        } elseif ($marketType === 'MyMI-Markets') {
                            $this->load->view('User/Dashboard/Markets/US_Market_News'); 
                        }
                        ?>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
	<?php
//         $this->db->from('bf_announcements');
//         $this->db->order_by('id', 'DESC');
//         $this->db->limit(2);
//         $getAnnounce = $this->db->get();
//         foreach ($getAnnounce->result_array() as $announce) {
//             if (empty($announce['video_link'])) {
//                 $announce_link 		= $announce['url_link'];
//             } else {
//                 $announce_link		= $announce['video_link'];
//             }
//             echo '
// <div class="tranx-list card card-bordered mt-2">
// 	<div class="tranx-item mb-1">
// 		<div class="tranx-col col-10">
// 			<div class="tranx-info">
// 				<div class="tranx-data row">
// 					<div class="tranx-label col-12"><a href="' . $announce_link . '">' . $announce['topic'] . ' </a><small class="text-muted ml-1">' . $announce['submitted_date'] . '</small></div>
// 					<div class="tranx-details col-12">' . $announce['details'] . '</div>
// 				</div>
// 			</div>
// 		</div>
// 		<div class="tranx-col col-2">
// 			<div class="tranx-amount">
// 				<div class="number"><a class="btn btn-primary" href="' . $announce_link . '">Read More</a></div>
// 			</div>
// 		</div>
// 	</div>
// </div>
// 			';
//         }
    ?>
