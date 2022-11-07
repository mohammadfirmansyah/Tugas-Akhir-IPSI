<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pertanyaan extends CI_Model
{
  protected $table1 = 'Pertanyaan';
  protected $table2 = 'Jawaban';
  protected $table3 = 'Komentar';
  protected $table4 = 'KomentarSiswa';
  protected $table5 = 'KomentarGuru';

  public function __construct()
  {
    parent::__construct();
  }

  //Menampilkan pertanyaan berdasarkan pemilik email
  public function getAllPertanyaanSiswa($idSiswa)
  {
    $sql = "SELECT * FROM $this->table1 WHERE idSiswa = $idSiswa";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  public function getAllPertanyaanGuru($idGuru)
  {
    $sql = "SELECT * FROM $this->table1 WHERE idGuru = $idGuru";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  public function addPertanyaan($idGuru, $idSiswa, $deskripsiPertanyaan, $judulMateri, $waktuKirim)
  {
    $data = array(
      "idGuru" => $idGuru,
      "idSiswa" => $idSiswa,
      "deskripsiPertanyaan" => $deskripsiPertanyaan,
      "judulMateri" => $judulMateri,
      "waktuKirim" => $waktuKirim
    );
    return $this->db->insert(
      $this->table1,
      $data
    );
  }

  public function getJudulMateriById($idPertanyaan)
  {
    $sql = "SELECT judulMateri FROM $this->table1 WHERE idPertanyaan = $idPertanyaan";
    $query = $this->db->query($sql);
    $result = $query->result();
    //Mengubah hasil array menjadi string
    foreach ($result as $row) : 
      $judulMateri = $row->judulMateri;
      endforeach;
      return $judulMateri;
  }

  public function getPertanyaan($idPertanyaan)
  {
    $sql = "SELECT * FROM $this->table1 WHERE idPertanyaan = $idPertanyaan";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  public function getJawaban($idPertanyaan)
  {
    $sql = "SELECT * FROM $this->table2 WHERE idPertanyaan = $idPertanyaan";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  public function getKomentar($idPertanyaan)
  {
    return $this->db->where($this->table3, array('idPertanyaan' => $idPertanyaan));
  }

  public function saveJawaban($idPertanyaan, $idGuru, $deskripsiPertanyaan, $waktuKirim)
  {
    $data = array(
      "idPertanyaan" => $idPertanyaan,
      "idGuru" => $idGuru,
      "deskripsiPertanyaan" => $deskripsiPertanyaan,
      "waktuKirim" => $waktuKirim
    );
    return $this->db->insert(
      $this->table2,
      $data
    );
  }

  public function saveKomentarSiswa($idJawaban, $idSiswa, $deskripsiKomentar, $waktuKirim)
  {
    $data = array(
      "idJawaban" => $idJawaban,
      "idSiswa" => $idSiswa,
      "deskripsiKomentar" => $deskripsiKomentar,
      "waktuKirim" => $waktuKirim
    );
    return $this->db->insert(
      $this->table4,
      $data
    );
  }

  public function saveKomentarGuru($idJawaban, $idGuru, $deskripsiKomentar, $waktuKirim)
  {
    $data = array(
      "idJawaban" => $idJawaban,
      "idGuru" => $idGuru,
      "deskripsiKomentar" => $deskripsiKomentar,
      "waktuKirim" => $waktuKirim
    );
    return $this->db->insert(
      $this->table5,
      $data
    );
  }
}
