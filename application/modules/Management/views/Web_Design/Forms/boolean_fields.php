<?php
    $type_values = array(
        'Yes'		=> 'Yes',
        'No'		=> 'No',
    );
    foreach ($type_values as $value => $display_text) {
        $selected = ($value == $this->input->post('customer_type')) ? ' selected="selected"' : "";

        echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
    }
