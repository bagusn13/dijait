<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testi extends CI_Controller
{
  // Load model
  public function __construct()
  {
    parent::__construct();
    $this->load->model('testi_model');
    // proteksi halaman
    $this->simple_login->cek_login();
  }

  // Data testi
  public function index()
  {
    $testi = $this->testi_model->listing();
    $data  = array(
      'title' => 'Data Testimoni',
      'testi' => $testi,
      'isi'   => 'admin/testi/list'
    );
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  // Tambah testi
  public function tambah()
  {
    // validasi input
    $valid = $this->form_validation;
    $valid->set_rules(
      'nama_pelanggan',
      'Nama Pelanggan',
      'required',
      array('required' => '%s harus diisi')
    );
    $valid->set_rules(
      'testimoni',
      'Testimoni',
      'required',
      array('required' => '%s harus diisi')
    );

    if ($valid->run()) {
      $config['upload_path']   = './assets/upload/image/testimoni/';
      $config['allowed_types'] = 'gif|jpg|png|jpeg';
      $config['max_size']      = '2400'; //dalam KB
      $config['max_width']     = '2024';
      $config['max_height']    = '2024';

      $this->load->library('upload', $config);
      // 'gambar' diambil dari inputan name='gambar' di tambah.php
      if (!$this->upload->do_upload('gambar')) {
        // End validasi
        $data = array(
          'title' => 'Tambah Testimoni',
          'error' =>  $this->upload->display_errors(),
          'isi'   => 'admin/testi/tambah'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
        // masuk database
      } else {
        $upload_gambar = array('upload_data' => $this->upload->data());
        // create thumbnail gambar
        $config['image_library']  = 'gd2';
        $config['source_image']   = './assets/upload/image/testimoni/' . $upload_gambar['upload_data']['file_name'];
        // lokasi folder thumbnailnya
        $config['new_image']      = './assets/upload/image/thumbs/testimoni/';
        $config['create_thumb']   = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']          = 250; //pixel
        $config['height']         = 250; //pixel
        $config['thumb_marker']   = '';

        $this->load->library('image_lib', $config);

        $this->image_lib->resize();
        // end create thumbnail

        $i    = $this->input;
        $data = array(
          'id_user'        => $this->session->userdata('id_user'),
          'nama_pelanggan' => $i->post('nama_pelanggan'),
          'pekerjaan'      => $i->post('pekerjaan'),
          'testimoni'      => $i->post('testimoni'),
          'gambar'         => $upload_gambar['upload_data']['file_name'],
          'status_testi'   => $i->post('status_testi'),
          'tanggal_post'   => date('Y-m-d H:i:s')
        );
        $this->testi_model->tambah($data);
        $this->session->set_flashdata('sukses', 'Data telah ditambah.');
        redirect(base_url('admin/testi'), 'refresh');
      }
    }
    // end masuk database
    $data = array(
      'title' => 'Tambah Testimoni',
      'isi'   => 'admin/testi/tambah'
    );
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  // edit testi
  public function edit($id_testi)
  {
    //ambil data testi yang akan diedit
    $testi = $this->testi_model->detail($id_testi);
    //validasi input
    $valid = $this->form_validation;
    $valid->set_rules(
      'nama_pelanggan',
      'Nama Pelanggan',
      'required',
      array('required' => '%s harus diisi')
    );
    $valid->set_rules(
      'testimoni',
      'Testimoni',
      'required',
      array('required' => '%s harus diisi')
    );

    if ($valid->run()) {
      // cek jika gambar diganti
      if (!empty($_FILES['gambar']['name'])) {
        $config['upload_path']   = './assets/upload/image/testimoni/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '2400'; //dalam KB
        $config['max_width']     = '2024';
        $config['max_height']    = '2024';

        $this->load->library('upload', $config);
        // 'gambar' diambil dari inputan name='gambar' di tambah.php
        if (!$this->upload->do_upload('gambar')) {
          // End validasi
          $data = array(
            'title' => 'Edit Testimoni: ' . $testi->nama_pelanggan,
            'testi' => $testi,
            'error' => $this->upload->display_errors(),
            'isi'   => 'admin/testi/edit'
          );
          $this->load->view('admin/layout/wrapper', $data, FALSE);
          // masuk database
        } else {
          unlink('./assets/upload/image/testimoni/' . $testi->gambar);
          unlink('./assets/upload/image/thumbs/testimoni/' . $testi->gambar);
          $upload_gambar  = array('upload_data' => $this->upload->data());
          // create thumbnail gambar
          $config['image_library']  = 'gd2';
          $config['source_image']   = './assets/upload/image/testimoni/' . $upload_gambar['upload_data']['file_name'];
          //lokasi folder thumbnailnya
          $config['new_image']      = './assets/upload/image/thumbs/testimoni/';
          $config['create_thumb']   = TRUE;
          $config['maintain_ratio'] = TRUE;
          $config['width']          = 250; //pixel
          $config['height']         = 250; //pixel
          $config['thumb_marker']   = '';

          $this->load->library('image_lib', $config);

          $this->image_lib->resize();
          // end create thumbnail

          $i    = $this->input;
          $data = array(
            'id_user'        => $this->session->userdata('id_user'),
            'nama_pelanggan' => $i->post('nama_pelanggan'),
            'pekerjaan'      => $i->post('pekerjaan'),
            'testimoni'      => $i->post('testimoni'),
            'gambar'         => $upload_gambar['upload_data']['file_name'],
            'status_testi'   => $i->post('status_testi'),
            'tanggal_post'   => date('Y-m-d H:i:s')
          );
          $this->testi_model->edit($data);
          $this->session->set_flashdata('sukses', 'Data telah diedit.');
          redirect(base_url('admin/testi'), 'refresh');
        }
      } else {
        // edit testi tanpa ganti gambar
        $i    = $this->input;
        $data = array(
          'id_user'        => $this->session->userdata('id_user'),
          'nama_pelanggan' => $i->post('nama_pelanggan'),
          'pekerjaan'      => $i->post('pekerjaan'),
          'testimoni'      => $i->post('testimoni'),
          // 'gambar'      => $upload_gambar['upload_data']['file_name'],
          'status_testi'   => $i->post('status_testi'),
          'tanggal_post'   => date('Y-m-d H:i:s')
        );
        $this->testi_model->edit($data);
        $this->session->set_flashdata('sukses', 'Data telah diedit.');
        redirect(base_url('admin/testi'), 'refresh');
      }
    }
    // end masuk database
    $data = array(
      'title' => 'Edit Testimoni: ' . $testi->nama_pelanggan,
      'testi' => $testi,
      'isi'   => 'admin/testi/edit'
    );
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  //delete testi
  public function delete($id_testi)
  {
    // proses hapus gambar
    $testi = $this->testi_model->detail($id_testi);
    unlink('./assets/upload/image/testimoni/' . $testi->gambar);
    unlink('./assets/upload/image/thumbs/testimoni/' . $testi->gambar);
    // end proses hapus 
    $data = array('id_testi' => $id_testi);
    $this->testi_model->delete($data);
    $this->session->set_flashdata('sukses', 'Data telah dihapus.');
    redirect(base_url('admin/testi'), 'refresh');
  }
}
