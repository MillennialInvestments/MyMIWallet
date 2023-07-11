<?php 
// Setup User Account Support Listing here
$this->db->from('bf_support_requests'); 
$this->db->where('user_id', $cuID); 
$this->db->where('email', $cuEmail); // Secondary layer of account validatioin. Deactivate/Comment out if causing issues
$this->db->order_by('id', 'DESC'); 
<<<<<<< HEAD
$this->db->limit(3); 
=======
$this->db->limit(6); 
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
$getSupportRequests                 = $this->db->get(); 
?>
<div class="card card-bordered card-full">
    <div class="card-inner border-bottom">
        <div class="card-title-group">
            <div class="card-title">
                <h6 class="title">Support Tickets</h6>
            </div>
            <div class="card-tools">
                <ul class="card-tools-nav">
<<<<<<< HEAD
                    <li><a href="<?php echo site_url('Support'); ?>"><span>Need Help?</span></a></li>
=======
                    <li><a href="#"><span>Cancel</span></a></li>
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                    <li class="active"><a href="#"><span>All</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <ul class="nk-activity">
        <?php 
        if (empty($getSupportRequests->result_array())) {
            echo '
            <li class="nk-activity-item">
                <div class="nk-activity-data full-width text-center ml-0 pt-3">
                    <div class="label">
                        <h6>No Active Support Requests</h6><br>
                        <a class="btn btn-primary btn-sm" href="' . site_url('/Support') . '"><i class="icon ni ni-plus"></i> Need Support?</a>
                    </div>
                </div>
            </li>
            ';
        } else {
            foreach ($getSupportRequests->result_array() as $requests) {
                echo '            
                <li class="nk-activity-item">
                    <a href="' . site_url('Support/Requests/' . $requests['id']) . '">
                        <div class="nk-activity-data">
                            <div class="label">' . $requests['topic'] . '</div>
                            <span class="time">' . date("f d, y", strtotime($requests['date'])) . ' - ' . $requests['time'] . '</span>
                        </div>
                    </a>
                </li>
                ';
            }
        }
        ?>
    </ul>
</div><!-- .card -->