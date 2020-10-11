<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testi_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  // Listing all testi
  public function listing()
  {
    $this->db->select('testi.*,
                    users.nama');
    $this->db->from('testi');
    //join
    $this->db->join('users', 'users.id_user = testi.id_user', 'left');
    //end join
    $this->db->order_by('id_testi', 'desc');
    $query = $this->db->get();
    return $query->result();
  }

  // Listing all testi di home
  public function home()
  {
    $this->db->select('testi.*,
                    users.nama');
    $this->db->from('testi');
    //join
    $this->db->join('users', 'users.id_user = testi.id_user', 'left');
    //end join
    $this->db->where('testi.status_testi', 'Publish');
    $this->db->order_by('id_testi', 'desc');
    $this->db->limit(10);
    $query = $this->db->get();
    return $query->result();
  }

  // detail testi
  public function detail($id_testi)
  {
    $this->db->select('*');
    $this->db->from('testi');
    $this->db->where('id_testi', $id_testi);
    $this->db->order_by('id_testi', 'desc');
    $query = $this->db->get();
    return $query->row();
  }

  //tambah
  public function tambah($data)
  {
    $this->db->insert('testi', $data);
  }

  //edit
  public function edit($data)
  {
    $this->db->where('id_testi', $data['id_testi']);
    $this->db->update('testi', $data);
  }

  //delete
  public function delete($data)
  {
    $this->db->where('id_testi', $data['id_testi']);
    $this->db->delete('testi', $data);
  }
}
