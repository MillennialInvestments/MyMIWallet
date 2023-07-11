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
                                <span class="overline-title">Introduction to Investing</span>
                                <h1 class="title text-white" style="font-size:2.5rem">A Beginner's Guide to Option Trading</h1>
                                <h2 class="subttitle text-white pb-3" style="font-size:1.5rem">A Guide for New Investors to Unlock the Power of Option Trading: </h2>
                                <div class="intro-section-desc">
                                    <p class="text-light">
                                        At MyMIWallet, we firmly believe in equipping our users with the knowledge and tools necessary to navigate the complex yet rewarding world of options trading. 
                                        This guide aims to elucidate the intricacies of options trading, simplifying key concepts, strategies, and their incorporation into your broader investment portfolio. 
                                        Whether you're a seasoned investor keen on diversifying your strategy or a novice trader just dipping your toes into the financial markets, this guide will offer valuable insights into the dynamic realm of options trading. 
                                    </p>                        
                                </div>
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
                                        <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true"><strong>Section 1: A Beginner's Guide to Investing</strong></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false"><strong>Section 2: Options Trading Basics: Calls and Puts</strong></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false"><strong>Section 3: Understanding the Mechanics of Options Trading</strong></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab4-tab" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false"><strong>Section 4: Why Consider Option Trading?</strong></a>
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
                                <ul class="nav flex-column text-left nav-pills px-2" style="align-items:normal;" id="myTab" role="tablist">
                                    <li class="nav-item"><a class="nav-link pl-3 pr-0" href="<?php echo site_url('/Blog/Personal-Budgeting/The-Importance-of-Personal-Financial-Budgeting'); ?>" id="tab1-tab"><strong>The Importance of Personal Financial Budgeting</strong></a></li>
                                    <li class="nav-item"><a class="nav-link pl-3 pr-0" href="<?php echo site_url('/Blog/Investing/Tips-For-Effective-Investment-Portfolio-Management'); ?>" id="tab1-tab"><strong>Tips for Effective Investment Portfolio Management</strong></a></li>
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
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <span class="overline-title intro-section-subtitle">A Beginner's Guide to Option Trading:</span>
                                    <h3 class="intro-heading-lead">The Fundamentals of Option Trading</h3>
                                    <div class="intro-section-desc">
                                        <p class="dark-text">
                                            Welcome to our comprehensive beginner's guide on the fundamentals of option trading. At MyMI Wallet, we believe in empowering our users with the knowledge and tools necessary to navigate the exciting landscape of options trading. In this guide, we will demystify the world of options, explaining key concepts, strategies, and how they can fit into your broader investment portfolio. Whether you're a seasoned investor or just starting, this guide will provide valuable insights into the world of option trading.
                                        </p>                                         
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row intro-action-group my-5">
                            <div class="col-12">
                                <h2 class="pb-3 subttitle" style="font-size:1.5rem">Connect with Us on Social Media</h2>
                            </div>
                            <div class="col-12">
                                <a class="btn btn-primary mr-2" href="https://www.facebook.com/MyMIWalletNews" target="_blank">Facebook</a>
                                <a class="btn btn-primary mr-2" href="https://www.twitter.com/MyMIWallet" target="_blank">Twitter</a>
                                <a class="btn btn-primary mr-2" href="https://www.youtube.com/@MyMIWallet" target="_blank">YouTube</a>
                                <a class="btn btn-primary" href="https://discord.gg/UUMexvA" target="_blank">Discord</a>
                            </div>
                        </div>   
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>1. Options Trading Basics: Calls and Puts</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Options are contracts that give you the right (but not the obligation) to buy or sell a specific stock at a predetermined price, known as the strike price, by a specific date, known as the expiration date. 
                                        There are two main types of options: call options and put options.
                                    </p>      
                                    <p class="dark-text">
                                        A call option gives you the right to buy a stock at the strike price, while a put option gives you the right to sell. 
                                        If you expect a stock's price to rise, you may buy a call option; if you expect it to fall, you may buy a put option.
                                    </p>                  
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>2. Understanding the Mechanics of Options Trading:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        An option contract typically represents 100 shares of a stock. If the stock price moves in your favor, you could potentially make a profit. 
                                        For example, if you buy a call option with a strike price of $50, and the stock price rises to $60, you can buy the stock at $50 and sell it at $60, making a $10 profit per share (minus the premium, the cost you paid for the option).
                                    </p>        
                                    <p class="dark-text">
                                        It's crucial to note that while the potential for profit is attractive, options also carry significant risks, especially for beginners.
                                        The premium you pay for the option could be lost entirely if the stock price does not move in the direction you predicted by the expiration date.
                                    </p>          
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>3. Why Consider Option Trading?:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Options trading can be part of a broader investment strategy. They can be used to hedge against potential losses in other investments, generate income through selling options, or speculate on the direction of stock prices with potentially significant returns. 
                                        However, the risk associated with options trading necessitates thorough research, financial literacy, and sometimes, guidance from financial advisors.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>4. Conclusion:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Option trading can offer a new dimension to your investment portfolio, allowing you to leverage the market's movements to your advantage. 
                                        However, it's critical to remember that with potential high rewards come high risks. At MyMIWallet, we encourage a well-informed and cautious approach to any new investment strategy.
                                    </p>    
                                    <p class="dark-text">
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        For more financial insights, investment advice, and tools to optimize your investment portfolio, view our <a href="<?php echo site_url('/Blog'); ?>">Financial Blog</a>: <a href="<?php echo site_url('/Blog'); ?>">Discover More!</a>.<br>
                                        Together, let's chart your path to financial success!
                                    </p>      
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane pb-5 fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <span class="overline-title intro-section-subtitle">A Beginner's Guide to Option Trading:</span>
                                    <h3 class="intro-heading-lead">Options Trading Basics: Calls and Puts?</h3>
                                    <div class="intro-section-desc">
                                        <p class="dark-text">
                                            In the world of options trading, the two primary types of contracts you'll encounter are calls and puts. 
                                            Both of these play crucial roles in various investment strategies, and understanding their functions is the first step towards effectively integrating options trading into your investment portfolio.
                                        </p>                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row intro-action-group my-5">
                            <div class="col-12">
                                <h2 class="pb-3 subttitle" style="font-size:1.5rem">Connect with Us on Social Media</h2>
                            </div>
                            <div class="col-12">
                                <a class="btn btn-primary mr-2" href="https://www.facebook.com/MyMIWalletNews" target="_blank">Facebook</a>
                                <a class="btn btn-primary mr-2" href="https://www.twitter.com/MyMIWallet" target="_blank">Twitter</a>
                                <a class="btn btn-primary mr-2" href="https://www.youtube.com/@MyMIWallet" target="_blank">YouTube</a>
                                <a class="btn btn-primary" href="https://discord.gg/UUMexvA" target="_blank">Discord</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>1. Call Options:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        A call option is a contract that gives the holder the right, but not the obligation, to buy a specific number of shares (typically 100) of a certain stock at a predetermined price, known as the strike price, within a specified time frame. 
                                        The beauty of call options lies in their potential for profit when the price of a stock rises.
                                    </p>      
                                    <p class="dark-text">
                                        For instance, if you buy a call option with a strike price of $50, and the market price of the stock climbs to $60 within your contract period, you have the opportunity to buy the stock for $50 and immediately sell it for $60, netting a $10 profit per share.
                                    </p> 
                                    <p class="dark-text">
                                        However, remember that the total cost of the option, known as the premium, must be subtracted from these profits. 
                                        This premium is the price you pay for the rights that the call option provides.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>2. Put Options:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        On the other hand, a put option is a contract that gives the holder the right, but not the obligation, to sell a certain number of shares of a particular stock at a predetermined price within a specified time frame. 
                                        Put options can potentially yield profits when the price of a stock falls.
                                    </p>  
                                    <p class="dark-text">
                                        For example, if you buy a put option with a strike price of $50, and the market price of the stock drops to $40 within your contract period, you can buy the stock for $40 and exercise your option to sell it for $50, making a $10 profit per share, less the premium you paid for the option.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>3. Calls and Puts: Two Sides of the Coin:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Both call and put options offer ways to leverage price movements in the stock market to your advantage. 
                                        Calls offer a way to amplify your gains in a rising market, while puts can help protect your portfolio against losses in a falling market, or even profit from downward price movements.
                                    </p> 
                                    <p class="dark-text">
                                        It's essential to bear in mind that while options can amplify profits, they can also magnify losses. 
                                        The premiums paid for options can be lost entirely if the stock price does not move in the predicted direction before the option's expiration. 
                                        This risk underscores the importance of employing sound risk management strategies and making well-informed investment decisions.
                                    </p> 
                                    <p class="dark-text">
                                        At MyMIWallet, our mission is to provide you with the financial literacy tools and investment insights you need to navigate the exciting world of options trading. 
                                        Stay tuned to our blog and connect with us on our social media channels for more investment education content.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>4. Choosing the Right Option Strategy:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        With the basic understanding of call and put options, you might be wondering how to choose the right strategy. 
                                        An investor's choice largely depends on their market outlook, risk tolerance, and investment goals. 
                                        If you anticipate an upward movement in the stock's price, you might consider buying a call option. 
                                        This strategy allows you to potentially profit from a price increase while limiting your potential loss to the premium paid.
                                    </p>      
                                    <p class="dark-text">
                                        Conversely, if you expect the stock's price to decrease, buying a put option could be a viable strategy. 
                                        This allows you to potentially profit from a price decrease, again with your potential loss limited to the premium paid. 
                                        But remember, buying options isn't the only strategy. 
                                    </p>      
                                    <p class="dark-text">
                                        You can also write, or sell, call and put options, which can generate income for your portfolio. 
                                        However, this strategy comes with its own set of risks, including potentially unlimited losses in the case of writing call options. 
                                        Therefore, selling options should only be done if you fully understand these risks and have a strategy to manage them.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>5. Understanding Option Pricing:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Option pricing can seem complicated, but understanding the basic factors that influence an option's premium can provide crucial insights. 
                                        The price or premium of an option is affected by various factors including the stock's current price, the option's strike price, the time until expiration, the volatility of the underlying stock, and the risk-free interest rate.  
                                        The intrinsic value of an option is the difference between the underlying stock's price and the option's strike price, if that difference is positive. 
                                        For a call option, it's the stock price minus the strike price. For a put option, it's the strike price minus the stock price. 
                                    </p>      
                                    <p class="dark-text">
                                        An option's intrinsic value can never be negative - if the calculation results in a negative number, the intrinsic value is simply zero.
                                        Time value is the part of the option's premium that exceeds its intrinsic value. 
                                        The time value reflects the potential for changes in the stock's price before the option expires. 
                                        Generally, the more time left until an option's expiration, the higher its time value will be.
                                    </p>      
                                    <p class="dark-text">
                                        Conversely, if you expect the stock's price to decrease, buying a put option could be a viable strategy. 
                                        This allows you to potentially profit from a price decrease, again with your potential loss limited to the premium paid. 
                                        But remember, buying options isn't the only strategy. 
                                    </p>      
                                    <p class="dark-text">
                                        You can also write, or sell, call and put options, which can generate income for your portfolio. 
                                        However, this strategy comes with its own set of risks, including potentially unlimited losses in the case of writing call options. 
                                        Therefore, selling options should only be done if you fully understand these risks and have a strategy to manage them.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>6. Importance of Diversification in Options Trading:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Just like with other forms of investing, diversification is key when it comes to options trading.
                                        This means spreading your investments across different types of options and underlying securities to mitigate risk. 
                                    </p>
                                    <p class="dark-text">
                                        For example, you might balance riskier option strategies with more conservative ones, or use options on different types of underlying assets such as stocks, ETFs, or indexes.
                                    </p>
                                    <p class="dark-text">
                                        At the same time, diversification should go hand in hand with careful planning and analysis. 
                                        Understanding the potential outcomes of your option strategies and how they fit into your overall investment portfolio is critical.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        In conclusion, options can be a powerful tool in your investment arsenal when used correctly. 
                                        They offer flexibility and leverage that other financial instruments don't. 
                                        However, they also come with their own set of risks that need to be understood and managed. 
                                    </p>
                                    <p class="dark-text">
                                        Remember, a well-informed investor is a successful investor. 
                                        Stay connected with us at MyMIWallet for more insights and strategies in options trading.
                                    </p>      
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane pb-5 fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <span class="overline-title intro-section-subtitle">A Beginner's Guide to Option Trading:</span>
                                    <h3 class="intro-heading-lead">Understanding the Mechanics of Options Trading</h3>
                                    <div class="intro-section-desc">
                                        <p class="dark-text">
                                            In the realm of options trading, a solid grasp of the core mechanics is vital. 
                                            While the basics of call and put options lay the foundation, it's important to understand the underlying mechanics that govern how options work. 
                                            In this section, we'll demystify the concepts of option premiums, option expiration, and the all-important 'moneyness' of an option.
                                        </p>                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row intro-action-group my-5">
                            <div class="col-12">
                                <h2 class="pb-3 subttitle" style="font-size:1.5rem">Connect with Us on Social Media</h2>
                            </div>
                            <div class="col-12">
                                <a class="btn btn-primary mr-2" href="https://www.facebook.com/MyMIWalletNews" target="_blank">Facebook</a>
                                <a class="btn btn-primary mr-2" href="https://www.twitter.com/MyMIWallet" target="_blank">Twitter</a>
                                <a class="btn btn-primary mr-2" href="https://www.youtube.com/@MyMIWallet" target="_blank">YouTube</a>
                                <a class="btn btn-primary" href="https://discord.gg/UUMexvA" target="_blank">Discord</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>1. Option Premium:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        This is the price you pay to buy an option contract. 
                                        It's determined by factors such as the stock's price, the option's strike price, the time until expiration, and the volatility of the underlying stock. 
                                        Keep in mind, the buyer of an option contract risks losing the entire premium if the option expires worthless.
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>2. Option Expiration:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Each option contract has a specific expiration date, after which the option becomes worthless if not exercised. 
                                        Options can have expiration periods as short as a day or as long as several years. 
                                        As a general rule, the more time until an option's expiration, the higher its premium will be. 
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <h4 class="subtitle"><strong>3. 'Moneyness' of an Option:</strong></h4>
                                </div>
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        This refers to the relationship between the price of the underlying stock and the strike price of the option. 
                                        An option is 'in the money' if exercising it would be profitable, 'at the money' if the stock price and strike price are equal, and 'out of the money' if exercising the option would not be profitable. 
                                        The 'moneyness' of an option can significantly impact its premium and its risk/reward profile. 
                                    </p>      
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        The mechanics of options trading can initially seem complex, but understanding these key concepts can greatly enhance your ability to navigate the options market and develop effective trading strategies. 
                                        Options offer a world of opportunities to diversify your portfolio, hedge your positions, and potentially generate profits. 
                                        However, as with all financial instruments, they come with their own risks and should be used wisely and strategically.
                                    </p>      
                                    <p class="dark-text">
                                        Here at MyMIWallet, our goal is to empower you with the knowledge and tools you need to confidently step into the world of options trading. 
                                        Stay connected with us for more investment insights and strategies that can help you on your financial journey.
                                    </p>      
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane pb-5 fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="intro-section-title">
                                    <span class="overline-title intro-section-subtitle">A Beginner's Guide to Option Trading:</span>
                                    <h3 class="intro-heading-lead">Why Consider Option Trading?</h3>
                                    <div class="intro-section-desc">
                                        <p class="dark-text">
                                            Options trading offers investors versatility that simply cannot be matched by other investment types. 
                                            It's a unique strategy that allows you to profit in all market conditions: you can profit when prices are rising, when they're falling, and even when they're stagnant.
                                        </p>                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row intro-action-group my-5">
                            <div class="col-12">
                                <h2 class="pb-3 subttitle" style="font-size:1.5rem">Connect with Us on Social Media</h2>
                            </div>
                            <div class="col-12">
                                <a class="btn btn-primary mr-2" href="https://www.facebook.com/MyMIWalletNews" target="_blank">Facebook</a>
                                <a class="btn btn-primary mr-2" href="https://www.twitter.com/MyMIWallet" target="_blank">Twitter</a>
                                <a class="btn btn-primary mr-2" href="https://www.youtube.com/@MyMIWallet" target="_blank">YouTube</a>
                                <a class="btn btn-primary" href="https://discord.gg/UUMexvA" target="_blank">Discord</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center pt-5 text-left">
                            <div class="col-12">
                                <div class="intro-section-desc">
                                    <p class="dark-text">
                                        Beyond flexibility, options also offer a high potential for return. 
                                        Since options allow you to control a large amount of shares with a relatively small investment (the cost of the option premium), the rate of return can be significant if your prediction on the stock's movement proves accurate.
                                    </p>
                                    <p class="dark-text">
                                        Options are also commonly used as a risk management tool. 
                                        Put options, for instance, can be used to hedge against potential losses in your stock holdings. 
                                        If the value of your stock goes down, the value of the put options can go up, offsetting some or all of the losses. 
                                    </p>
                                    <p class="dark-text">
                                        Lastly, options trading can simply provide more opportunities for diversification.
                                        With various strike prices and expiration dates, an investor can create numerous strategic possibilities to enhance or protect their portfolio. 
                                    </p>
                                    <p class="dark-text">
                                        Despite the numerous advantages, it's important to note that options trading involves risk and is not suitable for everyone. 
                                        The potential for higher returns comes with a higher level of risk, including the total loss of the premium spent on the options if the stock does not move in the predicted direction.
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
