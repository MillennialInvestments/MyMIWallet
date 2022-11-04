<?php defined('BASEPATH') || exit('No direct script access allowed');
/**
 * User Support Dashboard
 * 
 * THINGS TO CREATE/FINISH:
 * 
 * KNOWLEDGE BASE PLANNING
 * 
What questions or topics do your employees or customers ask most often?
What department is overwhelmed by requests for information on a consistent basis?
What is your current response rate to employee and client questions and is that response rate getting longer?
Is productivity within your organization falling because information can’t efficiently be shared?
What serious gaps would exist if certain company employees left the organization and took their knowledge with them?
 * SUBMISSION PROCEDURES
       - Response Setup
       - Bug/Report Conversions within Response Form
       - Adjustment to topic, subject Database Fields
       - Further development of Communications Manager for other functionality in one manager
       - FAQ Development
 * KNOWLEDGEBASE CONSTRUCTION:
 *      - Header with Search Feature
        - Getting Started
 *          - Basic Setup
                - Creating A MyMI Account
 *                  - Account Type Details
 *              - KYC Verification
                    - KYC Process/Requirements                                                          Refer to following: https://www.cftc.gov/IndustryOversight/AntiMoneyLaundering/dsio_amlprograms.html
 *                  - Check KYC Status
                - Configuring Investor Profile
                    - How to update Investor Profile
                    - Investor Profile Parameters and What We Consider
 *          - Adding Wallets/Trades
 *              - Intergrating Wallets
 *                  - Ways to Integrate
 *                  - How to Manually Track Trades
 *                  - How to Integrate Brokerage Accounts
 *              - Trade History & Tracker
 *          - Analytical Customization
 *              - Trade Tracker Customization
 *              - Backtesting & Forecasting
 *                  - Customizable Indicators (Trade Tracker)
 *                  - Ways to Backtest Your Investments
 *                  - Trend Analysis
 *                  - Import/Exporting Real-Time & Historical Data
 *                  - Share Trade Analysis
 *                  - Get The Communnity Involved
 *                  - MyMI Trade Tracker - In-Depth Overview<
 *      - Types-Of-Accounts
 *          - Investor Account
 *              - Overview
 *              - Investor Profile & Demographics
 *              - Premium Brokerage Integrations
 *                  - List of Financial Brokerages
 *              - Investor Performance Analysis
 *                  - Initial Investor Analysis
 *                      - Risk/Reward Analysis
 *                      - Current Positioning Analysis
 *              - Updating Investor Profile                                                             Referred to Configuring Investor Profile
 *                  - How to update Investor Profile
 *              - Investor Marketplace
 *                  - Purchasing/Selling Financial Data
 *              - Resources & Tools
 *                  - Main Page/Description
 *                  - Accounting & Analytical Tools
 *                  - MyMI Wallets                                                                      Refer to Accounting & Analytical Tools KnowledgeBase
 *                  - Trade Tracker                                                                     Refer to Accounting & Analytical Tools KnowledgeBase
 *                  - What Are Assets                                                                   Refer to Asset Knowledge Base
 *                  - Asset Creator                                                                     Refer to Asset Knowledge Base
 *          - Partnerships
 *              - Partner Account
 *                  - Register A Partner Account
 *                  - KYC Verification & Policy                                                         Refer to Account / Billing Knowledge Base - KYC Verification
 *                  - Partner Service Agreement
 *              - Creating Partner Assets
 *                  - What are Partner Assets? 
 *                  - Partner Asset Creator
 *                  - MyMI Exchange                                                                     Refer to Exchange Knowledge Base
 *                  - How to Request Coin Listing                                                       Refer to Exchange Knowledge Base
 *                  - How Are Assets Valued?                                                            Refer to Exchange Knowledge Base
 *              - Partner Referrals
 *                  - How Partner Referrals Work? 
 *                  - Account Designation/Setup
 *                  - Reporting & Analytics 
 *                  - Revenue Distributions                                                             Refer to Account / Billing Knowledge Base - KYC Verification
 *          - Referral Program
 *              - How It Works
 *                  - Investor Referral
 *              - Get Started!
 *              - Monthly Distributions
 *                  - Schedule of Monthly Distributions                                                 **BUILD/CREATE**
 *                  - How Distributions Are Determined                                                  **BUILD/CREATE**
 *              - KYC Verification                                                                      Refer to Account / Billing Knowledge Base - KYC Verification
 *              - Terms And Agreements                                                                  **BUILD/CREATE**
 *      - KYC Verification
 *          - Overview
 *              - Anti-Money Laundering Laws
 *              - Account Type Requirements
 *                  - Investor Accounts (Individual KYC)                                                                  
 *                      - Basic Customer Due Diligence
 *                          - Documentation to verify Name & Location
 *                  - Partner Accounts (Corporate KYC)
 *                      - Enhanced Customer Due Diligence
 *                          - Required Information/Records
 *                              - Registration Number/EIN
 *                              - Company Name
 *                              - Company Address
 *                              - Status with Secretary of State
 *                              - Key Management Personnel
 *                              - Ownership Structure & Percentage of Ownership(s)
 *                              - Ultimate Beneficial Owners (UBOs)                                     https://www.trulioo.com/blog/ubo 
 *                              - Verifying Origins of Larger Sums
 *                              - Cash Transaction Threshold Reporting
 *                          - Periodic Due Diligence Reviews       
 *                              - Is the account record up-to-date?       
 *                              - Do the type and amount of transactions match the stated purpose of the account?       
 *                              - Is the risk-level appropriate for the type and amount of transactions      
 *                          - Financial Services Compliance                                             https://www.trulioo.com/blog/financial-services-compliance                     
 *                              - US Regulations                                                                            
 *                                  - NDAA                                                              https://www.fincen.gov/national-defense-authorization-act   
 *                                  - Corporate Transparency Act (CTA)                                                             
 *                                  - Self-Hosted Wallet Proposal                                       https://cointelegraph.com/news/president-biden-freezes-fincen-s-proposed-crypto-wallet-regulations                                                             
 *                                  - Constitutional Issues                                             https://www.forbes.com/sites/benjessel/2021/01/04/the-treasurys-crypto-reporting-proposal-may-be-a-fourth-amendment-breach/?sh=57e64302a1ee                                                             
 *                                  - Virtual Assets Red Flag Indicators of Money Laundering            http://www.fatf-gafi.org/publications/fatfrecommendations/documents/Virtual-Assets-Red-Flag-Indicators.html                                                             
 *                              - UK Regulations                                                             
 *                                  - 5th Anti-Money Laundering Directive (5AMLD)                       https://www.sygna.io/blog/what-is-amld5-anti-money-laundering-directive-five-a-guide/                                                             
 *                                  - Digital Finance Package                                           https://ec.europa.eu/malta/news/digital-finance-package-commission-sets-out-new-ambitious-approach-encourage-responsible_en                                                             
 *                                  - Regulation on Markets in Crypto Assets                            https://eur-lex.europa.eu/legal-content/EN/TXT/?uri=CELEX:52020PC0593                                                             
 *                          - Crypto KYC Verification Requirements                                      https://www.trulioo.com/blog/kyc-crypto                       
 *                          - Expected Issues                       
 *                              - Creating Separate Accounts under Different Names        
 *                              - Initiating Transactions from Non-Trusted IP Addresses        
 *                              - Incomplete or Insufficient KYC Information        
 *                              - Customers declining rquests for KYC documents or inquiries regading the source of funds        
 *                              - Customers providing forged or falsified identity documents or photographs        
 *                              - Customers who are on watch lists        
 *                              - Customers who frequently change their identification information        
 *              - Monitoring
 *                  - KPIs
 *                      - Spikes in Activities                                                            
 *                      - Out of Area or Unusual Cross-Border Activities
 *                      - Inclusion Of People on Sanctions Lists
 *                      - Adverse Media Mentions    
 *                  - Suspicious Activity Reporting
 *                      - Report Requirements                                                        
 *                      - Report Submissions                                                        
 *      - Integrating Wallets
            -   What are Crypto Wallets?
            -   How Do MyMI Wallets Work?
 *          -   Manually Adding/Importing Trades
 *          -   Premium Brokerage Integration
            -   Resources &amp; Tools
 *      - Trade Tracker
 *          -   Overview
 *          -   What is the MyMI Trade Track
 *      - Announcements
 *      - Accounting/Analytical Tools Knowledge Base
 *          -   MyMI Wallets
 *          -   Trade Tracker
 *      - Account / Billing Knowledge Base
 *          -   Account Information
 *          -   Partner Integration/Setup
 *          -   Referral Program Application
 *          -   KYC Verification                                                                        Refer to Account / Billing Knowledge Base - KYC Verification
 *          -   Payment Methods
 *          -   Payment History
 *          -   Distribution Schedule
 *          -   Customer Support
 *      - Assets Knowledge Base
 *          -   Creating Assets
 *          -   Asset Exchange
 *          -   Auctionable Assets
 *          -   Disputes/Balance Checks
 *          -   Asset Support
 *      - Exchange Knowledge Base (!!!NOT INCLUDED ON THE KNOWLEDGE BASE HOMEPAGE!!!) - Add
 *          - MyMI Exchange
 *          - How to Request Coin Listing
 *      - Partner Knowledge Base
 *          -   Account Information
 *          -   Assets & Exchange
 *          -   Withdrawals
 *          -   Partner Support
 *      - Technical Support Knowledge Base
 *          -   Account Security
 *          -   Bug/Reports
 *          -   Support History
 *          -   Tech Support
 *      - Direct Support Initiation
 *      - Discussion Forums
 * 
 * COMPLETED:
 */

