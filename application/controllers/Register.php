<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
  // load model
  public function __construct()
  {
    parent::__construct();
    $this->load->model('pelanggan_model');
  }

  // registrasi
  public function index()
  {
    // validasi input
    $valid = $this->form_validation;
    // nama pelanggan
    $valid->set_rules(
      'nama_pelanggan',
      'Nama Lengkap',
      'required',
      array('required' => '%s harus diisi')
    );
    // email
    $valid->set_rules(
      'email',
      'Email',
      'required|valid_email|is_unique[pelanggan.email]',
      array(
        'required'    => '%s harus diisi',
        'valid_email' => '%s tidak valid',
        'is_unique'   => '%s sudah terdaftar'
      )
    );
    // password
    $valid->set_rules(
      'password',
      'Password',
      'required',
      array('required' => '%s harus diisi')
    );
    // ulang password
    $valid->set_rules(
      'confirm_password',
      'Password',
      'required|matches[password]',
      array(
        'required' => '%s harus diisi',
        'matches'  => '%s tidak sama'
      )
    );

    if ($valid->run() === FALSE) {
      // End validasi
      $data = array(
        'title' => 'Registrasi Pelanggan',
        'isi'   => 'registrasi/list'
      );
      $this->load->view('layout/wrapper', $data, FALSE);
      // masuk database
    }
    // proses registrasi
    else {
      $i      = $this->input;
      $email  = $this->input->post('email');
      $this->load->helper(array('form', 'url'));
      $data   = array(
        'oauth_provider'    => 'dijait',
        'status_pelanggan'  => 'Pending',
        'nama_pelanggan'    => $i->post('nama_pelanggan'),
        'email'             => $email,
        'password'          => SHA1($i->post('password')),
        'telepon'           => $i->post('telepon'),
        'alamat'            => $i->post('alamat'),
        'tanggal_daftar'    => date('Y-m-d H:i:s')
      );
      $id           = $this->pelanggan_model->tambah($data);
      $encrypted_id = md5($id);

      $config                 = array();
      $config['charset']      = 'utf-8';
      $config['useragent']    = 'Codeigniter';
      $config['protocol']     = "smtp";
      $config['mailtype']     = "html";
      // pengaturan smtp
      $config['smtp_host']    = "ssl://smtp.gmail.com";
      $config['smtp_port']    = "465";
      $config['smtp_timeout'] = "400";
      // isi dengan email kamu
      $config['smtp_user']    = "dijait.idverif@gmail.com";
      // isi dengan password kamu
      $config['smtp_pass']    = "jaitpakaian123";
      $config['crlf']         = "\r\n";
      $config['newline']      = "\r\n";
      $config['wordwrap']     = TRUE;

      // memanggil library email dan set konfigurasi untuk pengiriman email
      $this->email->initialize($config);
      // konfigurasi pengiriman
      $this->email->from($config['smtp_user']);
      $this->email->to($email);
      $this->email->subject("Verifikasi Akun");
      $this->email->message(
        "Terimakasih telah melakukan registrasi, untuk memverifikasi silahkan klik tautan berikut ini<br><br>" .
          site_url("register/verification/$encrypted_id")
      );

      if ($this->email->send()) {
        $this->session->set_flashdata('sukses', 'Berhasil melakukan registrasi, silahkan cek email kamu dan lakukan login');
        redirect(base_url('login'), 'refresh');
      } else {
        $this->session->set_flashdata('warning', 'Berhasil melakukan registrasi, namun gagal mengirim verifikasi email');
        redirect(base_url('login'), 'refresh');
      }
    }
    // end masuk database
  }

  // sukses registrasi
  public function success()
  {
    $data = array(
      'title' => 'Registrasi berhasil',
      'isi'   => 'registrasi/sukses'
    );
    $this->load->view('layout/wrapper', $data, FALSE);
  }

  // verifikasi
  public function verification($key)
  {
    $this->load->helper('url');
    $this->pelanggan_model->ganti_status($key);
    $this->session->set_flashdata('sukses', 'Selamat kamu telah memverifikasi akun kamu, silahkan login');
    redirect(base_url('login'), 'refresh');
  }
}
