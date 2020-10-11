<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{
  // load model
  public function __construct()
  {
    parent::__construct();
    $this->load->model('konfigurasi_model');
    $this->load->model('pelanggan_model');
    $this->load->model('testi_model');
  }

  // Halaman Tentang Kami
  public function index()
  {
    $id_pelanggan = $this->session->userdata('id_pelanggan');
    $pelanggan    = $this->pelanggan_model->detail($id_pelanggan);
    $site         = $this->konfigurasi_model->listing();
    $testi        = $this->testi_model->home();

    $data = array(
      'title'     => 'Tentang Kami' . ' | ' . $site->namaweb,
      'keywords'  => $site->keywords,
      'deskripsi' => $site->deskripsi,
      'site'      => $site,
      'pelanggan' =>  $pelanggan,
      'testi'     => $testi,
      'isi'       => 'tentang/list'
    );
    $this->load->view('layout/wrapper', $data, FALSE);
  }
}
