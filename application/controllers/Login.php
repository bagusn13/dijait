<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
  // load model
  public function __construct()
  {
    parent::__construct();
    $this->load->model('pelanggan_model');
  }

  // login pelanggan manual
  public function index()
  {
    // Validasi input 
    $this->form_validation->set_rules(
      'email',
      'Email',
      'required',
      array('required' => '%s harus diisi')
    );
    $this->form_validation->set_rules(
      'password',
      'Password',
      'required',
      array('required' => '%s harus diisi')
    );

    if ($this->form_validation->run()) {
      $email    = $this->input->post('email');
      $password = $this->input->post('password');
      //proses ke simple login
      $this->simple_pelanggan->login($email, $password);
    }
    // end validasi
    $data = array(
      'title' => 'Login',
      'isi'   => 'masuk/list',
    );
    $this->load->view('layout/wrapper', $data, FALSE);
  }

  // login dengan googleplus
  public function google()
  {
    if (isset($_GET['code'])) {
      // Authenticate user with google
      if ($this->googleplus->getAuthenticate()) {

        // Get user info from google
        $gpInfo    = $this->googleplus->getUserInfo();
        $email     = $gpInfo['email'];
        $oauth_uid = $gpInfo['id'];

        // Preparing data for database insertion
        $userData['oauth_provider'] = 'google';
        $userData['oauth_uid']      = $gpInfo['id'];
        $userData['nama_pelanggan'] = $gpInfo['name'];
        $userData['email']          = $gpInfo['email'];
        $userData['gender']         = !empty($gpInfo['gender']) ? $gpInfo['gender'] : '';
        //$userData['alamat']         = !empty($gpInfo['locale']) ? $gpInfo['locale'] : '';
        $userData['foto']           = !empty($gpInfo['picture']) ? $gpInfo['picture'] : '';

        $this->simple_pelanggan->google($userData, $email, $oauth_uid);
      }
    }

    $loginURL = $this->googleplus->loginURL();
    redirect($loginURL);
  }

  // login dengan facebook
  public function facebook()
  {
    // Check if user is logged in
    if ($this->facebook->is_authenticated()) {
      // Get user facebook profile details
      $fbUser    = $this->facebook->request('get', '/me?fields=id,name,email,gender,picture');
      $email     = $fbUser['email'];
      $oauth_uid = $fbUser['id'];

      // Preparing data for database insertion
      $userData['oauth_provider'] = 'facebook';
      $userData['oauth_uid']      = !empty($fbUser['id']) ? $fbUser['id'] : '';
      $userData['nama_pelanggan'] = !empty($fbUser['name']) ? $fbUser['name'] : '';
      $userData['email']          = !empty($fbUser['email']) ? $fbUser['email'] : '';
      $userData['gender']         = !empty($fbUser['gender']) ? $fbUser['gender'] : '';
      $userData['foto']           = !empty($fbUser['picture']['data']['url']) ? $fbUser['picture']['data']['url'] : '';
      // Get logout URL
      $logoutURL = $this->facebook->logout_url();
      $this->simple_pelanggan->facebook($userData, $email, $oauth_uid);
    }

    // Get login URL
    $loginURL =  $this->facebook->login_url();
    redirect($loginURL);
  }

  public function forgotPassword()
  {
    // Validasi
    $this->form_validation->set_rules(
      'email',
      'Email',
      'required',
      array('required' => '%s harus diisi')
    );
    if ($this->form_validation->run()) {
      // post('email') -> name="email" di form html
      $email     = $this->input->post('email');
      $findEmail = $this->pelanggan_model->forgotPassword($email);
      // jika emailnya ditemukan
      if ($findEmail) {
        $this->pelanggan_model->sendPassword($findEmail);
      }
      // jika emailnya tidak ditemukan
      else {
        $this->session->set_flashdata('warning', 'Email tidak ditemukan, silahkan coba lagi');
        redirect(base_url('login/forgotpassword'), 'refresh');
      }
    }
    $data = array(
      'title' => 'Lupa password',
      'isi'   => 'masuk/forgotpassword',
    );
    $this->load->view('layout/wrapper', $data, FALSE);
  }

  //logout
  public function logout()
  {
    // if login with facebook
    if ($this->session->userdata('oauth_provider') == 'facebook') {
      $this->facebook->destroy_session();
    }
    // if login with google
    if ($this->session->userdata('oauth_provider') == 'google') {
      $this->googleplus->revokeToken();
    }

    $this->session->unset_userdata('loggedIn');
    $this->session->unset_userdata('id_pelanggan');
    $this->session->unset_userdata('oauth_provider');
    $this->session->unset_userdata('nama_pelanggan');
    $this->session->unset_userdata('email');
    $this->session->set_flashdata('sukses', 'Kamu berhasil logout');
    redirect(base_url('login'), 'refresh');
    // Destroy entire session data
    $this->session->sess_destroy();
  }
}
