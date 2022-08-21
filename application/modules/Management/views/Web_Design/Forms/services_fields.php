<div data-for="100ft" class="col-lg-12 col-sm-12 form-group">
	<div class="row">
		<div class="col-6">
			<label for="100ft">100ft. Cable Run</label>
		</div>
		<div class="col-6">
			<select name="100ft" class="form-control display-7 white-bg" id="fourth_technician-formbuilder-2q"> 
				<option value="N/A">Select-Service</option>
				<?php
                    foreach ($quantities->result_array() as $row) {
                        $service_qty_values = array(
                            $row['quantity']	=> $row['quantity'],
                        );
                        foreach ($service_qty_values as $value => $display_text) {
                            $selected = ($value == $this->input->post('100ft')) ? ' selected="selected"' : "";

                            echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                        }
                    }
                ?>
			</select> 
		</div> 
	</div>
</div>
<div data-for="200ft" class="col-lg-12 col-sm-12 form-group">
	<div class="row">
		<div class="col-6">
			<label for="200ft">200ft. Cable Run</label>
		</div>
		<div class="col-6">
			<select name="200ft" class="form-control display-7 white-bg" id="fourth_technician-formbuilder-2q"> 
				<option value="N/A">Select-Service</option>
				<?php
                    foreach ($quantities->result_array() as $row) {
                        $service_qty_values = array(
                            $row['quantity']	=> $row['quantity'],
                        );
                        foreach ($service_qty_values as $value => $display_text) {
                            $selected = ($value == $this->input->post('200ft')) ? ' selected="selected"' : "";

                            echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                        }
                    }
                ?>
			</select> 
		</div> 
	</div>
</div>
<div data-for="300ft" class="col-lg-12 col-sm-12 form-group">
	<div class="row">
		<div class="col-6">
			<label for="300ft">300ft. Cable Run</label>
		</div>
		<div class="col-6">
			<select name="300ft" class="form-control display-7 white-bg" id="fourth_technician-formbuilder-2q"> 
				<option value="N/A">Select-Service</option>
				<?php
                    foreach ($quantities->result_array() as $row) {
                        $service_qty_values = array(
                            $row['quantity']	=> $row['quantity'],
                        );
                        foreach ($service_qty_values as $value => $display_text) {
                            $selected = ($value == $this->input->post('300ft')) ? ' selected="selected"' : "";

                            echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                        }
                    }
                ?>
			</select> 
		</div> 
	</div>
</div>
