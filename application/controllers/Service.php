<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('layanan_model');
    $this->load->model('kategori_model');
    $this->load->model('pelanggan_model');
  }

  public function index()
  {
    $id_pelanggan     = $this->session->userdata('id_pelanggan');
    $pelanggan        = $this->pelanggan_model->detail($id_pelanggan);
    $site             = $this->konfigurasi_model->listing();
    $listing_kategori = $this->layanan_model->listing_kategori();

    //data total
    $total            = $this->layanan_model->total_layanan();

    //paginasi start
    $this->load->library('pagination');
    $config['base_url']         = base_url() . 'service/index/';
    $config['total_rows']       = $total->total;
    $config['use_page_numbers'] = TRUE;
    $config['per_page']         = 10;
    $config['uri_segment']      = 3;
    $config['num_links']        = 5;
    $config['full_tag_open']    = '<ul class="pagination">';
    $config['full_tag_close']   = '</ul>';
    $config['first_link']       = 'First';
    $config['first_tag_open']   = '<li>';
    $config['first_tag_close']  = '</li>';
    $config['last_link']        = 'Last';
    $config['last_tag_open']    = '<li class="disabled"><li class="active"><a href="#">';
    $config['last_tag_close']   = '<span class="sr-only"><a/></li></li>';
    $config['next_link']        = '&gt;';
    $config['next_tag_open']    = '<div>';
    $config['next_tag_close']   = '</div>';
    $config['prev_link']        = '&lt;';
    $config['prev_tag_open']    = '<div>';
    $config['prev_tag_close']   = '</div>';
    $config['cur_tag_open']     = '<b>';
    $config['cur_tag_close']    = '</b>';
    $config['first_url']        = base_url() . 'service/';
    $this->pagination->initialize($config);

    // ambil data layanan
    $page    = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) * $config['per_page'] : 0;
    $layanan = $this->layanan_model->layanan($config['per_page'], $page);
    // paginasi end

    $data = array(
      'title'            => 'Layanan ' . $site->namaweb,
      'pelanggan'        => $pelanggan,
      'site'             => $site,
      'listing_kategori' => $listing_kategori,
      'layanan'          => $layanan,
      'pagin'            => $this->pagination->create_links(),
      'isi'              => 'layanan/list'
    );
    $this->load->view('layout/wrapper', $data, FALSE);
  }

  // listing data kategori layanan
  public function category($slug_kategori)
  {
    $id_pelanggan     = $this->session->userdata('id_pelanggan');
    $pelanggan        = $this->pelanggan_model->detail($id_pelanggan);

    // kategori detail
    $kategori         = $this->kategori_model->read($slug_kategori);
    $id_kategori      = $kategori->id_kategori;

    // data global
    $site             = $this->konfigurasi_model->listing();
    $listing_kategori = $this->layanan_model->listing_kategori();

    // data total
    $total            = $this->layanan_model->total_kategori($id_kategori);

    // paginasi start
    $this->load->library('pagination');
    $config['base_url']         = base_url() . 'service/category/' . $slug_kategori . '/index/';
    $config['total_rows']       = $total->total;
    $config['use_page_numbers'] = TRUE;
    $config['per_page']         = 6;
    $config['uri_segment']      = 5;
    $config['num_links']        = 5;
    $config['full_tag_open']    = '<ul class="pagination">';
    $config['full_tag_close']   = '</ul>';
    $config['first_link']       = 'First';
    $config['first_tag_open']   = '<li>';
    $config['first_tag_close']  = '</li>';
    $config['last_link']        = 'Last';
    $config['last_tag_open']    = '<li class="disabled"><li class="active"><a href="#">';
    $config['last_tag_close']   = '<span class="sr-only"><a/></li></li>';
    $config['next_link']        = '&gt;';
    $config['next_tag_open']    = '<div>';
    $config['next_tag_close']   = '</div>';
    $config['prev_link']        = '&lt;';
    $config['prev_tag_open']    = '<div>';
    $config['prev_tag_close']   = '</div>';
    $config['cur_tag_open']     = '<b>';
    $config['cur_tag_close']    = '</b>';
    $config['first_url']        = base_url() . '/service/category/' . $slug_kategori;
    $this->pagination->initialize($config);

    // ambil data layanan
    $page    = ($this->uri->segment(5)) ? ($this->uri->segment(5) - 1) * $config['per_page'] : 0;
    $layanan = $this->layanan_model->kategori($id_kategori, $config['per_page'], $page);
    // paginasi end

    $data = array(
      'pelanggan'        => $pelanggan,
      'title'            => $kategori->nama_kategori,
      'site'             => $site,
      'listing_kategori' => $listing_kategori,
      'layanan'          => $layanan,
      'pagin'            => $this->pagination->create_links(),
      'isi'              => 'layanan/list'
    );
    $this->load->view('layout/wrapper', $data, FALSE);
  }

  // detail layanan
  public function detail($slug_layanan)
  {
    $site             = $this->konfigurasi_model->listing();
    $layanan          = $this->layanan_model->read($slug_layanan);
    $id_layanan       = $layanan->id_layanan;
    $gambar           = $this->layanan_model->gambar($id_layanan);
    $layanan_related  = $this->layanan_model->home();
    $data             = array(
      'title'             =>  $layanan->nama_layanan,
      'site'              =>  $site,
      'layanan'           =>  $layanan,
      'layanan_related'   =>  $layanan_related,
      'gambar'            =>  $gambar,
      'isi'               =>  'layanan/detail'
    );
    $this->load->view('layout/wrapper', $data, FALSE);
  }
}
