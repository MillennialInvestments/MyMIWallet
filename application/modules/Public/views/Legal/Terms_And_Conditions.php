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
                                    <li class="nav-item"><a class="nav-link pl-3 pr-0" href="<?php echo site_url('/Legal/Privacy-Policy'); ?>" id="tab1-tab"><strong>Privacy Policy</strong></a></li>
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
                        <div class="row justify-content-center py-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <span class="intro-section-subtitle overline-title">MyMI Wallet Legal Documentation</span>
                                    <h3 class="intro-heading-lead">Terms and Conditions</h3>
                                    <div class="intro-section-desc">
                                        <p class="dark-text">
                                            Welcome to <a href="https://www.mymiwallet.com">https://www.mymiwallet.com</a>. The <a href="https://www.mymiwallet.com">https://www.mymiwallet.com</a> website (the "Site") is comprised of various web pages operated by MyMI Wallet Inc. ("MyMI Wallet"). <a href="https://www.mymiwallet.com">https://www.mymiwallet.com</a> is offered to you conditioned on your acceptance without modification of the terms, conditions, and notices contained herein (the "Terms"). Your use of <a href="https://www.mymiwallet.com">https://www.mymiwallet.com</a> constitutes your agreement to all such Terms. Please read these terms carefully, and keep a copy of them for your reference.
                                        </p>                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center py-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <div class="intro-section-title">
                                        <h4 class="subtitle"><strong>Agreement between User and https://www.mymiwallet.com</strong></h4>
                                    </div>
                                    <div class="intro-section-desc">
                                        <p class="dark-text">
                                            MyMI Wallet, a subsidiary of My Millennial Investments, LLC., serves as a robust personal budgeting and investment portfolio management platform. Our primary aim is to empower investors by providing a range of user-friendly tools designed to facilitate informed financial decision-making.
                                        </p>    
                                        <p class="dark-text">
                                            Our platform offers sophisticated investment accounting and analytical tools that allow both new and experienced investors to forecast and backtest their investment portfolios and strategies. These tools help investors visualize potential outcomes and understand the risk-reward trade-off of their strategies, allowing them to refine their investment approaches and enhance financial performance.
                                        </p>       
                                        <p class="dark-text">
                                            In addition to this, MyMI Wallet delves into the expanding realm of digital crypto assets. We provide a comprehensive platform for the creation, purchase, sale, and trade of digital assets through our dedicated MyMI Marketplace & Exchange. We understand the significance and the potential of this burgeoning sector and are committed to making this space accessible, understandable, and profitable for our users.
                                        </p>          
                                        <p class="dark-text">
                                            Taken together, MyMI Wallet is not just a tool but a comprehensive solution for personal budgeting and investment portfolio management. Our offerings are designed to make investing an achievable goal for all. We stand as a reliable ally in our users' financial journeys, providing essential knowledge, resources, and tools that they need to navigate and thrive in the dynamic world of investing.
                                        </p>          
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center py-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <div class="intro-section-title">
                                        <h4 class="subtitle"><strong>Privacy Policy</strong></h4>
                                    </div>
                                    <div class="intro-section-desc">
                                        <p class="dark-text">
                                            Your use of <a href="https://www.mymiwallet.com/Legal">https://www.mymiwallet.com/Legal/Privacy-Policy</a> is subject to MyMI Wallet's Privacy Policy. Please review our Privacy Policy, which also governs the Site and informs users of our data collection practices.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center py-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Electronic Communications</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Visiting <a href="https://www.mymiwallet.com">https://www.mymiwallet.com</a> or sending emails to MyMI Wallet constitutes electronic communications. You consent to receive electronic communications and you agree that all agreements, notices, disclosures, and other communications that we provide to you electronically, via email and on the Site, satisfy any legal requirement that such communications be in writing.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center py-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Your Account</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        If you use this site, you are responsible for maintaining the confidentiality of your account and password and for restricting access to your computer, and you agree to accept responsibility for all activities that occur under your account or password. You may not assign or otherwise transfer your account to any other person or entity. You acknowledge that MyMI Wallet is not responsible for third party access to your account that results from theft or misappropriation of your account. MyMI Wallet and its associates reserve the right to refuse or cancel service, terminate accounts, or remove or edit content in our sole discretion.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center py-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Children Under Thirteen</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        MyMI Wallet does not knowingly collect, either online or offline, personal information from persons under the age of thirteen. If you are under 18, you may use <a href="https://www.mymiwallet.com">https://www.mymiwallet.com</a> only with permission of a parent or guardian.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center py-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Cancellation/Refund Policy</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        At MyMI Wallet, we place our customers at the heart of our operations. With regards to cancellation and refunds, our policy is designed to ensure maximum flexibility and convenience for our users.
                                    </p>
                                    <p class="dark-text">
                                        Users who have purchased our Premium Features have the freedom to cancel their service at any point in time. If they choose to do so, they can also request a refund provided they meet certain criteria.
                                    </p>
                                    <p class="dark-text">
                                        To be eligible for a refund, the cancellation must be made within 15 days from the start of the service. Any cancellations made after this period will not qualify for a refund. This policy allows users to get a feel of our Premium Features and decide if it fits their needs and preferences.
                                    </p>
                                    <p class="dark-text">
                                        We understand that every individual's financial journey is unique, and our policies are shaped to respect and accommodate these varying paths. If you have any questions regarding cancellation or need further assistance with the refund process, do not hesitate to get in touch with us at <a href="mailto:support@mymiwallet.com">support@mymiwallet.com</a>. Our dedicated customer support team will be more than happy to assist you.
                                    </p>
                                    <p class="dark-text">
                                        We, at MyMI Wallet, strive to make your financial journey as seamless and rewarding as possible.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center py-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Links to Third Party Sites/Third Party Services</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        <a href="https://www.mymiwallet.com">https://www.mymiwallet.com</a> may contain links to other websites ("Linked Sites"). The Linked Sites are not under the control of MyMI Wallet and MyMI Wallet is not responsible for the contents of any Linked Site, including without limitation any link contained in a Linked Site, or any changes or updates to a Linked Site. MyMI Wallet is providing these links to you only as a convenience, and the inclusion of any link does not imply endorsement by MyMI Wallet of the site or any association with its operators.
                                    </p>
                                    <p class="dark-text">
                                        Certain services made available via <a href="https://www.mymiwallet.com">https://www.mymiwallet.com</a> are delivered by third party sites and organizations. By using any product, service or functionality originating from the <a href="https://www.mymiwallet.com">https://www.mymiwallet.com</a> domain, you hereby acknowledge and consent that MyMI Wallet may share such information and data with any third party with whom MyMI Wallet has a contractual relationship to provide the requested product, service or functionality on behalf of <a href="https://www.mymiwallet.com">https://www.mymiwallet.com</a> users and customers.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center py-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>No Unlawful or Prohibited Use/Intellectual Property</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        You are granted a non-exclusive, non-transferable, revocable license to access and use <a href="https://www.mymiwallet.com">https://www.mymiwallet.com</a> strictly in accordance with these terms of use. As a condition of your use of the Site, you warrant to MyMI Wallet that you will not use the Site for any purpose that is unlawful or prohibited by these Terms. You may not use the Site in any manner which could damage, disable, overburden, or impair the Site or interfere with any other party's use and enjoyment of the Site. You may not obtain or attempt to obtain any materials or information through any means not intentionally made available or provided for through the Site.
                                    </p>
                                    <p class="dark-text">
                                        All content included as part of the Service, such as text, graphics, logos, images, as well as the compilation thereof, and any software used on the Site, is the property of MyMI Wallet or its suppliers and protected by copyright and other laws that protect intellectual property and proprietary rights. 
                                        You agree to observe and abide by all copyright and other proprietary notices, legends or other restrictions contained in any such content and will not make any changes thereto. 
                                        You will not modify, publish, transmit, reverse engineer, participate in the transfer or sale, create derivative works, or in any way exploit any of the content, in whole or in part, found on the Site. 
                                        MyMI Wallet content is not for resale. Your use of the Site does not entitle you to make any unauthorized use of any protected content, and in particular you will not delete or alter any proprietary rights or attribution notices in any content. 
                                        You will use protected content solely for your personal use, and will make no other use of the content without the express written permission of MyMI Wallet and the copyright owner. 
                                        You agree that you do not acquire any ownership rights in any protected content. 
                                        We do not grant you any licenses, express or implied, to the intellectual property of MyMI Wallet or our licensors except as expressly authorized by these Terms.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center py-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Use of Communication Services</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        The Site may contain bulletin board services, chat areas, news groups, forums, communities, personal web pages, calendars, and/or other message or communication facilities designed to enable you to communicate with the public at large or with a group (collectively, "Communication Services"). 
                                        You agree to use the Communication Services only to post, send and receive messages and material that are proper and related to the particular Communication Service.
                                    </p>
                                    <p class="dark-text">
                                        By way of example, and not as a limitation, you agree that when using a Communication Service, you will not: defame, abuse, harass, stalk, threaten or otherwise violate the legal rights (such as rights of privacy and publicity) of others; publish, post, upload, distribute or disseminate any inappropriate, profane, defamatory, infringing, obscene, indecent or unlawful topic, name, material or information; upload files that contain software or other material protected by intellectual property laws (or by rights of privacy of publicity) unless you own or control the rights thereto or have received all necessary consents; upload files that contain viruses, corrupted files, or any other similar software or programs that may damage the operation of another's computer; advertise or offer to sell or buy any goods or services for any business purpose, unless such Communication Service specifically allows such messages; conduct or forward surveys, contests, pyramid schemes or chain letters; download any file posted by another user of a Communication Service that you know, or reasonably should know, cannot be legally distributed in such manner; falsify or delete any author attributions, legal or other proper notices or proprietary designations or labels of the origin or source of software or other material contained in a file that is uploaded; restrict or inhibit any other user from using and enjoying the Communication Services; violate any code of conduct or other guidelines which may be applicable for any particular Communication Service; harvest or otherwise collect information about others, including e-mail addresses, without their consent; violate any applicable laws or regulations.
                                    </p>
                                    <p class="dark-text">
                                        MyMI Wallet has no obligation to monitor the Communication Services. 
                                        However, MyMI Wallet reserves the right to review materials posted to a Communication Service and to remove any materials in its sole discretion. 
                                        MyMI Wallet reserves the right to terminate your access to any or all of the Communication Services at any time without notice for any reason whatsoever.
                                    </p>
                                    <p class="dark-text">
                                        MyMI Wallet reserves the right at all times to disclose any information as necessary to satisfy any applicable law, regulation, legal process or governmental request, or to edit, refuse to post or to remove any information or materials, in whole or in part, in MyMI Wallet's sole discretion.
                                    </p>
                                    <p class="dark-text">
                                        Always use caution when giving out any personally identifying information about yourself or your children in any Communication Service. 
                                        MyMI Wallet does not control or endorse the content, messages or information found in any Communication Service and, therefore, MyMI Wallet specifically disclaims any liability with regard to the Communication Services and any actions resulting from your participation in any Communication Service. 
                                        Managers and hosts are not authorized MyMI Wallet spokespersons, and their views do not necessarily reflect those of MyMI Wallet.
                                    </p>
                                    <p class="dark-text">
                                        Materials uploaded to a Communication Service may be subject to posted limitations on usage, reproduction and/or dissemination. 
                                        You are responsible for adhering to such limitations if you upload the materials.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center py-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Materials Provided to https://www.mymiwallet.com or Posted on Any MyMI Wallet Web Page</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        MyMI Wallet does not claim ownership of the materials you provide to <a href="https://www.mymiwallet.com">https://www.mymiwallet.com</a> (including feedback and suggestions) or post, upload, input or submit to any MyMI Wallet Site or our associated services (collectively "Submissions"). However, by posting, uploading, inputting, providing or submitting your Submission you are granting MyMI Wallet, our affiliated companies and necessary sublicensees permission to use your Submission in connection with the operation of their Internet businesses including, without limitation, the rights to: copy, distribute, transmit, publicly display, publicly perform, reproduce, edit, translate and reformat your Submission; and to publish your name in connection with your Submission.<br>
                                        No compensation will be paid with respect to the use of your Submission, as provided herein. MyMI Wallet is under no obligation to post or use any Submission you may provide and may remove any Submission at any time in MyMI Wallet's sole discretion.<br>
                                        By posting, uploading, inputting, providing or submitting your Submission you warrant and represent that you own or otherwise control all of the rights to your Submission as described in this section including, without limitation, all the rights necessary for you to provide, post, upload, input or submit the Submissions.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center py-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Third Party Accounts</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        You will be able to connect your MyMI Wallet account to third party accounts. By connecting your MyMI Wallet account to your third party account, you acknowledge and agree that you are consenting to the continuous release of information about you to others (in accordance with your privacy settings on those third party sites). If you do not want information about you to be shared in this manner, do not use this feature.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center py-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>International Users</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        The Service is controlled, operated and administered by MyMI Wallet from our offices within the USA. If you access the Service from a location outside the USA, you are responsible for compliance with all local laws. You agree that you will not use the MyMI Wallet Content accessed through <a href="https://www.mymiwallet.com">https://www.mymiwallet.com</a> in any country or in any manner prohibited by any applicable laws, restrictions or regulations.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center py-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Arbitration</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        The parties agree that any dispute or claim arising out of or in connection with these Terms and Conditions shall be settled by binding arbitration in accordance with the rules of the American Arbitration Association. The arbitration shall be conducted by a single arbitrator appointed in accordance with such rules. The entire dispute, including the scope and enforceability of this arbitration provision, shall be determined by the arbitrator. This arbitration provision shall survive the termination of these Terms and Conditions.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center py-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Class Action Waiver</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Any arbitration under these Terms and Conditions will take place on an individual basis; class arbitrations and class/representative/collective actions are not permitted. The parties agree that a party may bring claims against the other only in each's individual capacity, and not as a plaintiff or class member in any putative class, collective, and/or representative proceeding, such as in the form of a private attorney general action against the other. Further, unless both you and MyMI Wallet agree otherwise, the arbitrator may not consolidate more than one person's claims and may not otherwise preside over any form of a representative or class proceeding.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center py-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>Liability Disclaimer</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        The information, software, products, and services included in or available through the site may include inaccuracies or typographical errors. Changes are periodically added to the information herein. MyMI Wallet Inc. and/or its suppliers may make improvements and/or changes in the site at any time.<br>
                                        MyMI Wallet Inc. and/or its suppliers make no representations about the suitability, reliability, availability, timeliness, and accuracy of the information, software, products, services, and related graphics contained on the site for any purpose. To the maximum extent permitted by applicable law, all such information, software, products, services, and related graphics are provided "as is" without warranty or condition of any kind.<br>
                                        MyMI Wallet Inc. and/or its suppliers hereby disclaim all warranties and conditions with regard to this information, software, products, services, and related graphics, including all implied warranties or conditions of merchantability, fitness for a particular purpose, title, and non-infringement.<br>
                                        To the maximum extent permitted by applicable law, in no event shall MyMI Wallet Inc. and/or its suppliers be liable for any direct, indirect, punitive, incidental, special, consequential damages or any damages whatsoever including, without limitation, damages for loss of use, data or profits, arising out of or in any way connected with the use or performance of the site, with the delay or inability to use the site or related services, the provision of or failure to provide services, or for any information, software, products, services, and related graphics obtained through the site, or otherwise arising out of the use of the site, whether based on contract, tort, negligence, strict liability or otherwise, even if MyMI Wallet Inc. or any of its suppliers has been advised of the possibility of damages. Because some states/jurisdictions do not allow the exclusion or limitation of liability for consequential or incidental damages, the above limitation may not apply to you. If you are dissatisfied with any portion of the site or with any of these terms of use, your sole and exclusive remedy is to discontinue using the site.
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
