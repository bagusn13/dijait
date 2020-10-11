<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konfigurasi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //listing
    public function listing()
    {
        $query = $this->db->get('konfigurasi');
        return $query->row();
    }

    //edit
    public function edit($data)
    {
        $this->db->where('id_konfigurasi', $data['id_konfigurasi']);
        $this->db->update('konfigurasi', $data);
    }

    //load menu kategori layanan
    public function nav_layanan()
    {
        $this->db->select(
            'layanan.*,
            kategori.nama_kategori,
            kategori.slug_kategori'
        );
        $this->db->from('layanan');
        // JOIN 
        $this->db->join('kategori', 'kategori.id_kategori = layanan.id_kategori', 'left');
        // END JOIN
        $this->db->group_by('layanan.id_kategori');
        $this->db->order_by('kategori.urutan', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
}
