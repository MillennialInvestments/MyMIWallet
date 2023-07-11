<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap_model extends CI_Model {

  public function get_urls() {
    $this->db->select('page');
    $this->db->from('bf_marketing_page_views'); 
    $this->db->where('sitemap', 1);
    $getPages               = $this->db->get();
    $urls                   = array();

    foreach ($getPages->result_array() as $row) {
        $urls[]             = array(
            'loc'           => site_url($row['page']),
            'lastmod'       => date('Y-m-d\TH:i:sP')
        );
    }

    return $urls;
  }

  public function get_sitemap_urls() {
    $this->db->select('page');
    $this->db->from('bf_marketing_page_views'); 
    $this->db->where('sitemap', 1);
    $getPages               = $this->db->get();
    $urls                   = array();

    foreach ($getPages->result_array() as $row) {
        $urls[]             = array(
            'loc'           => site_url($row['page']),
            'lastmod'       => date('Y-m-d\TH:i:sP')
        );
    }

    return $urls;
  }

  public function get_etf_urls() {
    $this->db->select('page');
    $this->db->from('bf_marketing_page_views'); 
    $this->db->where('etf_sitemap', 1);
    $getPages               = $this->db->get();
    $urls                   = array();

    foreach ($getPages->result_array() as $row) {
        $urls[]             = array(
            'loc'           => site_url($row['page']),
            'lastmod'       => date('Y-m-d\TH:i:sP')
        );
    }

    return $urls;
  }

  public function get_stock_urls() {
    $this->db->select('page');
    $this->db->from('bf_marketing_page_views'); 
    $this->db->where('stock_sitemap', 1);
    $getPages               = $this->db->get();
    $urls                   = array();

    foreach ($getPages->result_array() as $row) {
        $urls[]             = array(
            'loc'           => site_url($row['page']),
            'lastmod'       => date('Y-m-d\TH:i:sP')
        );
    }

    return $urls;
  }

}
