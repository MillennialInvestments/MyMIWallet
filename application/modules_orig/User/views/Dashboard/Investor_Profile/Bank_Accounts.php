<?php 
// print_r($_SESSION['allSessionData']['userAccount']);
?> 
<div class="nk-block-head nk-block-head-lg">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Bank Accounts</h4>
            <div class="nk-block-des">
                <p>Here are your connected external bank accounts. <span class="text-soft"><em class="icon ni ni-info"></em></span></p>
            </div>
        </div>
        <div class="nk-block-head-content align-self-start">
            <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
        </div>
    </div>
</div><!-- .nk-block-head -->
<div class="nk-block mb-3">
    <div class="row">
        <div class="col">
            <a class="btn btn-primary text-white" data-toggle="modal" data-target="#createBankAccountModal"><span><i class="icon ni ni-plus"></i> Add</span></a>	
        </div>
    </div>
</div>
<div class="nk-block card card-bordered pt-0">
    <table class="table table-ulogs">
        <thead class="table-light">
            <tr>
                <th class="tb-col-os"><span class="overline-title">Bank/Institute</span></th>
                <th class="tb-col-ip"><span class="overline-title">Account Type</span></th>
                <th class="tb-col-ip"><span class="overline-title">Account Number</span></th>
                <th class="tb-col-ip text-center"><span class="overline-title">More Actions</span></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $getUserACHBankAccounts            = $this->accounts_model->get_user_ach_bank_accounts($cuID); 
            if (!empty($getUserACHBankAccounts)) {
                foreach ($getUserACHBankAccounts->result_array() as $userBank) {
                    echo '
                <tr>
                    <td class="tb-col-os">' . $userBank['bank_name'] . '</td>
                    <td class="tb-col-os">' . $userBank['account_type'] . '</td>
                    <td class="tb-col-os">' . substr($userBank['account_number'], 0, 0) . 'xxxxx' . substr($userBank['account_number'], -4) . '</td>
                    <td class="tb-col-os text-center">
                        <span><i class="icon ni ni-setting-alt"></i></span>
                        <span class="statusRed"><i class="icon ni ni-cross-circle"></i></span>
                    </td>
                </tr>
                    ';
                }
            } else {
                echo '
            <tr>
                <td class="tb-col-os">ACH Bank Account Not Availble</td>
                <td class="tb-col-os"></td>
                <td class="tb-col-os"></td>
                <td class="tb-col-os text-center">
                </td>
            </tr>
                ';
            }
            ?>
        </tbody>
    </table>
</div><!-- .nk-block-head -->