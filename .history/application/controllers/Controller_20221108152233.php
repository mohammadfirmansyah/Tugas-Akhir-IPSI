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
    $this->load->model('Pertanyaan');
    $this->load->model('Kelas');
  }

  public function index()
  {
    $this->Pengguna->checkLoginTrue();
    $data["title"] = "DISMA Selamat Datang";
    $this->load->view('Homepage', $data);
  }

  public function registerGuru()
  {
    $this->Pengguna->checkLoginTrue();
    $data["title"] = "Register Guru";
    $this->load->view('RegisterGuru', $data);
  }

  public function registerGuru_process()
  {
    $this->Pengguna->checkLoginTrue();
    //Melakukan validasi data masukan pengguna
    $this->form_validation->set_rules('email', 'email', 'trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('nama', 'nama', 'trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('nip', 'nip', 'trim|required|min_length[18]|max_length[18]');
    $this->form_validation->set_rules('sekolah', 'sekolah', 'trim|required|min_length[1]|max_length[255]');
    if ($this->form_validation->run() == true) {
      //Mengambil data masukan pengguna
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $nama = $this->input->post('nama');
      $nip = $this->input->post('nip');
      $sekolah = $this->input->post('sekolah');
      $hakAkses = 'guru';
      //Mengecek email apakah sudah terdaftar
      if ($this->Pengguna->searchEmail($email) == true) {
        //Pesan ketika email sudah terdaftar
        $this->session->set_flashdata('error', '
      <div class="alert alert-danger" role="alert" style="text-align: center;">
      <h4 class="alert-heading">Error!</h4>
      <p>Email kamu sudah terdaftar.</p>
    </div>');
        redirect('registerGuru');
      } else if ($this->Pengguna->searchNip($nip) == true) {
        //Pesan ketika email sudah terdaftar
        $this->session->set_flashdata('error', '
      <div class="alert alert-danger" role="alert" style="text-align: center;">
      <h4 class="alert-heading">Error!</h4>
      <p>NIP kamu sudah terdaftar.</p>
    </div>');
        redirect('registerGuru');
      } else {
        //Menyimpan data masukan pengguna
        $this->Pengguna->addUserGuru($email, $password, $nama, $nip, $sekolah);
        $this->Pengguna->addUsers($email, $password, $nama, $hakAkses);
        $this->session->set_flashdata('success_register', 'Proses Registrasi Berhasil');
        $this->session->set_userdata('email', $email);
        $this->session->set_userdata('nama', $nama);
        $this->session->set_userdata('hakAkses', $hakAkses);
        $this->session->set_userdata('is_login', TRUE);
        redirect('Dashboard');
      }
    } else {
      //Data masukan pengguna belum lengkap
      $this->session->set_flashdata('error', '
      <div class="alert alert-danger" role="alert" style="text-align: center;">
      <h4 class="alert-heading">Error!</h4>
      <p>Pastikan data yang harus kamu masukkan sudah lengkap.</p>
    </div>');
      redirect('registerGuru');
    }
    //Sumber : https://www.warungbelajar.com/membuat-fitur-register-login-dan-logout-di-codeigniter.html
    //Sumber : https://stackoverflow.com/questions/13692473/is-unique-for-codeigniter-form-validation
  }

  public function registerSiswa()
  {
    $this->Pengguna->checkLoginTrue();
    $data["title"] = "Register Siswa";
    $this->load->view('RegisterSiswa', $data);
  }

  public function registerSiswa_process()
  {
    $this->Pengguna->checkLoginTrue();
    //Melakukan validasi data masukan pengguna
    $this->form_validation->set_rules('email', 'email', 'trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('nama', 'nama', 'trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('nisn', 'nip', 'trim|required|min_length[10]|max_length[10]');
    $this->form_validation->set_rules('sekolah', 'sekolah', 'trim|required|min_length[1]|max_length[255]');
    if ($this->form_validation->run() == true) {
      //Mengambil data masukan pengguna
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $nama = $this->input->post('nama');
      $nisn = $this->input->post('nisn');
      $sekolah = $this->input->post('sekolah');
      $hakAkses = 'siswa';
      //Mengecek email apakah sudah terdaftar
      if ($this->Pengguna->searchEmail($email) == true) {
        //Pesan ketika email sudah terdaftar
        $this->session->set_flashdata('error', '
    <div class="alert alert-danger" role="alert" style="text-align: center;">
    <h4 class="alert-heading">Error!</h4>
    <p>Email kamu sudah terdaftar.</p>
  </div>');
        redirect('registerSiswa');
      } else if ($this->Pengguna->searchNisn($nisn) == true){
        //Pesan ketika email sudah terdaftar
        $this->session->set_flashdata('error', '
    <div class="alert alert-danger" role="alert" style="text-align: center;">
    <h4 class="alert-heading">Error!</h4>
    <p>Email kamu sudah terdaftar.</p>
  </div>');
        redirect('registerSiswa');
      } else {

      }
    } else {
      //Data masukan pengguna belum lengkap
      $this->session->set_flashdata('error', '
      <div class="alert alert-danger" role="alert" style="text-align: center;">
      <h4 class="alert-heading">Error!</h4>
      <p>Pastikan data yang harus kamu masukkan sudah lengkap.</p>
    </div>');
      redirect('registerSiswa');
    }
    //Sumber : https://www.warungbelajar.com/membuat-fitur-register-login-dan-logout-di-codeigniter.html
    //Sumber : https://stackoverflow.com/questions/13692473/is-unique-for-codeigniter-form-validation
  }

  public function Login()
  {
    $this->Pengguna->checkLoginTrue();
    $data["title"] = "Login DISMA";
    $this->load->view('Login', $data);
  }

  public function Login_process()
  {
    $this->Pengguna->checkLoginTrue();
    //Mengambil data masukan pengguna
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    //Mengecek data masukan pengguna
    if ($this->Pengguna->searchUser($email, $password) == true) {
      redirect('Dashboard');
    } else {
      //Apabila data pengguna tidak ditemukan
      $this->session->set_flashdata('error', '
      <div class="alert alert-danger" role="alert" style="text-align: center;">
      <h4 class="alert-heading">Error!</h4>
      <p>Pastikan data yang harus kamu masukkan sudah benar.</p>
    </div>');
      redirect('Login');
    }
  }

  public function Logout_process()
  {
    //Menghapus semua session
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('nama');
    $this->session->unset_userdata('hakAkses');
    $this->session->unset_userdata('is_login');
    redirect('index');
  }

  public function Dashboard()
  {
    $this->Pengguna->checkLogin();
    $data["title"] = "Selamat Datang di DISMA";
    $email = $this->session->userdata('email');
    //Ketika siswa yang melakukan login
    if ($this->session->userdata('hakAkses') == 'siswa') {
      $idSiswa = $this->Pengguna->getIdByEmailSiswa($email);
      $data['List_Pertanyaan'] = $this->Pertanyaan->getAllPertanyaanSiswa($idSiswa);
      $data['List_Kelas'] = $this->Kelas->getAllKelasSiswa($idSiswa);
      $data['idSiswa'] = $idSiswa;
      $this->load->view('DashboardSiswa', $data);
      //Ketika guru yang melakukan login
    } else {
      $idGuru = $this->Pengguna->getIdByEmailGuru($email);
      $data['List_Pertanyaan'] = $this->Pertanyaan->getAllPertanyaanGuru($idGuru);
      $data['List_Kelas'] = $this->Kelas->getAllKelasGuru($idGuru);
      $data['idGuru'] = $idGuru;
      $this->load->view('DashboardGuru', $data);
    }
  }

  public function addPertanyaan()
  {
    $this->Pengguna->checkLogin();
    $data["title"] = "Tambah Pertanyaan";
    $email = $this->session->userdata('email');
    $idSiswa = $this->Pengguna->getIdByEmailSiswa($email);
    //Apabila siswa sudah memiliki kelas
    if (!empty($this->Kelas->getAllIdKelasSiswa($idSiswa))) {
      $data['List_Kelas'] = $this->Kelas->getAllIdKelasSiswa($idSiswa);
      $this->load->view('addPertanyaan', $data);
      //Apabila siswa belum memiliki kelas
    } else {
      $this->session->set_flashdata('error', '
      <div class="alert alert-danger" role="alert" style="text-align: center;">
      <h4 class="alert-heading">Error!</h4>
      <p>Anda belum memiliki kelas!</p>
    </div>');
      redirect('joinKelas');
    }
  }

  public function addPertanyaan_process()
  {
    $this->Pengguna->checkLogin();
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
      $waktuKirim = date("Y-m-d");
      //Menyimpan data masukan pengguna dan menampilkan pesan berhasil
      $this->Pertanyaan->addPertanyaan($idGuru, $idSiswa, $deskripsiPertanyaan, $judulMateri, $waktuKirim);
      $this->session->set_flashdata('success_register', 'Pertanyaan Berhasil Dikirimkan');
      redirect('Dashboard');
    } else {
      //Data masukan pengguna belum lengkap
      $this->session->set_flashdata('error', '
      <div class="alert alert-danger" role="alert" style="text-align: center;">
      <h4 class="alert-heading">Error!</h4>
      <p>Pastikan data yang harus kamu masukkan sudah benar.</p>
    </div>');
    redirect('addPertanyaan');
    }
  }

  public function detailPertanyaan($idPertanyaan)
  {
    $this->Pengguna->checkLogin();
    //Mengambil data dari database
    $data["title"] = $this->Pertanyaan->getJudulMateriById($idPertanyaan);
    $data['Data_Pertanyaan'] = $this->Pertanyaan->getPertanyaan($idPertanyaan);
    $data['Data_Jawaban'] = $this->Pertanyaan->getJawaban($idPertanyaan);
    $data['Data_Komentar'] = $this->Pertanyaan->getKomentar($idPertanyaan);
    $data['idPertanyaan'] = $idPertanyaan;
    $email = $this->session->userdata('email');
    //Ketika siswa yang melakukan login
    if ($this->session->userdata('hakAkses') == 'siswa') {
      $data['idSiswa'] = $this->Pengguna->getIdByEmailSiswa($email);
      $this->load->view('detailPertanyaanSiswa', $data);
      //Ketika guru yang melakukan login
    } else {
      $this->load->view('detailPertanyaanGuru', $data);
    }
  }

  public function sendJawaban_process($idPertanyaan)
  {
    $this->Pengguna->checkLogin();
    //Melakukan validasi data masukan pengguna
    $this->form_validation->set_rules('deskripsiJawaban', 'deskripsiJawaban', 'trim|required|min_length[1]|max_length[255]');
    if ($this->form_validation->run() == true) {
      //Mengambil data masukan pengguna
      $email = $this->session->userdata('email');
      $idGuru = $this->Pengguna->getIdByEmailGuru($email);
      $namaGuru = $this->session->userdata('nama');
      $deskripsiJawaban = $this->input->post('deskripsiJawaban');
      $waktuKirim = date("Y-m-d");
      //Menyimpan data masukan pengguna dan menampilkan pesan berhasil
      $this->Pertanyaan->saveJawaban($idPertanyaan, $idGuru, $namaGuru, $deskripsiJawaban, $waktuKirim);
      $this->session->set_flashdata('success_register', 'Jawaban Berhasil Dikirimkan');
      redirect('pertanyaan/' . $idPertanyaan);
    } else {
      //Data masukan pengguna belum lengkap
      $this->session->set_flashdata('error', '
      <div class="alert alert-danger" role="alert" style="text-align: center;">
      <h4 class="alert-heading">Error!</h4>
      <p>Pastikan data yang harus kamu masukkan sudah benar.</p>
    </div>');
    redirect('pertanyaan/' . $idPertanyaan);
    }
  }

  public function sendKomentar_process($idPertanyaan)
  {
    $this->Pengguna->checkLogin();
    //Melakukan validasi data masukan pengguna
    $this->form_validation->set_rules('deskripsiKomentar', 'deskripsiKomentar', 'trim|required|min_length[1]|max_length[255]');
    if ($this->form_validation->run() == true) {
      //Mengambil data masukan pengguna
      $email = $this->session->userdata('email');
      $deskripsiKomentar = $this->input->post('deskripsiKomentar');
      $jenisKomentar = $this->session->userdata('hakAkses');
      $waktuKirim = date("Y-m-d");
      //Ketika siswa yang melakukan login
      if ($this->session->userdata('hakAkses') == 'siswa') {
        $idSiswa = $this->Pengguna->getIdByEmailSiswa($email);
        $namaSiswa = $this->session->userdata('nama');
        $this->Pertanyaan->saveKomentarSiswa($idPertanyaan, $idSiswa, $namaSiswa, $deskripsiKomentar, $waktuKirim);
        $this->Pertanyaan->saveKomentars($idPertanyaan, $idSiswa, $namaSiswa, $deskripsiKomentar, $jenisKomentar, $waktuKirim);
        $this->session->set_flashdata('success_register', 'Komentar Berhasil Dikirimkan');
        redirect('pertanyaan/' . $idPertanyaan);
        //Ketika guru yang melakukan login
      } else {
        $idGuru = $this->Pengguna->getIdByEmailGuru($email);
        $namaGuru = $this->session->userdata('nama');
        $this->Pertanyaan->saveKomentarGuru($idPertanyaan, $idGuru, $namaGuru, $deskripsiKomentar, $waktuKirim);
        $this->Pertanyaan->saveKomentars($idPertanyaan, $idGuru, $namaGuru, $deskripsiKomentar, $jenisKomentar, $waktuKirim);
        $this->session->set_flashdata('success_register', 'Komentar Berhasil Dikirimkan');
        redirect('pertanyaan/' . $idPertanyaan);
      }
    } else {
      //Data masukan pengguna belum lengkap
      $this->session->set_flashdata('error', '
      <div class="alert alert-danger" role="alert" style="text-align: center;">
      <h4 class="alert-heading">Error!</h4>
      <p>Pastikan data yang harus kamu masukkan sudah benar.</p>
    </div>');
      redirect('pertanyaan/' . $idPertanyaan);
    }
  }

  public function kelasSaya()
  {
    $this->Pengguna->checkLogin();
    $data["title"] = "Kelas Saya";
    $email = $this->session->userdata('email');
    //Ketika siswa yang melakukan login
    if ($this->session->userdata('hakAkses') == 'siswa') {
      $idSiswa = $this->Pengguna->getIdByEmailSiswa($email);
      $data['List_Kelas'] = $this->Kelas->getAllIdKelasSiswa($idSiswa);
      $data['idSiswa'] = $idSiswa;
      $this->load->view('kelasSayaSiswa', $data);
      //Ketika siswa yang melakukan login
    } else {
      $idGuru = $this->Pengguna->getIdByEmailGuru($email);
      $data['List_Kelas'] = $this->Kelas->getAllIdKelasGuru($idGuru);
      $data['idGuru'] = $idGuru;
      $this->load->view('kelasSayaGuru', $data);
    }
  }

  public function detailKelas($idKelas)
  {
    $this->Pengguna->checkLogin();
    //Mengambil data dari database
    $data["title"] = $this->Kelas->getMataPelajaran($idKelas);
    $data['Data_Kelas'] = $this->Kelas->getDetailKelas($idKelas);
    $data['Anggota_Kelas'] = $this->Kelas->getAnggotaKelas($idKelas);
    $data['idKelas'] = $idKelas;
    //Ketika siswa yang melakukan login
    if ($this->session->userdata('hakAkses') == 'siswa') {
      $this->load->view('detailKelasSiswa', $data);
      //Ketika siswa yang melakukan login
    } else {
      $this->load->view('detailKelasGuru', $data);
    }
  }

  public function hapusAnggotaKelas_process($idKelas, $idSiswa)
  {
    //Mengahapus data siswa dari tabel siswa kelas 
    $this->Pengguna->checkLogin();
    $this->Kelas->deleteAnggotaKelas($idKelas, $idSiswa);
    redirect("kelas/". $idKelas);
  }

  public function editDetailKelas($idKelas)
  {
    //Mengubah data kelas
    $this->Pengguna->checkLogin();
    $data["title"] = 'Edit' . $this->Kelas->getMataPelajaran($idKelas);
    $data['Data_Kelas'] = $this->Kelas->getDetailKelasRow($idKelas);
    $this->load->view('editDetailKelas', $data);
  }

  public function saveDetailKelas_process($idKelas)
  {
    $this->Pengguna->checkLogin();
    //Melakukan validasi data masukan pengguna
    $this->form_validation->set_rules('mataPelajaran', 'mataPelajaran', 'trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('deskripsiKelas', 'deskripsiKelas', 'trim|required|min_length[1]|max_length[255]');
    if ($this->form_validation->run() == true) {
      //Mengambil data masukan pengguna
      $idKelas = $idKelas;
      $mataPelajaran = $this->input->post('mataPelajaran');
      $deskripsiKelas = $this->input->post('deskripsiKelas');
      //Menyimpan data masukan pengguna dan menampilkan pesan berhasil
      $this->Kelas->updateDetailKelas($idKelas, $mataPelajaran, $deskripsiKelas);
      $this->Kelas->updateDetailPemilikKelas($idKelas, $mataPelajaran);
      $this->Kelas->updateDetailSiswaKelas($idKelas, $mataPelajaran);
      $this->session->set_flashdata('success_register', 'Profil Kelas Berhasil Diubah');
      redirect('kelas/'. $idKelas);
    } else {
      //Data masukan pengguna belum lengkap
      $this->session->set_flashdata('error', '
      <div class="alert alert-danger" role="alert" style="text-align: center;">
      <h4 class="alert-heading">Error!</h4>
      <p>Pastikan data yang anda masukkan sudah benar.</p>
    </div>');
    redirect('detail/'. $idKelas);
    }
  }

  public function addKelas()
  {
    //Menambahkan kelas baru
    $this->Pengguna->checkLogin();
    $data["title"] = "Buat Kelas Baru";
    $this->load->view('addKelas', $data);
  }

  public function addKelas_process()
  {
    $this->Pengguna->checkLogin();
    //Melakukan validasi data masukan pengguna
    $this->form_validation->set_rules('mataPelajaran', 'mataPelajaran', 'trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('deskripsiKelas', 'deskripsiKelas', 'trim|required|min_length[1]|max_length[255]');
    if ($this->form_validation->run() == true) {
      //Mengambil data masukan pengguna
      $email = $this->session->userdata('email');
      $idGuru = $this->Pengguna->getIdByEmailGuru($email);
      $namaGuru = $this->session->userdata('nama');
      $mataPelajaran = $this->input->post('mataPelajaran');
      $deskripsiKelas = $this->input->post('deskripsiKelas');
      $kodeKelas = $this->Kelas->getKodeKelas(10);
      $kodeKelas = $kodeKelas;
      //Menyimpan data masukan pengguna dan menampilkan pesan berhasil
      $this->Kelas->addKelas($idGuru, $namaGuru, $mataPelajaran, $deskripsiKelas, $kodeKelas);
      $idKelas = $this->Kelas->getIdKelasByKode($kodeKelas);
      $this->Kelas->addPemilikKelas($idKelas, $idGuru, $namaGuru, $mataPelajaran);
      $this->session->set_flashdata('success_register', 'Kelas Berhasil Dibuat');
      redirect('Dashboard');
    } else {
      //Data masukan pengguna belum lengkap
      $this->session->set_flashdata('error', '
      <div class="alert alert-danger" role="alert" style="text-align: center;">
      <h4 class="alert-heading">Error!</h4>
      <p>Pastikan data yang anda masukkan sudah benar.</p>
    </div>');
      redirect('addKelas');
    }
  }

  public function joinKelas()
  {
    //Bergabung ke kelas baru
    $this->Pengguna->checkLogin();
    $data["title"] = "Gabung Kelas Baru";
    $this->load->view('joinKelas', $data);
  }

  public function joinKelas_process()
  {
    $this->Pengguna->checkLogin();
    //Melakukan validasi data masukan pengguna
    $this->form_validation->set_rules('kodeKelas', 'mataPelajaran', 'trim|required|min_length[10]|max_length[10]');
    if ($this->form_validation->run() == true) {
      //Mengambil data masukan pengguna
      $email = $this->session->userdata('email');
      $idSiswa = $this->Pengguna->getIdByEmailSiswa($email);
      $kodeKelas = $this->input->post('kodeKelas');
      //Mengecek kode kelas
      if ($this->Kelas->searchKelas($kodeKelas) == true) {
        //Menyimpan data masukan pengguna dan menampilkan pesan berhasil
        $idKelas = $this->Kelas->getIdKelasByKode($kodeKelas);
        $nama = $this->session->userdata('nama');
        $mataPelajaran = $this->Kelas->getMataPelajaran($idKelas);
        $this->Kelas->joinKelas($idSiswa, $idKelas, $nama, $mataPelajaran);
        $this->session->set_flashdata('success', '
      <div class="alert alert-success" role="alert" style="text-align: center;">
      <h4 class="alert-heading">Error!</h4>
      <p>Kamu berhasil bergabung ke kelas baru!</p>
    </div>');
        redirect('kelasSaya');
        //Apabila kode kelas tidak ditemukan
      } else {
        $this->session->set_flashdata('error', '
      <div class="alert alert-danger" role="alert" style="text-align: center;">
      <h4 class="alert-heading">Error!</h4>
      <p>Kode kelas tidak ditemukan.</p>
    </div>');
        redirect('joinKelas');
      }
    } else {
      //Data masukan pengguna belum lengkap
      $this->session->set_flashdata('error', '
      <div class="alert alert-danger" role="alert" style="text-align: center;">
      <h4 class="alert-heading">Error!</h4>
      <p>Pastikan data yang harus kamu masukkan sudah benar.</p>
    </div>');
      redirect('joinKelas');
    }
  }

  public function profilSiswa($idSiswa)
  {
    //Melihat profil siswa
    $this->Pengguna->checkLogin();
    $data["title"] = $this->Pengguna->getNamaSiswa($idSiswa);
    $data['Data_Siswa'] = $this->Pengguna->getProfilSiswa($idSiswa);
    $this->load->view('profilSiswa', $data);
  }

  public function profilGuru($idGuru)
  {
    //Melihat profil guru
    $this->Pengguna->checkLogin();
    $data["title"] = $this->Pengguna->getNamaGuru($idGuru);
    $data['Data_Guru'] = $this->Pengguna->getProfilGuru($idGuru);
    $this->load->view('profilGuru', $data);
  }

  public function profilSaya()
  {
    //Melihat profil pemilik akun
    $this->Pengguna->checkLogin();
    $email = $this->session->userdata('email');
    //Ketika siswa yang melakukan login
    if ($this->session->userdata('hakAkses') == 'siswa') {
      $idSiswa = $this->Pengguna->getIdByEmailSiswa($email);
      $data["title"] = $this->Pengguna->getNamaSiswa($idSiswa);
      $data['Data_Siswa'] = $this->Pengguna->getProfilSiswa($idSiswa);
      $this->load->view('profilSaya', $data);
      //Ketika guru yang melakukan login
    } else {
      $idGuru = $this->Pengguna->getIdByEmailGuru($email);
      $data["title"] = $this->Pengguna->getNamaGuru($idGuru);
      $data['Data_Guru'] = $this->Pengguna->getProfilGuru($idGuru);
      $this->load->view('profilSaya', $data);
    }
  }
}
