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
    $this->form_validation->set_rules('email', 'email', 'trim|required|min_length[1]|max_length[255]|is_unique[Guru.email]');
    $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('nama', 'nama', 'trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('nip', 'nip', 'trim|required|min_length[18]|max_length[18]|is_unique[Guru.nip]');
    $this->form_validation->set_rules('sekolah', 'sekolah', 'trim|required|min_length[1]|max_length[255]');
    if ($this->form_validation->run() == true) {
      //Mengambil data masukan pengguna
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $nama = $this->input->post('nama');
      $nip = $this->input->post('nip');
      $sekolah = $this->input->post('sekolah');
      $hakAkses = 'guru';
      //Menyimpan data masukan pengguna
      $this->Pengguna->addUserGuru($email, $password, $nama, $nip, $sekolah);
      $this->Pengguna->addUsers($email, $password, $nama, $hakAkses);
      $this->session->set_flashdata('success_register', 'Proses Registrasi Berhasil');
      $this->session->set_userdata('email', $email);
      $this->session->set_userdata('nama', $nama);
      $this->session->set_userdata('hakAkses', $hakAkses);
      $this->session->set_userdata('is_login', TRUE);
      redirect('Dashboard');
    } else {
      //Data masukan pengguna belum lengkap
      $this->session->set_flashdata('error', '
      <div class="alert alert-danger" role="alert" style="text-align: center;">
      <h4 class="alert-heading">Error!</h4>
      <p>Pastikan data yang harus kamu masukkan sudah lengkap dan unik.</p>
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
    $this->form_validation->set_rules('email', 'email', 'trim|required|min_length[1]|max_length[255]|is_unique[Siswa.email]');
    $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('nama', 'nama', 'trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('nisn', 'nip', 'trim|required|min_length[10]|max_length[10]|is_unique[Siswa.nisn]');
    $this->form_validation->set_rules('sekolah', 'sekolah', 'trim|required|min_length[1]|max_length[255]');
    if ($this->form_validation->run() == true) {
      //Mengambil data masukan pengguna
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $nama = $this->input->post('nama');
      $nisn = $this->input->post('nisn');
      $sekolah = $this->input->post('sekolah');
      $hakAkses = 'siswa';
      //Menyimpan data masukan pengguna dan menampilkan pesan berhasil
      $this->Pengguna->addUserSiswa($email, $password, $nama, $nisn, $sekolah);
      $this->Pengguna->addUsers($email, $password, $nama, $hakAkses);
      $this->session->set_flashdata('success_register', 'Proses Registrasi Berhasil');
      $this->session->set_userdata('email', $email);
      $this->session->set_userdata('nama', $nama);
      $this->session->set_userdata('hakAkses', $hakAkses);
      $this->session->set_userdata('is_login', TRUE);
      redirect('Dashboard');
    } else {
      //Data masukan pengguna belum lengkap
      $this->session->set_flashdata('error', '
      <div class="alert alert-danger" role="alert" style="text-align: center;">
      <h4 class="alert-heading">Error!</h4>
      <p>Pastikan data yang harus kamu masukkan sudah lengkap dan unik.</p>
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
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('nama');
    $this->session->unset_userdata('hakAkses');
    $this->session->unset_userdata('is_login');
    redirect('Login');
  }

  public function Dashboard()
  {
    $this->Pengguna->checkLogin();
    $data["title"] = "Selamat Datang di DISMA";
    $email = $this->session->userdata('email');
    $idSiswa = $this->Pengguna->getIdByEmailSiswa($email);
    $idGuru = $this->Pengguna->getIdByEmailGuru($email);
    if ($this->session->userdata('hakAkses') == 'siswa') {
      $data['List_Pertanyaan'] = $this->Pertanyaan->getAllPertanyaanSiswa($idSiswa);
      $data['List_Kelas'] = $this->Kelas->getAllKelasSiswa($idSiswa);
      $data['idSiswa'] = $idSiswa;
      $this->load->view('DashboardSiswa', $data);
    } else {
      $data['List_Pertanyaan'] = $this->Pertanyaan->getAllPertanyaanGuru($idGuru);
      $data['List_Kelas'] = $this->Kelas->getAllKelasGuru($idGuru);
      $this->load->view('DashboardGuru', $data);
    }
  }

  public function addPertanyaan()
  {
    $this->Pengguna->checkLogin();
    $data["title"] = "Tambah Pertanyaan";
    $email = $this->session->userdata('email');
    $idSiswa = $this->Pengguna->getIdByEmailSiswa($email);
    // $data['List_Guru'] = $this->Kelas->getAllGuruSiswa($idKelas);
    if (!empty($this->Kelas->getAllIdKelasSiswa($idSiswa))) {
      $data['List_Kelas'] = $this->Kelas->getAllIdKelasSiswa($idSiswa);
      $this->load->view('addPertanyaan', $data);
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
      $this->session->set_flashdata('error', validation_errors());
      redirect('addPertanyaan');
    }
  }

  public function detailPertanyaan($idPertanyaan)
  {
    $this->Pengguna->checkLogin();
    $data["title"] = $this->Pertanyaan->getJudulMateriById($idPertanyaan);
    $data['Data_Pertanyaan'] = $this->Pertanyaan->getPertanyaan($idPertanyaan);
    $data['Data_Jawaban'] = $this->Pertanyaan->getJawaban($idPertanyaan);
    $data['Data_Komentar'] = $this->Pertanyaan->getKomentar($idPertanyaan);
    $data['idPertanyaan'] = $idPertanyaan;
    if ($this->session->userdata('hakAkses') == 'siswa') {
      $this->load->view('detailPertanyaanSiswa', $data);
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
      $deskripsiPertanyaan = $this->input->post('deskripsiPertanyaan');
      $waktuKirim = date("Y-m-d");
      //Menyimpan data masukan pengguna dan menampilkan pesan berhasil
      $this->Pertanyaan->saveJawaban($idPertanyaan, $idGuru, $namaGuru, $deskripsiPertanyaan, $waktuKirim);
      $this->session->set_flashdata('success_register', 'Jawaban Berhasil Dikirimkan');
      redirect('pertanyaan/' . $idPertanyaan);
    } else {
      //Data masukan pengguna belum lengkap
      $this->session->set_flashdata('error', validation_errors());
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
      $idSiswa = $this->Pengguna->getIdByEmailSiswa($email);
      $idGuru = $this->Pengguna->getIdByEmailGuru($email);
      $deskripsiKomentar = $this->input->post('deskripsiKomentar');
      $jenisKomentar = $this->session->userdata('hakAkses');
      $waktuKirim = date("Y-m-d");
      //Menyimpan data masukan pengguna dan menampilkan pesan berhasil
      if ($this->session->userdata('hakAkses') == 'siswa') {
        $namaSiswa = "$this->session->userdata('nama')";
        $this->Pertanyaan->saveKomentarSiswa($idPertanyaan, $idSiswa, $namaSiswa, $deskripsiKomentar, $jenisKomentar, $waktuKirim);
        $this->Pertanyaan->saveKomentars($idPertanyaan, $namaSiswa, $deskripsiKomentar, $waktuKirim);
        $this->session->set_flashdata('success_register', 'Komentar Berhasil Dikirimkan');
        redirect('pertanyaan/' . $idPertanyaan);
      } else {
        $namaGuru = $this->session->userdata('nama');
        $this->Pertanyaan->saveKomentarGuru($idPertanyaan, $idGuru, $namaGuru, $deskripsiKomentar, $jenisKomentar, $waktuKirim);
        $this->Pertanyaan->saveKomentars($idPertanyaan, $namaGuru, $deskripsiKomentar, $jenisKomentar, $waktuKirim);
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
    $idSiswa = $this->Pengguna->getIdByEmailSiswa($email);
    $idGuru = $this->Pengguna->getIdByEmailGuru($email);
    if ($this->session->userdata('hakAkses') == 'siswa') {
      $data['List_Kelas'] = $this->Kelas->getAllIdKelasSiswa($idSiswa);
      $data['idSiswa'] = $idSiswa;
      $this->load->view('kelasSayaSiswa', $data);
    } else {
      $data['List_Kelas'] = $this->Kelas->getAllIdKelasGuru($idGuru);
      $this->load->view('kelasSayaSiswa', $data);
    }
  }

  public function detailKelas($idKelas)
  {
    $this->Pengguna->checkLogin();
    $data["title"] = $this->Kelas->getMataPelajaran($idKelas);
    $data['Data_Kelas'] = $this->Kelas->getDetailKelas($idKelas);
    $data['Anggota_Kelas'] = $this->Kelas->getAnggotaKelas($idKelas);
    if ($this->session->userdata('hakAkses') == 'siswa') {
      $this->load->view('detailKelasSiswa', $data);
    } else {
      $this->load->view('detailKelasGuru', $data);
    }
  }

  public function hapusAnggotaKelas_process($idKelas, $idSiswa)
  {
    $this->Pengguna->checkLogin();
    $this->Kelas->deleteAnggotaKelas($idKelas, $idSiswa);
    redirect("detailKelas");
  }

  public function editDetailKelas($idKelas)
  {
    $this->Pengguna->checkLogin();
    $data["title"] = 'Edit' . $this->Kelas->getMataPelajaran($idKelas);
    $data['Data_Kelas'] = $this->Kelas->getDetailKelas($idKelas);
  }

  public function saveDetailKelas_process($idKelas)
  {
    $this->Pengguna->checkLogin();
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
        //Kode kelas tidak ditemukan
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
    $this->Pengguna->checkLogin();
    $data["title"] = $this->Pengguna->getNamaSiswa($idSiswa);
    $data['Data_Siswa'] = $this->Pengguna->getProfilSiswa($idSiswa);
    $this->load->view('profilSiswa', $data);
  }

  public function profilGuru($idGuru)
  {
    $this->Pengguna->checkLogin();
    $data["title"] = $this->Pengguna->getNamaGuru($idGuru);
    $data['Data_Guru'] = $this->Pengguna->getProfilGuru($idGuru);
    $this->load->view('profilGuru', $data);
  }
}
