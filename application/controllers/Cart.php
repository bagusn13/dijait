<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{
  // load model yang di butuhkan
  public function __construct()
  {
    parent::__construct();
    $this->load->model('layanan_model');
    $this->load->model('kategori_model');
    $this->load->model('konfigurasi_model');
    $this->load->model('pelanggan_model');
    $this->load->model('header_transaksi_model');
    $this->load->model('transaksi_model');
    //load helper random string
    $this->load->helper('string');
  }

  // halaman keranjang belanja
  public function index()
  {
    // ambil data session untuk data pelanggan yang ada di navbar
    $id_pelanggan = $this->session->userdata('id_pelanggan');
    $pelanggan    = $this->pelanggan_model->detail($id_pelanggan);

    // ambil fungsi cart yang ada di codeigniter
    $keranjang    = $this->cart->contents();
    $data         = array(
      'title'     => 'Keranjang Belanja',
      'pelanggan' => $pelanggan,
      'keranjang' => $keranjang,
      'isi'       => 'belanja/list'
    );

    // load view frontend halaman keranjang belanja
    $this->load->view('layout/wrapper', $data, FALSE);
  }

  // sukses belanja
  public function success()
  {
    // ambil data session untuk data pelanggan yang ada di navbar
    $id_pelanggan = $this->session->userdata('id_pelanggan');
    $pelanggan    = $this->pelanggan_model->detail($id_pelanggan);
    $data = array(
      'title'     => 'Belanja Berhasil',
      'pelanggan' => $pelanggan,
      'isi'       => 'belanja/sukses'
    );
    $this->load->view('layout/wrapper', $data, FALSE);
  }

  // checkout
  public function checkout()
  {
    // cek pelanggan sudah login atau belum, jika belum maka redirect ke login.
    // kondisi sudah login
    if ($this->session->userdata('email')) {
      $id_pelanggan     = $this->session->userdata('id_pelanggan');
      $email            = $this->session->userdata('email');
      // ngambil data di database sesuai id dan email
      $pelanggan        = $this->pelanggan_model->sudah_login($id_pelanggan, $email);
      $status_pelanggan = $pelanggan->status_pelanggan;

      if ($status_pelanggan == 'Aktif') {
        // pake library cart yang ada di CI
        $keranjang = $this->cart->contents();

        // validasi input
        $valid = $this->form_validation;
        $valid->set_rules(
          'nama_pelanggan',
          'Nama Lengkap',
          'required',
          array('required' => '%s harus diisi')
        );
        $valid->set_rules(
          'telepon',
          'Telepon',
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
          'email',
          'Email',
          'required|valid_email',
          array(
            'required'      =>  '%s harus diisi',
            'valid_email'   =>  '%s tidak valid'
          )
        );

        if ($valid->run() === FALSE) {
          // End validasi
          $data = array(
            'title'     => 'Checkout',
            'keranjang' => $keranjang,
            'pelanggan' => $pelanggan,
            'isi'       => 'belanja/checkout'
          );
          $this->load->view('layout/wrapper', $data, FALSE);
        }
        // proses memasukkan data ke database
        else {
          $i    = $this->input;
          $metode_bayar = $i->post('paymentMethod');
          $kode_transaksi = $i->post('kode_transaksi');
          $data = array(
            'id_pelanggan'      => $pelanggan->id_pelanggan,
            'nama_pelanggan'    => $i->post('nama_pelanggan'),
            'email'             => $i->post('email'),
            'telepon'           => $i->post('telepon'),
            'alamat'            => $i->post('alamat'),
            'kode_transaksi'    => $kode_transaksi,
            'tanggal_transaksi' => $i->post('tanggal_transaksi'),
            'jumlah_transaksi'  => $i->post('jumlah_transaksi'),
            'status_bayar'      => 'Belum',
            'instruksi'         => $i->post('instruksi'),
            'metode_bayar'      => $metode_bayar,
            'tanggal_post'      => date('Y-m-d H:i:s')
          );
          // proses masuk ke header transaksi
          $this->header_transaksi_model->tambah($data);
          // proses masuk ke tabel transaksi
          foreach ($keranjang as $keranjang) {
            $sub_total = $keranjang['price'] * $keranjang['qty'];

            $data = array(
              'id_pelanggan'      => $pelanggan->id_pelanggan,
              'kode_transaksi'    => $kode_transaksi,
              'id_layanan'        => $keranjang['id'],
              'harga'             => $keranjang['price'],
              'jumlah'            => $keranjang['qty'],
              'total_harga'       => $sub_total,
              'tanggal_transaksi' => $i->post('tanggal_transaksi')
            );
            $this->transaksi_model->tambah($data);
          }
          // end proses masuk ke tabel transaksi
          // setelah masuk ke tabel transaksi, maka keranjang di kosongkan lagi
          $this->cart->destroy();
          // end pengosongan keranjang
          $this->session->set_flashdata('sukses', 'Checkout berhasil');

          if ($metode_bayar == 'COD') {
            redirect(base_url('cart/success'), 'refresh');
          } else {
            redirect(base_url('dashboard/konfirmasi/' . $kode_transaksi), 'refresh');
          }
        }
        // end masuk database}
      } else {
        $this->session->set_flashdata('warning', 'Keranjang kamu kosong atau Akun kamu belum terverifikasi, silahkan verifikasi terlebih dahulu');
        redirect('dashboard', 'refresh');
      }
    }

    // kondisi belum login
    else {
      $this->session->set_flashdata('warning', 'Silahkan login terlebih dahulu');
      redirect(base_url('login'), 'refresh');
    }
  }

  // tambahkan ke keranjang belanja
  public function add()
  {
    // ambil data dari form 
    $id            = $this->input->post('id');
    $qty           = $this->input->post('qty');
    $price         = $this->input->post('price');
    $name          = $this->input->post('name');
    $redirect_page = $this->input->post('redirect_page');

    // proses memasukkan data layanan ke keranjang belanja
    $data = array(
      'id'    => $id,
      'qty'   => $qty,
      'price' => $price,
      'name'  => $name
    );

    $this->cart->insert($data);
    // redirect page
    redirect($redirect_page, 'refresh');
  }

  // update cart
  public function update_cart($rowid)
  {
    // jika ada data rowid
    if ($rowid) {
      $data = array(
        'rowid' => $rowid,
        'qty'   => $this->input->post('qty')
      );
      $this->cart->update($data);
      $this->session->set_flashdata('sukses', 'Data keranjang telah diperbarui');
      redirect(base_url('cart'), 'refresh');
    }
    // jika tidak ada rowid
    else {
      redirect(base_url('cart'), 'refresh');
    }
  }

  // hapus semua isi keranjang belanja
  public function delete($rowid = '')
  {
    // hapus per item
    if ($rowid) {
      $this->cart->remove($rowid);
      $this->session->set_flashdata('sukses', 'Data keranjang belanja telah dihapus');
      redirect(base_url('cart'), 'refresh');
    }
    // hapus all
    else {
      $this->cart->destroy();
      $this->session->set_flashdata('sukses', 'Data keranjang belanja telah dihapus');
      redirect(base_url('cart'), 'refresh');
    }
  }
}
