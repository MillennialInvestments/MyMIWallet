
<div class="nk-block-head nk-block-head-lg">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Account Activity</h4>
            <div class="nk-block-des">
                <p>Here is your last 20 login activities log. <span class="text-soft"><em class="icon ni ni-info"></em></span></p>
            </div>
        </div>
        <div class="nk-block-head-content align-self-start d-lg-none">
            <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
        </div>
    </div>
</div><!-- .nk-block-head -->
<div class="nk-block card card-bordered">
    <table class="table table-ulogs">
        <thead class="table-light">
            <tr>
                <th class="tb-col-ip"><span class="overline-title">Date</span></th>
                <th class="tb-col-os"><span class="overline-title">Activity</span></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $this->db->from('bf_act_logger'); 
            $this->db->where('created_by', $cuID); 
            $this->db->order_by('id', 'DESC'); 
            $this->db->limit(20); 
            $getUserActivities               = $this->db->get();
            // print_r($getUserActivities->result_array()); 
            foreach ($getUserActivities->result_array() as $userActivity) {
                echo '
            <tr>
                <td class="tb-col-ip"><span class="sub-text">' . $userActivity['created_on'] . '</span></td>
                <td class="tb-col-os">' . $userActivity['comment'] . '</td>
            </tr>
                ';
            }
            ?>
        </tbody>
    </table>
</div><!-- .nk-block-head -->