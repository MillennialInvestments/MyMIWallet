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
                                <h1 class="title text-white">How It Works</h1>
                                <h2 class="subttitle text-white pb-3">Personal Budgeting <span class="break-mb">&</span> Financial Forecasting</h2>
                                <!-- <h2 class="subttitle text-white pb-5">Investment Accounting/Analytical Software<br>Crypto Asset Marketplace &amp; Exchange</h1> -->
                                <p class="text-light">
                                    Creating a budget is an important step in managing your finances and achieving your financial goals. 
                                    A budget is a plan for how you will allocate your income and expenses over a given period of time, such as a month or a year. 
                                    It helps you to understand your financial situation and make informed decisions about how to best use your money.
                                    <!-- Our financial budgeting and forecasting tools are designed to help you manage your money and plan for the future. 
                                    <a href="#features">MyMI Wallet</a> make it easy to track your spending, create a budget, and see into your financial future.  -->
                                    <!-- We also provide features to help you make smart investments and plan for retirement. 
                                    Whether you want to save money, invest, or plan for the future, our tools can give you the information you need to make good financial decisions. 
                                    Give our tools a try and take control of your financial future. -->
                                </p>
                                <ul class="intro-action-group">
                                    <li><a href="#" class="link-to btn btn-lg btn-light">Learn More</a></li>
                                </ul>
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
<div class="intro-section intro-overview text-center bg-white pt-5">
    <div class="container-fluid pt-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="intro-section-title">
                    <span class="overline-title intro-section-subtitle">Personal Budgeting Overview</span>
                    <h3 class="intro-heading-lead">Getting Starting</h3>
                    <div class="intro-section-desc">
                        <p class="dark-text">
                            Personal financial budgeting is a process of managing your money to achieve your financial goals. It involves creating a plan for how you will allocate your income and expenses over a given period of time, such as a month or a year. By tracking your income and expenses, you can make informed decisions about how to best use your money and reach your financial goals. 
                            <!-- Utilize our <a href="<?php //echo site_url('/Marketplace'); ?>">MyMI Asset Marketplace</a> &amp; <a href="<?php //echo site_url('/Exchange'); ?>">Exchange</a> to profit from your investment data, build liquidity, and more at MyMI Wallet.  -->
                        </p>                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center pt-5 text-left">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="intro-section-title">
                    <h4 class="subtitle"><strong>1. Register Your MyMI Account</strong></h4>
                </div>
                <div class="intro-section-desc">
                    <p class="dark-text">
                        
                        <!-- Utilize our <a href="<?php //echo site_url('/Marketplace'); ?>">MyMI Asset Marketplace</a> &amp; <a href="<?php //echo site_url('/Exchange'); ?>">Exchange</a> to profit from your investment data, build liquidity, and more at MyMI Wallet.  -->
                    </p> 
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Creating Your Account</strong> Sign up for an account with MyMI Wallet, if you haven't already. This will require providing some basic personal and financial information, such as your name, email address, and contact information. Click <a href="<?php echo site_url('How-It-Works/Registering-An-Account'); ?>">here</a> for more information on <a href="<?php echo site_url('How-It-Works/Registering-An-Account'); ?>">Account & Security Settings</a>.</li><br>
                    </ul>
                    <a class="btn btn-primary mb-3" href="<?php echo $btnURL; ?> ">Create Account</a>
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Adding Your Wallets:</strong> Before creating your budget, you first need to know what your Checking &amp; Savings account balances are. You are also currently able to use MyMI Wallets to represent your Credit Card Accounts and their individual account balances to ensure your capture all of the financial resources you have available. Learn more about our <a href="<?php echo site_url('How-It-Works/MyMI-Wallets'); ?>">MyMI Wallets</a> and how they work by clicking <a href="<?php echo site_url('How-It-Works/MyMI-Wallets'); ?>">here</a>.</li><br>
                    </ul>
                    <?php 
                    if ($investmentOperations ===1) {
                    ?>
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Investor Profile:</strong> Our <a href="">Investor Profiles</a> are utilized to help determine your Financial Goals, Preferred Methods of Investments, and more. By configuring these settings, our system will be able to adjust according to your personalized preferences in the future. Complete your <a href="">Investor Profile</a> by clicking the link below:</li><br>
                    </ul>
                    <a class="btn btn-primary mb-3" href="<?php echo $btnURL; ?> ">Create Account</a>
                    <?php
                    }
                    ?>
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Account Issues &amp; Support:</strong> If you are having trouble creating an account or managing your account settings, simply contact us at <a href="<?php echo site_url('/Customer-Support'); ?>">MyMI Support</a> or via email at <a href="mailto:support@mymiwallet.com">support@mymiwallet.com</a>. Our Hours are Operations are as follows: Mon-Fri 8am-5pm (CST) excluded some recommended holidays.</li><br>
                    </ul>                   
                </div>
            </div>
        </div>
        <div class="row justify-content-center pt-5 text-left">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="intro-section-title">
                    <h4 class="subtitle"><strong>2. Create Your Budget</strong></h4>
                </div>
                <div class="intro-section-desc">
                    <p class="dark-text">
                    Creating a budget is an important step in managing your personal finances, and MyMI Wallet can help make the process easy and efficient. To create a budget using this online tool, you'll need to input your income and expenses, categorize them, and set spending limits for each category. 
                    Once your budget is set up, you can monitor your spending and make adjustments as needed to stay within your budget. 
                    </p>     
                    <ul class="list list-sm list-checked">
                        <li>
                            <strong class="list-blue-header pl-3">Gather your financial information:</strong> 
                            To get started with your budget, it may be best to gather all of your financial information that you have available. 
                            This includes your income, bills, and other expenses that you incur on a regular basis. 
                            You may want to use a spreadsheet or budgeting app to track this information. You can also use our <a href="" download>Fiancial Data Gathering Template</a> to get started: <a href="" download>Download</a>.
                        </li><br>
                    </ul>
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Begin your budget:</strong> Based on your financial information, begin adding your Income &amp; Expenses to your MyMI Budget. 
                        This will allow you to add recurring and non-recurring income and expenses that you are expecting to pay for the current month. For recurring accounts, you will be able to approve and adjust a Recurring Schedule to forecast those incomes and expenses accordingly.</li><br>
                    </ul>
                    <ul class="list list-sm list-checked">
                        <li>
                            <strong class="list-blue-header pl-3">Backtracking for the year:</strong> 
                            To capture your full financial forecast for the current year, you have the ability to backtrack any incomes and expenses that have already been paid. 
                            This will allow the MyMI Budget Forecast to be more precise in anticipating what your financial year will consist of completely.
                        </li><br>
                    </ul>
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Track your progress:</strong> Regularly review your budget to see how well you are sticking to it and make any necessary adjustments. You may also want to review your financial goals and see if you need to make any changes to your budget to stay on track.</li><br>
                    </ul>
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Determine your financial goals:</strong> Based on the result of your current budget, what do you want to achieve with your money? Do you want to save for a down payment on a house, pay off debt, or save for retirement? Identifying your financial goals will help you create a plan to reach them. Learn more about <a href="<?php echo site_url('/How-It-Works/Determining-Your-Financial-Goals'); ?>">Determining Financial Goals</a> below.</li><br>
                    </ul>
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Seek help if needed:</strong> If you are having trouble creating a budget or managing your money, consider seeking help from a financial planner or other professional. There are also many resources available online, such as budgeting apps, financial planning websites, and financial literacy courses, that can provide guidance and support. Find a <a href="">Local Financial Advisor</a> near you by clicking <a href="">here</a>.</li><br>
                    </ul>                   
                </div>
            </div>
        </div>
        <div class="row justify-content-center pt-5 text-left">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="intro-section-title">
                    <h4 class="subtitle"><strong>MyMI Budgeting & Financial Forecasting</strong></h4>
                </div>
                <div class="intro-section-desc">
                    <p class="dark-text">
                        <strong>MyMI Wallet</strong> was specifically designed to assist in providing a more simplistic way in managing your financial accounting and budgeting with our <a href="">MyMI Budgeting Tool</a>. 
                        Allow MyMI Wallet to take care of all the heavy lifting and make life that much easier for you to not only understand your current financial condition, but ultimately improve your financial health and weatlh generation.
                    </p>      
                    <ul class="intro-action-group">
                        <li><a href="<?php echo $btnURL; ?>" class="btn btn-lg btn-primary">Get Started!</a></li>
                    </ul>        
                </div>
            </div>
        </div>
        <?php /*
        <!-- <div class="row justify-content-center pt-5 text-left">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="intro-section-title">
                    <h4 class="subtitle"><strong>How to determine your financial goals</strong></h4>
                </div>
                <div class="intro-section-desc">
                    <p class="dark-text">
                    Determining your financial goals is an important step in personal financial budgeting. Your financial goals will help guide your budgeting decisions and provide motivation to stay on track. Here are some steps to help you determine your financial goals:
                    </p>              
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Consider your current financial situation:</strong> Take stock of your current financial situation, including your income, debts, and other expenses. This will help you determine what is realistic and achievable given your current financial circumstances.</li><br>
                    </ul>   
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Think about what you want to achieve:</strong> What do you want to accomplish with your money? Do you want to save for a down payment on a house, pay off debt, or save for retirement? Consider both short-term and long-term goals.</li><br>
                    </ul>
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Set specific and measurable goals:</strong> Rather than just saying "I want to save money," set specific goals, such as "I want to save $5,000 for a down payment on a house within the next two years." This will make it easier to track your progress and stay motivated.</li><br>
                    </ul>
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Prioritize your goals:</strong> Determine which goals are most important to you and prioritize them. This will help you make informed budgeting decisions and allocate your resources effectively.</li><br>
                    </ul> 
                    <p class="dark-text">
                        By following these steps, you can determine your financial goals and create a budget that reflects your priorities and helps you work towards achieving your financial objectives.
                    </p>      
                </div>
            </div>
        </div> -->
        <!-- <div class="row justify-content-center pt-5 text-left">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="intro-section-title">
                    <h4 class="subtitle"><strong>How to gather your financial information</strong></h4>
                </div>
                <div class="intro-section-desc">
                    <p class="dark-text">
                        There are several ways to gather financial information for personal budgeting:
                    </p>              
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Gather your bills and other financial documents:</strong> This includes things like pay stubs, bank statements, credit card statements, and bills for expenses like rent, utilities, and insurance.</li><br>
                    </ul>
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Use a budgeting app or spreadsheet:</strong> There are many budgeting apps and software programs available that can help you track your income and expenses. You can also use a spreadsheet program like Excel or Google Sheets to create a budget manually.</li><br>
                    </ul>
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Record your expenses manually:</strong> You can also track your expenses manually by writing down all of your purchases and bills in a notebook or on a piece of paper.</li><br>
                    </ul>
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Use online tools:</strong> There are also many online tools available that can help you track your finances, such as financial planning websites and personal finance management tools.</li><br>
                    </ul>    
                    <p class="dark-text">
                        By gathering all of your financial information in one place, you can get a clear picture of your income and expenses, which will help you create a budget that reflects your financial reality. 
                        It's important to be as accurate as possible when gathering this information, as this will help you create a budget that is realistic and achievable.
                    </p>      
                </div>
            </div>
        </div> -->
        <!-- <div class="row justify-content-center pt-5 text-left">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="intro-section-title">
                    <h4 class="subtitle"><strong>How to create your financial budget</strong></h4>
                </div>
                <div class="intro-section-desc">
                    <p class="dark-text">
                    Creating a budget is an important step in managing your money and achieving your financial goals. Here is a step-by-step guide to creating a budget:

                    <small class="text-muted"></small>
                    </p>              
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Calculate your total income:</strong> This includes all sources of income, such as employment, investments, and other sources.</li><br>
                    </ul>
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Calculate your total expenses:</strong> This includes all of your bills and necessary expenses, such as rent, utilities, and groceries.</li><br>
                    </ul>
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Determine your net income:</strong> Subtract your total expenses from your total income to determine your net income, which is the amount of money you have left over after paying your bills.</li><br>
                    </ul>
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Allocate your net income:</strong> Based on your financial goals and your net income, create a plan for how you will allocate your remaining funds. This may involve setting limits on certain expenses, saving for specific goals, or paying down debt.</li><br>
                    </ul>         
                </div>
            </div>
        </div> -->
        <!-- <div class="row justify-content-center pt-5 text-left">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="intro-section-title">
                    <h4 class="subtitle"><strong>Keeping track of your financial budget</strong></h4>
                </div>
                <div class="intro-section-desc">
                    <p class="dark-text">
                    Creating a budget is an important step in managing your money and achieving your financial goals. Here is a step-by-step guide to creating a budget:

                    <small class="text-muted"></small>
                    </p>              
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Develop financial discipline:</strong> Once you have clear insight of your current financial health, work to develop discipline in respecting the budget and not deviating too far from the plan.</li><br>
                    </ul>        
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Schedule weekly routines:</strong> Determine the best schedule to consistently update your budget to ensure you have a clear roadmap of a short and long-term plan to manage your budget.</li><br>
                    </ul>
                    <ul class="list list-sm list-checked">
                        <li><strong class="list-blue-header pl-3">Consistently re-evaluate budeting over time:</strong> Remember to consistently re-evaluate your current financial circumstances in comparison to the roadmap providing by creating the budget.</li><br>
                    </ul>       
                </div>
            </div>
        </div> -->
        <!-- <div class="row justify-content-center my-5">
            <div class="col-md-12">
                <div id="promotion" class="intro-section intro-section-sm intro-promo-iv text-white">
                    <div class="container container-ld">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                            <div class="g pe-md-4">
                                <div class="w-max-750px">
                                    <h3 class="title mb-3">Looking for Advanced Accounting & Analytical Investment System?</h3>
                                    <p class="lead">We're thrilled to welcome you to our new Automated Application to manage your future investments. 
                                        Interested in learning more?</p>
                                </div>
                            </div>
                            <div class="g mt-4 mt-md-0"><a href="<?php echo site_url('Knowledge-Base/Trade-Tracker'); ?>" target="_blank" class="btn btn-lg btn-primary"><span>Learn More!</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="intro-section-title">
                    <span class="overline-title intro-section-subtitle">MyMI Wallet Overview</span>
                    <h2 class="intro-heading-lead">Accounting <span class="break-mb">&</span> Analytical Statistics</h2>
                    <div class="intro-section-desc">
                        <p>
                            An overview of <strong class="text-soft">MyMI Wallet</strong> – capture all of your financial data in one place, customize your analytics to gain insight on your financial health and future, and utilize our investing resources and tools to optimize your investment decisions. 
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="intro-overview-list">
                    <div class="intro-overview-item highlight"><span class="intro-ov-number text-blue"><?php echo $totalActiveUsers; ?>+</span><span class="intro-ov-title text-blue">Investors</span></div>
                    <div class="intro-overview-item"><span class="intro-ov-number "><?php echo $totalWalletsCreated; ?></span><span class="intro-ov-title ">MyMI Wallets</span></div>
                    <div class="intro-overview-item"><span class="intro-ov-number "><?php echo $totalTradesTracked; ?></span><span class="intro-ov-title ">Total Trades</span></div>
                    <div class="intro-overview-item"><span class="intro-ov-number "><?php echo $totalActivePartners; ?></span><span class="intro-ov-title ">MyMI Partners</span></div>
                    <div class="intro-overview-item"><span class="intro-ov-number "><?php echo $totalApprovedAssets; ?></span><span class="intro-ov-title ">MyMI Assets</span></div>
                </div>
            </div>
        </div> -->
        */
        ?>
    </div>
</div>
