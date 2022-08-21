<?php
$pageURIA               = $this->uri->segment(1); 
$pageURIB               = $this->uri->segment(2); 
$pageURIC               = $this->uri->segment(3); 
$pageURID               = $this->uri->segment(4); 
$pageURIE               = $this->uri->segment(5); 

$releaseType            = $pageURIB; 
$releaseNumber          = $pageURIC; 
if (!empty($_SESSION['allSessionData'])) {
    $cuID 			    = $_SESSION['allSessionData']['userAccount']['cuID'];
    $currentUserRoleID 	= $_SESSION['allSessionData']['userAccount']['cuRole'];
} else {
    $cuID 			    = '';
    $currentUserRoleID  = '';
}
$beta                   = $this->config->item('beta'); 

if (empty($cuID)) {
    if ($beta === 0) {
        $btnURL         = site_url('/Free/register'); 
    } elseif ($beta === 1) {
        $btnURL         = site_url('/Beta/register'); 
    }
    $btnText            = 'Register Now';
} else {
    $btnURL             = site_url('/Dashboard'); 
    $btnText            = 'Dashboard';
}
$viewData               = array(
    'pageURIA'          => $pageURIA,
    'pageURIB'          => $pageURIB,
    'pageURIC'          => $pageURIC,
    'pageURID'          => $pageURID,
    'pageURIE'          => $pageURIE,
    'releaseType'       => $releaseType,
    'releaseNumber'     => $releaseNumber,
)
?>
<style>
    .intro-banner{
        background: url(<?php echo base_url('assets/images/MyMI-Walllet-Background.jpeg'); ?>) no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        padding: 100px 4px 0px 
    }
    .intro-banner .version {background-color: #3E61BC;}
</style>
<div class="intro-banner bg-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="intro-banner-wrap">
                    <div class="intro-banner-inner text-center pt-0">
                        <div class="intro-banner-desc pt-5">
                            <span class="overline-title pt-5">Introducing</span>
                            <h1 class="title text-white">MyMI Wallet <span class="version"><?php echo $releaseNumber; ?></span> </h1>
                            <h2 class="subttitle text-white pb-5">
                                <?php echo $releaseNumber . ' ' . $releaseType; ?> Release Review
                            </h2>
                            <p class="text-light">
                            </p>
                        </div>
                        <ul class="intro-action-group">
                            <!-- <li><a href="<?php //echo $btnURL; ?>" class="btn btn-lg btn-primary" target="_blank"><?php //echo $btnText; ?></a></li>
                            <li><a href="<?php //echo site_url('/Knowledge-Base'); ?>" class="link-to btn btn-lg btn-light">Learn More</a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="intro-section intro-overview bg-lighter pt-5">
    <div class="container-fluid container-xl px-2">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="intro-section-title">
                    <span class="overline-title intro-section-subtitle">Releases Notes</span>
                    <h2 class="intro-heading-lead">Welcome to <?php echo $releaseType . ' Release ' . $releaseNumber; ?><br></h2>
                    <?php $this->load->view('Public/Releases/Versions/' . str_replace(".","_",$releaseNumber), $viewData); ?>
                    <h3 class="intro-heading pt-5">Customer Support<br></h3>
                    <div class="intro-content-entry text-black pt-3">
                        <p>
                            <strong>Beta-Testing Assistance & Support</strong>
                            <br>
                            <br>
                            During our Open-Beta Release for Version <?php echo $releaseNumber; ?>, if at any time you need additional assistance or support, 
                            please do not hesitate to contact our Customer Support Department to receive the help you require to complete your Open-Beta Test of the MyMI Wallet Application &amp; Platform.<br>
                            <a class="btn btn-primary btn-sm mt-1" href="<?php echo site_url('/Customer-Support'); ?>">Contact Support</a>       
                            <br>
                            <br>
                            <!-- <br>
                            <br>
                            As we continue to develop more features and functionality that we wish to provide for the Financial Investment Industry, we focus strongly on collecting user feedback to provide the best Application & Financial Investment Platform possible for our members. 
                            By providing your feedback, we can improve the efficiency in how the application flexes to customize our member's experiences while utilizing our Features & Tools. 
                            You can complete this by visiting the link below:<br>
                            <a class="btn btn-primary btn-sm mt-1" href="<?php //echo site_url('/Customer-Support'); ?>">Provide Feedback!</a>                             -->
                        </p>
                    </div>
                    <div class="intro-content-entry text-black pt-3">
                        <?php $this->load->view('Public/Releases/Suggestions', $viewData); ?>
                    </div>
                    <div class="intro-content-entry text-black pt-3">
                        <div class="intro-team">
                            <span class="title text-soft">Design and developed by</span>
                            <div class="intro-team-list">
                                <div class="intro-team-member">
                                    <!-- <div class="intro-team-media"><img src="<?php //echo base_url('assets/images/Dashlite-Examples/team-abu.jpg'); ?>" src="<?php //echo base_url('assets/images/team-abu2x.jpg'); ?> 2x" alt="Abu"></div> -->
                                    <div class="intro-team-info">
                                        <h5 class="intro-team-title title">Timothy Burks Jr.</h5>
                                        <span class="intro-team-role">Role as Founder | Lead Developer</span>
                                    </div>
                                </div>
                                <div class="intro-team-member">
                                    <!-- <div class="intro-team-media"><img src="<?php //echo base_url('assets/images/Dashlite-Examples/team-nio.jpg'); ?>" src="<?php //echo base_url('assets/images/team-nio2x.jpg'); ?> 2x" alt="Nio"></div> -->
                                    <div class="intro-team-info">
                                        <h5 class="intro-team-title title">Mattia Bian</h5>
                                        <span class="intro-team-role">Role as Lead Developer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>