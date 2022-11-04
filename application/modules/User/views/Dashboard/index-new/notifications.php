<div class="card card-bordered h-100">
    <div class="card-inner border-bottom">
        <div class="card-title-group">
            <div class="card-title">
                <h6 class="title">Notifications</h6>
            </div>
            <div class="card-tools">
                <a href="#" class="link">View All</a>
            </div>
        </div>
    </div>
    <div class="card-inner">
        <div class="timeline">
            <h6 class="timeline-head"><?php echo date("F"); ?>, <?php echo date("Y"); ?></h6>
            <ul class="timeline-list">
                <?php
                $this->db->from('bf_announcements'); 
                $this->db->order_by('id', 'DESC');
                $this->db->where('month', date("F")); 
                $this->db->where('year', date("Y")); 
                $getAnnouncements       = $this->db->get(); 
                foreach ($getAnnouncements->result_array() as $announcement) {
                    echo '
                <li class="timeline-item">
                    <div class="timeline-status bg-primary is-outline"></div>
                    <div class="timeline-date">' . $announcement['day'] . ' ' . date("M ", strtotime($announcement['month'])) . ' <em class="icon ni ni-alarm-alt"></em></div>
                    <div class="timeline-data">
                        <h6 class="timeline-title">' . $announcement['topic'] . '</h6>
                        <div class="timeline-des">
                            <p>' . substr($announcement['details'], 0, 120) . '...</p>
                            <span class="time">' . $announcement['time'] . '</span>
                        </div>
                    </div>
                </li>
                    ';
                }
                ?>
            </ul>
        </div>
    </div>
</div><!-- .card -->