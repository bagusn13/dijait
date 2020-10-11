<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Layanan extends CI_Controller
{
  // Load model
  public function __construct()
  {
    parent::__construct();
    $this->load->model('layanan_model');
    $this->load->model('kategori_model');
    // proteksi halaman
    $this->simple_login->cek_login();
  }

  // Data layanan
  public function index()
  {
    $layanan = $this->layanan_model->listing();
    $data    = array(
      'title'   => 'Data Layanan',
      'layanan' => $layanan,
      'isi'     => 'admin/layanan/list'
    );
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  // Gambar
  public function gambar($id_layanan)
  {
    $layanan = $this->layanan_model->detail($id_layanan);
    $gambar  = $this->layanan_model->gambar($id_layanan);

    // validasi input
    $valid = $this->form_validation;

    $valid->set_rules(
      'judul_gambar',
      'Judul/Nama Gambar',
      'required',
      array('required' => '%s harus diisi')
    );

    if ($valid->run()) {
      $config['upload_path']   = './assets/upload/image/';
      $config['allowed_types'] = 'gif|jpg|png|jpeg';
      $config['max_size']      = '2400'; //dalam KB
      $config['max_width']     = '2024';
      $config['max_height']    = '2024';

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('gambar')) {
        // End validasi
        $data = array(
          'title'   => 'Tambah Gambar Layanan: ' . $layanan->nama_layanan,
          'layanan' => $layanan,
          'gambar'  => $gambar,
          'error'   => $this->upload->display_errors(),
          'isi'     => 'admin/layanan/gambar'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
        // masuk database
      } else {
        $upload_gambar = array('upload_data' => $this->upload->data());

        // create thumbnail gambar
        $config['image_library']  = 'gd2';
        $config['source_image']   = './assets/upload/image/' . $upload_gambar['upload_data']['file_name'];
        // lokasi folder thumbnail
        $config['new_image']      = './assets/upload/image/thumbs/';
        $config['create_thumb']   = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']          = 250; //pixel
        $config['height']         = 250; //pixel
        $config['thumb_marker']   = '';

        $this->load->library('image_lib', $config);

        $this->image_lib->resize();
        // end create thumbnail

        $i = $this->input;
        $data = array(
          'id_layanan'   => $id_layanan,
          'judul_gambar' => $i->post('judul_gambar'),
          // disimpan nama file gambar
          'gambar'       => $upload_gambar['upload_data']['file_name']
        );
        $this->layanan_model->tambah_gambar($data);
        $this->session->set_flashdata('sukses', 'Data gambar telah ditambah.');
        redirect(base_url('admin/layanan/gambar' . $id_layanan), 'refresh');
      }
    }
    // end masuk database
    $data = array(
      'title'   => 'Tambah Gambar Layanan: ' . $layanan->nama_layanan,
      'layanan' => $layanan,
      'gambar'  => $gambar,
      'isi'     => 'admin/layanan/gambar'
    );
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  // Tambah layanan
  public function tambah()
  {
    // ambil data kategori
    $kategori = $this->kategori_model->listing();

    // validasi input
    $valid = $this->form_validation;

    $valid->set_rules(
      'nama_layanan',
      'Nama Layanan',
      'required',
      array('required' => '%s harus diisi')
    );

    $valid->set_rules(
      'kode_layanan',
      'Kode Layanan',
      'required|is_unique[layanan.kode_layanan]',
      array(
        'required'  => '%s harus diisi',
        'is_unique' => '%s sudah ada. Buat kode produk baru'
      )
    );


    if ($valid->run()) {
      $config['upload_path']   = './assets/upload/image/';
      $config['allowed_types'] = 'gif|jpg|png|jpeg';
      $config['max_size']      = '2400'; //dalam KB
      $config['max_width']     = '2024';
      $config['max_height']    = '2024';

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('gambar')) {
        // End validasi
        $data = array(
          'title'    => 'Tambah Layanan',
          'kategori' => $kategori,
          'error'    => $this->upload->display_errors(),
          'isi'      => 'admin/layanan/tambah'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
        // masuk database
      } else {
        $upload_gambar = array('upload_data' => $this->upload->data());

        // create thumbnail gambar
        $config['image_library']  = 'gd2';
        $config['source_image']   = './assets/upload/image/' . $upload_gambar['upload_data']['file_name'];
        // lokasi folder thumbnail
        $config['new_image']      = './assets/upload/image/thumbs/';
        $config['create_thumb']   = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']          = 250; //pixel
        $config['height']         = 250; //pixel
        $config['thumb_marker']   = '';

        $this->load->library('image_lib', $config);

        $this->image_lib->resize();
        // end create thumbnail

        $i = $this->input;
        // slug layanan
        $slug_layanan = url_title($this->input->post('nama_layanan') . '-' . $this->input->post('kode_layanan'), 'dash', TRUE);

        $data = array(
          'id_user'        => $this->session->userdata('id_user'),
          'id_kategori'    => $i->post('id_kategori'),
          'kode_layanan'   => $i->post('kode_layanan'),
          'nama_layanan'   => $i->post('nama_layanan'),
          'slug_layanan'   => $slug_layanan,
          'keterangan'     => $i->post('keterangan'),
          'keywords'       => $i->post('keywords'),
          'harga'          => $i->post('harga'),
          // disimpan nama file gambar
          'gambar'         => $upload_gambar['upload_data']['file_name'],
          'status_layanan' => $i->post('status_layanan'),
          'tanggal_post'   => date('Y-m-d H:i:s')
        );
        $this->layanan_model->tambah($data);
        $this->session->set_flashdata('sukses', 'Data telah ditambah.');
        redirect(base_url('admin/layanan'), 'refresh');
      }
    }
    // end masuk database
    $data = array(
      'title'    => 'Tambah Layanan',
      'kategori' => $kategori,
      'isi'      => 'admin/layanan/tambah'
    );
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  // Edit layanan
  public function edit($id_layanan)
  {
    // ambil data layanan yang mau di edit
    $layanan  = $this->layanan_model->detail($id_layanan);
    // ambil data kategori
    $kategori = $this->kategori_model->listing();
    // validasi input
    $valid    = $this->form_validation;

    $valid->set_rules(
      'nama_layanan',
      'Nama Layanan',
      'required',
      array('required' => '%s harus diisi')
    );

    $valid->set_rules(
      'kode_layanan',
      'Kode Layanan',
      'required',
      array('required' => '%s harus diisi')
    );

    if ($valid->run()) {
      // cek jika gambar diganti
      if (!empty($_FILES['gambar']['name'])) {

        $config['upload_path']   = './assets/upload/image/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '2400'; //dalam KB
        $config['max_width']     = '2024';
        $config['max_height']    = '2024';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar')) {
          // End validasi
          $data = array(
            'title'    => 'Edit Layanan: ' . $layanan->nama_layanan,
            'kategori' => $kategori,
            'layanan'  => $layanan,
            'error'    => $this->upload->display_errors(),
            'isi'      => 'admin/layanan/edit'
          );
          $this->load->view('admin/layout/wrapper', $data, FALSE);
          // masuk database
        } else {
          unlink('./assets/upload/image/' . $layanan->gambar);
          unlink('./assets/upload/image/thumbs/' . $layanan->gambar);
          $upload_gambar = array('upload_data' => $this->upload->data());

          // create thumbnail gambar
          $config['image_library']  = 'gd2';
          $config['source_image']   = './assets/upload/image/' . $upload_gambar['upload_data']['file_name'];
          // lokasi folder thumbnail
          $config['new_image']      = './assets/upload/image/thumbs/';
          $config['create_thumb']   = TRUE;
          $config['maintain_ratio'] = TRUE;
          $config['width']          = 250; //pixel
          $config['height']         = 250; //pixel
          $config['thumb_marker']   = '';

          $this->load->library('image_lib', $config);

          $this->image_lib->resize();
          // end create thumbnail

          $i = $this->input;
          // slug layanan
          $slug_layanan = url_title($this->input->post('nama_layanan') . '-' . $this->input->post('kode_layanan'), 'dash', TRUE);

          $data = array(
            'id_layanan'     => $id_layanan,
            'id_user'        => $this->session->userdata('id_user'),
            'id_kategori'    => $i->post('id_kategori'),
            'kode_layanan'   => $i->post('kode_layanan'),
            'nama_layanan'   => $i->post('nama_layanan'),
            'slug_layanan'   => $slug_layanan,
            'keterangan'     => $i->post('keterangan'),
            'keywords'       => $i->post('keywords'),
            'harga'          => $i->post('harga'),
            // disimpan nama file gambar
            'gambar'         => $upload_gambar['upload_data']['file_name'],
            'status_layanan' => $i->post('status_layanan')
          );
          $this->layanan_model->edit($data);
          $this->session->set_flashdata('sukses', 'Data telah diedit.');
          redirect(base_url('admin/layanan'), 'refresh');
        }
      } else {
        // edit layanan tanpa ganti gambar
        $i = $this->input;
        // slug layanan
        $slug_layanan = url_title($this->input->post('nama_layanan') . '-' . $this->input->post('kode_layanan'), 'dash', TRUE);

        $data = array(
          'id_layanan'     => $id_layanan,
          'id_user'        => $this->session->userdata('id_user'),
          'id_kategori'    => $i->post('id_kategori'),
          'kode_layanan'   => $i->post('kode_layanan'),
          'nama_layanan'   => $i->post('nama_layanan'),
          'slug_layanan'   => $slug_layanan,
          'keterangan'     => $i->post('keterangan'),
          'keywords'       => $i->post('keywords'),
          'harga'          => $i->post('harga'),
          // disimpan nama file gambar
          //'gambar'            => $upload_gambar['upload_data']['file_name'],
          'status_layanan' => $i->post('status_layanan')
        );
        $this->layanan_model->edit($data);
        $this->session->set_flashdata('sukses', 'Data telah diedit.');
        redirect(base_url('admin/layanan'), 'refresh');
      }
    }
    // end masuk database
    $data = array(
      'title'    => 'Edit Layanan: ' . $layanan->nama_layanan,
      'kategori' => $kategori,
      'layanan'  => $layanan,
      'isi'      => 'admin/layanan/edit'
    );
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  // Delete layanan
  public function delete($id_layanan)
  {
    // proses hapus gambar
    $layanan = $this->layanan_model->detail($id_layanan);
    unlink('./assets/upload/image/' . $layanan->gambar);
    unlink('./assets/upload/image/thumbs/' . $layanan->gambar);
    //end proses hapus
    $data = array('id_layanan' => $id_layanan);
    $this->layanan_model->delete($data);
    $this->session->set_flashdata('sukses', 'Data telah dihapus.');
    redirect(base_url('admin/layanan'), 'refresh');
  }

  // Delete gambar layanan
  public function delete_gambar($id_layanan, $id_gambar)
  {
    // proses hapus gambar
    $gambar = $this->layanan_model->detail_gambar($id_gambar);
    unlink('./assets/upload/image/' . $gambar->gambar);
    unlink('./assets/upload/image/thumbs/' . $gambar->gambar);
    // end proses hapus
    $data = array('id_gambar' => $id_gambar);
    $this->layanan_model->delete_gambar($data);
    $this->session->set_flashdata('sukses', 'Data gambar telah dihapus.');
    redirect(base_url('admin/layanan/gambar/' . $id_layanan), 'refresh');
  }
}
