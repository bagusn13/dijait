<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
  // load model
  public function __construct()
  {
    parent::__construct();
    $this->load->model('transaksi_model');
    $this->load->model('rekening_model');
    $this->load->model('header_transaksi_model');
    $this->load->model('konfigurasi_model');
  }

  // load data transaksi
  public function index()
  {
    $header_transaksi = $this->header_transaksi_model->listing();
    $data = array(
      'title'            =>  'Data Transaksi',
      'header_transaksi' =>  $header_transaksi,
      'isi'              => 'admin/transaksi/list'
    );
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  // Detail
  public function detail($kode_transaksi)
  {
    $header_transaksi = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
    $transaksi        = $this->transaksi_model->kode_transaksi($kode_transaksi);

    $data = array(
      'title'            => 'Riwayat Belanja',
      'header_transaksi' => $header_transaksi,
      'transaksi'        => $transaksi,
      'isi'              => 'admin/transaksi/detail'
    );
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  // Cetak
  public function cetak($kode_transaksi)
  {
    $header_transaksi = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
    $transaksi        = $this->transaksi_model->kode_transaksi($kode_transaksi);
    $site             = $this->konfigurasi_model->listing();

    $data = array(
      'title'            => 'Riwayat Belanja',
      'header_transaksi' => $header_transaksi,
      'transaksi'        => $transaksi,
      'site'             => $site
    );
    $this->load->view('admin/transaksi/cetak', $data, FALSE);
  }

  public function status($kode_transaksi)
  {
    $header_transaksi = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
    $transaksi        = $this->transaksi_model->kode_transaksi($kode_transaksi);

    // validasi input
    $valid = $this->form_validation;
    $valid->set_rules(
      'status_bayar',
      'Status Bayar',
      'required',
      array('required' => '%s harus diisi')
    );
    if ($valid->run()) {
      $i = $this->input;

      $data = array(
        'id_header_transaksi' => $header_transaksi->id_header_transaksi,
        'status_bayar'        => $i->post('status_bayar')
      );
      $this->header_transaksi_model->edit($data);
      $this->session->set_flashdata('sukses', 'Update status berhasil');
      redirect(base_url('admin/transaksi'), 'refresh');
    }

    $data = array(
      'title'            => 'Status Transaksi',
      'header_transaksi' => $header_transaksi,
      'transaksi'        => $transaksi,
      'isi'              => 'admin/transaksi/status'
    );
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }
}
