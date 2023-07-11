<?php
class MY_Exceptions extends CI_Exceptions {

    public function __construct() {
        parent::__construct();
    }

    public function log_exception($severity, $message, $filepath, $line) {
        parent::log_exception($severity, $message, $filepath, $line);

        if ($severity == E_ERROR || $severity == E_PARSE || $severity == E_COMPILE_ERROR) {
            $this->send_email($severity, $message, $filepath, $line);
        }
    }

    private function send_email($severity, $message, $filepath, $line) {
        $CI =& get_instance();
        $CI->load->library('email');

        // Email settings
        $config['protocol'] = 'smtp'; // Set the email protocol to SMTP
        $config['smtp_host'] = 'smtp.dreamhost.com'; // SMTP server address
        $config['smtp_user'] = 'support@mymiwallet.com'; // SMTP username
        $config['smtp_pass'] = 'Dawg@239223.dawg'; // SMTP password
        $config['smtp_port'] = 465; // SMTP port number
        $config['smtp_crypto'] = 'ssl'; // SMTP encryption (ssl or tls)
        $config['mailtype'] = 'html'; // Email content type
        $config['charset'] = 'utf-8'; // Email character set
        $config['newline'] = "\r\n"; // Email newline character
        $config['wordwrap'] = true; // Enable word wrapping in emails
        $config['crlf'] = "\r\n"; // Email CRLF character
        $config['wrapchars'] = 80; // Number of characters to wrap at
        $CI->email->from('support@mymiwallet.com', 'MyMI Support');
        $CI->email->to('team@mymiwallet.com');
        $CI->email->subject('PHP Error: '.$severity);
        $CI->email->message("Severity: ".$severity."\r\nMessage: ".$message."\r\nFilepath: ".$filepath."\r\nLine: ".$line);

        $CI->email->send();
    }
}