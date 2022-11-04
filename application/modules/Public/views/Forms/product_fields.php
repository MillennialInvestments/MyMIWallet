 	<div data-for="5ft_patch" class="col-lg-12 col-sm-12 form-group">
	<div class="row">
		<div class="col-6">
			<label for="5ft_patch">5ft. Patch Cables</label>
		</div>
		<div class="col-6">
			<select name="5ft_patch" class="form-control display-7 white-bg" id="fourth_technician-formbuilder-2q"> 
				<option value="N/A">Select-Service</option>
				<?php
                    foreach ($quantities->result_array() as $row) {
                        $service_qty_values = array(
                            $row['quantity']	=> $row['quantity'],
                        );
                        foreach ($service_qty_values as $value => $display_text) {
                            $selected = ($value == $this->input->post('5ft_patch')) ? ' selected="selected"' : "";

                            echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                        }
                    }
                ?>
			</select> 
		</div> 
	</div>
</div>
<div data-for="7ft_patch" class="col-lg-12 col-sm-12 form-group">
	<div class="row">
		<div class="col-6">
			<label for="7ft_patch">7ft. Patch Cables</label>
		</div>
		<div class="col-6">
			<select name="7ft_patch" class="form-control display-7 white-bg" id="fourth_technician-formbuilder-2q"> 
				<option value="N/A">Select-Service</option>
				<?php
                    foreach ($quantities->result_array() as $row) {
                        $service_qty_values = array(
                            $row['quantity']	=> $row['quantity'],
                        );
                        foreach ($service_qty_values as $value => $display_text) {
                            $selected = ($value == $this->input->post('7ft_patch')) ? ' selected="selected"' : "";

                            echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                        }
                    }
                ?>
			</select> 
		</div> 
	</div>
</div>
<div data-for="10ft_patch" class="col-lg-12 col-sm-12 form-group">
	<div class="row">
		<div class="col-6">
			<label for="10ft_patch">10ft. Patch Cables</label>
		</div>
		<div class="col-6">
			<select name="10ft_patch" class="form-control display-7 white-bg" id="fourth_technician-formbuilder-2q"> 
				<option value="N/A">Select-Service</option>
				<?php
                    foreach ($quantities->result_array() as $row) {
                        $service_qty_values = array(
                            $row['quantity']	=> $row['quantity'],
                        );
                        foreach ($service_qty_values as $value => $display_text) {
                            $selected = ($value == $this->input->post('10ft_patch')) ? ' selected="selected"' : "";

                            echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                        }
                    }
                ?>
			</select> 
		</div> 
	</div>
</div>
<div data-for="wp_single" class="col-lg-12 col-sm-12 form-group">
	<div class="row">
		<div class="col-6">
			<label for="wp_single">Wall Plate - Single</label>
		</div>
		<div class="col-6">
			<select name="wp_single" class="form-control display-7 white-bg" id="fourth_technician-formbuilder-2q"> 
				<option value="N/A">Select-Service</option>
				<?php
                    foreach ($quantities->result_array() as $row) {
                        $service_qty_values = array(
                            $row['quantity']	=> $row['quantity'],
                        );
                        foreach ($service_qty_values as $value => $display_text) {
                            $selected = ($value == $this->input->post('wp_single')) ? ' selected="selected"' : "";

                            echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                        }
                    }
                ?>
			</select> 
		</div> 
	</div>
</div>
<div data-for="wp_double" class="col-lg-12 col-sm-12 form-group">
	<div class="row">
		<div class="col-6">
			<label for="wp_double">Wall Plate - Double</label>
		</div>
		<div class="col-6">
			<select name="wp_double" class="form-control display-7 white-bg" id="fourth_technician-formbuilder-2q"> 
				<option value="N/A">Select-Service</option>
				<?php
                    foreach ($quantities->result_array() as $row) {
                        $service_qty_values = array(
                            $row['quantity']	=> $row['quantity'],
                        );
                        foreach ($service_qty_values as $value => $display_text) {
                            $selected = ($value == $this->input->post('wp_double')) ? ' selected="selected"' : "";

                            echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                        }
                    }
                ?>
			</select> 
		</div> 
	</div>
