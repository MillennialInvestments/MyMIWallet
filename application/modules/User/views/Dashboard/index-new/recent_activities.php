<?php 
// Setup User Account Activities/Changes Listing here
?>
<div class="card card-bordered card-full">
    <div class="card-inner border-bottom">
        <div class="card-title-group">
            <div class="card-title">
                <h6 class="title">Recent Activities</h6>
            </div>
            <div class="card-tools">
                <ul class="card-tools-nav">
<<<<<<< HEAD
                    <!-- <li><a href="#"><span>Cancel</span></a></li> -->
=======
                    <li><a href="#"><span>Cancel</span></a></li>
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                    <li class="active"><a href="#"><span>All</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <ul class="nk-activity">
<<<<<<< HEAD
        <?php
            $this->db->from('bf_act_logger'); 
            $this->db->where('created_by', $cuID); 
            $this->db->not_like('type', 'Page Visit');
            $this->db->order_by('id', 'DESC');
            $this->db->limit(3); 
            $getUserActivity                = $this->db->get(); 
            if (empty($getUserActivity->result_array())) {
                echo '                
                <li class="nk-activity-item">
                    <div class="nk-activity-media user-avatar bg-success">' . $cuFirstName[0] . $cuLastName[0] . '</div>
                    <div class="nk-activity-data">
                        <div class="label">No Recent Activities</div>
                        <span class="time"></span>
                    </div>
                </li>
                ';
            } else {
                foreach($getUserActivity->result_array() as $activity) {
                    $dateStrTime            = strtotime($activity['created_on']); 
                    $dateCreated            = date("F jS, Y", $dateStrTime); 
                    echo '                
                    <li class="nk-activity-item">
                        <div class="nk-activity-media user-avatar bg-success">' . $cuFirstName[0] . $cuLastName[0] . '</div>
                        <div class="nk-activity-data">
                            <div class="label">' . $activity['comment'] . '</div>
                            <span class="time">' . $dateCreated . '</span>
                        </div>
                    </li>
                    ';
                }
            }
        ?>
=======
        <li class="nk-activity-item">
            <div class="nk-activity-media user-avatar bg-success"><img src="./images/avatar/c-sm.jpg" alt=""></div>
            <div class="nk-activity-data">
                <div class="label">Keith Jensen requested to Widthdrawl.</div>
                <span class="time">2 hours ago</span>
            </div>
        </li>
        <li class="nk-activity-item">
            <div class="nk-activity-media user-avatar bg-warning">HS</div>
            <div class="nk-activity-data">
                <div class="label">Harry Simpson placed a Order.</div>
                <span class="time">2 hours ago</span>
            </div>
        </li>
        <li class="nk-activity-item">
            <div class="nk-activity-media user-avatar bg-azure">SM</div>
            <div class="nk-activity-data">
                <div class="label">Stephanie Marshall got a huge bonus.</div>
                <span class="time">2 hours ago</span>
            </div>
        </li>
        <li class="nk-activity-item">
            <div class="nk-activity-media user-avatar bg-purple"><img src="./images/avatar/d-sm.jpg" alt=""></div>
            <div class="nk-activity-data">
                <div class="label">Nicholas Carr deposited funds.</div>
                <span class="time">2 hours ago</span>
            </div>
        </li>
        <li class="nk-activity-item">
            <div class="nk-activity-media user-avatar bg-pink">TM</div>
            <div class="nk-activity-data">
                <div class="label">Timothy Moreno placed a Order.</div>
                <span class="time">2 hours ago</span>
            </div>
        </li>
        <li class="nk-activity-item">
            <div class="nk-activity-media user-avatar bg-pink">TM</div>
            <div class="nk-activity-data">
                <div class="label">Timothy Moreno placed a Order.</div>
                <span class="time">2 hours ago</span>
            </div>
        </li>
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    </ul>
</div><!-- .card -->