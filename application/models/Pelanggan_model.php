<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->tableName  = 'pelanggan';
    $this->primaryKey = 'id_pelanggan';
  }

  // Listing all pelanggan
  public function listing()
  {
    $this->db->select('*');
    $this->db->from('pelanggan');
    $this->db->order_by('id_pelanggan', 'desc');
    $query = $this->db->get();
    return $query->result();
  }

  // cek autentikasi ketika login manual
  public function login($email, $password)
  {
    $this->db->select('*');
    $this->db->from('pelanggan');
    $this->db->where(array(
      'email'    => $email,
      'password' => SHA1($password)
    ));
    $this->db->order_by('id_pelanggan', 'desc');
    $query = $this->db->get();
    return $query->row();
  }

  // cek autentikasi ketika login menggunakan google plus atau facebook
  public function authentication($email, $oauth_uid)
  {
    $this->db->select('*');
    $this->db->from('pelanggan');
    $this->db->where(array(
      'email'      => $email,
      'oauth_uid'  => $oauth_uid
    ));
    $this->db->order_by('id_pelanggan', 'desc');
    $query = $this->db->get();
    return $query->row();
  }

  // cek user google
  public function checkUserGooglePlus($data = array())
  {
    $this->db->select($this->primaryKey);
    $this->db->from($this->tableName);

    $con = array(
      'oauth_provider' => $data['oauth_provider'],
      'oauth_uid'      => $data['oauth_uid']
    );
    $this->db->where($con);

    $query = $this->db->get();

    $check = $query->num_rows();

    if ($check > 0) {
      // Get prev user data
      $result = $query->row_array();

      // Update user data
      //$data['tanggal_update'] = date("Y-m-d H:i:s");
      $update = $this->db->update($this->tableName, $data, array('id_pelanggan' => $result['id_pelanggan']));

      // user id
      $userID = $result['id_pelanggan'];
    } else {
      // Insert user data
      $data['status_pelanggan']  = 'Pending';
      $data['tanggal_daftar'] = date("Y-m-d H:i:s");
      //$data['tanggal_update'] = date("Y-m-d H:i:s");
      $insert = $this->db->insert($this->tableName, $data);

      // user id
      $userID = $this->db->insert_id();
    }
    // Return user id
    return $userID ? $userID : false;
  }

  // cek user facebook
  public function checkUserFacebook($userData = array())
  {
    if (!empty($userData)) {
      // check whether user data already exists in database with same oauth info
      $this->db->select($this->primaryKey);
      $this->db->from($this->tableName);

      $con = array(
        'oauth_provider' => $userData['oauth_provider'],
        'oauth_uid'      => $userData['oauth_uid']
      );
      $this->db->where($con);

      $prevQuery = $this->db->get();
      $prevCheck = $prevQuery->num_rows();

      if ($prevCheck > 0) {
        $prevResult = $prevQuery->row_array();

        // update user data
        //$userData['tanggal_update'] = date("Y-m-d H:i:s");
        $update = $this->db->update($this->tableName, $userData, array('id_pelanggan' => $prevResult['id_pelanggan']));

        // get user ID
        $userID = $prevResult['id_pelanggan'];
      } else {
        //insert user data
        $userData['status_pelanggan'] = 'Pending';
        $userData['tanggal_daftar']  = date("Y-m-d H:i:s");
        //$userData['tanggal_update']  = date("Y-m-d H:i:s");
        $insert = $this->db->insert($this->tableName, $userData);

        //get user ID
        $userID = $this->db->insert_id();
      }
    }
    //return user ID
    return $userID ? $userID : FALSE;
  }

  // lupa password
  public function forgotPassword($email)
  {
    $this->db->select('*');
    $this->db->from('pelanggan');
    $this->db->where(array(
      'email' => $email,
      'oauth_provider' => 'dijait'
    ));
    $query = $this->db->get();
    return $query->row_array();
  }

  // kirim password ke email
  public function sendPassword($data)
  {
    $email  = $data['email'];
    $query1 = $this->db->query("SELECT *  from pelanggan where email = '" . $email . "' ");
    $row    = $query1->result_array();
    if ($query1->num_rows() > 0) {
      $passwordplain       = "";
      $passwordplain       = rand(999999999, 9999999999);
      $newpass['password'] = sha1($passwordplain);
      $this->db->where(array(
        'email'          => $email,
        'oauth_provider' => 'dijait'
      ));
      $this->db->update('pelanggan', $newpass);

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
      //memanggil library email dan set konfigurasi untuk pengiriman email
      $this->email->initialize($config);
      //konfigurasi pengiriman
      $this->email->from($config['smtp_user']);
      $this->email->to($email);
      $this->email->subject("Reset password akun dijait.id");
      $this->email->message('Halo ' . $row[0]['nama_pelanggan'] . ',' . "\r\n" . 'Thanks for contacting regarding to forgot password,<br> Your <b>Password</b> is <b>' . $passwordplain . '</b>' . "\r\n" . '<br>Please Update your password.' . '<br>Thanks & Regards' . '<br>dijait.id');

      if (!$this->email->send()) {
        $this->session->set_flashdata('warning', 'Gagal mengirim password ke email anda, silahkan coba lagi.');
        redirect(base_url() . 'login/forgotpassword', 'refresh');
      } else {
        $this->session->set_flashdata('sukses', 'Password telah dikirim ke email anda.');
        redirect(base_url() . 'login', 'refresh');
      }
    } else {
      $this->session->set_flashdata('warning', 'Email tidak ditemukan, silahkan coba lagi.');
      redirect(base_url() . 'login/forgotpassword', 'refresh');
    }
  }

  // sudah login
  public function sudah_login($id_pelanggan, $email)
  {
    $this->db->select('*');
    $this->db->from('pelanggan');
    $this->db->where(array(
      'id_pelanggan' => $id_pelanggan,
      'email'        => $email

    ));
    $this->db->order_by('id_pelanggan', 'desc');
    $query = $this->db->get();
    return $query->row();
  }

  // detail pelanggan
  public function detail($id_pelanggan)
  {
    $this->db->select('*');
    $this->db->from('pelanggan');
    $this->db->where('id_pelanggan', $id_pelanggan);
    $this->db->order_by('id_pelanggan', 'desc');
    $query = $this->db->get();
    return $query->row();
  }

  // tambah
  public function tambah($data)
  {
    $this->db->insert('pelanggan', $data);
    $id = $this->db->insert_id();
    return $id;
  }

  // ganti status pending menjadi aktif
  public function ganti_status($key)
  {
    $data = array(
      'status_pelanggan' => 'Aktif'
    );

    $this->db->where('md5(id_pelanggan)', $key);
    $this->db->update('pelanggan', $data);

    return true;
  }

  // edit
  public function edit($data)
  {
    $this->db->where('id_pelanggan', $data['id_pelanggan']);
    $this->db->update('pelanggan', $data);
  }

  // delete
  public function delete($data)
  {
    $this->db->where('id_pelanggan', $data['id_pelanggan']);
    $this->db->delete('pelanggan', $data);
  }
}