</div>
<div data-for="wp_quad" class="col-lg-12 col-sm-12 form-group">
	<div class="row">
		<div class="col-6">
			<label for="wp_quad">Wall Plate - Quad</label>
		</div>
		<div class="col-6">
			<select name="wp_quad" class="form-control display-7 white-bg" id="fourth_technician-formbuilder-2q"> 
				<option value="N/A">Select-Service</option>
				<?php
                    foreach ($quantities->result_array() as $row) {
                        $service_qty_values = array(
                            $row['quantity']	=> $row['quantity'],
                        );
                        foreach ($service_qty_values as $value => $display_text) {
                            $selected = ($value == $this->input->post('wp_quad')) ? ' selected="selected"' : "";

                            echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                        }
                    }
                ?>
			</select> 
		</div> 
	</div>
</div>
<div data-for="keystones" class="col-lg-12 col-sm-12 form-group">
	<div class="row">
		<div class="col-6">
			<label for="keystones">Keystones</label>
		</div>
		<div class="col-6">
			<select name="keystones" class="form-control display-7 white-bg" id="fourth_technician-formbuilder-2q"> 
				<option value="N/A">Select-Amount</option>
				<?php
                    foreach ($quantities->result_array() as $row) {
                        $service_qty_values = array(
                            $row['quantity']	=> $row['quantity'],
                        );
                        foreach ($service_qty_values as $value => $display_text) {
                            $selected = ($value == $this->input->post('keystones')) ? ' selected="selected"' : "";

                            echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                        }
                    }
                ?>
			</select> 
		</div> 
	</div>
</div>
<div data-for="key_blanks" class="col-lg-12 col-sm-12 form-group">
	<div class="row">
		<div class="col-6">
			<label for="key_blanks">Keystone Blanks</label>
		</div>
		<div class="col-6">
			<select name="key_blanks" class="form-control display-7 white-bg" id="fourth_technician-formbuilder-2q"> 
				<option value="N/A">Select-Amount</option>
				<?php
                    foreach ($quantities->result_array() as $row) {
                        $service_qty_values = array(
                            $row['quantity']	=> $row['quantity'],
                        );
                        foreach ($service_qty_values as $value => $display_text) {
                            $selected = ($value == $this->input->post('key_blanks')) ? ' selected="selected"' : "";

                            echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                        }
                    }
                ?>
			</select> 
		</div> 
	</div>
</div>
<div data-for="sm_boxes" class="col-lg-12 col-sm-12 form-group">
	<div class="row">
		<div class="col-6">
			<label for="sm_boxes">Surface-Mounted Boxes</label>
		</div>
		<div class="col-6">
			<select name="sm_boxes" class="form-control display-7 white-bg" id="fourth_technician-formbuilder-2q"> 
				<option value="N/A">Select-Service</option>
				<?php
                    foreach ($quantities->result_array() as $row) {
                        $service_qty_values = array(
                            $row['quantity']	=> $row['quantity'],
                        );
                        foreach ($service_qty_values as $value => $display_text) {
                            $selected = ($value == $this->input->post('sm_boxes')) ? ' selected="selected"' : "";

                            echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                        }
                    }
                ?>
			</select> 
		</div> 
	</div>
</div>
<div data-for="raceways" class="col-lg-12 col-sm-12 form-group">
	<div class="row">
		<div class="col-6">
			<label for="raceways">Raceways</label>
		</div>
		<div class="col-6">
			<select name="raceways" class="form-control display-7 white-bg" id="fourth_technician-formbuilder-2q"> 
				<option value="N/A">Select-Service</option>
				<?php
                    foreach ($quantities->result_array() as $row) {
                        $service_qty_values = array(
                            $row['quantity']	=> $row['quantity'],
                        );
                        foreach ($service_qty_values as $value => $display_text) {
                            $selected = ($value == $this->input->post('raceways')) ? ' selected="selected"' : "";

                            echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                        }
                    }
                ?>
			</select> 
		</div> 
	</div>
</div>


