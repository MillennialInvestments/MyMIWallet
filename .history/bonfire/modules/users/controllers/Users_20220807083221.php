<?php defined('BASEPATH') || exit('No direct script access allowed');
/**
 * Bonfire
 *
 * An open source project to allow developers to jumpstart their development of
 * CodeIgniter applications.
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2014, Bonfire Dev Team
 * @license   http://opensource.org/licenses/MIT
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
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

class Users extends Front_Controller
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

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->model(array('users/user_model', 'User/public_model', 'User/investment_model'));

        $this->load->library('users/auth');

        $this->lang->load('users');
        $this->siteSettings = $this->settings_lib->find_all();
        if ($this->siteSettings['auth.password_show_labels'] == 1) {
            Assets::add_module_js('users', 'password_strength.js');
            Assets::add_module_js('users', 'jquery.strength.js');
        }
    }

    // -------------------------------------------------------------------------
    // Authentication (Login/Logout)
    // -------------------------------------------------------------------------

    /**
     * Present the login view and allow the user to login.
     *
     * @return void
     */
    public function login()
    {
        $pageName = 'Login';
        $pageType = 'Standard';
        Template::set('pageName', $pageName);
        Template::set('pageType', $pageType);
        if (!empty($_SESSION['user_id'])) {
             $cuID 			            = $_SESSION['user_id'];
        } else {
            $cuID                       = $this->input->ip_address();
        }
        $betaStatus                     = $this->config->item('beta');
        if ($betaStatus === 0) {
            $beta                       = 'No';
        } else {
            $beta                       = 'Yes';
        }
        $thisController                 = $this->router->fetch_class();
        $thisMethod                     = $this->router->fetch_method();
        $thisURL                        = $this->uri->uri_string();
        $thisFullURL                    = $this->uri->current_url();
        // If the user is already logged in, go home.
        if ($this->auth->is_logged_in() !== false) {
            Template::redirect('/Dashboard');
        }

        // Try to login.
        if (isset($_POST['log-me-in'])
            && true === $this->auth->login(
                $this->input->post('login'),
                $this->input->post('password'),
                $this->input->post('remember_me') == '1'
            )
        ) {
            log_activity(
                $this->auth->user_id(),
                lang('us_log_logged') . ': ' . $this->input->ip_address(),
                'users'
            );
            $thisComment                    = 'User (' . $cuID . ') successfully logged into the following page: ' . $thisURL;
            $this->mymilogger
                ->user($cuID) //Set UserID, who created this  Action
                ->beta($beta) //Set whether in Beta or nto
                ->type('User Account') //Entry type like, Post, Page, Entry
                ->controller($thisController)
                ->method($thisMethod)
                ->url($thisURL)
                ->full_url($thisFullURL)
                ->comment($thisComment) //Token identify Action
                ->log(); //Add Database Entry

            // Now redirect. (If this ever changes to render something, note that
            // auth->login() currently doesn't attempt to fix `$this->current_user`
            // for the current page load).

            // If the site is configured to use role-based login destinations and
            // the login destination has been set...
            //~ if ($this->settings_lib->item('auth.do_login_redirect')
            //~ && ! empty($this->auth->login_destination)
            //~ ) {
            //~ Template::redirect($this->auth->login_destination);
            //~ }

            // If possible, send the user to the requested page.
            if (! empty($this->requested_page)) {
                if ($this->requested_page === site_url('')) {
                    Template::redirect('/Dashboard');
                } else {
                    Template::redirect($this->requested_page);
                }
            }
            
            
            //~ if ($this->settings_lib->item('auth.do_login_redirect')
            //~ && ! empty($this->auth->login_destination)
            //~ ) {
            //~ Template::redirect($this->auth->login_destination);
            //~ }

            // If there is nowhere else to go, go home.
            Template::redirect('/Dashboard');
        }

        // Prompt the user to login.
        Template::set('page_title', 'Login');
        Template::render('login');
    }

    /**
     * Log out, destroy the session, and cleanup, then redirect to the home page.
     *
     * @return void
     */
    public function logout()
    {
        if (!empty($_SESSION['user_id'])) {
             $cuID 			            = $_SESSION['user_id'];
        } else {
            $cuID                       = $this->input->ip_address();
        }
        $betaStatus                     = $this->config->item('beta');
        if ($betaStatus === 0) {
            $beta                       = 'No';
        } else {
            $beta                       = 'Yes';
        }
        $thisController                 = $this->router->fetch_class();
        $thisMethod                     = $this->router->fetch_method();
        $thisURL                        = $this->uri->uri_string();
        $thisFullURL                    = $this->uri->current_url();
        if (isset($this->current_user->id)) {
            // Login session is valid. Log the Activity.
            log_activity(
                $this->current_user->id,
                lang('us_log_logged_out') . ': ' . $this->input->ip_address(),
                'users'
            );
            $thisComment                    = 'User (' . $cuID . ') successfully logged out!';
            $this->mymilogger
                ->user($cuID) //Set UserID, who created this  Action
                ->beta($beta) //Set whether in Beta or nto
                ->type('User Account') //Entry type like, Post, Page, Entry
                ->controller($thisController)
                ->method($thisMethod)
                ->url($thisURL)
                ->full_url($thisFullURL)
                ->comment($thisComment) //Token identify Action
                ->log(); //Add Database Entry
        }

        // Always clear browser data (don't silently ignore user requests).
        $this->auth->logout();
        Template::redirect('/');
    }

    // -------------------------------------------------------------------------
    // User Management (Register/Update Profile)
    // -------------------------------------------------------------------------

    /**
     * Allow a user to edit their own profile information.
     *
     * @return void
     */
    public function profile()
    {
        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();

        $this->load->helper('date');

        $this->load->config('address');
        $this->load->helper('address');

        $this->load->config('user_meta');
        $meta_fields = config_item('user_meta_fields');

        Template::set('meta_fields', $meta_fields);

        if (isset($_POST['save'])) {
            $user_id = $this->current_user->id;
            if ($this->saveUser('update', $user_id, $meta_fields)) {
                $user = $this->user_model->find($user_id);
                $log_name = empty($user->display_name) ?
                    ($this->settings_lib->item('auth.use_usernames') ? $user->username : $user->email)
                    : $user->display_name;

                log_activity(
                    $this->current_user->id,
                    lang('us_log_edit_profile') . ": {$log_name}",
                    'users'
                );

                Template::set_message(lang('us_profile_updated_success'), 'success');

                // Redirect to make sure any language changes are picked up.
                Template::redirect('/users/profile');
            }

            Template::set_message(lang('us_profile_updated_error'), 'error');
        }

        // Get the current user information.
        $user = $this->user_model->find_user_and_meta($this->current_user->id);

        if ($this->siteSettings['auth.password_show_labels'] == 1) {
            Assets::add_js(
                $this->load->view('users_js', array('settings' => $this->siteSettings), true),
                'inline'
            );
        }

        // Generate password hint messages.
        $this->user_model->password_hints();

        Template::set('user', $user);
        Template::set('languages', unserialize($this->settings_lib->item('site.languages')));

        Template::set_view('profile');
        Template::render();
    }

    /**
     * Display the registration form for the user and manage the registration process.
     *
     * The redirect URLs for success (Login) and failure (register) can be overridden
     * by including a hidden field in the form for each, named 'register_url' and
     * 'login_url' respectively.
     *
     * @return void
     */public function register()
    {
        // Are users allowed to register?
        if (! $this->settings_lib->item('auth.allow_register')) {
            Template::set_message(lang('us_register_disabled'), 'error');
            Template::redirect('/');
        }

        // return an error of your choosing
        $id	 				            = $this->input->post('id');
        $beta                           = $this->input->post('beta');
        $type	 			            = $this->input->post('type');
        $partner 			            = $this->input->post('partner');
        $investor 			            = $this->input->post('investor');
        $organization		            = $this->input->post('organization');
        $signup_date		            = $this->input->post('signup_date');
        $account_type                   = $this->input->post('account_type');
        $email	 			            = $this->input->post('email');
        $username			            = $this->input->post('username');
        $user_email	 		            = $email;
        $register_url 		            = $this->input->post('register_url') ?: REGISTER_URL;
        $login_url    		            = $this->input->post('login_url') ?: LOGIN_URL;
                
        $phone				            = $this->input->post('phone');
        $address			            = $this->input->post('address');
        $city				            = $this->input->post('city');
        $state				            = $this->input->post('state');
        $country			            = $this->input->post('country');
        $zipcode			            = $this->input->post('zipcode');
                
        // Default Wallet Information
        $default_wallet		            = 'Yes';
        $exchange_wallet	            = 'Yes';
        $active				            = 'Yes';
        $market_pair		            = 'USD';
        $market				            = 'MYMI';
        $broker				            = 'Default';
        $nickname			            = 'MyMI Funds';
        $wallet_type		            = 'Fiat';
        $amount				            = '0.00';

        // Set Activity Logger Configuration
        if (!empty($_SESSION['user_id'])) {
             $cuID 			            = $_SESSION['user_id'];
        } else {
            $cuID                       = $this->input->ip_address();
        }
        $betaStatus                     = $this->config->item('beta');
        if ($betaStatus === 0) {
            $betaAlt                    = 'No';
        } else {
            $betaAlt                    = 'Yes';
        }
        $thisController                 = $this->router->fetch_class();
        $thisMethod                     = $this->router->fetch_method();
        $thisURL                        = $this->uri->uri_string();
        $thisFullURL                    = $this->uri->current_url();
                
        $this->load->model('roles/role_model');
        $this->load->helper('date');

        $this->load->config('address');
        $this->load->helper('address');
        $pageType		                = 'register';
        // $this->load->config('user_meta');
        // $meta_fields = config_item('user_meta_fields');
        // Template::set('meta_fields', $meta_fields);
        Template::set('pageType', $pageType);

        if (isset($_POST['register'])) {
            $score = get_recapture_score($this->input->post('g-recaptcha-response'));
        
            if ($score > RECAPTCHA_ACCEPTABLE_SPAM_SCORE) {
                if ($userId = $this->saveUser('insert', 0)) {
                    if ($this->user_model->add_social_networks($id, $email, $username)) {
                        if ($this->user_model->add_default_wallet($id, $active, $beta, $default_wallet, $exchange_wallet, $market_pair, $market, $username, $email, $broker, $wallet_type, $amount, $nickname)) {
                            // User Activation
                            $activation = $this->user_model->set_activation($userId);
                            $message    = $activation['message'];
                            $error      = $activation['error'];

                            Template::set_message($message, $error ? 'error' : 'success');

                            log_activity($userId, 'User registered account', 'users');
                            Template::redirect('Verify-Email/' . $userId);
                            $thisComment                    = 'User (' . $cuID . ') successfully registered an account!';
                            $this->mymilogger
                                ->user($cuID) //Set UserID, who created this  Action
                                ->beta($betaAlt) //Set whether in Beta or nto
                                ->type('User Account') //Entry type like, Post, Page, Entry
                                ->controller($thisController)
                                ->method($thisMethod)
                                ->url($thisURL)
                                ->full_url($thisFullURL)
                                ->comment($thisComment) //Token identify Action
                                ->log(); //Add Database Entry
                        }
                    }
                } else {
                    $thisComment                    = 'ERROR: User (' . $cuID . ') Account registration failed!';
                    $this->mymilogger
                        ->user($cuID) //Set UserID, who created this  Action
                        ->beta($betaAlt) //Set whether in Beta or nto
                        ->type('User Account') //Entry type like, Post, Page, Entry
                        ->controller($thisController)
                        ->method($thisMethod)
                        ->url($thisURL)
                        ->full_url($thisFullURL)
                        ->comment($thisComment) //Token identify Action
                        ->log(); //Add Database Entry
                    Template::set_message(lang('us_registration_fail'), 'error');
                    // Don't redirect because validation errors will be lost.
                }
            } else {
                $thisComment                    = 'ERROR: User (' . $cuID . ') Registration Recaptcha failed!';
                $this->mymilogger
                    ->user($cuID) //Set UserID, who created this  Action
                    ->beta($betaAlt) //Set whether in Beta or nto
                    ->type('User Account') //Entry type like, Post, Page, Entry
                    ->controller($thisController)
                    ->method($thisMethod)
                    ->url($thisURL)
                    ->full_url($thisFullURL)
                    ->comment($thisComment) //Token identify Action
                    ->log(); //Add Database Entry
                Template::set_message(lang('us_registration_fail'), 'error');
                // Don't redirect because validation errors will be lost.
                Template::set_message('Potential Spam! Please verify you are not a robot.', 'error'); 
                Template::redirect($this->uri->uri_string()); 
            }
        }

        if ($this->siteSettings['auth.password_show_labels'] == 1) {
            Assets::add_js(
                $this->load->view('users_js', array('settings' => $this->siteSettings), true),
                'inline'
            );
        }

        // Generate password hint messages.
        $this->user_model->password_hints();

        Template::set_view('users/register');
        Template::set('languages', unserialize($this->settings_lib->item('site.languages')));
        Template::set('page_title', 'Register');
        Template::render();
    }

    // -------------------------------------------------------------------------
    // Password Management
    // -------------------------------------------------------------------------

    /**
     * Allow a user to request the reset of a forgotten password. An email is sent
     * with a special temporary link that is only valid for 24 hours. This link
     * takes the user to reset_password().
     *
     * @return void
     */
    public function forgot_password()
    {
        // Set Activity Logger Variables
        if (!empty($_SESSION['user_id'])) {
             $cuID 			            = $_SESSION['user_id'];
        } else {
            $cuID                       = $this->input->ip_address();
        }
        $betaStatus                     = $this->config->item('beta');
        if ($betaStatus === 0) {
            $beta                       = 'No';
        } else {
            $beta                       = 'Yes';
        }
        $thisController                 = $this->router->fetch_class();
        $thisMethod                     = $this->router->fetch_method();
        $thisURL                        = $this->uri->uri_string();
        $thisFullURL                    = $this->uri->current_url();
        // If the user is logged in, go home.
        if ($this->auth->is_logged_in() !== false) {
            $thisComment                    = 'Forgot Password: User (' . $cuID . ') is already logged in!';
            $this->mymilogger
                ->user($cuID) //Set UserID, who created this  Action
                ->beta($beta) //Set whether in Beta or nto
                ->type('User Account') //Entry type like, Post, Page, Entry
                ->controller($thisController)
                ->method($thisMethod)
                ->url($thisURL)
                ->full_url($thisFullURL)
                ->comment($thisComment) //Token identify Action
                ->log(); //Add Database Entry
            Template::redirect('/');
        }

        if (isset($_POST['send'])) {
            // Validate the form to ensure a valid email was entered.
            $this->form_validation->set_rules('email', 'lang:bf_email', 'required|trim|valid_email');
            if ($this->form_validation->run() !== false) {
                // Validation passed. Does the user actually exist?
                $user = $this->user_model->find_by('email', $this->input->post('email'));
                if ($user === false) {
                    // No user found with the entered email address.
                    Template::set_message(lang('us_invalid_email'), 'error');
                } else {
                    // User exists, create a hash to confirm the reset request.
                    $this->load->helper('string');
                    $hash = sha1(random_string('alnum', 40) . $this->input->post('email'));

                    // Save the hash to the db for later retrieval.
                    $this->user_model->update_where(
                        'email',
                        $this->input->post('email'),
                        array('reset_hash' => $hash, 'reset_by' => strtotime("+24 hours"))
                    );

                    // Create the link to reset the password.
                    $pass_link = site_url('reset_password/' . str_replace('@', ':', $this->input->post('email')) . "/{$hash}");

                    // Now send the email
                    $this->load->library('emailer/emailer');
                    $data = array(
                        'to'      => $this->input->post('email'),
                        'subject' => lang('us_reset_pass_subject'),
                        'message' => $this->load->view(
                            '_emails/forgot_password',
                            array('link' => $pass_link),
                            true
                        ),
                     );

                    if ($this->emailer->send($data)) {
                        log_activity($cuID, 'User forgot password', 'users');
                        $thisComment                    = 'Forgot Password: User (' . $cuID . ') Instructions sent via email!';
                        $this->mymilogger
                            ->user($cuID) //Set UserID, who created this  Action
                            ->beta($beta) //Set whether in Beta or nto
                            ->type('User Account') //Entry type like, Post, Page, Entry
                            ->controller($thisController)
                            ->method($thisMethod)
                            ->url($thisURL)
                            ->full_url($thisFullURL)
                            ->comment($thisComment) //Token identify Action
                            ->log(); //Add Database Entry
                        Template::set_message(lang('us_reset_pass_message'), 'success');
                    } else {
                        $thisComment                    = 'ERRORR: Forgot Password: User (' . $cuID . ') Instructions failed to be sent via email!';
                        $this->mymilogger
                            ->user($cuID) //Set UserID, who created this  Action
                            ->beta($beta) //Set whether in Beta or nto
                            ->type('User Account') //Entry type like, Post, Page, Entry
                            ->controller($thisController)
                            ->method($thisMethod)
                            ->url($thisURL)
                            ->full_url($thisFullURL)
                            ->comment($thisComment) //Token identify Action
                            ->log(); //Add Database Entry
                        Template::set_message(lang('us_reset_pass_error') . $this->emailer->error, 'error');
                    }
                }
            }
        }

        Template::set_view('users/forgot_password');
        Template::set('page_title', 'Password Reset');
        Template::render();
    }

    /**
     * Allows the user to create a new password for their account. At the moment,
     * the only way to get here is to go through the forgot_password() process,
     * which creates a unique code that is only valid for 24 hours.
     *
     * Since 0.7 this method is also reached via the force_password_reset security
     * features.
     *
     * @param string $email The email address to check against.
     * @param string $code  A randomly generated alphanumeric code. (Generated by
     * forgot_password()).
     *
     * @return void
     */
    public function reset_password($email = '', $code = '')
    {
        // Set Activity Logger Variables
        if (!empty($_SESSION['user_id'])) {
             $cuID 			            = $_SESSION['user_id'];
        } else {
            $cuID                       = $this->input->ip_address();
        }
        $betaStatus                     = $this->config->item('beta');
        if ($betaStatus === 0) {
            $beta                       = 'No';
        } else {
            $beta                       = 'Yes';
        }
        $thisController                 = $this->router->fetch_class();
        $thisMethod                     = $this->router->fetch_method();
        $thisURL                        = $this->uri->uri_string();
        $thisFullURL                    = $this->uri->current_url();
        // If the user is logged in, go home.
        if ($this->auth->is_logged_in() !== false) {
            $thisComment                    = 'Reset Password: User (' . $cuID . ') is already logged in!';
            $this->mymilogger
                ->user($cuID) //Set UserID, who created this  Action
                ->beta($beta) //Set whether in Beta or nto
                ->type('User Account') //Entry type like, Post, Page, Entry
                ->controller($thisController)
                ->method($thisMethod)
                ->url($thisURL)
                ->full_url($thisFullURL)
                ->comment($thisComment) //Token identify Action
                ->log(); //Add Database Entry
            Template::redirect('/');
        }

        // Bonfire may have stored the email and code in the session.
        if (empty($code) && $this->session->userdata('pass_check')) {
            $code = $this->session->userdata('pass_check');
        }

        if (empty($email) && $this->session->userdata('email')) {
            $email = $this->session->userdata('email');
        }

        // If there is no code/email, then it's not a valid request.
        if (empty($code) || empty($email)) {
            Template::set_message(lang('us_reset_invalid_email'), 'error');
            Template::redirect(LOGIN_URL);
        }

        // Handle the form
        if (isset($_POST['set_password'])) {
            $this->form_validation->set_rules('password', 'lang:bf_password', 'required|max_length[120]|valid_password');
            $this->form_validation->set_rules('pass_confirm', 'lang:bf_password_confirm', 'required|matches[password]');

            if ($this->form_validation->run() !== false) {
                // The user model will create the password hash.
                $data = array(
                    'password'   => $this->input->post('password'),
                                  'reset_by'    => 0,
                                  'reset_hash'  => '',
                    'force_password_reset' => 0,
                );
                if ($this->user_model->update($this->input->post('user_id'), $data)) {
                    log_activity($this->input->post('user_id'), 'User Reset Password', 'users');
                    $thisComment                    = 'User (' . $cuID . ') successfully reset password';
                    $this->mymilogger
                        ->user($cuID) //Set UserID, who created this  Action
                        ->beta($beta) //Set whether in Beta or nto
                        ->type('Account') //Entry type like, Post, Page, Entry
                        ->controller($thisController)
                        ->method($thisMethod)
                        ->url($thisURL)
                        ->full_url($thisFullURL)
                        ->comment($thisComment) //Token identify Action
                        ->log(); //Add Database Entry

                    Template::set_message(lang('us_reset_password_success'), 'success');
                    Template::redirect(LOGIN_URL);
                }

                if (! empty($this->user_model->error)) {
                    $thisComment                    = 'User (' . $cuID . ') failed to reset password';
                    $this->mymilogger
                        ->user($cuID) //Set UserID, who created this  Action
                        ->beta($beta) //Set whether in Beta or nto
                        ->type('User Account') //Entry type like, Post, Page, Entry
                        ->controller($thisController)
                        ->method($thisMethod)
                        ->url($thisURL)
                        ->full_url($thisFullURL)
                        ->comment($thisComment) //Token identify Action
                        ->log(); //Add Database Entry
                    Template::set_message(sprintf(lang('us_reset_password_error'), $this->user_model->error), 'error');
                }
            }
        }

        // Check the code against the database
        $email = str_replace(':', '@', $email);
        $user = $this->user_model->find_by(
            array(
                'email'       => $email,
                'reset_hash'  => $code,
                'reset_by >=' => time(),
            )
        );

        // $user will be an Object if a single result was returned.
        if (! is_object($user)) {
            Template::set_message(lang('us_reset_invalid_email'), 'error');
            Template::redirect(LOGIN_URL);
        }

        if ($this->siteSettings['auth.password_show_labels'] == 1) {
            Assets::add_js(
                $this->load->view('users_js', array('settings' => $this->siteSettings), true),
                'inline'
            );
        }

        // At this point, it is a valid request....
        Template::set('user', $user);

        Template::set_view('users/reset_password');
        Template::render();
    }
   
    public function Verify_Email($userID)
    {
        $pageType = 'Standard';
        $pageName = 'Verify_Email';
        $this->load->library('users/auth');
        $this->set_current_user();
        
        // Set Activity Logger Variables
        if (!empty($_SESSION['user_id'])) {
             $cuID 			            = $_SESSION['user_id'];
        } else {
            $cuID                       = $this->input->ip_address();
        }
        $betaStatus                     = $this->config->item('beta');
        if ($betaStatus === 0) {
            $beta                       = 'No';
        } else {
            $beta                       = 'Yes';
        }
        $thisController                 = $this->router->fetch_class();
        $thisMethod                     = $this->router->fetch_method();
        $thisURL                        = $this->uri->uri_string();
        $thisFullURL                    = $this->uri->current_url();
        $thisComment                    = 'User (' . $cuID . ') has reached Email Verification Notification';
        $this->mymilogger
            ->user($cuID) //Set UserID, who created this  Action
            ->beta($beta) //Set whether in Beta or nto
            ->type('User Account') //Entry type like, Post, Page, Entry
            ->controller($thisController)
            ->method($thisMethod)
            ->url($thisURL)
            ->full_url($thisFullURL)
            ->comment($thisComment) //Token identify Action
            ->log(); //Add Database Entry
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function Account_Information()
    {
        $pageType = 'Standard';
        $pageName = 'Account_Information';
        $this->load->library('users/auth');
        $this->load->module('User/Wallets');
        $this->set_current_user();
        $this->auth->restrict();
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        $this->form_validation->set_rules('subpage_name', 'Subpage Name', 'trim');
        $this->form_validation->set_rules('subpage_link', 'Subpage Link', 'trim');
        $this->form_validation->set_rules('subpage_icon', 'Subpage Icon', 'trim');
        $this->load->model('roles/role_model');
        $this->load->helper('date');

        $this->load->config('address');
        $this->load->helper('address');
        $this->load->config('user_meta');
        $meta_fields        = config_item('user_meta_fields');
        Template::set('meta_fields', $meta_fields);
        Template::set('pageType', $pageType);
        // Default Wallet Information
        $betaSetting		= $this->config->item('beta');
        if ($betaSetting === 1) {
            $beta			= 'Yes';
        } else {
            $beta			= 'No';
        }
        $active				= 'Yes';
        $default_wallet		= 'Yes';
        $exchange_wallet	= 'Yes';
        $market_pair		= 'USD';
        $market				= 'MYMI';
        $broker				= 'Default';
        $wallet_type		= 'Fiat';
        $amount				= '0.00';
        $nickname			= 'MyMI Funds';
        // Set Activity Logger Variables
        if (!empty($_SESSION['user_id'])) {
            $cuID 			            = $_SESSION['user_id'];
        } else {
            $cuID                       = $this->input->ip_address();
        }
        $thisController                 = $this->router->fetch_class();
        $thisMethod                     = $this->router->fetch_method();
        $thisURL                        = $this->uri->uri_string();
        $thisFullURL                    = $this->uri->current_url();
        
        if ($this->form_validation->run() === false) {
            $this->load->view('users/Account_Information');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $user_id				= $this->input->post('user_id');
            $private_key            = $this->input->post('private_key');
            $wallet_id              = $this->input->post('public_key');
            $realize_id             = $this->input->post('realize_id');
            $first_name				= $this->input->post('first_name');
            $middle_name			= $this->input->post('middle_name');
            $last_name				= $this->input->post('last_name');
            $name_suffix			= $this->input->post('name_suffix');
            $phone					= $this->input->post('phone');
            $address				= $this->input->post('address');
            $city					= $this->input->post('city');
            $state					= $this->input->post('state');
            $country				= $this->input->post('country');
            $zipcode				= $this->input->post('zipcode');
            $timezones				= $this->input->post('timezones');
            $language				= $this->input->post('language');
            $advertisement			= $this->input->post('advertisement');
            
            if ($this->user_model->add_account_information($user_id, $private_key, $wallet_id, $realize_id, $first_name, $middle_name, $last_name, $name_suffix, $phone, $address, $city, $state, $country, $zipcode, $timezones, $language, $advertisement)) {
                // user creation ok
                $thisComment                    = 'User (' . $cuID . ') has successfully updated their Account Information.';
                $this->mymilogger
                    ->user($cuID) //Set UserID, who created this  Action
                    ->beta($beta) //Set whether in Beta or nto
                    ->type('User Account') //Entry type like, Post, Page, Entry
                    ->controller($thisController)
                    ->method($thisMethod)
                    ->url($thisURL)
                    ->full_url($thisFullURL)
                    ->comment($thisComment) //Token identify Action
                    ->log(); //Add Database Entry
                Template::set_message('Account Information Submitted Successfully', 'success');
                redirect('/Registration-Successful/' . $user_id);
            } else {
                
                $thisComment                    = 'ERROR: User (' . $cuID . ') failed to successfully update their Account Information.';
                $this->mymilogger
                    ->user($cuID) //Set UserID, who created this  Action
                    ->beta($beta) //Set whether in Beta or nto
                    ->type('User Account') //Entry type like, Post, Page, Entry
                    ->controller($thisController)
                    ->method($thisMethod)
                    ->url($thisURL)
                    ->full_url($thisFullURL)
                    ->comment($thisComment) //Token identify Action
                    ->log(); //Add Database Entry
                // user creation failed, this should never happen
                $data->error = 'There was a problem udpating your account information. Please try again or contact us at <a href="mailto:support@mymiwallet.com">support@mymiwallet.com</a>.';
                
                // send error to the view
                $this->load->view('users/Account_Information', $data);
                Template::set_message('There was a problem udpating your account information. Please try again or contact us at <a href="mailto:support@mymiwallet.com">support@mymiwallet.com</a>.', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
        }
    }
    
    public function Successful_Cancellation()
    {
        $pageType = 'Standard';
        $pageName = 'User_Successful_Cancellation';
        $this->load->library('users/auth');
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
        
    public function Successful_Downgrade()
    {
        $pageType = 'Standard';
        $pageName = 'User_Successful_Downgrade';
        $this->load->library('users/auth');
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
        
    public function Successful_Registration()
    {
        $pageType = 'Standard';
        $pageName = 'User_Successful_Registration';
        $this->load->library('users/auth');
        $this->set_current_user();
        $this->auth->restrict();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    //--------------------------------------------------------------------------
    // ACTIVATION METHODS
    //--------------------------------------------------------------------------

    /**
     * Activate user.
     *
     * Checks a passed activation code and, if verified, enables the user account.
     * If the code fails, an error is generated.
     *
     * @param  integer $user_id The user's ID.
     *
     * @return void
     */
    public function activate($user_id = null)
    {
        if (isset($_POST['activate'])) {
            $this->form_validation->set_rules('code', 'Verification Code', 'required|trim');
            if ($this->form_validation->run()) {
                $code = $this->input->post('code');
                $activated = $this->user_model->activate($user_id, $code);
                if ($activated) {
                    $user_id = $activated;

                    // Now send the email.
                    $this->load->library('emailer/emailer');
                    $email_message_data = array(
                        'title' => $this->settings_lib->item('site.title'),
                        'link'  => site_url('/Account-Information/' . $user_id),
                    );
                    $data = array(
                        'to'      => $this->user_model->find($user_id)->email,
                        'subject' => lang('us_account_active'),
                        'message' => $this->load->view('_emails/activated', $email_message_data, true),
                    );

                    if ($this->emailer->send($data)) {
                        Template::set_message(lang('us_account_active'), 'success');
                    } else {
                        Template::set_message(lang('us_err_no_email'). $this->emailer->error, 'error');
                    }

                    Template::redirect('/Account-Information/'. $user_id);
                }

                if (! empty($this->user_model->error)) {
                    Template::set_message($this->user_model->error . '. ' . lang('us_err_activate_code'), 'error');
                }
            }
        }
        $pageType               = 'Standard';
        $pageName               = 'Activate';
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::set_view('users/activate');
        Template::set('page_title', 'Account Activation');
        Template::render();
    }

    /**
     * Allow a user to request another activation code. If the email address matches
     * an existing account, the code is resent.
     *
     * @return void
     */
    public function resend_activation()
    {
        if (isset($_POST['send'])) {
            $this->form_validation->set_rules('email', 'lang:bf_email', 'required|trim|valid_email');

            if ($this->form_validation->run()) {
                // Form validated. Does the user actually exist?
                $user = $this->user_model->find_by('email', $_POST['email']);
                if ($user === false) {
                    Template::set_message('Cannot find that email in our records.', 'error');
                } else {
                    $activation = $this->user_model->set_activation($user->id);
                    $message = $activation['message'];
                    $error = $activation['error'];

                    Template::set_message($message, $error ? 'error' : 'success');
                }
            }
        }

        Template::set_view('users/resend_activation');
        Template::set('page_title', 'Activate Account');
        Template::render();
    }

    // -------------------------------------------------------------------------
    // Private Methods
    // -------------------------------------------------------------------------

    /**
     * Save the user.
     *
     * @param  string  $type            The type of operation ('insert' or 'update').
     * @param  integer $id              The id of the user (ignored on insert).
     * @param  array   $metaFields      Array of meta fields for the user.
     *
     * @return boolean/integer The id of the inserted user or true on successful
     * update. False if the insert/update failed.
     */
    private function saveUser($type = 'insert', $id = 0, $metaFields = array())
    {
        $extraUniqueRule = '';

        if ($type != 'insert') {
            if ($id == 0) {
                $id = $this->current_user->id;
            }
            $_POST['id'] = $id;

            // Security check to ensure the posted id is the current user's id.
            if ($_POST['id'] != $this->current_user->id) {
                $this->form_validation->set_message('email', 'lang:us_invalid_userid');
                return false;
            }

            $extraUniqueRule = ',users.id';
        }

        $this->form_validation->set_rules($this->user_model->get_validation_rules($type));

        $usernameRequired = '';
        if ($this->settings_lib->item('auth.login_type') == 'username'
            || $this->settings_lib->item('auth.use_usernames')
        ) {
            $usernameRequired = 'required|';
        }

        $this->form_validation->set_rules('username', 'lang:bf_username', "{$usernameRequired}trim|max_length[30]|unique[users.username{$extraUniqueRule}]");
        $this->form_validation->set_rules('email', 'lang:bf_email', "required|trim|valid_email|max_length[254]|unique[users.email{$extraUniqueRule}]");

        // If a value has been entered for the password, pass_confirm is required.
        // Otherwise, the pass_confirm field could be left blank and the form validation
        // would still pass.
        if ($type != 'insert' && $this->input->post('password')) {
            $this->form_validation->set_rules('pass_confirm', 'lang:bf_password_confirm', "required|matches[password]");
        }

        $userIsAdmin = isset($this->current_user) && $this->current_user->role_id == 1;
        $metaData = array();
        foreach ($metaFields as $field) {
            $adminOnlyField = isset($field['admin_only']) && $field['admin_only'] === true;
            $frontEndField = ! isset($field['frontend']) || $field['frontend'];
            if ($frontEndField
                && ($userIsAdmin || ! $adminOnlyField)
            ) {
                $this->form_validation->set_rules($field['name'], $field['label'], $field['rules']);
                $metaData[$field['name']] = $this->input->post($field['name']);
            }
        }

        // Setting the payload for Events system.
        $payload = array('user_id' => $id, 'data' => $this->input->post());

        // Event "before_user_validation" to run before the form validation.
        Events::trigger('before_user_validation', $payload);

        if ($this->form_validation->run() === false) {
            return false;
        }

        // Compile our core user elements to save.
        $data = $this->user_model->prep_data($this->input->post());
        $result = false;

        if ($type == 'insert') {
            $activationMethod = $this->settings_lib->item('auth.user_activation_method');
            if ($activationMethod == 0) {
                // No activation method, so automatically activate the user.
                $data['active'] = 1;
            }

            $id = $this->user_model->insert($data);
            if (is_numeric($id)) {
                $result = $id;
            }
        } else {
            $result = $this->user_model->update($id, $data);
        }

        if (is_numeric($id) && ! empty($metaData)) {
            $this->user_model->save_meta_for($id, $metaData);
        }

        // Add result to payload.
        $payload['result'] = $result;
        // Trigger event after saving the user.
        Events::trigger('save_user', $payload);

        return $result;
    }
}
