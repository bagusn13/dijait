<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  // load model yang di butuhkan
  public function __construct()
  {
    parent::__construct();
    $this->load->model('pelanggan_model');
    $this->load->model('header_transaksi_model');
    $this->load->model('transaksi_model');
    $this->load->model('rekening_model');
    // halaman ini diproteksi dengan simple_pelanggan => cek login
    $this->simple_pelanggan->cek_login();
  }

  // halaman dashboard pelanggan
  public function index()
  {
    // ambil data login id_pelanggan dari session
    $id_pelanggan     = $this->session->userdata('id_pelanggan');
    $pelanggan        = $this->pelanggan_model->detail($id_pelanggan);
    $header_transaksi = $this->header_transaksi_model->pelanggan($id_pelanggan);

    $data = array(
      'title'            => 'Halaman Dashboard Pelanggan',
      'pelanggan'        => $pelanggan,
      'header_transaksi' => $header_transaksi,
      'isi'              => 'dashboard/list'
    );
    $this->load->view('layout/wrapper', $data, FALSE);
  }

  // Riwayat belanja
  public function orderHistory()
  {
    // ambil data login id_pelanggan dari session
    $id_pelanggan     = $this->session->userdata('id_pelanggan');
    $pelanggan        = $this->pelanggan_model->detail($id_pelanggan);
    $header_transaksi = $this->header_transaksi_model->pelanggan($id_pelanggan);

    $data = array(
      'title'            => 'Riwayat Belanja',
      'pelanggan'        => $pelanggan,
      'header_transaksi' => $header_transaksi,
      'isi'              => 'dashboard/belanja'
    );
    $this->load->view('layout/wrapper', $data, FALSE);
  }

  // detail
  public function detail($kode_transaksi)
  {
    // ambil data login id_pelanggan dari session
    $id_pelanggan     = $this->session->userdata('id_pelanggan');
    $pelanggan        = $this->pelanggan_model->detail($id_pelanggan);
    $header_transaksi = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
    $transaksi        = $this->transaksi_model->kode_transaksi($kode_transaksi);

    // pastikan bahwa pelanggan hanya mengakses data transaksinya
    if ($header_transaksi->id_pelanggan != $id_pelanggan) {
      $this->session->set_flashdata('warning', 'Kamu mencoba mengakses data transaksi orang lain');
      redirect(base_url('login'));
    }
    $data = array(
      'title'            => 'Riwayat Belanja',
      'header_transaksi' => $header_transaksi,
      'pelanggan'        => $pelanggan,
      'transaksi'        => $transaksi,
      'isi'              => 'dashboard/detail'
    );
    $this->load->view('layout/wrapper', $data, FALSE);
  }

  // profil
  public function profile()
  {
    // ambil data login id_pelanggan dari session
    $id_pelanggan = $this->session->userdata('id_pelanggan');
    $pelanggan    = $this->pelanggan_model->detail($id_pelanggan);

    // validasi input
    $valid = $this->form_validation;

    $valid->set_rules(
      'nama_pelanggan',
      'Nama Lengkap',
      'required',
      array('required' => '%s harus diisi')
    );
    $valid->set_rules(
      'alamat',
      'Alamat',
      'required',
      array('required' => '%s harus diisi')
    );
    $valid->set_rules(
      'telepon',
      'Telepon',
      'required',
      array('required' => '%s harus diisi')
    );

    if ($valid->run() === FALSE) {
      // End validasi
      $data = array(
        'title'     => 'Profil Saya',
        'pelanggan' => $pelanggan,
        'isi'       => 'dashboard/profil'
      );
      $this->load->view('layout/wrapper', $data, FALSE);
    }
    // proses edit profile
    // masuk database
    else {
      $i    = $this->input;
      $data = array(
        'id_pelanggan'    => $id_pelanggan,
        'nama_pelanggan'  => $i->post('nama_pelanggan'),
        'telepon'         => $i->post('telepon'),
        'alamat'          => $i->post('alamat')
      );
      // end data update
      $this->pelanggan_model->edit($data);
      $this->session->set_flashdata('sukses', 'Update profil berhasil');
      redirect(base_url('dashboard/profil'), 'refresh');
    }
    // end masuk database
  }

  // verifikasi akun (pending to aktif)
  public function verification()
  {
    $id           = $this->session->userdata('id_pelanggan');
    $email        = $this->session->userdata('email');
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
      "Terimakasih telah melakukan verifikasi akun anda, untuk memverifikasi silahkan klik tautan berikut ini<br><br>" .
        site_url("dashboard/code_verification/$encrypted_id")
    );

    if ($this->email->send()) {
      $this->session->set_flashdata('sukses', 'Berhasil mengirimkan tautan verifikasi ke email kamu');
      redirect(base_url('dashboard'), 'refresh');
    } else {
      $this->session->set_flashdata('warning', 'Gagal mengirimkan tautan verifikasi ke email kamu, silahkan coba beberapa saat lagi');
      redirect(base_url('dashboard'), 'refresh');
    }
  }

  // verifikasi
  public function code_verification($key)
  {
    //$this->load->helper('url');
    $this->pelanggan_model->ganti_status($key);
    $this->session->set_flashdata('sukses', 'Selamat akun kamu telah terverifikasi');
    redirect(base_url('dashboard'), 'refresh');
  }

  // ganti password
  public function changePassword()
  {
    // ambil data login id_pelanggan dari session
    $id_pelanggan = $this->session->userdata('id_pelanggan');
    $pelanggan    = $this->pelanggan_model->detail($id_pelanggan);

    // validasi input
    $valid = $this->form_validation;
    $valid->set_rules(
      'old_password',
      'Password lama',
      'required',
      array('required' => '%s harus diisi')
    );
    $valid->set_rules(
      'new_password',
      'Password baru',
      'required',
      array('required' => '%s harus diisi')
    );
    $valid->set_rules(
      'confirm_new_password',
      'Password baru',
      'required|matches[new_password]',
      array(
        'required' => '%s harus diisi',
        'matches'  => '%s tidak sama'
      )
    );

    if ($valid->run() === FALSE) {
      // End validasi
      $data = array(
        'title'     => 'Ganti Password',
        'pelanggan' => $pelanggan,
        'isi'       => 'dashboard/changepassword'
      );
      $this->load->view('layout/wrapper', $data, FALSE);
      // masuk database
    }
    // proses ganti password 
    else {
      $i = $this->input;
      $check = $this->pelanggan_model->detail($id_pelanggan);

      // cek password lama apakah sama dengan password di database
      // jika sama
      if ($check->password == sha1($i->post('old_password'))) {
        // jika password lebih dari atau sama dengan 6 karakter, maka password di ganti
        if (strlen($i->post('new_password')) >= 6) {
          $data = array(
            'id_pelanggan' => $id_pelanggan,
            'password'     => SHA1($i->post('new_password'))
          );
          // end data update
          $this->pelanggan_model->edit($data);
          $this->session->set_flashdata('sukses', 'Ganti password berhasil');
          redirect(base_url('dashboard'), 'refresh');
        }
        // jika password kurang dari 6
        else {
          // end masuk database
          // kalau passwordnya kurang dari 6 maka password g diganti
          $this->session->set_flashdata('warning', 'Password tidak boleh kurang dari 6 digit');
          redirect(base_url('dashboard/changepassword'), 'refresh');
        }
      }
      // jika beda
      else {
        $this->session->set_flashdata('warning', 'Password lama yang anda masukkan salah!');
        redirect(base_url('dashboard/changepassword'), 'refresh');
      }
    }
  }

  // konfirmasi pembayaran
  public function konfirmasi($kode_transaksi)
  {
    // ambil data login id_pelanggan dari session
    $id_pelanggan     = $this->session->userdata('id_pelanggan');
    $pelanggan        = $this->pelanggan_model->detail($id_pelanggan);
    $header_transaksi = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
    $rekening         = $this->rekening_model->listing();

    // validasi input
    $valid = $this->form_validation;
    $valid->set_rules(
      'nama_bank',
      'Nama Bank',
      'required',
      array('required' => '%s harus diisi')
    );
    $valid->set_rules(
      'rekening_pembayaran',
      'Nomor Rekening',
      'required',
      array('required'  => '%s harus diisi')
    );
    $valid->set_rules(
      'rekening_pelanggan',
      'Nama Pemilik',
      'required',
      array('required'  => '%s harus diisi')
    );
    $valid->set_rules(
      'tanggal_bayar',
      'Tanggal Pembayaran',
      'required',
      array('required'  => '%s harus diisi')
    );
    $valid->set_rules(
      'jumlah_bayar',
      'Jumlah Pembayaran',
      'required',
      array('required'  => '%s harus diisi')
    );

    if ($valid->run()) {
      if (!empty($_FILES['bukti_bayar']['name'])) {
        $config['upload_path']   = './assets/upload/image/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '2400'; //dalam KB
        $config['max_width']     = '2024';
        $config['max_height']    = '2024';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('bukti_bayar')) {
          // End validasi
          $data   =   array(
            'title'            => 'Konfirmasi Pembayaran',
            'header_transaksi' => $header_transaksi,
            'rekening'         => $rekening,
            'error'            => $this->upload->display_errors(),
            'isi'              => 'dashboard/konfirmasi'
          );
          $this->load->view('layout/wrapper', $data, FALSE);
          // masuk database
        } else {
          $upload_gambar = array('upload_data' => $this->upload->data());
          //create thumbnail gambar
          $config['image_library']  = 'gd2';
          $config['source_image']   = './assets/upload/image/' . $upload_gambar['upload_data']['file_name'];
          //lokasi folder thumbnail
          $config['new_image']      = './assets/upload/image/thumbs/';
          $config['create_thumb']   = TRUE;
          $config['maintain_ratio'] = TRUE;
          $config['width']          = 250; //pixel
          $config['height']         = 250; //pixel
          $config['thumb_marker']   = '';

          $this->load->library('image_lib', $config);

          $this->image_lib->resize();
          //end create thumbnail

          $i = $this->input;

          $data = array(
            'id_header_transaksi' => $header_transaksi->id_header_transaksi,
            'status_bayar'        => 'Menunggu Konfirmasi',
            'jumlah_bayar'        => $i->post('jumlah_bayar'),
            'rekening_pembayaran' => $i->post('rekening_pembayaran'),
            'rekening_pelanggan'  => $i->post('rekening_pelanggan'),
            'bukti_bayar'         => $upload_gambar['upload_data']['file_name'],
            'id_rekening'         => $i->post('id_rekening'),
            'tanggal_bayar'       => $i->post('tanggal_bayar'),
            'nama_bank'           => $i->post('nama_bank')
          );
          $this->header_transaksi_model->edit($data);
          $this->session->set_flashdata('sukses', 'Konfirmasi pembayaran berhasil');
          redirect(base_url('dashboard'), 'refresh');
        }
      } else {
        $i = $this->input;

        $data = array(
          'id_header_transaksi' => $header_transaksi->id_header_transaksi,
          'status_bayar'        => 'Menunggu Konfirmasi',
          'jumlah_bayar'        => $i->post('jumlah_bayar'),
          'rekening_pembayaran' => $i->post('rekening_pembayaran'),
          'rekening_pelanggan'  => $i->post('rekening_pelanggan'),
          'id_rekening'         => $i->post('id_rekening'),
          'tanggal_bayar'       => $i->post('tanggal_bayar'),
          'nama_bank'           => $i->post('nama_bank'),
          'metode_bayar'        => 'Transfer'
        );
        $this->header_transaksi_model->edit($data);
        $this->session->set_flashdata('sukses', 'Konfirmasi pembayaran berhasil');
        redirect(base_url('dashboard'), 'refresh');
      }
    }
    // end masuk database
    $data   =   array(
      'title'             => 'Konfirmasi Pembayaran',
      'header_transaksi'  => $header_transaksi,
      'rekening'          => $rekening,
      'pelanggan'         => $pelanggan,
      'isi'               => 'dashboard/konfirmasi'
    );
    $this->load->view('layout/wrapper', $data, FALSE);
  }

  // konfirmasi pembayaran
  public function konfirmasi_cod($kode_transaksi)
  {
    // ambil data login id_pelanggan dari session
    $id_pelanggan     = $this->session->userdata('id_pelanggan');
    $pelanggan        = $this->pelanggan_model->detail($id_pelanggan);
    $header_transaksi = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
    $rekening         = $this->rekening_model->listing();

    $i = $this->input;

    $data = array(
      'id_header_transaksi' => $header_transaksi->id_header_transaksi,
      'status_bayar'        => 'Menunggu Konfirmasi',
      'jumlah_bayar'        => $i->post('jumlah_bayar'),
      'tanggal_bayar'       => $i->post('tanggal_bayar'),
      'metode_bayar'        => 'COD'
    );
    $this->header_transaksi_model->edit($data);
    $this->session->set_flashdata('sukses', 'Konfirmasi pembayaran berhasil');
    redirect(base_url('dashboard'), 'refresh');
  }
}
