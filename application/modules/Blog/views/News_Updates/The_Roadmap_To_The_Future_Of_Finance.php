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
                                <span class="overline-title">News & Updates</span>
                                <h1 class="text-white title"style="font-size:2.5rem">MyMI Wallet: The Roadmap To The Future Of Finance</h1>
                                <h2 class="text-white pb-3 subttitle"style="font-size:1.5rem"><small>Discover Our Exciting Service & Solution Roadmap</small></h2>
                                <p class="text-light">
                                    We're thrilled to unveil the MyMI Wallet Service & Solution Roadmap, outlining our vision for the future of finance. 
                                    This roadmap showcases our commitment to providing innovative financial tools and services, from personal budgeting to cryptocurrency asset creation. 
                                    In this blog post, we'll dive into each solution and the value it brings to our users.
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
                                    <li class="nav-item"><a class="nav-link active" href="#tab1" id="tab1-tab" role="tab" aria-controls="tab1" aria-selected="true" data-toggle="tab"><strong>Introduction: Our Solutions at MyMI Wallet</strong></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab2" id="tab2-tab" role="tab" aria-controls="tab2" aria-selected="false" data-toggle="tab"><strong>Section 2: Personal Financial Budgeting</strong></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab3" id="tab3-tab" role="tab" aria-controls="tab3" aria-selected="false" data-toggle="tab"><strong>Section 3: Investment Portfolio Management</strong></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab4" id="tab4-tab" role="tab" aria-controls="tab4" aria-selected="false" data-toggle="tab"><strong>Section 4: Our Integration with Plaid</strong></a></li>
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
                                    <span class="overline-title intro-section-subtitle">MyMI Wallet: The Roadmap To The Future Of Finance</span>
                                    <h3 class="intro-heading-lead">Introducing Our Solutions</h3>
                                    <div class="intro-section-desc">
                                        <p class="dark-text">
                                            Our roadmap includes a variety of financial solutions designed to empower users and transform the way they manage their finances. 
                                            Ranging from personal budgeting tools to cryptocurrency asset marketplaces, our platform aims to provide a comprehensive suite of services to cater to the diverse needs of our users. 
                                            Here's a glimpse of the exciting solutions we plan to develop and release:
                                        </p>                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>1. Personal Financial Budgeting:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Our Personal Financial Budgeting tool helps users create and manage budgets effortlessly, track expenses, set financial goals, and monitor progress. 
                                        With an intuitive interface and personalized recommendations, users can stay on track and make informed decisions for a secure financial future.
                                    </p>  
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>2. Investment Portfolio Management:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        MyMI Wallet's Investment Portfolio Management tools enable users to build and manage diverse investment portfolios. 
                                        Our platform offers features like risk assessment, asset allocation, and performance tracking, empowering users to make data-driven decisions and optimize their investments for long-term growth.
                                    </p>  
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>3. Integrating with Plaid:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        MyMI Wallet's Investment Portfolio Management tools enable users to build and manage diverse investment portfolios. 
                                        Our platform offers features like risk assessment, asset allocation, and performance tracking, empowering users to make data-driven decisions and optimize their investments for long-term growth.
                                    </p>  
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>4. Financial Data Compilation:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Our Financial Data Compilation service collects users' financial data from various sources, including bank accounts, credit cards, and investment portfolios. 
                                        This aggregated data is then analyzed and presented in a comprehensive dashboard, allowing users to gain valuable insights into their financial health.
                                    </p>          
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>5. Financial Bank Service:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        MyMI Wallet's Financial Bank Service offers seamless integration with banking and investment institutions, enabling users to access and manage their accounts through a single, unified platform. 
                                        This simplifies the user experience, making it easy to track financial transactions and stay updated on their overall financial situation.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>6. MyMI Wallet: CFA Collaboration Association (CCA):</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        We're committed to establishing partnerships with Certified Financial Analysts (CFA) and other industry professionals, fostering a collaborative environment for our members. 
                                        This network of experts will provide valuable insights, advice, and resources to help users optimize their financial planning and investment strategies.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>7. Asset Creator (Cryptocurrency Creator):</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Our Asset Creator solution will enable users to create and launch their own cryptocurrencies, opening up new opportunities for fundraising, asset management, and investment. 
                                        With a user-friendly interface and comprehensive support, MyMI Wallet aims to democratize access to the world of digital assets.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>8. Asset Marketplace:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        The MyMI Wallet Asset Marketplace will serve as a hub for users to buy, sell, and trade a wide range of digital assets, including cryptocurrencies, real estate-backed crypto assets, and municipal bond-backed crypto assets. 
                                        Our goal is to provide a secure, transparent, and user-friendly marketplace for all participants.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>9. Asset Exchange:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Our Asset Exchange will facilitate the trading of digital assets in a second-hand public market, providing users with a seamless and efficient platform to manage their investments. 
                                        With advanced security features and a focus on user experience, the MyMI Wallet Asset Exchange aims to revolutionize the way users trade digital assets.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>10. Private Equity Investments:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        MyMI Wallet plans to offer users access to private equity investment opportunities, allowing them to diversify their portfolios and tap into the growth potential of emerging companies. 
                                        This solution will democratize access to private equity, providing users with a wider range of investment options to suit their risk preferences and financial goals.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>11. Charitable Giving and Social Impact:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        MyMI Wallet is committed to fostering social responsibility and making a positive impact on our communities. 
                                        We plan to introduce a charitable giving feature, allowing users to easily donate to their favorite causes and track their contributions. 
                                        This will encourage users to become more engaged in philanthropic activities and support organizations that align with their values and interests.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>12. In Conclusion:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        The MyMI Wallet Service & Solution Roadmap is designed to provide users with a comprehensive suite of tools and services for managing their personal finances and investments. 
                                        As we continue to develop and expand our platform, we remain committed to delivering innovative, user-friendly solutions that empower individuals to take control of their financial future. 
                                        We're excited about the journey ahead and look forward to welcoming new users to the MyMI Wallet community.
                                    </p>    
                                    <p class="dark-text"> 
                                        Stay tuned for updates on our progress, and don't forget to register on our website, MyMIWallet, for the latest news and developments in personal finance and investment management.
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
                                    <span class="overline-title intro-section-subtitle">MyMI Wallet: The Roadmap To The Future Of Finance</span>
                                    <h3 class="intro-heading-lead">Personal Financial Budgeting:</h3>
                                    <div class="intro-section-desc">
                                        <p class="dark-text">
                                            Our Personal Budgeting solutions form a cornerstone of the MyMI Wallet platform, offering users an integrated suite of tools to effectively manage their finances. 
                                            From tracking spending to setting saving goals, our solutions are designed to give you full control over your financial life. 
                                            Here's an in-depth look at the features we're excited to share:
                                        </p>                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="justify-content-center row pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>1. Expense Tracking:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        The backbone of our Personal Budgeting solution, the expense tracking feature, offers real-time monitoring of your spending habits. 
                                        By connecting your financial accounts to MyMI Wallet, the tool will automatically categorize and log your expenses, helping you understand where your money goes each month.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>2. Budget Creation and Management:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        MyMI Wallet allows users to create personalized budgets based on their income, expenses, and financial goals. 
                                        Our platform provides an easy-to-use interface to adjust and manage budgets, accommodating changes in financial circumstances or goals.
                                    </p>  
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>3. Goal Setting and Progress Tracking:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Our goal setting feature empowers users to define their financial objectives, whether it's saving for a house, planning a vacation, or preparing for retirement. 
                                        With progress tracking, users can monitor their advancement towards these goals, making necessary adjustments to stay on track.
                                    </p>          
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>4. Debt Management:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        A crucial aspect of personal finance is managing and reducing debt. 
                                        Our debt management tool will help users keep track of their liabilities, offering customized strategies for debt reduction based on their income, interest rates, and repayment capabilities.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>5. Savings Forecasting:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        By analyzing your income, expenses, and saving habits, our savings forecasting tool provides a projection of your future savings. 
                                        This feature can assist users in making informed decisions about their spending and saving strategies to achieve their long-term financial goals.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>6. Alerts and Notifications:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        To keep users informed and proactive, our platform sends real-time alerts and notifications regarding budget limits, goal progress, and potential savings opportunities.
                                        This feature ensures users are always aware of their financial situation, enabling them to make timely and informed decisions.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>7. Integration with Other MyMI Wallet Services:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Our Personal Budgeting tools are seamlessly integrated with the other services offered by MyMI Wallet. 
                                        Users can easily track their investment performance, check the value of their digital assets, and monitor their overall financial health, all from within the same platform.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>8. Privacy and Security:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        At MyMI Wallet, we understand the importance of keeping your financial data safe. 
                                        Our platform employs advanced security measures and encryption technologies to protect your data and privacy.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>9. In Conclusion:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Personal Budgeting with MyMI Wallet is designed to empower users to take control of their financial life. With our comprehensive suite of tools, users can gain a clearer understanding of their spending habits, set and track financial goals, manage debt, and forecast savings. 
                                        We believe that effective personal budgeting is a crucial step towards achieving financial freedom, and we're excited to facilitate this journey for our users.
                                    </p>    
                                    <p class="dark-text"> 
                                    Stay tuned for more exciting features and services we plan to introduce. Don't forget to register your account to stay updated on the latest developments and features related to personal budgeting and financial management.
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
                    <div class="tab-pane pb-5 fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                        <div class="row justify-content-center pb-5">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <span class="overline-title intro-section-subtitle">MyMI Wallet: The Roadmap To The Future Of Finance</span>
                                    <h3 class="intro-heading-lead">Investment Portfolio Management:</h3>
                                    <div class="intro-section-desc">
                                        <p class="dark-text">
                                            Investment Portfolio Management is a crucial aspect of our financial roadmap. 
                                            This feature at MyMI Wallet is designed to simplify the complex process of managing diverse investment portfolios, making it accessible and manageable for users of all experience levels. 
                                            With a robust set of features, we aim to provide users with a clear perspective of their investments and the tools to optimize them for long-term growth.
                                        </p>                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="justify-content-center row pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>1. The Power of Customization:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Every investor's needs are unique, and their portfolio management tools should reflect that. 
                                        Our platform allows users to customize their portfolios to align with their individual financial goals and risk tolerance. 
                                        Users can include a variety of asset classes, from stocks and bonds to cryptocurrencies, and manage them all seamlessly through our platform.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>2. Risk Assessment and Management:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        MyMI Wallet's risk assessment feature provides a comprehensive analysis of the potential risks associated with each investment. This empowers users to make informed decisions and create a balanced portfolio that aligns with their risk tolerance. 
                                        Our system uses advanced algorithms and real-time market data to evaluate and manage risk effectively.
                                    </p>  
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>3. Asset Allocation:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                            Understanding the importance of a well-diversified portfolio, we offer features that guide users in effective asset allocation. 
                                            Our platform provides clear and intuitive information about different asset classes and their historical performance, enabling users to allocate their assets strategically and maintain a healthy, diversified portfolio.
                                    </p>          
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>4. Performance Tracking:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Investors need to keep a close eye on their portfolio's performance to make timely adjustments. 
                                        MyMI Wallet provides real-time tracking and detailed analytics of portfolio performance, offering insights into individual asset performance, total returns, and comparative market benchmarks. 
                                        This data-driven approach allows users to make informed decisions and optimize their investments.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>5. Integrating with Plaid:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        In order to provide a seamless experience for users, MyMI Wallet's Investment Portfolio Management tools are integrated with Plaid, a leading data network that connects consumers, financial institutions, and developers. 
                                        This integration ensures secure and efficient data transfer, allowing users to link their external bank and investment accounts to their MyMI Wallet. 
                                        With Plaid, users can access all their financial information in one place, facilitating comprehensive portfolio management.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>6. Portfolio Advisory:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Beyond just providing tools, MyMI Wallet also offers portfolio advisory services. 
                                        Our partnership with Certified Financial Analysts (CFA) and industry professionals enables us to provide expert advice and personalized portfolio recommendations to our users, ensuring they make the most of their investments.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>9. In Conclusion:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Investment Portfolio Management at MyMI Wallet is more than just a tool—it's a comprehensive solution designed to empower users in their investment journey. 
                                        We strive to offer a robust, user-friendly platform that simplifies portfolio management, providing users with the insights and resources they need to achieve their financial goals.
                                    </p>    
                                    <p class="dark-text"> 
                                        Stay connected with us for more updates on our Investment Portfolio Management tools and features. 
                                        Don't forget to register your account to stay updated on the latest developments and features related to personal budgeting and financial management.
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
                    <div class="tab-pane pb-5 fade" id="tab4" role="tabpanel" aria-labelledby="tab3-tab">
                        <div class="row justify-content-center pb-5">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <span class="overline-title intro-section-subtitle">MyMI Wallet: The Roadmap To The Future Of Finance</span>
                                    <h3 class="intro-heading-lead">Our Integration with Plaid:</h3>
                                    <div class="intro-section-desc">
                                        <p class="dark-text">
                                            To fully understand the value and capabilities of MyMI Wallet, it's crucial to acknowledge the role of Plaid, a technological powerhouse that is a key part of our platform's infrastructure.
                                        </p>                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="justify-content-center row pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>1. Plaid: The Driving Force Behind Seamless Financial Integration:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Plaid is a technology company that serves as a bridge between financial applications, such as MyMI Wallet, and users' bank accounts. 
                                        It provides the necessary infrastructure to power the digital financial ecosystem, enabling account authentication, account balance checking, identity confirmation, and transaction verification. 
                                        Plaid's technology is an essential ingredient in the recipe for financial platforms, providing the necessary connectivity and security to facilitate seamless and secure transactions.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>2. The MyMI Wallet and Plaid Collaboration: Empowering Users:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        MyMI Wallet leverages the powerful technology provided by Plaid to deliver a top-notch financial experience to our users. 
                                        This collaboration allows MyMI Wallet to integrate users' financial accounts and facilitate secure transactions. Here's how it works:
                                    </p>  
                                </div>
                                <div class="intro-section-subtitle pt-5">
                                    <h5 class="subtitle"><strong>Integration of Financial Institutions:</strong></h5>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Thanks to Plaid's technology, MyMI Wallet allows users to seamlessly integrate their bank accounts, credit cards, and investment portfolios. 
                                        This integration forms the basis of our Financial Data Compilation service and enables us to provide users with a unified platform for managing their finances.
                                    </p>          
                                </div>
                                <div class="intro-section-subtitle pt-5">
                                    <h5 class="subtitle"><strong>Secure Transactions:</strong></h5>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Plaid's secure infrastructure enables MyMI Wallet to facilitate transactions with confidence. 
                                        Users can securely transfer funds, pay bills, and make investments, all within the MyMI Wallet platform. 
                                        Plaid's technology ensures that all transactions are securely processed, protecting users' financial data and maintaining the integrity of their financial activities.
                                    </p>          
                                </div>
                                <div class="intro-section-subtitle pt-5">
                                    <h5 class="subtitle"><strong>Innovative Financial Tools:</strong></h5>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        By integrating with Plaid, MyMI Wallet is able to offer a host of innovative financial tools. 
                                        From our Personal Financial Budgeting tool and Investment Portfolio Management tool to our Asset Creator tool, Plaid's technology empowers us to provide users with an all-in-one financial management platform.
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
                                        Our integration with Plaid is a key aspect of MyMI Wallet's functionality. 
                                        It enables us to offer users a comprehensive, secure, and intuitive platform for managing their finances. 
                                        With Plaid's technology, we're able to deliver on our promise of providing a revolutionary financial platform that empowers users to take control of their financial future. 
                                        As we continue on our journey, we look forward to further leveraging Plaid's technology to enhance our platform and provide our users with the best possible financial management experience.
                                    </p>    
                                    <p class="dark-text"> 
                                        Learn more about how MyMI Wallet is working to integrate with Plaid in more detail by visiting:<br><a href="<?php echo site_url('/Blog/News-And-Updates/Integrating-With-Plaid'); ?>">MyMI Wallet Blog: Integrating with Plaid</a>
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