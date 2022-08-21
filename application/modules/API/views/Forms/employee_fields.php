<?php
    $this->db->from('bf_users');
    $this->db->order_by('display_name', 'ASC');
    $this->db->not_like('role_id', 0);
    $this->db->not_like('id', 1);
    $getEmployeeQuery = $this->db->get();
?>
	<select name="id" class="form-control display-7 white-bg" id="user-id-formbuilder-2q" required="required">
		<option value="N/A">Select-A-Team-Member</option>
		<?php
            foreach ($getEmployeeQuery->result_array() as $employeeInfo) {
                $employee_values = array(
                    $employeeInfo['id']	=> $employeeInfo['display_name'],
                );
                foreach ($employee_values as $value => $display_text) {
                    $selected = ($value == $this->input->post('id')) ? ' selected="selected"' : "";

                    echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                }
            }
        ?>
	</select>
