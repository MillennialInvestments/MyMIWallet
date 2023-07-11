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
<div class="pb-3 bg-dark intro-banner">
    <div class="container pt-3">
        <div class="row justify-content-center pt-1">
            <div class="col-lg-6 col-xl-6 col-md-12">
                <div class="intro-banner-wrap">
                    <div class="intro-banner-inner text-center">
                        <div class="intro-banner-desc py-lg-5 py-md-2">
                            <div class="row">
                                <span class="overline-title">News &amp; Updates</span>
                                <h1 class="text-white title" style="font-size:2.5rem">MyMI Wallet: Integrating with Plaid</h1>
                                <h2 class="pb-3 subttitle text-white" style="font-size:1.5rem"><small>Enhanced Personal Budgeting and Investment Portfolio Management</small></h2>
                                <p class="text-light">
                                    We're excited to announce that MyMI Wallet has successfully integrated with Plaid, a leading financial data platform. 
                                    This integration brings a wealth of new capabilities to our users, further enhancing the MyMI Wallet experience in managing personal budgeting and investment portfolio management solutions. 
                                    In this blog post, we'll explore the features Plaid provides and how they benefit MyMI Wallet users.
                                </p>
                                <div class="row intro-action-group mt-3">
                                    <div class="col-12">
                                        <h2 class="pb-3 subttitle text-white" style="font-size:1.5rem">Connect with Us on Social Media</h2>
                                    </div>
                                    <div class="col-12">
                                        <a class="btn btn-primary mr-2" href="https://www.facebook.com/MyMIWalletNews" target="_blank">Facebook</a>
                                        <a class="btn btn-primary mr-2" href="https://www.twitter.com/MyMIWallet" target="_blank">Twitter</a>
                                        <a class="btn btn-primary mr-2" href="https://www.youtube.com/@MyMIWallet" target="_blank">YouTube</a>
                                        <a class="btn btn-primary" href="https://discord.gg/UUMexvA" target="_blank">Discord</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6 d-lg-block d-md-none pl-5">
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
<div class="text-center bg-white intro-overview intro-section">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-3 col-xl-3 d-md-block d-none px-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-bordered">
                            <div class="card-body py-5">
                                <h2 class="text-left pl-4">Table of Contents</h2>
                                <ul class="flex-column nav nav-pills px-2 text-left" id="myTab" role="tablist" style="align-items:normal">
                                    <li class="nav-item"><a class="nav-link active" href="#tab1" id="tab1-tab" role="tab" aria-controls="tab1" aria-selected="true" data-toggle="tab"><strong>Section 1: What is Plaid?</strong></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab2" id="tab2-tab" role="tab" aria-controls="tab2" aria-selected="false" data-toggle="tab"><strong>Section 2: Enhancing Financial Management</strong></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab3" id="tab3-tab" role="tab" aria-controls="tab3" aria-selected="false" data-toggle="tab"><strong>Section 3: Creating Your Personal Budget</strong></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab4" id="tab4-tab" role="tab" aria-controls="tab4" aria-selected="false" data-toggle="tab"><strong>Section 4: Tips for Sticking to Your Budget</strong></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab5" id="tab5-tab" role="tab" aria-controls="tab5" aria-selected="false" data-toggle="tab"><strong>Section 5: Role of Budgeting in Long-Term Financial Planning</strong></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-bordered">
                            <div class="card-body pb-5">
                                <h2 class="text-left pl-4">Related Links</h2>
                                <ul class="flex-column nav nav-pills px-2 text-left" id="myTab" role="tablist" style="align-items:normal">
                                    <li class="nav-item"><a class="nav-link pl-3 pr-0" href="<?php echo site_url('/Blog/Personal-Budgeting/The-Importance-of-Personal-Financial-Budgeting'); ?>" id="tab1-tab"><strong>The Importance of Personal Financial Budgeting</strong></a></li>
                                    <li class="nav-item"><a class="nav-link pl-3 pr-0" href="<?php echo site_url('/Blog/Investing/The-Fundamentals-Of-Investing'); ?>" id="tab1-tab"><strong>The Fundamentals Of Investing</strong></a></li>
                                    <li class="nav-item"><a class="nav-link pl-3 pr-0" href="<?php echo site_url('/Blog/Investing/Tips-For-Effective-Investment-Portfolio-Management'); ?>" id="tab1-tab"><strong>Tips for Effective Investment Portfolio Management</strong></a></li>
                                    <!-- Add more related links if desired -->
                                </ul>
                                <!-- Add the content of your blog post here -->
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
                                    <span class="overline-title intro-section-subtitle">MyMI Wallet: Integrating with Plaid</span>
                                    <h3 class="intro-heading-lead">What is Plaid?</h3>
                                    <div class="intro-section-desc">
                                        <p class="dark-text">
                                            Plaid is a financial technology company that enables applications to connect with users' bank accounts. 
                                            By integrating with Plaid, MyMI Wallet can securely access users' financial information, providing a seamless experience for managing personal budgeting and investment portfolio management. 
                                            Plaid's platform connects to thousands of financial institutions, allowing users to easily link their bank accounts and enjoy the enhanced features offered by MyMI Wallet.
                                        </p>                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>1. What is Plaid and How Does It Enhance MyMI Wallet?:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Plaid is a leading financial technology company that serves as a bridge between applications and users' bank accounts. 
                                        It specializes in enabling applications to access and manage users' financial data securely and efficiently. 
                                        In this section, we'll take a closer look at Plaid's functionalities and how its integration with MyMI Wallet elevates the user experience in managing personal budgeting and investment portfolio management.
                                    </p>  
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <p class="dark-text">Benefits of Plaid Integration:</p>
                                <ul class="list list-sm list-checked" style="justify-content:normal;">
                                    <li><strong class="list-blue-header pl-3">Enhanced account connectivity:</strong> <span class="text-black">Plaid enables seamless connections to thousands of financial institutions, ensuring that MyMI Wallet users can quickly and securely access their financial data for improved budgeting and investment portfolio management.</span></li>
                                </ul>
                                <ul class="list list-sm list-checked" style="justify-content:normal;">
                                    <li><strong class="list-blue-header pl-3">Improved transaction data:</strong> <span class="text-black">Plaid's robust transaction categorization allows users to better understand and manage their spending habits, helping them to make more informed decisions about their budget and investment strategy.</span></li>
                                </ul>
                                <ul class="list list-sm list-checked" style="justify-content:normal;">
                                    <li><strong class="list-blue-header pl-3">Real-time balance updates:</strong> <span class="text-black">With Plaid, MyMI Wallet users can access their account balances in real-time, enabling better financial decision-making and timely adjustments to their budget and investment plan.</span></li>
                                </ul>
                                <ul class="list list-sm list-checked" style="justify-content:normal;">
                                    <li><strong class="list-blue-header pl-3">Identity verification:</strong> <span class="text-black">Plaid's identity verification capabilities help to ensure user security and prevent fraudulent activity, creating a safe environment for managing finances and investments.</span></li>
                                </ul>
                                <ul class="list list-sm list-checked" style="justify-content:normal;">
                                    <li><strong class="list-blue-header pl-3">Streamlined lending:</strong> <span class="text-black">Plaid facilitates the lending process by providing lenders with accurate, up-to-date financial information on potential borrowers, making it easier for MyMI Wallet users to secure loans for personal or investment purposes.</span></li>
                                </ul>
                                <ul class="list list-sm list-checked" style="justify-content:normal;">
                                    <li><strong class="list-blue-header pl-3">Simplified payment initiation:</strong> <span class="text-black">Plaid's payment initiation features make it easier for MyMI Wallet users to send and receive money, streamlining transactions related to their budget and investment activities.</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>2. Securely Connecting to Financial Institutions:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Plaid's primary role is to provide a secure connection between users' bank accounts and applications like MyMI Wallet. 
                                        By connecting to thousands of financial institutions, Plaid allows MyMI Wallet users to easily link their bank accounts, credit cards, and other financial accounts to the platform. 
                                        This seamless connectivity ensures that users can enjoy a streamlined experience while managing their finances.
                                    </p>  
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>3. Data Security and Privacy:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Plaid prioritizes data security and privacy. It employs state-of-the-art encryption methods and practices to protect users' financial information. 
                                        With Plaid's integration, MyMI Wallet users can trust that their data is safe and secure when accessing and managing their personal budgeting and investment portfolio.
                                    </p>          
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>4. Enhanced Financial Management Features:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Plaid's robust features and services have a direct impact on the functionality and convenience of MyMI Wallet. 
                                        For example, Plaid's transaction categorization helps users understand their spending habits better, leading to more informed budgeting and investment decisions. 
                                        Real-time balance updates and payment initiation features further streamline the user experience, ensuring efficient financial management.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>5. Unlocking New Opportunities:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Plaid's ability to securely access users' financial information creates new opportunities for MyMI Wallet users. 
                                        Streamlined lending processes, identity verification, and access to asset and liability data provide a comprehensive financial overview, empowering users to make better decisions regarding their personal budgeting and investment portfolio management.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>6. In Conclusion:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        In summary, Plaid's integration with MyMI Wallet significantly enhances the platform's capabilities, providing users with a more powerful, efficient, and secure financial management experience. 
                                        By leveraging Plaid's functionalities, MyMI Wallet users can enjoy a seamless and comprehensive solution for managing their personal budgeting and investment portfolio.
                                    </p>    
                                    <p class="dark-text"> 
                                        And don't forget to register to our website, MyMIWallet, for more personalized budgeting and investment portfolio management news and financial solutions!
                                    </p>    
                                    <!-- <p class="dark-text">
                                        Together, let's create a greener and financially prosperous future!
                                    </p>       -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane pb-5 fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                        <div class="row justify-content-center pb-5">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <span class="overline-title intro-section-subtitle">MyMI Wallet: Integrating with Plaid</span>
                                    <h3 class="intro-heading-lead">Enhancing Financial Management<br>With Automation and Plaid</h3>
                                    <div class="intro-section-desc">
                                        <p class="dark-text">
                                            Switching from manual entry to automated integrations and updates with the Plaid Platform allows MyMI Wallet to provide a more efficient and user-friendly experience. 
                                            By integrating with Plaid, MyMI Wallet can access up-to-date financial data directly from users' bank accounts, streamlining the process of personal budgeting and investment portfolio management. 
                                            Here's how we plan to use Plaid's resources to enhance our platform:
                                        </p>                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>1. Optimizing Personal Budgeting:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        By automating the process of gathering transaction data and account balances, MyMI Wallet users can easily track their expenses and income in real-time. 
                                        Plaid's advanced transaction categorization also helps users to understand their spending patterns, enabling them to create personalized budgets that better align with their financial goals.
                                    </p>  
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>2. Introducing Users to Investments:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        MyMI Wallet aims to educate users on the benefits of investing and how it can contribute to financial wealth and freedom. 
                                        By integrating Plaid's Assets feature, users can gain insights into their current investments, allowing them to make informed decisions about their investment strategy.
                                    </p>  
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>3. Providing Tools for Investment Portfolio Management:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Plaid's platform offers access to a wide range of financial data, which MyMI Wallet will leverage to provide users with comprehensive tools for managing their investment portfolios. 
                                        Users can track the performance of their investments, receive alerts on significant changes, and access in-depth analysis to make data-driven decisions.
                                    </p>          
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>4. Partnering with Industry Experts:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        To ensure a complete financial management solution, MyMI Wallet plans to collaborate with industry experts and partners. 
                                        These collaborations will fill any gaps in our offerings and provide users with a well-rounded financial management experience, regardless of their background or expertise in personal budgeting or investment portfolio management.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>5. Unlocking New Opportunities:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Plaid's ability to securely access users' financial information creates new opportunities for MyMI Wallet users. 
                                        Streamlined lending processes, identity verification, and access to asset and liability data provide a comprehensive financial overview, empowering users to make better decisions regarding their personal budgeting and investment portfolio management.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>6. In Conclusion:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        MyMI Wallet's integration with Plaid represents a significant step forward for our platform, providing users with a more powerful, efficient, and secure financial management experience. 
                                        By utilizing Plaid's resources and tools, we aim to offer our members autonomous tools to help develop a customized financial roadmap to financial wealth and freedom.
                                    </p>    
                                    <p class="dark-text"> 
                                        To learn more about Plaid's features and how they benefit MyMI Wallet users, visit the Plaid documentation: <a href="https://plaid.com/docs/api">https://plaid.com/docs/api</a>.
                                    </p>  
                                    <p class="dark-text"> 
                                        To access the Power of MyMI Wallet and Plaid, register by clicking below for more personalized budgeting and investment portfolio management solutions and financial news!
                                    </p>   
                                    <!-- <p class="dark-text">
                                        Together, let's create a greener and financially prosperous future!
                                    </p>       -->
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
                                            To access the Power of MyMI Wallet and Plaid, register by clicking below to deep dive into our personalized budgeting, investment portfolio management solutions and financial news!
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