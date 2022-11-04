<?php
defined('BASEPATH') || exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|   example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|   $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|   $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'home';
$route['404_override'] = 'Custom404';
$route['translate_uri_dashes'] = false;

// Authentication
Route::any(LOGIN_URL, 'users/login', array('as' => 'login'));
Route::any(REGISTER_URL, 'users/register', array('as' => 'register'));
Route::block('users/login');
Route::block('users/register');
Route::any('Free/register', 'users/register'); // Completed
Route::any('free/register', 'users/register'); // Completed
Route::any('Beta/register', 'users/register'); // Completed
Route::any('beta/register', 'users/register'); // Completed
Route::any('Partner/register', 'users/register'); // Completed
Route::any('partner/register', 'users/register'); // Completed
Route::any('Verify-Email/(:any)', 'users/Verify_Email/$1'); // Completed
Route::any('Account-Information/(:any)', 'users/Account_Information'); // Completed
Route::any('Registration-Successful', 'users/Successful_Registration');
Route::any('Registration-Successful/(:any)', 'users/Successful_Registration');
Route::any('logout', 'users/logout');

// Activation / Account Management
Route::any('activate', 'users/activate');
Route::any('activate/(:any)', 'users/activate/$1');
Route::any('activate/(:any)/(:any)', 'users/activate/$1/$2');
Route::any('resend-activation', 'users/resend_activation');
Route::any('resend-activation/(:any)', 'users/resend_activation/$1');
Route::any('forgot-password', 'users/forgot_password');
Route::any('reset-password', 'users/reset_password');
Route::any('reset-password/(:any)/(:any)', 'users/reset_password/$1/$2');

// Public Pages - Customer Support
Route::any('Customer-Support', 'Public/Support/index');
Route::any('Customer-Support/Contact-Us', 'Public/Support/Request');
Route::any('Customer-Support/FAQ', 'Public/Support/FAQ');
Route::any('Customer-Support/Requests', 'Support_Management/Request_Overview');
Route::any('Customer-Support/Response/(:any)', 'Public/Support/Response');
Route::any('Customer-Support/Close-Request/(:any)/(:any)', 'Public/Support/Close_Request/$1/$2');
Route::any('Customer-Support/Member-Request/(:any)', 'User/Support/Member_Customer_Support_Request');
Route::any('Customer-Support/Manager/(:any)', 'User/Support/Customer_Support_Manager');

// Public Pages - Investment
Route::any('Invest', 'Public/Invest');
Route::any('Invest/(:any)', 'Public/Invest');
Route::any('Invest/Complete-Purchase/(:any)', 'Public/Invest/Purchase');
Route::any('Invest/Purchase-Complete/(:any)', 'Public/Invest/Purchase_Complete/$1');
Route::any('Invest/Complete/(:any)', 'Public/Invest/Complete');
Route::any('Investor/register', 'users/register');
Route::any('Investor/Verify-Email/(:any)', 'users/Verify_Email/$1');
Route::any('Investor/register/(:any)', 'users/investor_register');
Route::any('Investor/Activate/(:any)', 'Public/Invest/Activate');

// Public Pages - Rel
Route::any('Releases/(:any)/(:any)', 'Public/Releases/Version_Template');

// Public Pages - Search
Route::any('ETF/(:any)/(:any)', 'User/ETF/Template');
Route::any('Stock/(:any)/(:any)', 'User/Stock/Template');
Route::any('Indexes/(:any)/(:any)', 'User/Indexes/Template');

// User - Announcements
Route::any('Announcements', 'Management/Announcements');
Route::any('Announcements/Post', 'Management/Announcements/Post');

// User - Dashboard
Route::any('Dashboard', 'User/Dashboard/index');
Route::any('Markets/(:any)', 'User/Dashboard/Markets');
Route::any('Budget', 'User/Budget/index');
Route::any('Budget/Add/("')

// User - Accounts
Route::any('Investor-Profile', 'User/Dashboard/Investor_Profile'); 
Route::any('Profile-Manager', 'User/Dashboard/Profile_Manager');

