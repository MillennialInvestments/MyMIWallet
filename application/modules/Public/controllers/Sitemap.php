<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends Front_Controller {

  public function __construct() {
      parent::__construct();
      $this->load->model('Public/sitemap_model');
  }

  public function index() {
    $sitemapType                = $this->uri->segment(1); 
    if ($sitemapType === 'sitemap.xml') {
        $data['urls'] = $this->sitemap_model->get_sitemap_urls();
        header("Content-type: text/xml");
        $this->load->view('Public/Sitemap/index', $data);
    } elseif ($sitemapType === 'blog-sitemap.xml') {
        $data['urls'] = $this->sitemap_model->get_blog_urls();
        header("Content-type: text/xml");
        $this->load->view('Public/Sitemap/index', $data);
    } elseif ($sitemapType === 'crypto-sitemap.xml') {
        $data['urls'] = $this->sitemap_model->get_crypto_urls();
        header("Content-type: text/xml");
        $this->load->view('Public/Sitemap/index', $data);
    } elseif ($sitemapType === 'etf-sitemap.xml') {
        $data['urls'] = $this->sitemap_model->get_etf_urls();
        header("Content-type: text/xml");
        $this->load->view('Public/Sitemap/index', $data);
    } elseif ($sitemapType === 'news-sitemap.xml') {
        $data['urls'] = $this->sitemap_model->get_news_urls();
        header("Content-type: text/xml");
        $this->load->view('Public/Sitemap/index', $data);
    } elseif ($sitemapType === 'stock-sitemap.xml') {
        $data['urls'] = $this->sitemap_model->get_stock_urls();
        header("Content-type: text/xml");
        $this->load->view('Public/Sitemap/index', $data);
        
    }
  }

}