<?php
$cuUserID 						= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$this->db->from('bf_support_requests');
$this->db->where('user_id', $cuUserID);
$this->db->where('res_id', null);
$getRequests				= $this->db->get();
?>     
<?php
if ($getRequests !== false) {
    ?>
<section class="content04 cid-s0IVv1oGAS" id="content04-8">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12">
                <h2 class="mbr-section-title pb-3 mbr-bold pb-3 mbr-fonts-style display-5">Open Services Requests</h2>
            </div>
            <div class="mbr-black col-12 col-md-12 col-lg-12">
				<table class="table table-default dataTable">
					<thead>
						<tr>
							<th>Ticket #</th>
							<th>Date</th>
							<th>Details</th>
						</tr>
					</thead>
					<tbody>
						<?php
                        foreach ($getRequests->result_array() as $reqInfo) {
                            echo '
						<tr>
							<td>' . $reqInfo['id'] . '</td>
							<td>' . $reqInfo['date'] . '</td>
							<td><a type="button" class="btn btn-primary btn-sm btn-rounded text-center" href="' . site_url('/Customer-Support/Responses/' . $userInfo['id']) . '">View</a></td>
						</tr>
						';
                        } ?>
					</tbody>
				</table>
            </div>
        </div>
    </div>
</section>
<?php
} else {
                            return;
                        }
?>
