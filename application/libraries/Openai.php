<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Openai
{
    private $api_key;
    private $CI;

    public function __construct()
    {   
        $this->CI =& get_instance();
        $this->CI->load->config('site_settings');
        $this->api_key = $this->CI->config->item('openai_api_key');
    }

    public function request($path, $params = [])
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.openai.com/v1/' . $path,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->api_key,
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false;
        } else {
            return json_decode($response);
        }
    }
}