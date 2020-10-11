<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{
  // load model
  public function __construct()
  {
    parent::__construct();
    $this->load->model('konfigurasi_model');
    $this->load->model('pelanggan_model');
    $this->load->model('kontak_model');
  }

  // Halaman Utama Website - Homepage
  public function index()
  {
    $site         = $this->konfigurasi_model->listing();
    $id_pelanggan = $this->session->userdata('id_pelanggan');
    $pelanggan    = $this->pelanggan_model->detail($id_pelanggan);
    // Validasi input
    $valid = $this->form_validation;

    $valid->set_rules(
      'nama',
      'Nama',
      'required',
      array('required' => '%s harus diisi')
    );

    $valid->set_rules(
      'email',
      'Email',
      'required',
      array('required' => '%s harus diisi')
    );

    $valid->set_rules(
      'pesan',
      'Pesan',
      'required',
      array('required' => '%s harus diisi')
    );

    if ($valid->run() === FALSE) {
      // End validasi
      $data = array(
        'title'     => 'Kontak Kami' . ' | ' . $site->namaweb,
        'keywords'  => $site->keywords,
        'deskripsi' => $site->deskripsi,
        'site'      => $site,
        'pelanggan' => $pelanggan,
        'isi'       => 'kontak/list'
      );
      $this->load->view('layout/wrapper', $data, FALSE);
    } else {
      // Masuk database
      $i = $this->input;
      $data = array(
        'nama'  => $i->post('nama'),
        'email' => $i->post('email'),
        'pesan' => $i->post('pesan')
      );
      $this->kontak_model->tambah($data);
      $this->session->set_flashdata('sukses', 'Pesan Anda Telah Dikirim, Terima Kasih Sudah Menghubungi Kami');
      redirect(base_url('contact'), 'refresh');
    }
    // End masuk database
  }
}
