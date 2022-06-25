<div class="card-head">
	<div class="card-title mb-0 py-3"><h5 class="title">Annoucements</h5></div>
	<div class="card-tools">
		<ul class="card-tools-nav">
		</ul>
	</div>
</div>
	<?php
        $this->db->from('bf_announcements');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(3);
        $getAnnounce = $this->db->get();
        foreach ($getAnnounce->result_array() as $announce) {
            if (empty($announce['video_link'])) {
                $announce_link 		= $announce['url_link'];
            } else {
                $announce_link		= $announce['video_link'];
            }
            echo '
<div class="tranx-list card card-bordered mt-2">
	<div class="tranx-item mb-1">
		<div class="tranx-col col-10">
			<div class="tranx-info">
				<div class="tranx-data row">
					<div class="tranx-label col-12"><a href="' . $announce_link . '">' . $announce['topic'] . ' </a><small class="text-muted ml-1">' . $announce['submitted_date'] . '</small></div>
					<div class="tranx-details col-12">' . $announce['details'] . '</div>
				</div>
			</div>
		</div>
		<div class="tranx-col col-2">
			<div class="tranx-amount">
				<div class="number"><a class="btn btn-primary" href="' . $announce_link . '">Read More</a></div>
			</div>
		</div>
	</div>
</div>
			';
        }
    ?>
