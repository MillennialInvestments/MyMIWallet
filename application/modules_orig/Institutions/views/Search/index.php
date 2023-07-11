<?php
// User Account Information
$userAccount                        = $_SESSION['allSessionData']['userAccount'];
$userBudget                         = $_SESSION['allSessionData']['userBudget'];
// print_r($userAccount);
$cuID                               = $userAccount['cuID'];
$cuRole                             = $userAccount['cuRole'];

// echo $totalIncome;
// echo $totalExpenses;
?>
<style>
    .nk-order-ovwg-data.income {
        border-color: #8ff0d6;
    }
    .nk-order-ovwg-data.expenses {
        border-color: #e85347;
    }
    .nk-order-ovwg-data.surplus {
        border-color: #84b8ff;
    }
    .nk-order-ovwg-data.investments {
        border-color: #f4bd0e;
    }
    .nk-order-ovwg-data .amount {
        font-size: 1.25rem;
        font-weight: 700;
    }
</style>
<div class="nk-block">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10">
            <?php $this->load->view('User/Budget/index/control_center'); ?>
        </div><!-- .col -->
        
    </div>
</div>