<?php 
// Check if the base path is defined, if not exit the script
if(!defined('BASEPATH'))exit('No direct script access allowed');

// Load the required libraries
// require 'vendor/autoload.php';
use GuzzleHttp\Client;

class FRED{
    private $ci;

    // Constructor function
    public function __construct(){
        // Get an instance of CodeIgniter
        $this->CI=&get_instance();

        // Load the required libraries and models
        $this->CI->load->library(array('curl','session','settings/settings_lib','Template'));
        $this->CI->load->model();
        $this->CI->load->library('users/auth');

        // Get the user ID
        $cuID=$this->CI->auth->user_id();

        // Define the base URL for the API
        $api_base='https://api.stlouisfed.org/fred/';

        // Get the API key from the config
        $api_key=$this->CI->config->item('fred_api_key');
    }

    // Function to fetch data from the API
    public function fetchData($series_id,$api_key){
        // Check if the series ID and API key are strings
        if(!is_string($series_id)||!is_string($api_key)){
            throw new InvalidArgumentException('Series ID and API key must be strings.');
        }

        try{
            // Create a new Guzzle client
            $client=new Client(['base_uri'=>$api_base,]);

            // Send a GET request to the API
            $response=$client->request('GET','series/observations',['query'=>['series_id'=>$series_id,'api_key'=>$api_key,'file_type'=>'json']]);

            // Get the status code and the body of the response
            $statusCode=$response->getStatusCode();
            $content=$response->getBody();

            // Decode the JSON response
            $data=json_decode($content,true);

            // If the 'observations' key exists in the data
            if(isset($data['observations'])){
                // Loop through each observation
                foreach($data['observations']as $observation){
                    // Print the date and value of the observation
                    echo $observation['date'].": ".$observation['value']."<br>";
                }
            }
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching data: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to fetch series info from the API
    public function fetchSeriesInfo($series_id,$api_key){
        // Check if the series ID and API key are strings
        if(!is_string($series_id)||!is_string($api_key)){
            throw new InvalidArgumentException('Series ID and API key must be strings.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','series',['query'=>['series_id'=>$series_id,'api_key'=>$api_key,'file_type'=>'json']]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching series info: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to search series from the API
    public function searchSeries($keywords,$api_key){
        // Check if the keywords and API key are strings
        if(!is_string($keywords)||!is_string($api_key)){
            throw new InvalidArgumentException('Keywords and API key must be strings.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','series/search',['query'=>['search_text'=>$keywords,'api_key'=>$api_key,'file_type'=>'json']]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error searching series: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to fetch category series from the API
    public function fetchCategorySeries($category_id,$api_key){
        // Check if the category ID is a number and the API key is a string
        if(!is_numeric($category_id)||!is_string($api_key)){
            throw new InvalidArgumentException('Category ID must be a number and API key must be a string.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','category/series',['query'=>['category_id'=>$category_id,'api_key'=>$api_key,'file_type'=>'json']]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching category series: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to fetch category children from the API
    public function fetchCategoryChildren($category_id,$api_key){
        // Check if the category ID is a number and the API key is a string
        if(!is_numeric($category_id)||!is_string($api_key)){
            throw new InvalidArgumentException('Category ID must be a number and API key must be a string.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','category/children',['query'=>['category_id'=>$category_id,'api_key'=>$api_key,'file_type'=>'json']]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching category children: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to fetch series updates from the API
    public function fetchSeriesUpdates($api_key,$limit=10){
        // Check if the API key is a string and the limit is a number
        if(!is_string($api_key)||!is_numeric($limit)){
            throw new InvalidArgumentException('API key must be a string and limit must be a number.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','series/updates',['query'=>['api_key'=>$api_key,'file_type'=>'json','limit'=>$limit]]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching series updates: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to fetch series releases from the API
    public function fetchSeriesReleases($series_id,$api_key){
        // Check if the series ID and API key are strings
        if(!is_string($series_id)||!is_string($api_key)){
            throw new InvalidArgumentException('Series ID and API key must be strings.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','series/releases',['query'=>['series_id'=>$series_id,'api_key'=>$api_key,'file_type'=>'json']]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching series releases: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to fetch series tags from the API
    public function fetchSeriesTags($series_id,$api_key){
        // Check if the series ID and API key are strings
        if(!is_string($series_id)||!is_string($api_key)){
            throw new InvalidArgumentException('Series ID and API key must be strings.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','series/tags',['query'=>['series_id'=>$series_id,'api_key'=>$api_key,'file_type'=>'json']]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching series tags: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to fetch series related tags from the API
    public function fetchSeriesRelatedTags($series_id,$tag_names,$api_key){
        // Check if the series ID, tag names, and API key are strings
        if(!is_string($series_id)||!is_string($tag_names)||!is_string($api_key)){
            throw new InvalidArgumentException('Series ID, tag names, and API key must be strings.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','series/related_tags',['query'=>['series_id'=>$series_id,'tag_names'=>$tag_names,'api_key'=>$api_key,'file_type'=>'json']]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching series related tags: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to fetch a release from the API
    public function fetchRelease($release_id,$api_key){
        // Check if the release ID is a number and the API key is a string
        if(!is_numeric($release_id)||!is_string($api_key)){
            throw new InvalidArgumentException('Release ID must be a number and API key must be a string.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','release',['query'=>['release_id'=>$release_id,'api_key'=>$api_key,'file_type'=>'json']]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching release: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to fetch release dates from the API
    public function fetchReleaseDates($release_id,$api_key){
        // Check if the release ID is a number and the API key is a string
        if(!is_numeric($release_id)||!is_string($api_key)){
            throw new InvalidArgumentException('Release ID must be a number and API key must be a string.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','release/dates',['query'=>['release_id'=>$release_id,'api_key'=>$api_key,'file_type'=>'json']]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching release dates: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to fetch release series from the API
    public function fetchReleaseSeries($release_id,$api_key){
        // Check if the release ID is a number and the API key is a string
        if(!is_numeric($release_id)||!is_string($api_key)){
            throw new InvalidArgumentException('Release ID must be a number and API key must be a string.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','release/series',['query'=>['release_id'=>$release_id,'api_key'=>$api_key,'file_type'=>'json']]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching release series: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to fetch release sources from the API
    public function fetchReleaseSources($release_id,$api_key){
        // Check if the release ID is a number and the API key is a string
        if(!is_numeric($release_id)||!is_string($api_key)){
            throw new InvalidArgumentException('Release ID must be a number and API key must be a string.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','release/sources',['query'=>['release_id'=>$release_id,'api_key'=>$api_key,'file_type'=>'json']]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching release sources: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to fetch a category from the API
    public function getCategory($category_id,$api_key){
        // Check if the category ID is a number and the API key is a string
        if(!is_numeric($category_id)||!is_string($api_key)){
            throw new InvalidArgumentException('Category ID must be a number and API key must be a string.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','fred/category',['query'=>['category_id'=>$category_id,'api_key'=>$api_key,'file_type'=>'json']]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching category: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to fetch related categories from the API
    public function getCategoryRelated($category_id,$api_key){
        // Check if the category ID is a number and the API key is a string
        if(!is_numeric($category_id)||!is_string($api_key)){
            throw new InvalidArgumentException('Category ID must be a number and API key must be a string.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','fred/category/related',['query'=>['category_id'=>$category_id,'api_key'=>$api_key,'file_type'=>'json']]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching related categories: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to fetch category tags from the API
    public function getCategoryTags($category_id,$api_key){
        // Check if the category ID is a number and the API key is a string
        if(!is_numeric($category_id)||!is_string($api_key)){
            throw new InvalidArgumentException('Category ID must be a number and API key must be a string.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','fred/category/tags',['query'=>['category_id'=>$category_id,'api_key'=>$api_key,'file_type'=>'json']]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching category tags: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to fetch a release from the API
    public function getRelease($release_id,$api_key){
        // Check if the release ID is a number and the API key is a string
        if(!is_numeric($release_id)||!is_string($api_key)){
            throw new InvalidArgumentException('Release ID must be a number and API key must be a string.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','fred/release',['query'=>['release_id'=>$release_id,'api_key'=>$api_key,'file_type'=>'json']]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching release: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to fetch release dates from the API
    public function getReleaseDates($release_id,$api_key){
        // Check if the release ID is a number and the API key is a string
        if(!is_numeric($release_id)||!is_string($api_key)){
            throw new InvalidArgumentException('Release ID must be a number and API key must be a string.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','fred/release/dates',['query'=>['release_id'=>$release_id,'api_key'=>$api_key,'file_type'=>'json']]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching release dates: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to fetch release sources from the API
    public function getReleaseSources($release_id,$api_key){
        // Check if the release ID is a number and the API key is a string
        if(!is_numeric($release_id)||!is_string($api_key)){
            throw new InvalidArgumentException('Release ID must be a number and API key must be a string.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','fred/release/sources',['query'=>['release_id'=>$release_id,'api_key'=>$api_key,'file_type'=>'json']]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching release sources: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to fetch release tags from the API
    public function getReleaseTags($release_id,$api_key){
        // Check if the release ID is a number and the API key is a string
        if(!is_numeric($release_id)||!is_string($api_key)){
            throw new InvalidArgumentException('Release ID must be a number and API key must be a string.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','fred/release/tags',['query'=>['release_id'=>$release_id,'api_key'=>$api_key,'file_type'=>'json']]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching release tags: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to fetch related tags for a release from the API
    public function getReleaseRelatedTags($release_id,$api_key){
        // Check if the release ID is a number and the API key is a string
        if(!is_numeric($release_id)||!is_string($api_key)){
            throw new InvalidArgumentException('Release ID must be a number and API key must be a string.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','fred/release/related_tags',['query'=>['release_id'=>$release_id,'api_key'=>$api_key,'file_type'=>'json']]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching related tags for release: '.$e->getMessage());
            throw $e;
        }
    }

    // Function to fetch release tables from the API
    public function getReleaseTables($release_id,$api_key){
        // Check if the release ID is a number and the API key is a string
        if(!is_numeric($release_id)||!is_string($api_key)){
            throw new InvalidArgumentException('Release ID must be a number and API key must be a string.');
        }

        try{
            // Send a GET request to the API
            $response=$this->client->request('GET','fred/release/tables',['query'=>['release_id'=>$release_id,'api_key'=>$api_key,'file_type'=>'json']]);

            // Return the decoded JSON response
            return json_decode($response->getBody(),true);
        }catch(Exception $e){
            // Log any errors
            log_message('error','Error fetching release tables: '.$e->getMessage());
            throw $e;
        }
    }
}
?>
