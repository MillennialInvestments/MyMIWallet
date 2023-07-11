<?php
$beta               = $this->config->item('beta');
$tutorialData       = array(
    'total'         => $total,
); 
?>
<div class="nk-block">
    <div class="row g-gs">
        <div class="col-xl-12">
            <div class="nk-block-head nk-block-head-lg wide border-bottom">
                <div class="nk-block-head-content">
                    <div class="card">
                        <div class="card-inner text-center">
                            <i class="icon myfs-lg ni ni-account-setting"></i>
                            <h3 class="nk-block-title fw-normal">How It Works!</h3>
                            <div class="nk-block-des">
                                <p class="lead">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        if ($beta === 1) {
            $this->load->view('User/Knowledgebase/Tutorials/Categories/MyMIGold/includes/beta_tutorials', $tutorialData);
        } else {
            $this->load->view('User/Knowledgebase/Tutorials/Categories/MyMIGold/includes/production_tutorials', $tutorialData);
        }
        ?>
    </div>
</div>