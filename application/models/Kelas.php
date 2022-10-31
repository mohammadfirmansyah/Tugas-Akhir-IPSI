<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pertanyaan extends CI_Model
{
  protected $table1 = 'SiswaKelas';
  protected $table2 = 'GuruKelas';
  protected $table3 = 'Kelas';

  public function __construct()
	{
        parent::__construct();
	}

  public function getidKelasSiswa($idSiswa) {
    $this->db->select('idKelas');
    return $this->db->where($this->table1, array('idSiswa' => $idSiswa))->row();
  }
  
  public function getAllGuruSiswa($idKelas) {
    $this->db->select('idGuru', 'namaGuru');
    return $this->db->where($this->table3, array('idKelas' => $idKelas))->row();
  }
}
