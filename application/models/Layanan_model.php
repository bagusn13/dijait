<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Layanan_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  // Listing all layanan
  public function listing()
  {
    $this->db->select(
      'layanan.*,
                      users.nama,
                      kategori.nama_kategori,
                      kategori.slug_kategori,
                      COUNT(gambar.id_gambar) AS total_gambar'
    );
    $this->db->from('layanan');
    // JOIN 
    $this->db->join('users', 'users.id_user = layanan.id_user', 'left');
    $this->db->join('kategori', 'kategori.id_kategori = layanan.id_kategori', 'left');
    $this->db->join('gambar', 'gambar.id_layanan = layanan.id_layanan', 'left');
    // END JOIN
    $this->db->group_by('layanan.id_layanan');
    $this->db->order_by('id_layanan', 'desc');
    $query = $this->db->get();
    return $query->result();
  }

  // Listing all layanan home
  public function home()
  {
    $this->db->select(
      'layanan.*,
      users.nama,
      kategori.nama_kategori,
      kategori.slug_kategori,
      COUNT(gambar.id_gambar) AS total_gambar'
    );
    $this->db->from('layanan');
    // JOIN 
    $this->db->join('users', 'users.id_user = layanan.id_user', 'left');
    $this->db->join('kategori', 'kategori.id_kategori = layanan.id_kategori', 'left');
    $this->db->join('gambar', 'gambar.id_layanan = layanan.id_layanan', 'left');
    // END JOIN
    $this->db->where('layanan.status_layanan', 'Publish');
    $this->db->group_by('layanan.id_layanan');
    $this->db->order_by('id_layanan', 'desc');
    $this->db->limit(12);
    $query = $this->db->get();
    return $query->result();
  }

  // read layanan
  public function read($slug_layanan)
  {
    $this->db->select(
      'layanan.*,
      users.nama,
      kategori.nama_kategori,
      kategori.slug_kategori,
      COUNT(gambar.id_gambar) AS total_gambar'
    );
    $this->db->from('layanan');
    // JOIN 
    $this->db->join('users', 'users.id_user = layanan.id_user', 'left');
    $this->db->join('kategori', 'kategori.id_kategori = layanan.id_kategori', 'left');
    $this->db->join('gambar', 'gambar.id_layanan = layanan.id_layanan', 'left');
    // END JOIN
    $this->db->where('layanan.status_layanan', 'Publish');
    $this->db->where('layanan.slug_layanan', $slug_layanan);
    $this->db->group_by('layanan.id_layanan');
    $this->db->order_by('id_layanan', 'desc');
    $query = $this->db->get();
    return $query->row();
  }

  //layanan
  public function layanan($limit, $start)
  {
    $this->db->select(
      'layanan.*,
      users.nama,
      kategori.nama_kategori,
      kategori.slug_kategori,
      COUNT(gambar.id_gambar) AS total_gambar'
    );
    $this->db->from('layanan');
    // JOIN 
    $this->db->join('users', 'users.id_user = layanan.id_user', 'left');
    $this->db->join('kategori', 'kategori.id_kategori = layanan.id_kategori', 'left');
    $this->db->join('gambar', 'gambar.id_layanan = layanan.id_layanan', 'left');
    // END JOIN
    $this->db->where('layanan.status_layanan', 'Publish');
    $this->db->group_by('layanan.id_layanan');
    $this->db->order_by('id_layanan', 'desc');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }

  //total layanan
  public function total_layanan()
  {
    $this->db->select('COUNT(*) AS total');
    $this->db->from('layanan');
    $this->db->where('status_layanan', 'Publish');
    $query = $this->db->get();
    return $query->row();
  }

  //kategori layanan
  public function kategori($id_kategori, $limit, $start)
  {
    $this->db->select(
      'layanan.*,
      users.nama,
      kategori.nama_kategori,
      kategori.slug_kategori,
      COUNT(gambar.id_gambar) AS total_gambar'
    );
    $this->db->from('layanan');
    // JOIN 
    $this->db->join('users', 'users.id_user = layanan.id_user', 'left');
    $this->db->join('kategori', 'kategori.id_kategori = layanan.id_kategori', 'left');
    $this->db->join('gambar', 'gambar.id_layanan = layanan.id_layanan', 'left');
    // END JOIN
    $this->db->where('layanan.status_layanan', 'Publish');
    $this->db->where('layanan.id_kategori', $id_kategori);
    $this->db->group_by('layanan.id_layanan');
    $this->db->order_by('id_layanan', 'desc');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }

  //total kategori layanan
  public function total_kategori($id_kategori)
  {
    $this->db->select('COUNT(*) AS total');
    $this->db->from('layanan');
    $this->db->where('status_layanan', 'Publish');
    $this->db->where('id_kategori', $id_kategori);
    $query = $this->db->get();
    return $query->row();
  }

  //listing kategori
  public function listing_kategori()
  {
    $this->db->select(
      'layanan.*,
                      users.nama,
                      kategori.nama_kategori,
                      kategori.slug_kategori,
                      COUNT(gambar.id_gambar) AS total_gambar'
    );
    $this->db->from('layanan');
    // JOIN 
    $this->db->join('users', 'users.id_user = layanan.id_user', 'left');
    $this->db->join('kategori', 'kategori.id_kategori = layanan.id_kategori', 'left');
    $this->db->join('gambar', 'gambar.id_layanan = layanan.id_layanan', 'left');
    // END JOIN
    $this->db->group_by('layanan.id_kategori');
    $this->db->order_by('id_layanan', 'desc');
    $query = $this->db->get();
    return $query->result();
  }

  // detail layanan
  public function detail($id_layanan)
  {
    $this->db->select('*');
    $this->db->from('layanan');
    $this->db->where('id_layanan', $id_layanan);
    $this->db->order_by('id_layanan', 'desc');
    $query = $this->db->get();
    return $query->row();
  }

  // detail gambar layanan
  public function detail_gambar($id_gambar)
  {
    $this->db->select('*');
    $this->db->from('gambar');
    $this->db->where('id_gambar', $id_gambar);
    $this->db->order_by('id_gambar', 'desc');
    $query = $this->db->get();
    return $query->row();
  }
  // gambar
  public function gambar($id_layanan)
  {
    $this->db->select('*');
    $this->db->from('gambar');
    $this->db->where('id_layanan', $id_layanan);
    $this->db->order_by('id_gambar', 'desc');
    $query = $this->db->get();
    return $query->result();
  }

  //tambah
  public function tambah($data)
  {
    $this->db->insert('layanan', $data);
  }

  //tambah gambar
  public function tambah_gambar($data)
  {
    $this->db->insert('gambar', $data);
  }

  //edit
  public function edit($data)
  {
    $this->db->where('id_layanan', $data['id_layanan']);
    $this->db->update('layanan', $data);
  }

  //delete
  public function delete($data)
  {
    $this->db->where('id_layanan', $data['id_layanan']);
    $this->db->delete('layanan', $data);
  }

  //delete gambar
  public function delete_gambar($data)
  {
    $this->db->where('id_gambar', $data['id_gambar']);
    $this->db->delete('gambar', $data);
  }
}
