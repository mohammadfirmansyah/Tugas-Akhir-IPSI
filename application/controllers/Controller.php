<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->model('Pengguna');
    $this->Pengguna->checkLogin();
  }

  public function index()
  {
    $data["title"] = "DISMA Selamat Datang";
    $this->load->view('Homepage', $data);
  }

  public function registerGuru()
  {
    $data["title"] = "Register Guru";
    $this->load->view('RegisterGuru', $data);
  }

  public function registerGuru_process()
  {
    //Melakukan validasi data masukan pengguna
    $this->form_validation->set_rules('email', 'email', 'trim|required|min_length[1]|max_length[255]|is_unique[Guru.email]');
    $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('nama', 'nama', 'trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('nip', 'nip', 'trim|required|min_length[1]|max_length[`18`]|is_unique[Guru.nip]');
    $this->form_validation->set_rules('sekolah', 'sekolah', 'trim|required|min_length[1]|max_length[255]');
    if ($this->form_validation->run() == true) {
      //Mengambil data masukan pengguna
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $nama = $this->input->post('nama');
      $nip = $this->input->post('nip');
      $sekolah = $this->input->post('sekolah');
      //Menyimpan data masukan pengguna
      $this->Pengguna->addUserGuru($email, $password, $nama, $nip, $sekolah);
      $this->Pengguna->addUsers($email, $password, $nama);
      $this->session->set_flashdata('success_register', 'Proses Registrasi Berhasil');
      $this->session->set_userdata('email', $email);
      $this->session->set_userdata('nama', $nama);
      $this->session->set_userdata('is_login', TRUE);
      redirect('Dashboard');
    } else {
      //Data masukan pengguna belum lengkap
      $this->session->set_flashdata('error', validation_errors());
      redirect('registerGuru');
    }
    //Sumber : https://www.warungbelajar.com/membuat-fitur-register-login-dan-logout-di-codeigniter.html
    //Sumber : https://stackoverflow.com/questions/13692473/is-unique-for-codeigniter-form-validation
  }

  public function registerSiswa()
  {
    $data["title"] = "Register Siswa";
    $this->load->view('RegisterSiswa', $data);
  }

  public function registerSiswa_process()
  {
    //Melakukan validasi data masukan pengguna
    $this->form_validation->set_rules('email', 'email', 'trim|required|min_length[1]|max_length[255]|is_unique[Siswa.email]');
    $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('nama', 'nama', 'trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('nisn', 'nip', 'trim|required|min_length[1]|max_length[10]|is_unique[Siswa.nisn]');
    $this->form_validation->set_rules('sekolah', 'sekolah', 'trim|required|min_length[1]|max_length[255]');
    if ($this->form_validation->run() == true) {
      //Mengambil data masukan pengguna
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $nama = $this->input->post('nama');
      $nisn = $this->input->post('nip');
      $sekolah = $this->input->post('sekolah');
      //Menyimpan data masukan pengguna dan menampilkan pesan berhasil
      $this->Pengguna->addUserSiswa($email, $password, $nama, $nisn, $sekolah);
      $this->Pengguna->addUsers($email, $password, $nama);
      $this->session->set_flashdata('success_register', 'Proses Registrasi Berhasil');
      $this->session->set_userdata('email', $email);
      $this->session->set_userdata('nama', $nama);
      $this->session->set_userdata('is_login', TRUE);
      redirect('Dashboard');
    } else {
      //Data masukan pengguna belum lengkap
      $this->session->set_flashdata('error', validation_errors());
      redirect('registerSiswa');
    }
    //Sumber : https://www.warungbelajar.com/membuat-fitur-register-login-dan-logout-di-codeigniter.html
    //Sumber : https://stackoverflow.com/questions/13692473/is-unique-for-codeigniter-form-validation
  }

  public function Login()
  {
    $data["title"] = "Login DISMA";
    $this->load->view('Login', $data);
  }

  public function Login_process()
  {
    //Mengambil data masukan pengguna
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    //Mengecek data masukan pengguna
    if ($this->Pengguna->searchUser($email, $password)) {
      redirect('Dashboard');
    } else {
      $this->session->set_flashdata('error', 'Email & Password salah');
      redirect('Login');
    }
  }

  public function Logout_process()
  {
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('nama');
    $this->session->unset_userdata('is_login');
    redirect('Login');
  }

  public function Dashboard()
  {
    $data["title"] = "Selamat Datang di DISMA";
    $email = $this->session->userdata('email');
    $idSiswa = $this->Pengguna->getIdByEmailSiswa($email);
    $idGuru = $this->Pengguna->getIdByEmailGuru($email);
    if (!empty($idSiswa)) {
      $data['List_Pertanyaan'] = $this->Pertanyaan->getAllPertanyaanSiswa($idSiswa);
    } else {
      $data['List_Pertanyaan'] = $this->Pertanyaan->getAllPertanyaanGuru($idGuru);
    }
    $this->load->view('Dashboard', $data);
  }

  public function addPertanyaan()
  {
    $data["title"] = "Tambah Pertanyaan";
    $email = $this->session->userdata('email');
    $idSiswa = $this->Pengguna->getIdByEmailSiswa($email);
    $idKelas = $this->Kelas->getidKelasSiswa($idSiswa);
    $data['List_Guru'] = $this->Kelas->getAllGuruSiswa($idKelas);
    $this->load->view('addPertanyaan', $data);
  }

  public function addPertanyaan_process()
  {
    //Melakukan validasi data masukan pengguna
    $this->form_validation->set_rules('judulMateri', 'judulMateri', 'trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('deskripsiPertanyaan', 'deskripsiPertanyaan', 'trim|required|min_length[1]|max_length[255]');
    if ($this->form_validation->run() == true) {
      //Mengambil data masukan pengguna
      $judulMateri = $this->input->post('judulMateri');
      $deskripsiPertanyaan = $this->input->post('deskripsiPertanyaan');
      $email = $this->session->userdata('email');
      $idSiswa = $this->Pengguna->getIdByEmailSiswa($email);
      $idGuru = $this->input->post('idGuru');
      $waktuKirim = $this->input->post('waktuKirim');
      //Menyimpan data masukan pengguna dan menampilkan pesan berhasil
      $this->Pertanyaan->addPertanyaan($idGuru, $idSiswa, $deskripsiPertanyaan, $judulMateri, $waktuKirim);
      $this->session->set_flashdata('success_register', 'Pertanyaan Berhasil Dikirimkan');
      redirect('Dashboard');
    } else {
      //Data masukan pengguna belum lengkap
      $this->session->set_flashdata('error', validation_errors());
      redirect('addPertanyaan');
    }
  }

  public function detailPertanyaan($idPertanyaan)
  {
    $data["title"] = $this->Pertanyaan->getJudulMateriById($idPertanyaan);
    $data['Data_Pertanyaan'] = $this->Pertanyaan->getPertanyaan($idPertanyaan);
    $email = $this->session->userdata('email');
    $idSiswa = $this->Pengguna->getIdByEmailSiswa($email);
    if (!empty($idSiswa)) {
      $this->load->view('detailPertanyaanSiswa', $data);
    } else {
      $this->load->view('detailPertanyaanGuru', $data);
    }
  }

  public function sendJawaban_process()
  {
    //Melakukan validasi data masukan pengguna
    $this->form_validation->set_rules('deskripsiJawaban', 'deskripsiJawaban', 'trim|required|min_length[1]|max_length[255]');
    if ($this->form_validation->run() == true) {
      //Mengambil data masukan pengguna
      $idPertanyaan = $this->input->post('idPertanyaan');
      $email = $this->session->userdata('email');
      $idGuru = $this->Pengguna->getIdByEmailGuru($email);
      $deskripsiPertanyaan = $this->input->post('deskripsiPertanyaan');
      $waktuKirim = $this->input->post('waktuKirim');
      //Menyimpan data masukan pengguna dan menampilkan pesan berhasil
      $this->Pertanyaan->saveJawaban($idPertanyaan, $idGuru, $deskripsiPertanyaan, $waktuKirim);
      $this->session->set_flashdata('success_register', 'Jawaban Berhasil Dikirimkan');
      redirect('detailPertanyaan');
    } else {
      //Data masukan pengguna belum lengkap
      $this->session->set_flashdata('error', validation_errors());
      redirect('detailPertanyaan');
    }
  }

  public function sendKomentar_process()
  {
    //Melakukan validasi data masukan pengguna
    $this->form_validation->set_rules('deskripsiKomentar', 'deskripsiKomentar', 'trim|required|min_length[1]|max_length[255]');
    if ($this->form_validation->run() == true) {
      //Mengambil data masukan pengguna
      $idJawaban = $this->input->post('idJawaban');
      $email = $this->session->userdata('email');
      $idSiswa = $this->Pengguna->getIdByEmailSiswa($email);
      $idGuru = $this->Pengguna->getIdByEmailGuru($email);
      $deskripsiKomentar = $this->input->post('deskripsiKomentar');
      $waktuKirim = $this->input->post('waktuKirim');
      //Menyimpan data masukan pengguna dan menampilkan pesan berhasil
      if (!empty($idSiswa)) {
        $this->Pertanyaan->saveKomentarSiswa($idJawaban, $idSiswa, $deskripsiKomentar, $waktuKirim);
        $this->session->set_flashdata('success_register', 'Komentar Berhasil Dikirimkan');
        redirect('detailPertanyaan');
      } else {
        $this->Pertanyaan->saveKomentarGuru($idJawaban, $idGuru, $deskripsiKomentar, $waktuKirim);
        $this->session->set_flashdata('success_register', 'Komentar Berhasil Dikirimkan');
        redirect('detailPertanyaan');
      }
    } else {
      //Data masukan pengguna belum lengkap
      $this->session->set_flashdata('error', validation_errors());
      redirect('detailPertanyaan');
    }
  }

  public function kelasSaya()
  {
    $data["title"] = "Kelas Saya";
    $email = $this->session->userdata('email');
    $idSiswa = $this->Pengguna->getIdByEmailSiswa($email);
    $idGuru = $this->Pengguna->getIdByEmailGuru($email);
    if (!empty($idSiswa)) {
      $data['List_Kelas'] = $this->Kelas->getAllKelasSiswa($idSiswa);
    } else {
      $data['List_Kelas'] = $this->Kelas->getAllKelasGuru($idGuru);
    }

    $this->load->view('kelasSaya', $data);
  }

  public function detailKelas($idKelas)
  {
    $data["title"] = $this->Kelas->getMataPelajaran($idKelas);
    $data['Data_Kelas'] = $this->Kelas->getDetailKelas($idKelas);
    $data['Anggota_Kelas'] = $this->Kelas->getAnggotaKelas($idKelas);
  }

  public function hapusAnggotaKelas_process($idSiswa)
  {
    $this->Kelas->deleteAnggotaKelas($idSiswa);
    redirect("detailKelas");
  }

  public function editDetailKelas($idKelas)
  {
    $data["title"] = 'Edit' . $this->Kelas->getMataPelajaran($idKelas);
    $data['Data_Kelas'] = $this->Kelas->getDetailKelas($idKelas);
  }

  public function saveDetailKelas_process($idKelas)
  {
    //Melakukan validasi data masukan pengguna
    $this->form_validation->set_rules('mataPelajaran', 'mataPelajaran', 'trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('deskripsiKelas', 'deskripsiKelas', 'trim|required|min_length[1]|max_length[255]');
    if ($this->form_validation->run() == true) {
      //Mengambil data masukan pengguna
      $idKelas = $this->input->post('idKelas');
      $mataPelajaran = $this->input->post('mataPelajaran');
      $deskripsiPertanyaan = $this->input->post('deskripsiPertanyaan');
      //Menyimpan data masukan pengguna dan menampilkan pesan berhasil
      $this->Kelas->updateDetailKelas($idKelas, $mataPelajaran, $deskripsiPertanyaan);
      $this->session->set_flashdata('success_register', 'Profil Kelas Berhasil Diubah');
      redirect('detailPertanyaan');
    } else {
      //Data masukan pengguna belum lengkap
      $this->session->set_flashdata('error', validation_errors());
      redirect('editDetailKelas');
    }
  }

  public function addKelas()
  {
    $data["title"] = "Buat Kelas Baru";
    $this->load->view('addKelas', $data);
  }

  public function addKelas_process()
  {
    //Melakukan validasi data masukan pengguna
    $this->form_validation->set_rules('mataPelajaran', 'mataPelajaran', 'trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('deskripsiKelas', 'deskripsiKelas', 'trim|required|min_length[1]|max_length[255]');
    if ($this->form_validation->run() == true) {
      //Mengambil data masukan pengguna
      $email = $this->session->userdata('email');
      $idGuru = $this->Pengguna->getIdByEmailGuru($email);
      $mataPelajaran = $this->input->post('mataPelajaran');
      $deskripsiPertanyaan = $this->input->post('deskripsiPertanyaan');
      $kodeKelas = random_bytes(10);
      //Menyimpan data masukan pengguna dan menampilkan pesan berhasil
      $this->Kelas->addKelas($idGuru, $mataPelajaran, $deskripsiPertanyaan, $kodeKelas);
      $this->session->set_flashdata('success_register', 'Kelas Berhasil Dibuat');
      redirect('Dashboard');
    } else {
      //Data masukan pengguna belum lengkap
      $this->session->set_flashdata('error', validation_errors());
      redirect('kelasSaya');
    }
  }

  public function joinKelas()
  {
    $data["title"] = "Gabung Kelas Baru";
    $this->load->view('joinKelas', $data);
  }

  public function joinKelas_process()
  {
    //Melakukan validasi data masukan pengguna
    $this->form_validation->set_rules('kodeKelas', 'mataPelajaran', 'trim|required|min_length[1]|max_length[10]');
    if ($this->form_validation->run() == true) {
      //Mengambil data masukan pengguna
      $email = $this->session->userdata('email');
      $idSiswa = $this->Pengguna->getIdByEmailSiswa($email);
      $kodeKelas = $this->input->post('kodeKelas');
      //Mengecek kode kelas
      if ($this->Kelas->searchKelas($kodeKelas)) {
        //Menyimpan data masukan pengguna dan menampilkan pesan berhasil
        $idKelas = $this->Kelas->getIdKelasByKode($kodeKelas);
        $nama = $this->session->userdata('nama');
        $mataPelajaran = $this->Kelas->getMataPelajaranById($idKelas);
        $this->Kelas->joinKelas($idSiswa, $idKelas, $nama, $mataPelajaran);
        $this->session->set_flashdata('success_register', 'Kelas Berhasil Dibuat');
        redirect('kelasSaya');
      } else {
        $this->session->set_flashdata('error', 'Kode Kelas Tidak Ditemukan');
        redirect('joinKelas');
      }
    } else {
      //Data masukan pengguna belum lengkap
      $this->session->set_flashdata('error', validation_errors());
      redirect('joinKelas');
    }
  }

  public function profilSiswa($idSiswa)
  {
    $data["title"] = $this->Pengguna->getNamaSiswa($idSiswa);
    $data['Data_Siswa'] = $this->Pengguna->getProfilSiswa($idSiswa);
    $this->load->view('profilSiswa', $data);
  }

  public function profilGuru($idGuru)
  {
    $data["title"] = $this->Pengguna->getNamaGuru($idGuru);
    $data['Data_Guru'] = $this->Pengguna->getProfilGuru($idGuru);
    $this->load->view('profilGuru', $data);
  }
}
