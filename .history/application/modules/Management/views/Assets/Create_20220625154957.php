<?php
$pageURIA                                   = $this->uri->segment(1);
$pageURIB                                   = $this->uri->segment(2);
$pageURIC                                   = $this->uri->segment(3);
$pageURID                                   = $this->uri->segment(4);
$pageURIE                                   = $this->uri->segment(5);
$userID                                     = $pageURID; 
$redirect_url                               = current_url();
$dashboardTitle                             = 'Users /';
$dashboardSubtitle                          = 'Asset Creato'; 
$userAccount                                = $_SESSION['allSessionData']['userAccount'];
$viewData                                   = array(
    'userAccount'                           => $userAccount,
); 
?>
<div class="nk-block">
    <div class="row gy-gs">
        <div class="col-lg-12 col-xl-12">
            <div class="nk-block">
                <div class="nk-block-head-xs">
                    <div class="nk-block-head-content">
                        <h1 class="nk-block-title title"><?php echo $dashboardTitle; ?></h1>
                        <h2 class="nk-block-title subtitle"><?php echo $dashboardSubtitle; ?></h2>
                        <p id="private_key"></p>
                        <p id="address"></p>
                        <a href="<?php echo site_url('/Management'); ?>">Back to Dashboard</a>							
                    </div>
                </div>
            </div>
            <div class="nk-block">
                <div class="row">
                    <div class="col-sm-6 col-lg-8 col-xxl-9">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <form action="#">
                                    <fieldset>
                                        <?php
                                        Template::block('Exchange/Coin_Listing_Asset_Information/create_fields', 'Exchange/Coin_Listing_Asset_Information/create_fields', $viewData);
                                        ?>
                                    </fieldset>
                                </form>
                            </div>
                        </div><!-- .card --> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>