// User - Assets
Route::any('Assets', 'User/Asset_Management/index');

// User - Budget
// Route::any('Budget', 'User/Budget');
// Route::any('Budget/Income', 'User/Budget/Type_Overview');
// Route::any('Budget/Income/Add', 'User/Budget/Add_Account');
// Route::any('Budget/Expense', 'User/Budget/Type_Overview');
// Route::any('Budget/Expense/Add', 'User/Budget/Add_Account');

// User - Exchange
Route::any('Exchange', 'Exchange/index');
Route::any('Exchange/Market/(:any)/(:any)', 'Exchange/Overview');
Route::any('Exchange/Market/(:any)/(:any)', 'Exchange/Overview/$1/$2');
Route::any('Management/Exchange', 'Exchange/Dashboard');
Route::any('Exchange/Application-Manager/(:any)', 'Exchange/Application_Manager');
Route::any('Exchange/Coin-Listing/Request', 'Exchange/Coin_Listing_Request');
Route::any('Exchange/Coin-Listing/Asset-Information', 'Exchange/Coin_Listing_Asset_Information');
Route::any('Exchange/Coin-Listing/Asset-Information/(:any)', 'Exchange/Coin_Listing_Asset_Information');
Route::any('Exchange/Coin-Listing/Asset-Information/(:any)/(:any)', 'Exchange/Coin_Listing_Asset_Information');
Route::any('Exchange/Coin-Listing/Asset-Information-Modal', 'Exchange/Coin_Listing_Asset_Information_Modal');
Route::any('Exchange/Coin-Listing/Asset-Information-Modal/(:any)', 'Exchange/Coin_Listing_Asset_Information_Modal');
Route::any('Exchange/Coin-Listing/Asset-Information-Modal/(:any)/(:any)', 'Exchange/Coin_Listing_Asset_Information_Modal');
Route::any('Exchange/Coin-Listing/Request-Complete', 'Exchange/Coin_Listing_Request_Complete');
//~ Route::any('Exchange/Order-Event-Manager/(:any)/(:any)/(:any)', 'Exchange/Order_Event_Manager/$1/$2/$3');
Route::any('Exchange/Account-Information/(:any)', 'Exchange/Account_Information');
Route::any('Exchange/KYC-Registration-Reward/(:any)', 'Exchange/KYC_Reward/$1');

// User - Referral Program
Route::any('Referral-Program', 'User/Referral_Program/index');
Route::any('Referral-Program/Apply', 'User/Referral_Program/Apply');
Route::any('Referral-Program/Apply/(:any)', 'User/Referral_Program/Apply');
Route::any('Referral-Program/Application/Success', 'User/Referral_Program/Success');
Route::any('Referral-Program/Applications', 'User/Referral_Program/Users');
Route::any('Referral-Program/New-Affiliate-Information/(:any)', 'User/Referral_Program/New_Affiliate_Information/$1');
Route::any('Referral-Program/Activate-Affiliate/(:any)', 'User/Referral_Program/Activate_Affiliate/$1');
Route::any('Referral-Program/Affiliates', 'User/Referral_Program/Users');
Route::any('Referral-Program/Marketing-Affiliate-Program-Agreement', 'User/Referral_Program/Marketing_Affiliate_Program_Agreement');
Route::any('My-Referrals', 'User/Referral_Program/My_Referrals'); 
// User - Trade Tracker
Route::any('Trade-Tracker', 'User/Trade_Tracker/Overview');
Route::any('Trade-Tracker/Trade-Manager', 'User/Trade_Tracker/Trade_Manager');


