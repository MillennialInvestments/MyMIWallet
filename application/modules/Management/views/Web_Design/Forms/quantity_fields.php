<?php
    $this->db->from('bf_quantities');
    $quantQuery = $this->db->get();
    
    foreach ($quantQuery->result_array() as $quantInfo) {
        $quantity_values = array(
            $quantInfo['quantity'] => $quantInfo['quantity'],
        );
        foreach ($type_values as $value => $display_text) {
            $selected = ($value == $this->input->post('customer_type')) ? ' selected="selected"' : "";

            echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
        }
    }
