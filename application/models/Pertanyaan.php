<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pertanyaan extends CI_Model
{
  protected $table1 = 'Pertanyaan';
  protected $table2 = 'Jawaban';
  protected $table3 = 'Komentar';

  public function __construct()
	{
        parent::__construct();
	}

  //Menampilkan pertanyaan berdasarkan pemilik email
  public function getAllPertanyaanSiswa($idSiswa)
  {
    return $this->db->get_where(
      $this->table1,
      ["idSiswa" => $idSiswa]
    )->row();
  }

  public function getAllPertanyaanGuru($idGuru)
  {
    return $this->db->get_where(
      $this->table1,
      ["idGuru" => $idGuru]
    )->row();
  }

  public function addPertanyaan($idGuru)
  {
    return $this->db->get_where(
      $this->table1,
      ["idGuru" => $idGuru]
    )->row();
  }

  public function getJudulMateriById($idPertanyaan) {
    $this->db->select('judulMateri');
    return $this->db->where($this->table, array('idPertanyaan' => $idPertanyaan));
  }
  
  public function getPertanyaan($idPertanyaan) {
    return $this->db->where($this->table, array('idPertanyaan' => $idPertanyaan));
  }

  public function saveJawaban()
  {
    $data = array(
      "deskripsiJawaban" => $this->input->post('judul'),
      "deskripsi" => $this->input->post('deskripsi'),
      "tanggal" => $this->input->post('tanggal'),
      "gambarBerita" => $this->input->post('gambarBerita')
    );
    return $this->db->insert(
      $this->table,
      $data
    );
  }
}
