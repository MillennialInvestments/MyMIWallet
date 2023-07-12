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
                    <!-- <li><a href="#"><span>Cancel</span></a></li> -->
                    <li class="active"><a href="#"><span>All</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <ul class="nk-activity">
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
    </ul>
</div><!-- .card -->