<?php
defined('BASEPATH')or exit('No direct script access allowed');

abstract class CI_Session_driver implements SessionHandlerInterface {
    protected $_config;
    protected $_fingerprint;
    protected $_lock = false;
    protected $_session_id;
    protected $_success;
    protected $_failure;

    public function __construct(&$params) {
        $this->_config = &$params;
        if (is_php('7')) {
            $this->_success = true;
            $this->_failure = false;
        } else {
            $this->_success = 0;
            $this->_failure = -1;
        }
    }

    #[\ReturnTypeWillChange]
    public function open($save_path, $name) {
        session_start();
        $this->_session_id = $name;
        return true;
    }

    #[\ReturnTypeWillChange]
    public function close() {
        session_destroy();
        $this->_session_id = null;
        return true;
    }

    #[\ReturnTypeWillChange]
    public function read($id) {
        if (isset($_SESSION[$id])) {
            return $_SESSION[$id];
        } else {
            return false;
        }
    }

    #[\ReturnTypeWillChange]
    public function write($id, $data) {
        $_SESSION[$id] = $data;
        return true;
    }

    #[\ReturnTypeWillChange]
    public function destroy($id) {
        if (isset($_SESSION[$id])) {
            unset($_SESSION[$id]);
            return true;
        } else {
            return false;
        }
    }

    #[\ReturnTypeWillChange]
    public function gc($max_lifetime) {
        $deleted = 0;
        foreach ($_SESSION as $id => $data) {
            if ($data['timestamp'] < time() - $max_lifetime) {
                unset($_SESSION[$id]);
                $deleted++;
            }
        }
        return $deleted;
    }

    public function php5_validate_id() {
        if (PHP_VERSION_ID < 70000 && isset($_COOKIE[$this->_config['cookie_name']]) && !$this->validateId($_COOKIE[$this->_config['cookie_name']])) {
            unset($_COOKIE[$this->_config['cookie_name']]);
        }
    }

    protected function _cookie_destroy() {
        return setcookie($this->_config['cookie_name'], '', 1, $this->_config['cookie_path'], $this->_config['cookie_domain'], $this->_config['cookie_secure'], true);
    }

    protected function _get_lock($session_id) {
        $this->_lock = true;
        return true;
    }

    protected function _release_lock() {
        if ($this->_lock) {
            $this->_lock = false;
        }
        return true;
    }

    protected function _fail() {
        ini_set('session.save_path', config_item('sess_save_path'));
        return $this->_failure;
    }
}
