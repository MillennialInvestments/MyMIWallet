<?php
$beta           = $this->config->item('beta');
?>
<div class="nk-block">
    <div class="row g-gs">
        <div class="col-xl-12">
            <div class="nk-block-head nk-block-head-lg wide border-bottom">
                <div class="nk-block-head-content">
                    <div class="card">
                        <div class="card-inner text-center">
                            <i class="icon myfs-lg ni ni-account-setting"></i>
                            <h3 class="nk-block-title fw-normal">What Next?</h3>
                            <div class="nk-block-des">
                                <p class="lead">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="hover-bg-primary text-center position-relative px-4 py-5 rounded-lg shadow"> 
                <i class="icon myfs-xxl ni ni-user-circle img-fluid"></i>
                <h5 class="pt-5 pb-3 text-capitalize card-title">Account Mode: <strong class="text-primary">Beta</strong></h5>
                <p class="mb-4">While in <strong>Beta</strong>, you will be able to access all features purchased with your MyMI Gold as long as your account is in a Beta Status.</p>
                <br>
                <a class="btn btn-outline-primary" href="#virtual-credit-card-information" data-abc="true">View Card</a>
            </div>
        </div>
        <div class="col-sm-6 col-12">
            <div class="hover-bg-primary text-center position-relative px-4 py-5 rounded-lg shadow"> 
                <i class="icon myfs-xxl ni ni-user-circle img-fluid"></i>
                <h5 class="pt-5 pb-3 text-capitalize card-title">Access Your Features</h5>
                <p class="mb-4">Now that you have completed your order, you can proceed by accessing your selected premium feature to activate those services.</p><br>
                <a class="btn btn-outline-primary" href="#" data-abc="true">Read More</a>
            </div>
        </div>
        <?php 
        if ($beta === 1) {
        } else {
            
        }
        ?>
    </div>
</div>