/**
 * Users Controller.
 *
 * Provides front-end functions for users, including access to login and logout.
 *
 * @package Bonfire\Modules\Users\Controllers\Users
 * @author     Bonfire Dev Team
 * @link    http://cibonfire.com/docs/developer
 */
class Knowledgebase extends Admin_Controller
{
    /** @var array Site's settings to be passed to the view. */
    private $siteSettings;

    /**
     * Setup the required libraries etc.
     *
     * @retun void
     */
    public function __construct()
    {
        parent::__construct();
        //$this->load->module('ContactUs');
        $this->load->library('Template');
        $this->load->model(array('User/dashboard_model', 'User/exchange_model', 'User/public_model'));
    }

    // -------------------------------------------------------------------------
    // Main Blog Post Page
    // -------------------------------------------------------------------------

    public function index()
    {
        $pageType = 'Standard';
        $pageName = 'User_Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Getting_Started()
    {
        $pageType = 'Standard';
        $pageName = 'User_Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Integrating_Wallets() 
   {
        $pageType = 'Standard';
        $pageName = 'User_Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Investor_Profile()
    {
        $pageType = 'Standard';
        $pageName = 'User_Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function KYC_Verification()
    {
        $pageType = 'Standard';
        $pageName = 'User_Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Trade_Tracker()
    {
        $pageType = 'Standard';
        $pageName = 'User_Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Types_Of_Accounts()
    {
        $pageType = 'Standard';
        $pageName = 'User_Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    private function saveData($type = 'insert', $id = 0)
    {
        if ($type != 'insert') {
            if ($id == 0) {
                $id = $navbarID;
            }
            $_POST['id'] = $id;
            
            // Security check to ensure the posted id is the current navbar's id.
            if ($_POST['id'] != $id) {
                $this->form_validation->set_message('email', 'Invalid Navbar ID');
                return false;
            }
        }
        
        $this->form_validation->set_rules($this->dashboard_model->get_validation_rules($type));
        
        // Setting the payload for Events System.
        $payload = array('id' => $id, 'data' => $this->input->post());
        
        // Events "before_navbar_validation to run before the form validation.
        Events::trigger('before_user_validation', $payload);
        
        if ($this->form_validation->run() === false) {
            return false;
        }
        
        //Compile our core user elements to save.
        $data = $this->dashboard_model->prep_data($this->input->post());
        $result = false;
        
        if ($type == 'insert') {
            $id = $this->dashboard_model->insert($data);
            if (is_numeric($id)) {
                $result = $id;
            }
        } else {
            $result = $this->dashboard_model->update($id, $data);
        }
        
        // Add result to payload.
        $payload['result'] = $result;
        // Trigger Event after saving the user.
        Events::trigger('save_user', $payload);
        
        return $result;
    }
    
    protected function set_current_user()
    {
        if (class_exists('Auth')) {
            // Load our current logged in user for convenience
            if ($this->auth->is_logged_in()) {
                $this->current_user = clone $this->auth->user();

                $this->current_user->user_img = gravatar_link($this->current_user->email, 22, $this->current_user->email, "{$this->current_user->email} Profile");

                // if the user has a language setting then use it
                if (isset($this->current_user->language)) {
                    $this->config->set_item('language', $this->current_user->language);
                }
            } else {
                $this->current_user = null;
            }

            // Make the current user available in the views
            if (! class_exists('Template')) {
                $this->load->library('Template');
            }
            Template::set('current_user', $this->current_user);
        }
    }
    /* end ./application/controllers/home.php */
}
