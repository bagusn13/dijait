<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Simple_pelanggan
{
  protected $CI;

  public function __construct()
  {
    $this->CI = &get_instance();
    // Load data model user
    $this->CI->load->model('pelanggan_model');
  }

  // fungsi login
  public function login($email, $password)
  {
    $check = $this->CI->pelanggan_model->login($email, $password);
    // jika ada data user, maka create session login
    if ($check) {
      $id_pelanggan   = $check->id_pelanggan;
      $nama_pelanggan = $check->nama_pelanggan;
      // create session
      $this->CI->session->set_userdata('loggedIn', true);
      $this->CI->session->set_userdata('id_pelanggan', $id_pelanggan);
      $this->CI->session->set_userdata('oauth_provider', 'dijait');
      $this->CI->session->set_userdata('nama_pelanggan', $nama_pelanggan);
      $this->CI->session->set_userdata('email', $email);
      // redirect ke halaman admin yang diproteksi
      redirect(base_url('dashboard'), 'refresh');
    } else {
      // kalau tidak ada (username password salah), maka suruh login lagi
      $this->CI->session->set_flashdata('warning', 'Email atau password salah');
      redirect(base_url('login'), 'refresh');
    }
  }

  // autentikasi dengan google
  public function google($userData, $email, $oauth_uid)
  {
    // Insert or update user data to the database
    $userID         = $this->CI->pelanggan_model->checkUserGooglePlus($userData);
    $check          = $this->CI->pelanggan_model->authentication($email, $oauth_uid);
    $id_pelanggan   = $check->id_pelanggan;
    $nama_pelanggan = $check->nama_pelanggan;

    // Store the status and user profile info into session
    $this->CI->session->set_userdata('loggedIn', true);
    $this->CI->session->set_userdata('id_pelanggan', $id_pelanggan);
    $this->CI->session->set_userdata('oauth_provider', 'google');
    $this->CI->session->set_userdata('email', $email);
    $this->CI->session->set_userdata('nama_pelanggan', $nama_pelanggan);

    // Redirect to dashboard page
    redirect(base_url('dashboard'), 'refresh');
  }

  // autentikasi dengan facebook
  public function facebook($userData, $email, $oauth_uid)
  {
    // Insert or update user data
    $userID         = $this->CI->pelanggan_model->checkUserFacebook($userData);

    $check          = $this->CI->pelanggan_model->authentication($email, $oauth_uid);
    $id_pelanggan   = $check->id_pelanggan;
    $nama_pelanggan = $check->nama_pelanggan;

    // Store the status and user profile info into session
    $this->CI->session->set_userdata('loggedIn', true);
    $this->CI->session->set_userdata('id_pelanggan', $id_pelanggan);
    $this->CI->session->set_userdata('oauth_provider', 'facebook');
    $this->CI->session->set_userdata('email', $email);
    $this->CI->session->set_userdata('nama_pelanggan', $nama_pelanggan);

    // Redirect to dashboard page
    redirect(base_url('dashboard'), 'refresh');
  }

  //

  // fungsi cek login
  public function cek_login()
  {
    // memeriksa apakah session sudah ada atau belum, jika belum maka alihkan ke halamnan login 
    if (!$this->CI->session->userdata('loggedIn')) {
      $this->CI->session->set_flashdata('warning', 'Anda belum login');
      redirect(base_url('login'), 'refresh');
    }
  }

  // fungsi logout
  public function logout()
  {
    //membuang semua session yang telah diset pada saat login
    $this->CI->session->unset_userdata('id_pelanggan');
    $this->CI->session->unset_userdata('nama_pelanggan');
    $this->CI->session->unset_userdata('email');
    //setelah session dibuang, maka redirect ke login
    $this->CI->session->set_flashdata('sukses', 'Anda berhasil logout');
    redirect(base_url('login'), 'refresh');
  }
}
