<div class="nk-block nk-block-lg">   
    <div class="card card-bordered pricing">
        <div class="pricing-head">
            <div class="pricing-title">
                <h4 class="card-title title">Account Information</h4>
                <p class="sub-text">Please fill out information below!</p>
            </div>
        </div>
        <div class="pricing-body">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-12 py-2">
                    <ul class="list list-lg list-checked py-4">
                        <li><span class="w-30">Due Date:</span> <span class="ms-auto">Designated Date that <?= $accountType; ?> is due or received.</span></li>
                        <li><span class="w-30">Account Type:</span> <span class="ms-auto">Whether the account is an Income or Expense Account</span></li>
                        <li><span class="w-30">Account Name:</span> <span class="ms-auto">Provide a preferred name when referencing the account.</span></li>
                        <li><span class="w-30">Net Amount:</span> <span class="ms-auto">Provide the net amount of the <?= $accountType; ?> Account.</span></li>
                        <li><span class="w-30">Recurring Account:</span> <span class="ms-auto">Is the <?= $accountType; ?> recurring? If so, provide the Time Interval</span></li>
                        <li><span class="w-30">Interval (If Recurring):</span> <span class="ms-auto">Is the account due on a Weekly, Monthly or Annual Basis?</span></li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="pricing-action mt-0">
                <p class="sub-text">Need additional assistance or support?<br>Contact us via <a href="">email</a> or simply click below:</p>
                <a class="btn btn-primary btn-sm" href="<?php echo site_url('/Support'); ?>"><i class="icon ni ni-envelope"></i>Contact Support</a>
            </div>
        </div>
    </div>
</div>