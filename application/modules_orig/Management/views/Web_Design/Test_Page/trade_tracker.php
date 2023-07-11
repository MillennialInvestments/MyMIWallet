<?php
$cuID                           = 2;
$this->db->from('bf_users_trades');
$this->db->where('user_id', $cuID);
$getTrades                      = $this->db->get();
?>
<table class="table display" id="alertOverviewDatatable" role="grid" aria-describedby="DataTables_Table_0_info">
    <thead>
        <tr>     
            <th>Date Submitted</th>
            <th class="text-center">Order Status</th>
            <th class="text-center">Type</th>
            <th class="text-center">CUSIP</th>
            <th class="text-center">Stock</th>
            <th class="text-center">Alert Price</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($getTrades->result_array() as $info) {
            $submitted_date     = $info['open_date'] . ' ' . $info['open_time'];
            $order_status       = $info['order_status'];
            $category           = $info['category'];
            $cusip              = $info['symbol_id'];
            $symbol             = $info['symbol'];
            $entry_price        = $info['entry_price'];
            
            echo '
            <tr>
                <td>' . $submitted_date . '</td>
                <td class="text-center">' . $order_status . '</td>
                <td class="text-center">' . $category . '</td>
                <td class="text-center">' . $cusip . '</a></td>
                <td class="text-center">' . $symbol . '</a></td>
                <td class="text-center">$' . $entry_price . '</td>
            </tr>';
        }
        ?>
    </tbody>
</table>