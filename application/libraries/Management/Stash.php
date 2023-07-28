<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require 'vendor/autoload.php';

use Stash\Pool;
use Stash\Driver\FileSystem;

class Stash {

    private $ci;
    private $pool;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library(array('session', 'settings/settings_lib', 'Template'));
        $this->CI->load->model();
        $this->CI->load->library('users/auth');
        $cuID 								= $this->CI->auth->user_id();
        //~ $this->CI->load->library(array('Auth', 'MyMIWallets'));

        $driver                             = new FileSystem([]);
        $this->pool                         = new Pool($driver);
    }

    public function set($key, $value, $ttl = null) {
        $item                               = $this->pool->getItem($key);
        $item->set($value);
        if ($ttl !== null) {
            $item->expiresAfter($ttl);
        }
        $this->pool->save($item);
    }

    public function get($key) {
        $item                               = $this->pool->getItem($key);
        if ($item->isMiss()) {
            return null;
        }
        return $item->get();
    }

    public function delete($key) {
        $this->pool->deleteItem($key);
    }

    public function clear() {
        $this->pool->clear();
    }
}
