<<<<<<< HEAD
<?php 
        $this->db->from('bf_announcements'); 
        $this->db->order_by('id', 'DESC');
        $this->db->where('month', date("F")); 
        $this->db->where('year', date("Y")); 
        $this->db->order_by('id', 'DESC');
        $this->db->limit(3); 
        $getAnnouncements       = $this->db->get(); 
?>
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
            <?php 
            if (!empty($getAnnouncements->result_array())) {
                echo '
            <h6 class="timeline-head">' . date("F") . ', ' . date("Y") . '/h6>
                ';
            }
            ?>
            <ul class="timeline-list">
                <?php
                if (empty($getAnnouncements->result_array())) {
                    echo '
                    <li class="timeline-item">
                        <div class="timeline-status bg-primary is-outline"></div>
                        <div class="timeline-data text-center">
                            <h6 class="timeline-title">No Current Announcements</h6>
                            <div class="timeline-des">
                                <p></p>
                                <span class="time"></span>
                            </div>
                        </div>
                    </li>
                    ';
                } else { 
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
=======
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
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                }
                ?>
            </ul>
        </div>
    </div>
<<<<<<< HEAD
</div>
=======
</div><!-- .card -->
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
