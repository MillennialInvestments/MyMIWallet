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
                                <span class="overline-title">Introducing</span>
                                <h1 class="text-white title" style="font-size:2.5rem">Go Green and Save Money:<br>IRS Announces Expanded Home Energy Tax Credits</h1>
                                <h2 class="pb-3 subttitle text-white" style="font-size:1.5rem"><small>Discover How You Can Qualify and Benefit from These Tax Credits</small></h2>
                                <p class="text-light">The Internal Revenue Service (IRS) has expanded home energy tax credits presenting a golden opportunity for homeowners and renters to save money while making energy-efficient improvements to their homes. Read on to discover how you can qualify for these tax credits and reduce your carbon footprint.</p>
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
                                    <li class="nav-item"><a class="nav-link active" href="#tab1" id="tab1-tab" role="tab" aria-controls="tab1" aria-selected="true" data-toggle="tab"><strong>Section 1: Why Budgeting Matters</strong></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab2" id="tab2-tab" role="tab" aria-controls="tab2" aria-selected="false" data-toggle="tab"><strong>Section 2: Common Budgeting Myths</strong></a></li>
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
                                    <span class="overline-title intro-section-subtitle">IRS Home Energy Tax Credit Expansion</span>
                                    <h3 class="intro-heading-lead">Going Green Could Help Taxpayers Qualify for Expanded Home Energy Tax Credits</h3>
                                    <div class="intro-section-desc">
                                        <p class="dark-text">
                                        The IRS recently announced that taxpayers who make energy-efficient updates to their homes may qualify for home energy tax credits. 
                                        The Inflation Reduction Act of 2022 expanded the credit amounts and types of qualifying expenses, opening doors for more individuals to benefit from these tax incentives.
                                        </p>                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>1. What Taxpayers Need to Know:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        The Energy Efficient Home Improvement Credit and the Residential Clean Energy Credit are available for the year in which qualifying expenditures are made. 
                                        Homeowners who improve their primary residence have the most opportunities to claim these credits, but renters and owners of second homes used as residences may also be eligible. 
                                        Landlords, however, cannot claim this credit.
                                    </p>        
                                    <p class="dark-text">
                                        To ensure eligibility, the IRS encourages taxpayers to review all requirements and qualifications for energy-efficient equipment at IRS.gov/homeenergy before making any purchases. 
                                        Additional information is available on energy.gov, where you can compare the credit amounts for tax years 2022 and 2023.
                                    </p>           
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>2. Energy Efficient Home Improvement Credit:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Starting from January 1, 2023, taxpayers making qualified energy-efficient improvements to their homes may qualify for a tax credit of up to $3,200 for the tax year the improvements are made. 
                                    </p>  
                                    <p class="dark-text">                                        
                                        The credit equals 30% of certain qualified expenses, including: 
                                    </p>             
                                    <ul class="list list-sm list-checked" style="justify-content:normal;">
                                        <li><strong class="list-blue-header pl-3">Exterior doors, windows, and skylights</strong></li>
                                    </ul>  
                                    <ul class="list list-sm list-checked" style="justify-content:normal;">
                                        <li><strong class="list-blue-header pl-3">Insulation and air sealing materials or systems</strong></li>
                                    </ul>  
                                    <ul class="list list-sm list-checked" style="justify-content:normal;">
                                        <li><strong class="list-blue-header pl-3">Residential energy property expenses</strong> (such as central air conditioners, water heaters, furnaces, boilers, heat pumps, biomass stoves and boilers, and home energy audits)</li>
                                    </ul>  
                                    <p class="dark-text">
                                        There are maximum credit limits for certain expenses, such as doors, windows, and home energy audits. 
                                        The credit is available only for qualifying expenditures on existing homes or for additions or renovations of existing homes, not for newly constructed homes. 
                                        It is important to note that this credit is nonrefundable, meaning it cannot exceed the amount owed in taxes, and any excess credit cannot be carried over to future tax years.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>3. Residential Clean Energy Credit:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Taxpayers who invest in energy improvements for their main home, including solar, wind, geothermal, fuel cells, or battery storage, may qualify for an annual residential clean energy tax credit. 
                                        The credit equals 30% of the costs of new, qualified clean energy property installed in a home in the United States from 2022 through 2033. 
                                        Qualified expenses include the costs of solar electric panels, solar water heaters, wind turbines, geothermal heat pumps, fuel cells, and battery storage technology (beginning in 2023).
                                    </p>      
                                    <p class="dark-text">
                                        The Residential Clean Energy Credit has no annual or lifetime dollar limit (except for fuel cell property) and can be claimed each tax year until it begins to phase out in 2033. 
                                        Similar to the Energy Efficient Home Improvement Credit, this credit is nonrefundable, and excess unused credit can be carried forward and applied to future tax years. 
                                        To claim the Residential Clean Energy Credit, taxpayers should use Form 5695, Residential Energy Credits, when filing their tax returns. 
                                        It's important to note that the credit must be claimed for the tax year when the property is installed, not just purchased.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>4. Good Recordkeeping and Related Resources:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        To ensure a smooth process when claiming these tax credits, taxpayers are advised to maintain good records of their purchases and expenses during the time the improvements are made. 
                                        This will help accurately claim the applicable credits during the tax filing season.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>5. In Conclusion:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        The recent release by the IRS regarding expanded home energy tax credits presents an excellent opportunity for homeowners and renters to make energy-efficient improvements to their homes while enjoying financial benefits. 
                                        By going green, not only can you save money through these tax credits, but you also contribute to a healthier environment. 
                                        Take advantage of these incentives and start your journey toward a more sustainable and financially secure future.
                                    </p>    
                                    <p class="dark-text">
                                        For more information on qualifying expenditures and how to claim the credits, visit the official IRS website:<br><a target="_blank" href="https://www.irs.gov/newsroom/irs-going-green-could-help-taxpayers-qualify-for-expanded-home-energy-tax-credits">Link to Article: IRS: Going green could help taxpayers qualify for expanded home energy tax credits</a>
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
                </div>         
            </div>
        </div>
    </div>
</div>