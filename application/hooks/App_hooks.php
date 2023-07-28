<?php defined('BASEPATH') || exit('No direct script access allowed');
/**
 * Bonfire
 *
 * An open source project to allow developers to jumpstart their development of
 * CodeIgniter applications
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2018, Bonfire Dev Team
 * @license   http://opensource.org/licenses/MIT The MIT License
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
 */

/**
 * Application Hooks
 *
 * A set of methods used for the CodeIgniter hooks.
 * @link https://ellislab.com/codeigniter/user-guide/general/hooks.html
 *
 * @package Bonfire\Hooks\App_hooks
 * @author  Bonfire Dev Team
 * @link    http://cibonfire.com/docs/developer
 */
class App_hooks
{
    /** @var array List of pages which bypass the Site Offline page. */
    protected $allowOffline = array(
        '/users/login',
        '/users/logout',
    );

    protected $isInstalled = false;

    /**
     * @var object The CodeIgniter core object.
     */
    private $ci;

    /**
     * @var array List of pages for which the URL-save/prep hooks are not run.
     */
    private $ignore_pages = array(
        '/users/login',
        '/users/logout',
        '/users/register',
        '/users/forgot_password',
        '/users/activate',
        '/users/resend_activation',
        '/images',
    );

    //--------------------------------------------------------------------------

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        // Check if an instance of CodeIgniter is available.
        if (get_instance() !== null) {
            $this->ci =& get_instance();
        } else {
            // If an instance is not available, create a new CI object.
            $this->ci = new CI_Controller();
        }

        if (is_object($this->ci)) {
            $this->isInstalled = $this->ci->config->item('bonfire.installed');
            if (! $this->isInstalled) {
                // Is Bonfire installed?
                $this->ci->load->library('installer_lib');
                $this->isInstalled = $this->ci->installer_lib->is_installed();
            }
        }
    }

    /**
     * Check the online/offline status of the site.
     *
     * Called by the "post_controller_constructor" hook.
     *
     * @return void
     */
    public function checkSiteStatus()
    {
        if (! isset($this->ci->load)) {
            return;
        }

        // If the settings lib is not available, load it.
        if (! isset($this->ci->settings_lib)) {
            $this->ci->load->library('settings/settings_lib');
        }

        if ($this->ci->settings_lib->item('site.status') != 0) {
            return;
        }

        if (! class_exists('Auth', false)) {
            $this->ci->load->library('users/auth');
        }

        if (! $this->ci->auth->has_permission('Site.Signin.Offline')
            && ! $this->ruriInArray($this->allowOffline)
        ) {
            $offlineReason = $this->ci->settings_lib->item('site.offline_reason');
            include(APPPATH . 'errors/offline.php');
            die();
        }
    }

    /**
     * Stores the name of the current uri in the session as 'previous_page'.
     * This allows redirects to take us back to the previous page without
     * relying on inconsistent browser support or spoofing.
     *
     * Called by the "post_controller" hook.
     *
     * @return void
     */
    public function prepRedirect()
    {
        if (! class_exists('CI_Session', false)) {
            $this->ci->load->library('session');
        }

        if (! $this->ruriInArray($this->ignore_pages)) {
            $this->ci->session->set_userdata('previous_page', current_url());
        }
    }

    /**
     * Store the requested page in the session data so we can use it
     * after the user logs in.
     *
     * Called by the "pre_controller" hook.
     *
     * @return void
     */
    public function saveRequested()
    {
        if (! $this->isInstalled) {
            return;
        }

        // Check if CI_Session class is loaded and load it if necessary.
        if (! class_exists('CI_Session', false)) {
            if (! isset($this->ci->session)) {
                $this->ci->load->library('session');
            }
        }

        // Either the session library was available all along or it has been loaded,
        // so determine whether the current URL is in the ignore_pages array and,
        // if it is not, set it as the requested page in the session.

        if (! $this->ruriInArray($this->ignore_pages)) {
            $this->ci->session->set_userdata('requested_page', current_url());
        }
    }


    protected function ruriInArray(array $ruriArray)
    {
        if (!isset($this->ci->router)) {
            return false;
        }
    
        $directory = $this->ci->router->directory;
        if ($directory !== null) {
            $ruriString = '/' . ltrim(
                str_replace($directory, '', $this->ci->uri->ruri_string()),
                '/'
            );
        } else {
            // Handle the case where directory is null
            $ruriString = '/' . ltrim($this->ci->uri->ruri_string(), '/');
        }
        return in_array($ruriString, $ruriArray);
    }
    
}