// User - Wallets
Route::any('Wallets', 'User/Wallets/index');
Route::any('Wallets/Connect-Bank-Account', 'User/Wallets/Create_Bank_Account');
Route::any('MyMI-Wallet', 'User/Wallets/MyMI_Wallet');
Route::any('Link-Account/TD-Ameritrade/(:any)', 'User/Brokerages/TD_Ameritrade/$1');
Route::any('Wallets/Link-Account', 'User/Wallets/Link_Account');
Route::any('Wallets/Link-Account/(:any)', 'User/Wallets/Link_Account/$1');
Route::any('Wallets/Link-Account/(:any)/(:any)', 'User/Wallets/Link_Account/$1');
/* Link Account Pages
- Wallets/Link-Account/Confirm                      - Confirm Account Information (provided by User)
- Wallets/Link-Account/Upload-Trades                - Upload Trades to Manually Added Accounts
- Wallets/Link-Account/TD-Ameritrade                - Automatically Import Account and Account Trades utilizing TDA API Integration
*/
// Route::any('Wallets/Link-Account-Successful', 'User/Wallets/Link_Account_Success');

// User - Transactional Modal
Route::any('Add-Wallet', 'User/Wallets/Add');
Route::any('Add-Wallet/Free/Fiat', 'User/Wallets/Add');
Route::any('Add-Wallet/Free/Digital', 'User/Wallets/Add');
Route::any('Add-Wallet/Premium/Fiat', 'User/Wallets/Add');
Route::any('Add-Wallet/Premium/Digital', 'User/Wallets/Add');
Route::any('Wallet-Selection/(:any)', 'User/Wallets/Wallet_Selection');
Route::any('Purchase-Wallet/(:any)', 'User/Wallets/Purchase');
Route::any('Purchase-Wallet/(:any)/(:any)', 'User/Wallets/Purchase');
Route::any('Deposit-Funds', 'User/Wallets/Deposit_Funds');
Route::any('Deposit-Funds/(:any)', 'User/Wallets/Deposit_Funds');
Route::any('Wallets/Confirm-Deposit/(:any)', 'User/Wallets/Confirm_Deposit');
Route::any('Wallets/Deposit-Complete/(:any)', 'User/Wallets/Deposit_Complete/$1');
Route::any('Wallets/Track-Deposit/(:any)', 'User/Wallets/Track_Deposit'); 
Route::any('Add-Wallet-Deposit-Fetch/(:any)', 'User/Wallets/Add_Deposit_Fetch');
Route::any('Withdraw-Funds', 'User/Wallets/Withdraw_Funds');
Route::any('Withdraw-Funds/(:any)', 'User/Wallets/Withdraw_Funds');
Route::any('Add-Wallet-Withdraw-Fetch/(:any)', 'User/Wallets/Add_Withdraw_Fetch');
Route::any('MyMI-Gold/Purchase/(:any)', 'User/Wallets/Purchase_Gold');
Route::any('Purchase-MyMI-Gold', 'User/Wallets/Purchase_MyMI_Gold');
Route::any('Wallets/Address-Generator', 'User/Wallets/Generate_Wallet');
Route::any('Wallet-Details/(:any)', 'User/Wallets/Details');
Route::any('MyMI-Gold/Purchase/(:any)', 'User/Wallets/Purchase_Gold/$1');
// Route::any('MyMI-Gold/Complete-Purchase', 'User/Dashboard/Purchase');
// Route::any('MyMI-Gold/Complete-Purchase/(:any)', 'User/Dashboard/Purchase');
// Route::any('MyMI-Gold/Purchase-Complete', 'User/Dashboard/Complete');
// Route::any('MyMI-Gold/Purchase-Complete/(:any)', 'User/Dashboard/Complete/$1');
Route::any('MyMI-Gold/Complete-Purchase', 'User/Wallets/Complete_Purchase');
Route::any('MyMI-Gold/Complete-Purchase/(:any)', 'User/Wallets/Complete_Purchase');
Route::any('MyMI-Gold/Purchase-Complete', 'User/Wallets/Purchase_Complete');
Route::any('MyMI-Gold/Purchase-Complete/(:any)', 'User/Wallets/Purchase_Complete/$1');
Route::any('Wallets/Purchase-Coins-Transaction', 'User/Wallets/Purchase_Coins_Transaction');

// User - Support
Route::any('Support', 'User/Support'); 
Route::any('Support/Communication-Manager', 'User/Support/Communication_Manager');
Route::any('Support/My-Requests', 'User/Support/My_Requests');

