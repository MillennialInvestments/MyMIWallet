<?php defined('BASEPATH') || exit('No direct script access allowed');
use GuzzleHttp\Client;
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

/**
 * FRED API Information https://fred.stlouisfed.org/docs/api/fred/:
 *
 *  * FRED website: Visit FRED's website and use the search function to find data series of interest. When viewing a series, its ID is found in the URL. For example, if you search for "Civilian Unemployment Rate," clicking on that series will take you to a URL ending in "UNRATE", which is the series ID for that data.

 *  * FRED API: FRED also provides an API endpoint for searching their data series. You can use the /series/search endpoint with a keyword to find relevant series. The returned results include the series ID. This is a more advanced option, and you would need to parse the returned JSON or XML.

 *  * FRED API Documentation: The FRED API documentation provides information on how to use the API, including how to search for and use series IDs.

 *  * FRED Categories: The FRED API also allows you to pull all series within a category using the /category/series endpoint with a category ID. You can find category IDs using the /category/children endpoint with the parent category ID.
 * 
 * Refer to some general resources for financial and demographic data.

 * For the United States:

 *  * Federal Reserve's Survey of Consumer Finances (SCF): This survey includes information on U.S. family incomes, net worth, balance sheet components, credit use, and other financial outcomes. You can access the data at: Federal Reserve's Survey of Consumer Finances (SCF)

 *  * U.S. Census Bureau: The Census Bureau collects data on a variety of demographic and economic topics, which can be accessed at: U.S. Census Bureau

 * For Canada:

 *  * Statistics Canada: They provide wide range of statistics about Canada's economy, society and environment. You can access their data at: Statistics Canada
 * For Mexico:

 *  * Instituto Nacional de Estadística y Geografía (INEGI): They provide wide range of statistics about Mexico's economy, society and environment. You can access their data at: INEGI
 * For Europe:

 *  * Eurostat: The statistical office of the European Union offers a wide range of statistics at European level that enable comparisons between countries and regions. You can access their data at: Eurostat
 */

class Fred extends Front_Controller
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

        $this->load->helper(array('directory', 'form', 'file', 'url'));
        $this->load->library(array('form_validation', 'upload'));
        //$this->load->model('user_model');
        $this->load->module('User/Trade_Tracker');

        //$this->lang->load('Blog_lang');
        $this->siteSettings = $this->settings_lib->find_all();
        if ($this->siteSettings['auth.password_show_labels'] == 1) {
            add_module_js('users', 'password_strength.js');
            Assets::add_module_js('users', 'jquery.strength.js');
        }
    }

    // -------------------------------------------------------------------------
    // Main Blog Post Page
    // -------------------------------------------------------------------------

    public function index()
    {
        $pageType = 'Automated';
        $pageName = 'Home';
        $this->load->library('users/auth');
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function fetchData($seriesID) {
        $client = new Client([
            'base_uri' => 'https://api.stlouisfed.org/fred/',
        ]);

        $response = $client->request('GET', 'series/observations', [
            'query' => [
                'series_id' => $seriesID,
                'api_key' => $this->config->item('fred_api'),
                'file_type' => 'json'
            ]
        ]);

        $statusCode = $response->getStatusCode();
        $content = $response->getBody();
        
        $data = json_decode($content, true);
        // Now $data contains your data, you can do whatever you need with it.

        // Just an example of how to access data
        if(isset($data['observations'])){
            foreach ($data['observations'] as $observation) {
                echo $observation['date'] . ": " . $observation['value'] . "<br>";
            }
        }
    }

    public function getReleases() {
        $client = new Client();

        $response = $client->request('GET', 'https://api.stlouisfed.org/fred/releases', [
            'query' => [
                'api_key' => $this->config->item('fred_api'),
                'file_type' => 'json'
            ]
        ]);

        $statusCode = $response->getStatusCode();
        $content = $response->getBody();

        $data = json_decode($content, true);
        // Now $data contains your data, you can do whatever you need with it.

        // Just an example of how to access data
        if(isset($data['releases'])){
            foreach ($data['releases'] as $release) {
                echo $release['id'] . ": " . $release['name'] . "<br>";
            }
        }
    }

    public function getReleasesView() { // Distribution of information into a View File Example ()
        $client = new Client();

        $response = $client->request('GET', 'https://api.stlouisfed.org/fred/releases', [
            'query' => [
                'api_key' => 'abcdefghijklmnopqrstuvwxyz123456',
                'file_type' => 'json'
            ]
        ]);

        $statusCode = $response->getStatusCode();
        $content = $response->getBody();

        $data = json_decode($content, true);
        // Now $data contains your data, you can do whatever you need with it.

        if(isset($data['releases'])){
            $this->load->view('fred_view', ['releases' => $data['releases']]);
        }
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
