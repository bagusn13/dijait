<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
  // load model
  public function __construct()
  {
    parent::__construct();
    $this->load->model('layanan_model');
    $this->load->model('kategori_model');
    $this->load->model('konfigurasi_model');
    $this->load->model('berita_model');
    $this->load->model('testi_model');
    $this->load->model('pelanggan_model');
  }

  // Halaman Utama Website - Homepage
  public function index()
  {
    $id_pelanggan = $this->session->userdata('id_pelanggan');
    $pelanggan    = $this->pelanggan_model->detail($id_pelanggan);
    $site         = $this->konfigurasi_model->listing();
    $kategori     = $this->konfigurasi_model->nav_layanan();
    $layanan      = $this->layanan_model->home();
    $berita       = $this->berita_model->home();
    $testi        = $this->testi_model->home();

    $data = array(
      'title'     => $site->namaweb . ' | ' . $site->tagline,
      'keywords'  => $site->keywords,
      'deskripsi' => $site->deskripsi,
      'site'      => $site,
      'kategori'  => $kategori,
      'layanan'   => $layanan,
      'berita'    => $berita,
      'testi'     => $testi,
      'pelanggan' => $pelanggan,
      'isi'       => 'home/list'
    );
    $this->load->view('layout/wrapper', $data, FALSE);
  }
}
