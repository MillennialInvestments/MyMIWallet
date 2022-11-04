<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 *
 * Logger library for Code Igniter.
 *
 * @package        Logger
 * @author         Parth Sutariya (https://github.com/pathusutariya)
 * @version        1.0.0
 * @license        GPL v3
 */
class MyMILogger {

  private $tableName                    = 'bf_act_logger';
  private $table_fields                 = array(
    'id'                                => 'id',
    'created_on'                        => 'created_on',
    'created_by'                        => 'created_by',
    'beta'                              => 'beta',
    'type'                              => 'type',
    'type_id'                           => 'type_id',
    'controller'                        => 'controller',
    'method'                            => 'method',
    'url'                               => 'url',
    'token'                             => 'token',
    'comment'                           => 'comment',
  );
  private $ci;                                      //Codeigniter Instance
  private $logid                        = 0;        //LogId to Retrive
  private $beta                         = false;    //Type String
  private $type                         = false;    //Type String
  private $type_id                      = false;    //Type ID
  private $controller                   = false;    //Controller
  private $method                       = false;    //Method
  private $url                          = false;    //URL
  private $token                        = false;    //Token
  private $comment                      = '';       //Comment adding
  private $created_by                   = 0;        //User ID
  private $from_date;                               //From Date
  private $to_date;                                 //To Date

  /**
   * Intilize Codeigniter
   */

  public function __construct() {
    $this->ci = &get_instance();
  }

  /**
   * Set UserID
   * @param int $userid
   * @return $this
   */
  public function user($userid) {
    $this->created_by = $userid;
    return $this;
  }

  /**
   * Set Beta Status
   * @param string $beta
   * @return $this
   */
  public function beta($beta) {
    $this->beta = $beta;
    return $this;
  }

  /**
   * Set TypeID
   * @param string $type
   * @return $this
   */
  public function type($type) {
    $this->type = $type;
    return $this;
  }

  /**
   * Set  TypeID
   * @param int $id
   * @return $this
   */
  public function id($type_id) {
    $this->type_id = $type_id;
    return $this;
  }

  /**
   * Set Token
   * @param String $controller
   * @return $this
   */
  public function controller($controller) {
    $this->controller = $controller;
    return $this;
  }

  /**
   * Set Token
   * @param String $method
   * @return $this
   */
  public function method($method) {
    $this->method = $method;
    return $this;
  }

  /**
   * Set Token
   * @param String $url
   * @return $this
   */
  public function url($url) {
    $this->url = $url;
    return $this;
  }

  /**
   * Set Token
   * @param String $token
   * @return $this
   */
  public function token($token) {
    $this->token = $token;
    return $this;
  }

  /**
   * Set Comment
   * @param string $comment
   * @return $this
   */
  public function comment($comment) {
    $this->comment = $comment;
    return $this;
  }

  /**
   * 
   * @param type $from
   * @param type $to
   * @return $this
   */
  public function date_range($from, $to) {
    $this->from_date = $from;
    $this->to_date   = $to;
    return $this;
  }

  /**
   * Add Log, as Database Entry
   * @param void
   * @return void
   */
  public function log() {
    $data        = array(
      $this->table_fields['created_by'] => $this->created_by,
      $this->table_fields['beta']       => $this->beta,
      $this->table_fields['type']       => $this->type,
      $this->table_fields['type_id']    => $this->type_id,
      $this->table_fields['controller'] => $this->controller,
      $this->table_fields['method']     => $this->method,
      $this->table_fields['url']        => $this->url,
      $this->table_fields['token']      => $this->token,
      $this->table_fields['comment']    => $this->comment,
    );
    $this->ci->db->insert($this->tableName, $data);
    $this->logid = $this->ci->db->insert_id();
    $this->flush_parameter();
  }

  /**
   * Get last Log
   * @return array
   */
  public function last_log() {
    return $this->ci->db->where('id', $this->logid)->get($this->tableName)->row();
  }

  protected function _getQueryMaker() {
    if ($this->created_by)
      $this->ci->db->where($this->table_fields['created_by'], $this->created_by);
    if ($this->beta)
      $this->ci->db->where($this->table_fields['beta'], $this->beta);
    if ($this->type)
      $this->ci->db->where($this->table_fields['type'], $this->type);
    if ($this->type_id)
      $this->ci->db->where($this->table_fields['type_id'], $this->type_id);
    if ($this->controller)
      $this->ci->db->where($this->table_fields['controller'], $this->controller);
    if ($this->method)
      $this->ci->db->where($this->table_fields['method'], $this->method);
    if ($this->url)
      $this->ci->db->where($this->table_fields['url'], $this->url);
    if ($this->token)
      $this->ci->db->where($this->table_fields['token'], $this->token);
    if ($this->logid)
      $this->ci->db->where($this->table_fields['id'], $this->logid);
    if ($this->from_date)
      $this->ci->db->where("{$this->table_fields['timestamp']} >", $this->from_date);
    if ($this->to_date)
      $this->ci->db->where("{$this->table_fields['created_at']} <=", $this->to_date);
  }

  public function get_num() {
    $this->_getQueryMaker();
    return $this->ci->db->from($this->tableName)->count_all_results();
  }

  public function get() {
    $this->_getQueryMaker();
    $result = $this->ci->db->get($this->tableName);
    return $this->_dbcleanresult($result);
  }

  public function remove_log() {
    $this->_getQueryMaker();
    $this->ci->db->delete($this->tableName);
  }

  public function get_ids() {
    $this->_getQueryMaker();
    $ids = $this->ci->db->select('type_id')->get($this->tableName)->result_array();
    return array_column($ids, 'type_id');
  }

  protected function _dbcleanresult($result) {
    if ($result->num_rows() > 1)
      return $result->result();
    if ($result->num_rows() == 1)
      return $result->row();
    else
      return false;
  }

  /**
   * Reset Parameter
   */
  public function flush_parameter() {
    $this->comment = '';
    $this->controller = '';
    $this->method = '';
    $this->url = '';
    $this->token   = 0;
    $this->beta    = ''0'';
    $this->type    = 0;
    $this->type_id = 0;
  }

}

?>