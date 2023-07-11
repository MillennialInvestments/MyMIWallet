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
                                <span class="overline-title">Introducing</span>
                                <h1 class="title text-white" style="font-size:2.5rem">MyMI Wallet<br>Financial Education Management Blog and More!</h1>
                                <h2 class="subttitle text-white pb-3" style="font-size:1.5rem">Master Your Finances:<br>Personal Finance &amp; Investment Literacy</h2>
                                <!-- <h2 class="subttitle text-white pb-5">Investment Accounting/Analytical Software<br>Crypto Asset Marketplace &amp; Exchange</h1> -->
                                <p class="text-light">
                                    Unlock the power of effective budgeting and investment portfolio management with MyMI Wallet! 
                                    Learn the top strategies to maximize your finances to improve your wealth and achieve financial freedom. 
                                    Subscribe now for more News &amp; Updates on our exclusive tools, resources, and expert insights that will transform your financial journey.
                                    <!-- Our financial budgeting and forecasting tools are designed to help you manage your money and plan for the future. 
                                    <a href="#features">MyMI Wallet</a> make it easy to track your spending, create a budget, and see into your financial future.  -->
                                    <!-- We also provide features to help you make smart investments and plan for retirement. 
                                    Whether you want to save money, invest, or plan for the future, our tools can give you the information you need to make good financial decisions. 
                                    Give our tools a try and take control of your financial future. -->
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
                            <div class="card-body py-5">
                                <h2 class="pl-4 text-left">Table of Contents</h2>
                                <ul class="nav flex-column text-left nav-pills px-2" style="align-items:normal;" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true"><strong>News and Updates</strong></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false"><strong>Personal Budgeting</strong></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false"><strong>Investment Portfolio Management</strong></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab4-tab" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false"><strong>IRS / Managing Taxes</strong></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-bordered">
                            <div class="card-body pb-5">
                                <h2>Related Links</h2>
                                <ul class="nav flex-column nav-pills px-2" id="myTab" role="tablist">
                                    <li class="nav-item"><a class="nav-link pl-3 pr-0" href="<?php echo site_url('/Blog/Personal-Budgeting/The-Importance-of-Personal-Financial-Budgeting'); ?>" id="tab1-tab"><strong>The Importance of Personal Financial Budgeting</strong></a></li>
                                    <li class="nav-item"><a class="nav-link pl-3 pr-0" href="<?php echo site_url('/Blog/Investing/The-Fundamentals-Of-Investing'); ?>" id="tab1-tab"><strong>The Fundamentals Of Investing</strong></a></li>
                                    <li class="nav-item"><a class="nav-link pl-3 pr-0" href="<?php echo site_url('/Blog/IRS/IRS-Expanded-Home-Energy-Tax-Credits'); ?>" id="tab1-tab"><strong>IRS Announces Expanded Home Energy Tax Credits</strong></a></li>
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
                                    <span class="overline-title intro-section-subtitle">MyMI Wallet<br>Financial Education Management Blog and More!</span>
                                    <h3 class="intro-heading-lead">News and Updates</h3>
                                    <div class="intro-section-desc">
                                        <p class="dark-text">
                                            In today's ever-evolving financial landscape, effective investment portfolio management plays a crucial role in achieving long-term financial success. 
                                            Managing your investments wisely can help you grow your wealth, secure your future, and achieve your financial goals. 
                                            This comprehensive guide will provide you with essential insights into the world of investment portfolio management, ensuring you make informed decisions and adopt the right strategies to optimize your investment returns.
                                        </p>                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>1. The Roadmap to the Future of Finance:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        We're thrilled to unveil the MyMI Wallet Service & Solution Roadmap, outlining our vision for the future of finance. 
                                        This roadmap showcases our commitment to providing innovative financial tools and services, from personal budgeting to cryptocurrency asset creation. 
                                        In this blog post, we'll dive into each solution and the value it brings to our users.
                                    </p>                  
                                    <a class="btn btn-primary text-white float-right" href="<?php echo site_url('/Blog/News-And-Updates/The-Roadmap-To-The-Future-Of-Finance'); ?>">Read More...</a>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>2. Integrating With Plaid:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        We're excited to announce that MyMI Wallet has successfully integrated with Plaid, a leading financial data platform. 
                                        This integration brings a wealth of new capabilities to our users, further enhancing the MyMI Wallet experience in managing personal budgeting and investment portfolio management solutions. 
                                        In this blog post, we'll explore the features Plaid provides and how they benefit MyMI Wallet users.
                                    </p>                  
                                    <a class="btn btn-primary text-white float-right" href="<?php echo site_url('/Blog/News-And-Updates/Integrating-With-Plaid'); ?>">Read More...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane pb-5 fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                        <div class="row justify-content-center pb-5">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <span class="overline-title intro-section-subtitle">MyMI Wallet<br>Financial Education Management Blog and More!</span>
                                    <h3 class="intro-heading-lead">Personal Budgeting</h3>
                                    <div class="intro-section-desc">
                                        <p class="dark-text">
                                            Budgeting is often misunderstood, with numerous misconceptions surrounding its purpose and implementation. 
                                            These myths can deter individuals from taking advantage of the benefits that budgeting can provide. 
                                            In this section, we will debunk some common budgeting myths and reveal the truth behind these misconceptions. 
                                            By understanding the real purpose and power of budgeting, you can start making informed decisions and take control of your financial future.
                                        </p>                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>1. Importance of Personal Budgeting:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Discover the power of personal financial budgeting and unlock the secrets to a more secure and prosperous financial future. 
                                        In this comprehensive guide, we'll explore the benefits of budgeting, dispel common myths, and provide you with practical advice to create a budget that works for your unique circumstances.
                                    </p>    
                                    <a class="btn btn-primary text-white float-right" href="<?php echo site_url('Blog/Personal-Budgeting/The-Importance-of-Personal-Financial-Budgeting'); ?>">Read More...</a>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane pb-5 fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                        <div class="row justify-content-center pb-5">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <span class="overline-title intro-section-subtitle">MyMI Wallet<br>Financial Education Management Blog and More!</span>
                                    <h3 class="intro-heading-lead">Investment Portfolio Management</h3>
                                    <div class="intro-section-desc">
                                        <p class="dark-text">
                                            {ENTER DESCRIPTION HERE}
                                        </p>                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>1. The Fundamentals of Investing:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Introducing "The Fundamentals of Investing" - a comprehensive guide designed to provide you with a solid foundation in the world of investing. 
                                        Whether you're new to investing or looking to refine your knowledge, this guide covers essential topics such as setting financial goals, understanding risk and reward, diversifying your investments, choosing the right investment vehicles, and building a well-balanced investment portfolio.
                                    </p>      
                                    <a class="btn btn-primary text-white float-right" href="<?php echo site_url('/Blog/Investing/The-Fundamentals-Of-Investing'); ?>">Read More...</a>  
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>2. Tips for Effective Investment Portfolio Management:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Unlock the power of effective investment portfolio management with MyMI Wallet! 
                                        Learn the top strategies to maximize your wealth and achieve financial freedom. 
                                        Subscribe now for more News &amp; Updates on our exclusive tools, resources, and expert insights that will transform your financial journey.
                                    </p>      
                                    <a class="btn btn-primary text-white float-right" href="<?php echo site_url('Blog/Investing/Tips-For-Effective-Investment-Portfolio-Management'); ?>">Read More...</a>  
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>3. The Beginner's Guide to Option Trading:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        At MyMIWallet, we firmly believe in equipping our users with the knowledge and tools necessary to navigate the complex yet rewarding world of options trading. 
                                        This guide aims to elucidate the intricacies of options trading, simplifying key concepts, strategies, and their incorporation into your broader investment portfolio. 
                                        Whether you're a seasoned investor keen on diversifying your strategy or a novice trader just dipping your toes into the financial markets, this guide will offer valuable insights into the dynamic realm of options trading. 
                                    </p>   
                                    <a class="btn btn-primary text-white float-right" href="<?php echo site_url('Blog/Investing/The-Beginners-Guide-To-Option-Trading'); ?>">Read More...</a>     
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane pb-5 fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                        <div class="row justify-content-center pb-5">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <span class="overline-title intro-section-subtitle">MyMI Wallet<br>Financial Education Management Blog and More!</span>
                                    <h3 class="intro-heading-lead">The IRS and Managing Taxes</h3>
                                    <div class="intro-section-desc">
                                        <p class="dark-text">
                                            {ENTER DESCRIPTION HERE}
                                        </p>                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>1. IRS Expanded Home Energy Tax Credits:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        The Internal Revenue Service (IRS) has expanded home energy tax credits presenting a golden opportunity for homeowners and renters to save money while making energy-efficient improvements to their homes. 
                                        Read on to discover how you can qualify for these tax credits and reduce your carbon footprint.
                                    </p>   
                                    <a class="btn btn-primary text-white float-right" href="<?php echo site_url('Blog/IRS/IRS-Expanded-Home-Energy-Tax-Credits'); ?>">Read More...</a>    
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>2. Sector and Industry Diversification:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Within each asset class, further diversify your investments across various sectors and industries. 
                                        This can help protect your portfolio from negative developments in a specific sector or industry, such as regulatory changes, technological disruptions, or economic downturns.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>3. Geographic Diversification:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        By investing in different countries and regions, you can reduce the impact of localized economic or political events on your portfolio. 
                                        Global diversification can help protect your investments from country-specific risks and provide exposure to growth opportunities in emerging markets.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>4. Investment Style Diversification:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Different investment styles, such as value, growth, and income investing, can perform differently under various market conditions. 
                                        Diversifying across investment styles can help reduce the impact of market fluctuations on your portfolio and potentially enhance returns.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>5. Diversification Through Investment Vehicles:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Consider using various investment vehicles, such as individual stocks and bonds, mutual funds, exchange-traded funds (ETFs), and real estate investment trusts (REITs), to further diversify your portfolio. 
                                        These investment vehicles offer different levels of risk, return, and liquidity, enabling you to tailor your portfolio to your specific needs and objectives.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>6. Periodic Rebalanceing:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Over time, market movements and changes in the value of your investments can cause your portfolio's asset allocation to drift from your original target. 
                                        Regularly rebalancing your portfolio by adjusting your investments to maintain your desired asset allocation can help ensure that your portfolio remains diversified and aligned with your risk tolerance and investment objectives.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        By harnessing the power of diversification, you can build a resilient and well-balanced investment portfolio that is better positioned to weather market fluctuations and economic downturns, improving your chances of achieving long-term financial success.
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
