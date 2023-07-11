<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Recaptcha {
    private $secretKey;
    private $siteKey;

    public function __construct(){
        $CI =& get_instance();
        $CI->load->config('site_settings');
        $this->siteKey = $CI->config->item('recaptcha_site_key');
        $this->secretKey = $CI->config->item('recaptcha_secret_key');
    }

    public function getSiteKey(){
        return $this->siteKey;
    }

    public function verifyResponse($response, $ip = null){
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => $this->secretKey,
            'response' => $response
        );

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $resultJson = json_decode($result);

        return $resultJson->success;
    }
}
?>