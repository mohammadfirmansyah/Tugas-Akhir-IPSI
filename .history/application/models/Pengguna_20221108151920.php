<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Model
{
  protected $table1 = 'Guru';
  protected $table2 = 'Siswa';
  protected $table3 = 'Users';

  public function __construct()
  {
    parent::__construct();
  }

  //Menambahkan data pengguna Guru baru
  public function addUserGuru($email, $password, $nama, $nip, $sekolah)
  {
    $data = array(
      'email' => $email,
      'password' => $password,
      'nama' => $nama,
      'nip' => $nip,
      'sekolah' => $sekolah
    );
    $this->db->insert($this->table1, $data);
  }

  //Menambahkan data pengguna Siswa baru
  public function addUserSiswa($email, $password, $nama, $nisn, $sekolah)
  {
    $data = array(
      'email' => $email,
      'password' => $password,
      'nama' => $nama,
      'nisn' => $nisn,
      'sekolah' => $sekolah
    );
    $this->db->insert($this->table2, $data);
  }

  //Menambahkan data pengguna baru
  public function addUsers($email, $password, $nama, $hakAkses)
  {
    $data = array(
      'email' => $email,
      'password' => $password,
      'nama' => $nama,
      'hakAkses' => $hakAkses
    );
    $this->db->insert($this->table3, $data);
  }

  //Mencari data pengguna
  public function searchUser($email, $password)
  {
    $query = $this->db->get_where($this->table3, array('email' => $email));
    if ($query->num_rows() > 0) {
      $data = $query->row();
      if ($password == $data->password) {
        $this->session->set_userdata('email', $email);
        $this->session->set_userdata('nama', $data->nama);
        $this->session->set_userdata('hakAkses', $data->hakAkses);
        $this->session->set_userdata('is_login', TRUE);
        return TRUE;
      } else {
        return FALSE;
      }
    } else {
      return FALSE;
    }
  }

  public function searchEmail($email)
  {
    $query = $this->db->get_where($this->table3, array('email' => $email));
    if ($query->num_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function searchNip($nip)
  {
    $query = $this->db->get_where($this->table1, array('nip' => $nip));
    if ($query->num_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function searchNip($nip)
  {
    $query = $this->db->get_where($this->table1, array('nip' => $nip));
    if ($query->num_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  //Mengecek apakah pengguna sudah login
  public function checkLogin()
  {
    if (empty($this->session->userdata('is_login'))) {
      redirect('');
    }
  }

  public function checkLoginTrue()
  {
    if ($this->session->userdata('is_login') == true) {
      redirect('Dashboard');
    }
  }

  //Mendapatkan id pengguna 
  public function getIdByEmailSiswa($email)
  {
    $sql = "SELECT idSiswa FROM $this->table2 WHERE email = '$email'";
    $query = $this->db->query($sql);
    $result = $query->result();
    //Mengubah hasil array menjadi string
    foreach ($result as $row) :
      $idSiswa = $row->idSiswa;
    endforeach;
    return $idSiswa;
  }

  public function getIdByEmailGuru($email)
  {
    $sql = "SELECT idGuru FROM $this->table1 WHERE email = '$email'";
    $query = $this->db->query($sql);
    $result = $query->result();
    //Mengubah hasil array menjadi string
    foreach ($result as $row) :
      $idGuru = $row->idGuru;
    endforeach;
    return $idGuru;
  }

  public function getNamaSiswa($idSiswa)
  {
    $sql = "SELECT nama FROM $this->table2 WHERE idSiswa = $idSiswa";
    $query = $this->db->query($sql);
    $result = $query->result();
    //Mengubah hasil array menjadi string
    foreach ($result as $row) :
      $nama = $row->nama;
    endforeach;
    return $nama;
  }

  public function getProfilSiswa($idSiswa)
  {
    $sql = "SELECT * FROM $this->table2 WHERE idSiswa = $idSiswa";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }

  public function getNamaGuru($idGuru)
  {
    $sql = "SELECT nama FROM $this->table1 WHERE idGuru = $idGuru";
    $query = $this->db->query($sql);
    $result = $query->result();
    //Mengubah hasil array menjadi string
    foreach ($result as $row) :
      $nama = $row->nama;
    endforeach;
    return $nama;
  }

  public function getProfilGuru($idGuru)
  {
    $sql = "SELECT * FROM $this->table1 WHERE idGuru = $idGuru";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
  }
}
