<?php
    $this->db->where('position', 'Installation Technician');
    $this->db->order_by('name', 'ASC');
    $this->db->from('bf_employees');
    $technicians = $this->db->get();
?>
	<div class="col-lg-12 form-group" data-for="technician_one">
		<select name="technician_one" class="form-control display-7 white-bg" id="technician-formbuilder-2q" required="required">
			<option value="N/A">Select-A-Technician</option>
			<?php
                foreach ($technicians->result_array() as $row) {
                    $technician_values = array(
                        $row['name']	=> $row['name'],
                    );
                    foreach ($technician_values as $value => $display_text) {
                        $selected = ($value == $this->input->post('technician_one')) ? ' selected="selected"' : "";

                        echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                    }
                }
            ?>
		</select>
		<a class="align-left pl-2" data-toggle="collapse" href="#technicianTwo" role="button" aria-expanded="false" aria-controls="collapseExample">
			+Add Technician
		</a>
		<a class="align-left pl-2" href="<?php echo site_url('/Add-Techs'); ?>" role="button">
			+Add New Technician
		</a>
	</div>
	<div class="collapse col-lg-12" id="technicianTwo">
		<div class="row">
			<div data-for="technician_two" class="col-lg-12 col-sm-12 form-group">
				<select name="technician_two" class="form-control display-7 white-bg" id="second_technician-formbuilder-2q">  
					<option value="N/A">Select-A-Technician</option>
					<?php
                        foreach ($technicians->result_array() as $row) {
                            $technician_values = array(
                                $row['name']	=> $row['name'],
                            );
                            foreach ($technician_values as $value => $display_text) {
                                $selected = ($value == $this->input->post('technician_two')) ? ' selected="selected"' : "";

                                echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                            }
                        }
                    ?>
				</select>
				<a class="align-left pl-2" data-toggle="collapse" href="#technicianThree" role="button" aria-expanded="false" aria-controls="collapseExample">
					+Add Technician
				</a>
			</div>
		</div>
	</div>
	<div class="collapse col-lg-12" id="technicianThree">
		<div class="row">
			<div data-for="technician_three" class="col-lg-12 col-sm-12 form-group">
				<select name="technician_three" class="form-control display-7 white-bg" id="second_technician-formbuilder-2q">     
					<option value="N/A">Select-A-Technician</option>
					<?php
                        foreach ($technicians->result_array() as $row) {
                            $technician_values = array(
                                $row['name']	=> $row['name'],
                            );
                            foreach ($technician_values as $value => $display_text) {
                                $selected = ($value == $this->input->post('technician_three')) ? ' selected="selected"' : "";

                                echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                            }
                        }
                    ?>
				</select>
				<a class="align-left pl-2" data-toggle="collapse" href="#technicianFour" role="button" aria-expanded="false" aria-controls="collapseExample">
					+Add Technician
				</a>
			</div>
		</div>
	</div>
	<div class="collapse col-lg-12" id="technicianFour">
		<div class="row">
			<div data-for="technician_four" class="col-lg-12 col-sm-12 form-group">
				<select name="technician_four" class="form-control display-7 white-bg" id="second_technician-formbuilder-2q">    
					<option value="N/A">Select-A-Technician</option>
					<?php
                        foreach ($technicians->result_array() as $row) {
                            $technician_values = array(
                                $row['name']	=> $row['name'],
                            );
                            foreach ($technician_values as $value => $display_text) {
                                $selected = ($value == $this->input->post('technician_four')) ? ' selected="selected"' : "";

                                echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                            }
                        }
                    ?>
				</select>
				<a class="align-left pl-2" data-toggle="collapse" href="#technicianFive" role="button" aria-expanded="false" aria-controls="collapseExample">
					+Add Technician
				</a>
			</div>
		</div>
	</div>
	<div class="collapse col-lg-12" id="technicianFive">
		<div class="row">
			<div data-for="technician_five" class="col-lg-12 col-sm-12 form-group">
				<select name="technician_five" class="form-control display-7 white-bg" id="second_technician-formbuilder-2q">  
					<option value="N/A">Select-A-Technician</option>
					<?php
                        foreach ($technicians->result_array() as $row) {
                            $technician_values = array(
                                $row['name']	=> $row['name'],
                            );
                            foreach ($technician_values as $value => $display_text) {
                                $selected = ($value == $this->input->post('technician_five')) ? ' selected="selected"' : "";

                                echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                            }
                        }
                    ?>
				</select>
				<a class="align-left pl-2" data-toggle="collapse" href="#technicianSix" role="button" aria-expanded="false" aria-controls="collapseExample">
					+Add Technician
				</a>
			</div>
		</div>
	</div>
	<div class="collapse col-lg-12" id="technicianSix">
		<div class="row">
			<div data-for="technician_six" class="col-lg-12 col-sm-12 form-group">
				<select name="technician_six" class="form-control display-7 white-bg" id="second_technician-formbuilder-2q">   
					<option value="N/A">Select-A-Technician</option>
					<?php
                        foreach ($technicians->result_array() as $row) {
                            $technician_values = array(
                                $row['name']	=> $row['name'],
                            );
                            foreach ($technician_values as $value => $display_text) {
                                $selected = ($value == $this->input->post('technician_six')) ? ' selected="selected"' : "";

                                echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                            }
                        }
                    ?>
				</select>
				<a class="align-left pl-2" data-toggle="collapse" href="#technicianSeven" role="button" aria-expanded="false" aria-controls="collapseExample">
					+Add Technician
				</a>
			</div>
		</div>
	</div>
	<div class="collapse col-lg-12" id="technicianSeven">
		<div class="row">
			<div data-for="technician_seven" class="col-lg-12 col-sm-12 form-group">
				<select name="technician_seven" class="form-control display-7 white-bg" id="second_technician-formbuilder-2q"> 
					<option value="N/A">Select-A-Technician</option>
					<?php
                        foreach ($technicians->result_array() as $row) {
                            $technician_values = array(
                                $row['name']	=> $row['name'],
                            );
                            foreach ($technician_values as $value => $display_text) {
                                $selected = ($value == $this->input->post('technician_seven')) ? ' selected="selected"' : "";

                                echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                            }
                        }
                    ?>
				</select>
				<a class="align-left pl-2" data-toggle="collapse" href="#technicianEight" role="button" aria-expanded="false" aria-controls="collapseExample">
					+Add Technician
				</a>
			</div>
		</div>
	</div>
	<div class="collapse col-lg-12" id="technicianEight">
		<div class="row">
			<div data-for="technician_eight" class="col-lg-12 col-sm-12 form-group">
				<select name="technician_eight" class="form-control display-7 white-bg" id="second_technician-formbuilder-2q">     
					<option value="N/A">Select-A-Technician</option>
					<?php
                        foreach ($technicians->result_array() as $row) {
                            $technician_values = array(
                                $row['name']	=> $row['name'],
                            );
                            foreach ($technician_values as $value => $display_text) {
                                $selected = ($value == $this->input->post('technician_eight')) ? ' selected="selected"' : "";

                                echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                            }
                        }
                    ?>
				</select>
				<a class="align-left pl-2" data-toggle="collapse" href="#technicianNine" role="button" aria-expanded="false" aria-controls="collapseExample">
					+Add Technician
				</a>
			</div>
		</div>
	</div>
	<div class="collapse col-lg-12" id="technicianNine">
		<div class="row">
			<div data-for="technician_nine" class="col-lg-12 col-sm-12 form-group">
				<select name="technician_nine" class="form-control display-7 white-bg" id="second_technician-formbuilder-2q">   
					<option value="N/A">Select-A-Technician</option>
					<?php
                        foreach ($technicians->result_array() as $row) {
                            $technician_values = array(
                                $row['name']	=> $row['name'],
                            );
                            foreach ($technician_values as $value => $display_text) {
                                $selected = ($value == $this->input->post('technician_nine')) ? ' selected="selected"' : "";

                                echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                            }
                        }
                    ?>
				</select>
				<a class="align-left pl-2" data-toggle="collapse" href="#technicianTen" role="button" aria-expanded="false" aria-controls="collapseExample">
					+Add Technician
				</a>
			</div>
		</div>
	</div>
	<div class="collapse col-lg-12" id="technicianTen">
		<div class="row">
			<div data-for="technician_ten" class="col-lg-12 col-sm-12 form-group">
				<select name="technician_ten" class="form-control display-7 white-bg" id="second_technician-formbuilder-2q">
					<option value="N/A">Select-A-Technician</option>
					<?php
                        foreach ($technicians->result_array() as $row) {
                            $technician_values = array(
                                $row['name']	=> $row['name'],
                            );
                            foreach ($technician_values as $value => $display_text) {
                                $selected = ($value == $this->input->post('technician_ten')) ? ' selected="selected"' : "";

                                echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                            }
                        }
                    ?>
				</select>
			</div>
		</div>
	</div>
