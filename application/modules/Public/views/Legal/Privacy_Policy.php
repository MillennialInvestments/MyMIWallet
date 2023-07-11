<?php
$currentUserID 			= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$currentUserRoleID 		= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
$beta                   = $this->config->item('beta'); 
$investmentOperations   = $this->config->item('investmentOperations'); 
$registerType           = $this->uri->segment(1);
if ($registerType === 'Investor') {
    $title		        = 'Register An Investor Account';
} else {
    $title		        = 'Register An Investor Account Free!';
};
if (empty($currentUserID)) {
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
$totalActiveUsers       = $_SESSION['reporting']['totalActiveUsers']; 
$totalWalletsCreated    = $_SESSION['reporting']['totalWalletsCreated']; 
$totalTradesTracked     = $_SESSION['reporting']['totalTradesTracked']; 
$totalActivePartners    = $_SESSION['reporting']['totalActivePartners']; 
$totalApprovedAssets    = $_SESSION['reporting']['totalApprovedAssets']; 
$formData               = array(
    'title'             => $title,
    'registerType'      => $registerType,
);
?>
<style>
    .intro-banner{
        background: url(<?php echo base_url('assets/images/MyMI-Walllet-Background.jpeg'); ?>) no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    .intro-banner .version {background-color: #3E61BC;}
    .intro-overview ul {justify-content:normal;}
    .list-checked > li {color: #364A63; font-size: 1.125rem}; 
    .list-blue-header {color: #3E61BC}
</style>
<div class="intro-banner pb-3 bg-dark">
    <div class="container pt-3">
        <div class="row justify-content-center pt-1">
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="intro-banner-wrap">
                    <div class="intro-banner-inner text-center">
                        <div class="intro-banner-desc py-md-2 py-lg-5">
                            <div class="row">
                                <span class="overline-title">Legal</span>
                                <h1 class="title text-white" style="font-size:2.5rem">MyMI Wallet Privacy Policy</h1>
                                <h2 class="subttitle text-white pb-3" style="font-size:1.5rem">Manage Your Finances<br>with Confidence</h2>
                                <!-- <h2 class="subttitle text-white pb-5">Investment Accounting/Analytical Software<br>Crypto Asset Marketplace &amp; Exchange</h1> -->
                                <p class="text-light">
                                    MyMI Wallet is your all-in-one financial management solution. Gain control over your money, budget effectively, and make informed investment decisions. 
                                    Whether you're a seasoned investor or just starting, our tools and resources will empower you to master your finances and build a better financial future.
                                </p>
                                <div class="row intro-action-group mt-3">
                                    <div class="col-12">
                                        <h2 class="subttitle text-white pb-3" style="font-size:1.5rem">Join Our Mailing List<br>For More News &amp; Updates!</h2>
                                    </div>
                                    <div class="col-12">
                                        <?php $this->load->view('Blog/Subscribe/header_subscribe'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-md-none d-lg-block col-lg-6 col-xl-6 pl-5">
                <div class="intro-banner-wrap pt-lg-5">
                    <div class="intro-banner-inner">
                        <div class="intro-banner-desc pt-0">
                            <img class="img-fluid rounded" src="<?php echo base_url('assets/images/How_It_Works/Personal_Budgeting.jpg'); ?>" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="intro-section intro-overview text-center bg-white">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="d-none d-md-block col-md-3 col-lg-3 col-xl-3 px-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-bordered">
                            <div class="card-body pb-5">
                                <h2>Related Links</h2>
                                <ul class="nav flex-column nav-pills px-2" id="myTab" role="tablist">
                                    <li class="nav-item"><a class="nav-link pl-3 pr-0" href="<?php echo site_url('/Legal'); ?>" id="tab1-tab"><strong>Legal Home</strong></a></li>
                                    <li class="nav-item"><a class="nav-link pl-3 pr-0" href="<?php echo site_url('/Leagl/Terms-And-Conditions'); ?>" id="tab1-tab"><strong>Terms and Conditions</strong></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-bordered">
                            <div class="card-body pb-5 px-0">
                                <img class="img-fluid" src="<?php echo base_url('assets/images/Marketing/Promotional-Infographic-1.png'); ?>" alt="MyMI Wallet - Personal Budgeting & Investment Portfolio Management" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-none d-md-block col-md-7 col-lg-7 col-xl-7 pl-5">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane pb-5 fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                        <div class="row justify-content-center pb-5">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <span class="overline-title intro-section-subtitle">MyMI Wallet Legal</span>
                                    <h3 class="intro-heading-lead">Privacy Policy</h3>
                                    <div class="intro-section-desc">
                                        <p class="dark-text">
                                            At MyMI Wallet, we prioritize the security and confidentiality of your personal information. We are committed to protecting your privacy and maintaining the trust you place in us. This Privacy Policy outlines how we collect, use, and safeguard your personal information when you use our services. We encourage you to read this policy carefully to understand our practices regarding your personal data.
                                        </p>                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center py-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Personal Information</strong></h4>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        When ordering and purchasing products and services, we may collect the following personal information:
                                    </p>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="intro-section-desc">
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3"><strong class="list-blue-header">Age/Gender</strong></li><br>
                                    </ul> 
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3"><strong class="list-blue-header">E-mail Address</strong></li><br>
                                    </ul> 
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3"><strong class="list-blue-header">First and Last Name</strong></li><br>
                                    </ul> 
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3"><strong class="list-blue-header">Job Title</strong></li><br>
                                    </ul> 
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3"><strong class="list-blue-header">Mailing Address</strong></li><br>
                                    </ul> 
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3"><strong class="list-blue-header">Phone Number</strong></li><br>
                                    </ul> 
                                </div>
                            </div>
                            <div class="col-5 pl-3">
                                <div class="intro-section-desc">
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3"><strong class="list-blue-header">Budget/Investment Related Information</strong></li><br>
                                    </ul> 
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3"><strong class="list-blue-header">Credit/Debit Card Information:</strong></li><br>
                                    </ul> 
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3"><strong class="list-blue-header">Employer</strong></li><br>
                                    </ul> 
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3"><strong class="list-blue-header">Financial/Investment Data <small>(Transactions Only)</small></strong></li><br>
                                    </ul> 
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3"><strong class="list-blue-header">Household Income</strong></li><br>
                                    </ul>  
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3"><strong class="list-blue-header">Race</strong></li><br>
                                    </ul> 
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Use of Your Personal Information</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        MyMI collects and uses your personal information to operate and deliver the services you have requested. MyMI may also use your personally identifiable information to inform you of other products or services available from MyMI and its affiliates.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Sharing Information with Third Parties</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        MyMI may sell, rent, or lease customer information to third parties for the following reasons:
                                    </p>
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">MyMI Wallet will host a Crypto Asset Creator, Marketplace, and Exchange to allow our users to sell their financial data and other private equity investment-related opportunities or services at their discretion.</li><br>
                                    </ul>  
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">MyMI may, from time to time, contact you on behalf of external business partners about a particular offering that may be of interest to you. In those cases, your unique personally identifiable information (e-mail, name, address, telephone number) is transferred to the third party.</li><br>
                                    </ul>  
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">MyMI may share data with trusted partners to help perform statistical analysis, send you email or postal mail, provide customer support, or arrange for deliveries. All such third parties are prohibited from using your personal information except to provide these services to MyMI, and they are required to maintain the confidentiality of your information.</li><br>
                                    </ul>  
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">MyMI may disclose your personal information, without notice, if required to do so by law or in the good faith belief that such action is necessary to: (a) conform to the edicts of the law or comply with legal process served on MyMI or the site; (b) protect and defend the rights or property of MyMI; and/or (c) act under exigent circumstances to protect the personal safety of users of MyMI or the public.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Opting Out of Personal Information Sale or Disclosure</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        To opt-out of the sale or disclosure of your personal information, visit this web page:
                                        <a href="https://www.mymiwallet.com/Investor-Profile/Cancel">https://www.mymiwallet.com/Investor-Profile/Cancel</a>.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Security of Your Personal Information</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        MyMI secures your personal information from unauthorized access, use, or disclosure. MyMI uses the following methods for this purpose:
                                    </p>
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">SSL Protocol</li><br>
                                    </ul>  
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">2FA/Multi-factor Authentication</li><br>
                                    </ul>  
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">CloudFlare</li><br>
                                    </ul>  
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">DigiByte Blockchain/Encryption</li><br>
                                    </ul>  
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">DigiByte Dig-iID Security Integrations</li><br>
                                    </ul>  
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">KYC Integrations</li><br>
                                    </ul>  
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">Plaid Financial Institution Integrations</li><br>
                                    </ul>  
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">Plaid Identify Verification Integrations</li><br>
                                    </ul>  
                                    <p class="dark-text">
                                        We strive to take appropriate security measures to protect against unauthorized access to or alteration of your personal information. However, no data transmission over the Internet or any wireless network can be guaranteed to be 100% secure. As a result, while we strive to protect your personal information, you acknowledge that there are security and privacy limitations inherent to the Internet which are beyond our control, and the security, integrity, and privacy of any and all information and data exchanged between you and us through this site cannot be guaranteed.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Right to Deletion</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Subject to certain exceptions set out below, on receipt of a verifiable request from you, we will:
                                    </p>                                    
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">Delete your personal information from our records; and</li><br>
                                    </ul>  
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">Direct any service providers to delete your personal information from their records.</li><br>
                                    </ul>
                                    <p class="dark-text">
                                        Please note that we may not be able to comply with requests to delete your personal information if it is necessary to:
                                    </p> 
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">Complete the transaction for which the personal information was collected, fulfill the terms of a written warranty or product recall conducted in accordance with federal law, provide a good or service requested by you, or reasonably anticipated within the context of our ongoing business relationship with you, or otherwise perform a contract between you and us;</li><br>
                                    </ul>  
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">Detect security incidents, protect against malicious, deceptive, fraudulent, or illegal activity; or prosecute those responsible for that activity;</li><br>
                                    </ul>  
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">Debug to identify and repair errors that impair existing intended functionality;</li><br>
                                    </ul>  
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">Exercise free speech, ensure the right of another consumer to exercise his or her right;</li><br>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Children Under Thirteen</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        MyMI does not knowingly collect personally identifiable information from children under the age of thirteen. If you are under the age of thirteen, you must ask your parent or guardian for permission to use this application.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Contact Information</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        If you have any questions or comments regarding this Privacy Policy, you can contact us at:
                                    </p>
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">Email: <a href="mailto:support@mymiwallet.com">support@mymiwallet.com</a></li><br>
                                    </ul>  
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">Phone: 3187759059</li><br>
                                    </ul>  
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>E-mail Communications</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        From time to time, MyMI may contact you via email for the purpose of providing announcements, promotional offers, alerts, confirmations, surveys, and/or other general communication. In order to improve our services, we may receive a notification when you open an email from MyMI or click on a link therein.
                                    </p>
                                    <p class="dark-text">
                                        If you would like to stop receiving marketing or promotional communications via email from MyMI, you may opt out of such communications by clicking the unsubscribe button provided in every email you receive from MyMI Wallet or any third-party partners used to distribute emails. Users can also adjust their notification settings by visiting their Dashboard -> Account -> Notifications (<a href="https://www.mymiwallet.com/Investor-Profile/Notifications">https://www.mymiwallet.com/Investor-Profile/Notifications</a>) and adjusting their notifications accordingly to the user's discretion or preference.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>External Data Storage Sites</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        We may store your data on servers provided by third-party hosting vendors with whom we have contracted.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Changes to this Statement</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        MyMI reserves the right to change this Privacy Policy from time to time. We will notify you about significant changes in the way we treat personal information by sending a notice to the primary email address specified in your account, by placing a prominent notice on our application, and/or by updating any privacy information. Your continued use of the application and/or services available after such modifications will constitute your: (a) acknowledgment of the modified Privacy Policy; and (b) agreement to abide and be bound by that Policy.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Contact Information</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        MyMI welcomes your questions or comments regarding this Statement of Privacy. If you believe that MyMI has not adhered to this Statement, please contact MyMI at:
                                    </p>
                                    <p class="dark-text">
                                        My Millennial Investments, LLC.<br>
                                        2304 Ashland Ave.<br>
                                        Bossier City, Louisiana 71111
                                    </p>
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">Email Address: <a href="mailto:support@mymiwallet.com">support@mymiwallet.com</a></li><br>
                                    </ul>  
                                    <ul class="list list-sm list-checked">
                                        <li class="pl-3">Telephone number: 3187759059</li><br>
                                    </ul>  
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Effective Date</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Effective as of January 01, 2023.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="tab-pane active" id="tab20" role="tabpanel" aria-labelledby="tab20-tab">
                        <?php 
                        $currentUserID	 		= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
                        $currentUserRoleID 		= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
                        $currentUserEmail 		= isset($current_user->email) && ! empty($current_user->email) ? $current_user->email : '';
                        $marketMovers			= date("F-jS-Y");
                        $beta                   = $this->config->item('beta'); 
                        if (empty($currentUserID)) {
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
                        ?>
                        <div class="row justify-content-center pt-5">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h3 class="intro-heading-lead"><strong>Access Our Financial Tools Now!</strong></h3>
                                    <div class="intro-section-desc">
                                        <p class="dark-text">
                                            Discover financial freedom with MyMI Wallet! Access our Personal Financial Budgeting and Investment Portfolio Management Tools at MyMI Wallet!
                                            By registering an account, you'll gain access to a suite of powerful tools designed to help you take control of your finances and grow your wealth.
                                        </p>      
                                        <?php                                         
                                        if (!empty($currentUserID)) {
                                            echo '
                                            <a class="btn btn-primary" href="' . site_url('/Dashboard') . '">Get Started!</a> 
                                            ';
                                        } else {
                                            echo '
                                            <a class="btn btn-primary" href="' . $btnURL . '">Get Started!</a> 
                                            ';
                                        }   
                                        ?>               
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
