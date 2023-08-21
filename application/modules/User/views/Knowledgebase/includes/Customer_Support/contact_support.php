<?php
// Social Media Links
$facebookPage                           = $this->config->item('facebook'); 
$twitterPage                            = $this->config->item('twitter'); 
$stocktwitsPage                         = $this->config->item('stocktwits'); 
$discordPage                            = $this->config->item('discord'); 
$youtubePage                            = $this->config->item('youtube'); 
?>
<div class="row" id="contact-support"></div>
<div class="row g-gs">
    <div class="col-xl-12">
        <div class="nk-block-head nk-block-head-lg wide-md pb-0">
            <div class="nk-block-head-content">
                <div class="card">
                    <div class="card-inner text-left">
                        <h5 class="nk-block-title fw-normal pb-3">Contact Support</h5>
                        <div class="nk-block-des">
                            <p class="lead fs-14px">
                                If you need to reach out to <a href="<?php echo site_url('Support'); ?>">Customer Support</a>, you can submit a ticket or reach out to us via Social Media via the links below:        
                            </p>
                            <div class="row pt-3">
                                <div class="col-12 col-md-3 text-center"><a class="btn btn-outline-primary" href="<?php echo site_url('Support'); ?>"><em class="icon ni ni-help"></em> Submit Ticket</a></div>           
                                <div class="col-12 col-md-3 text-center"><a class="btn btn-outline-primary" href="<?php echo $facebookPage; ?>"><em class="icon ni ni-facebook-circle"></em> Facebook</a></div>           
                                <div class="col-12 col-md-3 text-center"><a class="btn btn-outline-primary" href="<?php echo $twitterPage; ?>"><em class="icon ni ni-twitter"></em> Twitter</a></div>                  
                                <div class="col-12 col-md-3 text-center"><a class="btn btn-outline-primary" href="<?php echo $youtubePage; ?>"><i class="icon ni ni-youtube"></i> Youtube</a></div>              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>