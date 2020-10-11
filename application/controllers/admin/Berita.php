<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends CI_Controller
{
  // Load model
  public function __construct()
  {
    parent::__construct();
    $this->load->model('berita_model');
    // proteksi halaman
    $this->simple_login->cek_login();
  }

  // Data berita
  public function index()
  {
    $berita = $this->berita_model->listing();
    $data   = array(
      'title'  => 'Data Berita',
      'berita' => $berita,
      'isi'    => 'admin/berita/list'
    );
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  // Tambah berita
  public function tambah()
  {
    // validasi input
    $valid = $this->form_validation;
    $valid->set_rules(
      'judul_berita',
      'Judul Berita',
      'required',
      array('required' => '%s harus diisi')
    );

    if ($valid->run()) {
      $config['upload_path']   = './assets/upload/image/instagram/';
      $config['allowed_types'] = 'gif|jpg|png|jpeg';
      $config['max_size']      = '2400'; // dalam KB
      $config['max_width']     = '2024';
      $config['max_height']    = '2024';

      $this->load->library('upload', $config);
      // 'gambar' diambil dari inputan name='gambar' di tambah.php
      if (!$this->upload->do_upload('gambar')) {
        // End validasi
        $data = array(
          'title' => 'Tambah Berita',
          'error' => $this->upload->display_errors(),
          'isi'   => 'admin/berita/tambah'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
        // masuk database
      } else {
        $upload_gambar = array('upload_data' => $this->upload->data());
        // create thumbnail gambar
        $config['image_library']  = 'gd2';
        $config['source_image']   = './assets/upload/image/instagram/' . $upload_gambar['upload_data']['file_name'];
        //lokasi folder thumbnailnya
        $config['new_image']      = './assets/upload/image/thumbs/instagram/';
        $config['create_thumb']   = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']          = 250; //pixel
        $config['height']         = 250; //pixel
        $config['thumb_marker']   = '';

        $this->load->library('image_lib', $config);

        $this->image_lib->resize();
        // end create thumbnail

        $i           = $this->input;
        $slug_berita = url_title($this->input->post('judul_berita') . '-' . $this->input->post('jenis_berita'), 'dash', TRUE);
        $data        = array(
          'id_user'       => $this->session->userdata('id_user'),
          'jenis_berita'  => $i->post('jenis_berita'),
          'judul_berita'  => $i->post('judul_berita'),
          'slug_berita'   => $slug_berita,
          'keywords'      => $i->post('keywords'),
          'status_berita' => $i->post('status_berita'),
          'keterangan'    => $i->post('keterangan'),
          'link'          => $i->post('link'),
          'gambar'        => $upload_gambar['upload_data']['file_name'],
          'tanggal_post'  => date('Y-m-d H:i:s')
        );
        $this->berita_model->tambah($data);
        $this->session->set_flashdata('sukses', 'Data telah ditambah.');
        redirect(base_url('admin/berita'), 'refresh');
      }
    }

    // end masuk database
    $data = array(
      'title' => 'Tambah Berita',
      'isi'   => 'admin/berita/tambah'
    );
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  // edit berita
  public function edit($id_berita)
  {
    // ambil data berita yang akan diedit
    $berita = $this->berita_model->detail($id_berita);

    // validasi input
    $valid = $this->form_validation;

    $valid->set_rules(
      'judul_berita',
      'Judul Berita',
      'required',
      array('required' => '%s harus diisi')
    );

    if ($valid->run()) {
      // cek jika gambar diganti
      if (!empty($_FILES['gambar']['name'])) {
        $config['upload_path']    = './assets/upload/image/instagram/';
        $config['allowed_types']  = 'gif|jpg|png|jpeg';
        $config['max_size']       = '2400'; //dalam KB
        $config['max_width']      = '2024';
        $config['max_height']     = '2024';

        $this->load->library('upload', $config);
        //'gambar' diambil dari inputan name='gambar' di tambah.php
        if (!$this->upload->do_upload('gambar')) {
          // End validasi
          $data = array(
            'title'  => 'Edit Berita: ' . $berita->judul_berita,
            'berita' => $berita,
            'error'  => $this->upload->display_errors(),
            'isi'    => 'admin/berita/edit'
          );
          $this->load->view('admin/layout/wrapper', $data, FALSE);
          // masuk database
        } else {
          unlink('./assets/upload/image/instagram/' . $berita->gambar);
          unlink('./assets/upload/image/thumbs/instagram/' . $berita->gambar);
          $upload_gambar = array('upload_data' => $this->upload->data());
          // create thumbnail gambar
          $config['image_library']  = 'gd2';
          $config['source_image']   = './assets/upload/image/instagram/' . $upload_gambar['upload_data']['file_name'];
          // lokasi folder thumbnailnya
          $config['new_image']      = './assets/upload/image/thumbs/instagram/';
          $config['create_thumb']   = TRUE;
          $config['maintain_ratio'] = TRUE;
          $config['width']          = 250; //pixel
          $config['height']         = 250; //pixel
          $config['thumb_marker']   = '';

          $this->load->library('image_lib', $config);

          $this->image_lib->resize();
          // end create thumbnail

          $i           = $this->input;
          $slug_berita = url_title($this->input->post('judul_berita') . '-' . $this->input->post('jenis_berita'), 'dash', TRUE);
          $data        = array(
            'id_berita'     => $id_berita,
            'id_user'       => $this->session->userdata('id_user'),
            'jenis_berita'  => $i->post('jenis_berita'),
            'judul_berita'  => $i->post('judul_berita'),
            'slug_berita'   => $slug_berita,
            'keywords'      => $i->post('keywords'),
            'status_berita' => $i->post('status_berita'),
            'keterangan'    => $i->post('keterangan'),
            'link'          => $i->post('link'),
            'gambar'        => $upload_gambar['upload_data']['file_name']
          );
          $this->berita_model->edit($data);
          $this->session->set_flashdata('sukses', 'Data telah diedit.');
          redirect(base_url('admin/berita'), 'refresh');
        }
      } else {
        // edit berita tanpa ganti gambar
        $i            = $this->input;
        $slug_berita  = url_title($this->input->post('judul_berita') . '-' . $this->input->post('jenis_berita'), 'dash', TRUE);
        $data         = array(
          'id_berita'     => $id_berita,
          'id_user'       => $this->session->userdata('id_user'),
          'jenis_berita'  => $i->post('jenis_berita'),
          'judul_berita'  => $i->post('judul_berita'),
          'slug_berita'   => $slug_berita,
          'keywords'      => $i->post('keywords'),
          'status_berita' => $i->post('status_berita'),
          'keterangan'    => $i->post('keterangan'),
          'link'          => $i->post('link'),
          //'gambar'        => $upload_gambar['upload_data']['file_name']
        );
        $this->berita_model->edit($data);
        $this->session->set_flashdata('sukses', 'Data telah diedit.');
        redirect(base_url('admin/berita'), 'refresh');
      }
    }
    // end masuk database
    $data = array(
      'title'  => 'Edit Berita: ' . $berita->judul_berita,
      'berita' => $berita,
      'isi'    => 'admin/berita/edit'
    );
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  // delete berita
  public function delete($id_berita)
  {
    // proses hapus gambar
    $berita = $this->berita_model->detail($id_berita);
    unlink('./assets/upload/image/instagram/' . $berita->gambar);
    unlink('./assets/upload/image/thumbs/instagram/' . $berita->gambar);
    // end proses hapus 
    $data = array('id_berita' => $id_berita);
    $this->berita_model->delete($data);
    $this->session->set_flashdata('sukses', 'Data telah dihapus.');
    redirect(base_url('admin/berita'), 'refresh');
  }
}
