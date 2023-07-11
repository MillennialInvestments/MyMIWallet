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
class Budget extends Admin_Controller
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
        $this->load->model(array('User/budget_model'));
    }

    // -------------------------------------------------------------------------
    // Main Blog Post Page
    // -------------------------------------------------------------------------

    public function index()
    {
        // Connect to TD Ameritrade Streaming API
        $client = new \Ratchet\Client\WebSocket\Client('wss://streamer.tdameritrade.com/ws', [], [
            'Authorization' => 'Bearer ' . $api_key,
            'Connection' => 'Upgrade',
            'Upgrade' => 'websocket',
            'Sec-WebSocket-Version' => '13',
            'Sec-WebSocket-Key' => base64_encode(random_bytes(16)),
        ]);
        
        // Subscribe to symbols
        $client->send('{"requests":[{"service":"QUOTE","requestid":"1","command":"SUBS","account":"'.$account_id.'","source":"'.$source_id.'","parameters":{"keys":"'.$symbol.'"},"timestamp":"'.$timestamp.'"}]}');
        
        // Receive data
        $client->on('message', function($message) {
        // Process data
                });
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
