<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  // Listing all berita
  public function listing()
  {
    $this->db->select('berita.*,
                    users.nama');
    $this->db->from('berita');
    //join
    $this->db->join('users', 'users.id_user = berita.id_user', 'left');
    //end join
    $this->db->order_by('id_berita', 'desc');
    $query = $this->db->get();
    return $query->result();
  }

  // Listing all berita di home
  public function home()
  {
    $this->db->select('berita.*,
                    users.nama');
    $this->db->from('berita');
    //join
    $this->db->join('users', 'users.id_user = berita.id_user', 'left');
    //end join
    $this->db->where('berita.status_berita', 'Publish');
    $this->db->order_by('id_berita', 'desc');
    $this->db->limit(10);
    $query = $this->db->get();
    return $query->result();
  }

  // detail berita
  public function detail($id_berita)
  {
    $this->db->select('*');
    $this->db->from('berita');
    $this->db->where('id_berita', $id_berita);
    $this->db->order_by('id_berita', 'desc');
    $query = $this->db->get();
    return $query->row();
  }

  //tambah
  public function tambah($data)
  {
    $this->db->insert('berita', $data);
  }

  //edit
  public function edit($data)
  {
    $this->db->where('id_berita', $data['id_berita']);
    $this->db->update('berita', $data);
  }

  //delete
  public function delete($data)
  {
    $this->db->where('id_berita', $data['id_berita']);
    $this->db->delete('berita', $data);
  }
}
