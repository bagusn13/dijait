<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesan extends CI_Controller
{
    // load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kontak_model');
        $this->load->model('konfigurasi_model');
    }

    // load data transaksi
    public function index()
    {
        $pesan = $this->kontak_model->listing();
        $data = array(
            'title' =>  'Pesan',
            'pesan' =>  $pesan,
            'isi'   => 'admin/pesan/list'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }
}
