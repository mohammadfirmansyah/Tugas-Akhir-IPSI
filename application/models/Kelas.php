<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pertanyaan extends CI_Model
{
  protected $table1 = 'SiswaKelas';
  protected $table2 = 'PemilikKelas';
  protected $table3 = 'Kelas';

  public function __construct()
  {
    parent::__construct();
  }

  public function getidKelasSiswa($idSiswa)
  {
    $this->db->select('idKelas');
    return $this->db->where($this->table1, array('idSiswa' => $idSiswa))->row();
  }

  public function getAllGuruSiswa($idKelas)
  {
    $this->db->select('idGuru', 'namaGuru');
    return $this->db->where($this->table3, array('idKelas' => $idKelas))->row();
  }

  public function getAllKelasSiswa($idSiswa)
  {
    return $this->db->get_where(
      $this->table1,
      ["idSiswa" => $idSiswa]
    )->row();
  }

  public function getAllKelasGuru($idGuru)
  {
    return $this->db->get_where(
      $this->table2,
      ["idGuru" => $idGuru]
    )->row();
  }

  public function getMataPelajaran($idKelas)
  {
    $this->db->select('mataPelajaran');
    return $this->db->where($this->table3, array('idKelas' => $idKelas));
  }

  public function getDetailKelas($idKelas)
  {
    return $this->db->where($this->table3, array('idKelas' => $idKelas));
  }

  public function getAnggotaKelas($idKelas)
  {
    $this->db->select('namaSiswa');
    return $this->db->where($this->table1, array('idKelas' => $idKelas));
  }

  public function deleteAnggotaKelas($idSiswa)
  {
    return $this->db->delete(
      $this->table1,
      array("idSiswa" => $idSiswa)
    );
  }

  public function updateDetailKelas($idKelas, $mataPelajaran, $deskripsiPertanyaan)
  {
    $data = array(
      "mataPelajaran" => $mataPelajaran,
      "deskripsiPertanyaan" => $deskripsiPertanyaan
    );
    return $this->db->update(
      $this->table3,
      $data,
      array(
        'idKelas' => $idKelas
      )
    );
  }

  public function addKelas($idGuru, $mataPelajaran, $deskripsiPertanyaan, $kodeKelas)
  {
    $data = array(
      "idGuru" => $idGuru,
      "mataPelajaran" => $mataPelajaran,
      "deskripsiPertanyaan" => $deskripsiPertanyaan,
      "kodeKelas" => $kodeKelas
    );
    return $this->db->insert(
      $this->table3,
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
    $this->db->select('idKelas');
    return $this->db->where($this->table3, array('kodeKelas' => $kodeKelas));
  }

  public function getMataPelajaranById($idKelas)
  {
    $this->db->select('mataPelajaran');
    return $this->db->where($this->table3, array('idKelas' => $idKelas));
  }

  public function joinKelas($idSiswa, $idKelas, $nama, $mataPelajaran)
  {
    $data = array(
      "idSiswa" => $idSiswa,
      "idKelas" => $idKelas,
      "nama" => $nama,
      "mataPelajaran" => $mataPelajaran
    );
    return $this->db->insert(
      $this->table1,
      $data
    );
  }
}
