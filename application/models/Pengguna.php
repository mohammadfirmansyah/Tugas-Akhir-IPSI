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
      'password' => password_hash($password, PASSWORD_DEFAULT),
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
      'password' => password_hash($password, PASSWORD_DEFAULT),
      'nama' => $nama,
      'nisn' => $nisn,
      'sekolah' => $sekolah
    );
    $this->db->insert($this->table1, $data);
  }

  //Menambahkan data pengguna baru
  public function addUsers($email, $password, $nama)
  {
    $data = array(
      'email' => $email,
      'password' => password_hash($password, PASSWORD_DEFAULT),
      'nama' => $nama
    );
    $this->db->insert($this->table3, $data);
  }

  //Mencari data pengguna
  public function searchUser($email, $password)
  {
    $query = $this->db->get_where($this->table3, array('email' => $email));
    if ($query->num_rows() > 0) {
      $data = $query->row();
      if (password_verify($password, $data->password)) {
        $this->session->set_userdata('email', $email);
        $this->session->set_userdata('nama', $data->nama);
        $this->session->set_userdata('is_login', TRUE);
        return TRUE;
      } else {
        return FALSE;
      }
    } else {
      return FALSE;
    }
  }

  //Mengecek apakah pengguna sudah login
  public function checkLogin()
  {
    if (empty($this->session->userdata('is_login'))) {
      redirect('Login');
    }
  }

  //Mendapatkan id pengguna 
  public function getIdByEmailSiswa($email)
  {
    $this->db->select('idSiswa');
    return $this->db->where($this->table2, array('email' => $email));
  }

  public function getIdByEmailGuru($email)
  {
    $this->db->select('idGuru');
    return $this->db->where($this->table1, array('email' => $email));
  }

  public function getNamaSiswa($idSiswa)
  {
    $this->db->select('nama');
    return $this->db->where($this->table2, array('idSiswa' => $idSiswa));
  }

  public function getProfilSiswa($idSiswa)
  {
    return $this->db->where($this->table2, array('idSiswa' => $idSiswa));
  }

  public function getNamaGuru($idGuru)
  {
    $this->db->select('nama');
    return $this->db->where($this->table2, array('idGuru' => $idGuru));
  }

  public function getProfilGuru($idGuru)
  {
    return $this->db->where($this->table2, array('idGuru' => $idGuru));
  }
}