// User - Support Knowledgebase
Route::any('Knowledge-Base', 'User/Knowledgebase/index'); 
Route::any('Knowledge-Base/Account-And-Billing', 'User/Knowledgebase/Account_Billing');
Route::any('Knowledge-Base/Assets', 'User/Knowledgebase/Assets');
Route::any('Knowledge-Base/Getting-Started', 'User/Knowledgebase/Getting_Started');
Route::any('Knowledge-Base/Integrating-Wallets', 'User/Knowledgebase/Integrating_Wallets');
Route::any('Knowledge-Base/Investor-Profile', 'User/Knowledgebase/Investor_Profile');
Route::any('Knowledge-Base/KYC-Verification', 'User/Knowledgebase/KYC_Verification');
Route::any('Knowledge-Base/MyMI-Partnerships', 'User/Knowledgebase/Partnerships');
Route::any('Knowledge-Base/Technical-Support', 'User/Knowledgebase/Technical_Support');
Route::any('Knowledge-Base/Trade-Tracker', 'User/Knowledgebase/Trade_Tracker');
Route::any('Knowledge-Base/Types-Of-Accounts', 'User/Knowledgebase/Types_Of_Accounts');

// Management - Assets
Route::any('Management/Assets/Application', 'Management/Assets/Applications'); 
Route::any('Management/Assets/Application/Approve/(:any)', 'Management/Assets/Approval/$1');
Route::any('Management/Assets/Application/Deny/(:any)', 'Management/Assets/Deny/$1');
Route::any('Management/Assets/Application/Details/(:any)', 'Management/Assets/Application_Details'); 
Route::any('Management/Assets/Application/Details/(:any)/(:any)', 'Management/Assets/Application_Details'); 
Route::any('Management/Assets/Distribute', 'Management/Assets/Distribute'); 

// Management - Support 
Route::any('Management/Support', 'Management/Support/Reporting'); 
Route::any('Management/Support/Logs', 'Management/Support/Logs'); 
Route::any('Management/(:any)/Support', 'Management/Support/Reporting'); 
Route::any('Management/(:any)/Support/Requests', 'Management/Support/Requests'); 
Route::any('Management/(:any)/Support/Requests/(:any)', 'Management/Support/Requests'); 

// Management - User
Route::any('Management/Users/Assets/(:any)', 'Management/Users/Assets'); 
Route::any('Management/Users/Block/(:any)', 'Management/Users/Block'); 
Route::any('Management/Users/Distribute/(:any)', 'Management/Assets/Distribute'); 
Route::any('Management/Users/Force-Reset/(:any)', 'Management/Users/Force_Reset'); 
Route::any('Management/Users/Orders/(:any)', 'Management/Users/Orders'); 

// Management - Web Design
Route::any('Admin/Add-External-Site', 'Management/Admin/Add_External_Site');
Route::any('Content-Creator', 'Management/Web_Design/Content_Creator');
Route::any('Test-Page', 'Management/Web_Design/Test_Page');
Route::any('Management/Web-Design', 'Management/Web_Design/index');
Route::any('Management/Web-Design/Charts', 'Management/Web_Design/Charts');
Route::any('Management/Web-Design/Forms', 'Management/Web_Design/Forms');
Route::any('Management/Web-Design/Icons', 'Management/Web_Design/Icons');
Route::any('Management/Web-Design/Tables', 'Management/Web_Design/Tables');
Route::any('Management/Web-Design/Test-Page', 'Management/Web_Design/Test_Page');
Route::any('Management/Web-Design/Test-Page-CB', 'Management/Web_Design/Test_Page_CB');
Route::any('Management/Web-Design/Test-Page-Email', 'Management/Web_Design/Test_Page_Email');
Route::any('Management/Web-Design/UI-Elements', 'Management/Web_Design/UI_Elements');

// Contexts
Route::prefix(SITE_AREA, function () {
    Route::context('content', array('home' => SITE_AREA .'/content/index'));
    Route::context('reports', array('home' => SITE_AREA .'/reports/index'));
    Route::context('developer');
    Route::context('settings');
});

$route = Route::map($route);
