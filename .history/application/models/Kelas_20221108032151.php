<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Model
{
  protected $table1 = 'SiswaKelas';
  protected $table2 = 'PemilikKelas';
  protected $table3 = 'Kelas';

  public function __construct()
  {
    parent::__construct();
  }

  public function getAllGuruSiswa($idKelas)
  {
    $sql = "SELECT idGuru, namaGuru FROM $this->table3 WHERE idKelas = $idKelas";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  public function getAllKelasSiswa($idSiswa)
  {
    $sql = "SELECT * FROM $this->table1 WHERE idSiswa = $idSiswa";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  public function getAllKelasGuru($idGuru)
  {
    $sql = "SELECT * FROM $this->table2 WHERE idGuru = $idGuru";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  public function getAllIdKelasSiswa($idSiswa)
  {
    $sql = "SELECT idKelas FROM $this->table1 WHERE idSiswa = $idSiswa";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  public function getAllIdKelasGuru($idGuru)
  {
    $sql = "SELECT idKelas FROM $this->table2 WHERE idGuru = $idGuru";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  public function getMataPelajaran($idKelas)
  {
    // $this->db->select('mataPelajaran');
    // return $this->db->where($this->table3, array('idKelas' => $idKelas));
    $sql = "SELECT mataPelajaran FROM $this->table3 WHERE idKelas = $idKelas";
    $query = $this->db->query($sql);
    $result = $query->result();
    //Mengubah hasil array menjadi string
    foreach ($result as $row) :
      $mataPelajaran = $row->mataPelajaran;
    endforeach;
    return $mataPelajaran;
  }

  public function getDetailKelas($idKelas)
  {
    // return $this->db->where($this->table3, array('idKelas' => $idKelas));
    $sql = "SELECT * FROM $this->table3 WHERE idKelas = $idKelas";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  public function getDetailKelasRow($idKelas)
  {
    // return $this->db->where($this->table3, array('idKelas' => $idKelas));
    $sql = "SELECT * FROM $this->table3 WHERE idKelas = $idKelas";
    $query = $this->db->query($sql);
    $result = $query->row();
    return $result;
  }

  public function getAnggotaKelas($idKelas)
  {
    // $this->db->select('namaSiswa');
    // return $this->db->where($this->table1, array('idKelas' => $idKelas));
    $sql = "SELECT idSiswa, namaSiswa FROM $this->table1 WHERE idKelas = $idKelas";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  public function deleteAnggotaKelas($idKelas, $idSiswa)
  {
    return $this->db->delete(
      $this->table1,
      array(
        "idKelas" => $idKelas,
        "idSiswa" => $idSiswa
      )
    );
  }

  public function updateDetailKelas($idKelas, $mataPelajaran, $deskripsiKelas)
  {
    $data = array(
      "mataPelajaran" => $mataPelajaran,
      "deskripsiKelas" => $deskripsiKelas
    );
    return $this->db->update(
      $this->table3,
      $data,
      array(
        'idKelas' => $idKelas
      )
    );
  }

  public function addKelas($idGuru, $namaGuru, $mataPelajaran, $deskripsiKelas, $kodeKelas)
  {
    $data = array(
      "idGuru" => $idGuru,
      "namaGuru" => $namaGuru,
      "mataPelajaran" => $mataPelajaran,
      "deskripsiKelas" => $deskripsiKelas,
      "kodeKelas" => $kodeKelas
    );
    return $this->db->insert(
      $this->table3,
      $data
    );
  }

  public function addPemilikKelas($idKelas, $idGuru, $namaGuru, $mataPelajaran)
  {
    $data = array(
      "idKelas" => $idKelas,
      "idGuru" => $idGuru,
      "namaGuru" => $namaGuru,
      "mataPelajaran" => $mataPelajaran
    );
    return $this->db->insert(
      $this->table2,
      $data
    );
  }

  public function searchKelas($kodeKelas)
  {
    $query = $this->db->get_where($this->table3, array('kodeKelas' => $kodeKelas));
    if ($query->num_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function getIdKelasByKode($kodeKelas)
  {
    $sql = "SELECT idKelas FROM $this->table3 WHERE kodeKelas = '$kodeKelas'";
    $query = $this->db->query($sql);
    $result = $query->result();
    //Mengubah hasil array menjadi string
    foreach ($result as $row) :
      $idKelas = $row->idKelas;
    endforeach;
    return $idKelas;
  }

  public function joinKelas($idSiswa, $idKelas, $nama, $mataPelajaran)
  {
    $data = array(
      "idSiswa" => $idSiswa,
      "idKelas" => $idKelas,
      "namaSiswa" => $nama,
      "mataPelajaran" => $mataPelajaran
    );
    return $this->db->insert(
      $this->table1,
      $data
    );
  }

  function getKodeKelas($jumlahDigit)
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $jumlahDigit; $i++) {
      $index = rand(0, strlen($characters) - 1);
      $randomString .= $characters[$index];
    }

    return $randomString;
  }
}
