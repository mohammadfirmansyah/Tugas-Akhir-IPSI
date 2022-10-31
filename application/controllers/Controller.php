<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
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
    $this->form_validation->set_rules('email', 'email','trim|required|min_length[1]|max_length[255]|is_unique[Guru.email]');
		$this->form_validation->set_rules('password', 'password','trim|required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('nama', 'nama','trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('nip', 'nip','trim|required|min_length[1]|max_length[`18`]|is_unique[Guru.nip]');
    $this->form_validation->set_rules('sekolah', 'sekolah','trim|required|min_length[1]|max_length[255]');
		if ($this->form_validation->run() == true)
	   	{
      //Mengambil data masukan pengguna
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$nama = $this->input->post('nama');
      $nip = $this->input->post('nip');
      $sekolah = $this->input->post('sekolah');
      //Menyimpan data masukan pengguna
			$this->Pengguna->addUserGuru($email, $password, $nama, $nip, $sekolah);
      $this->Pengguna->addUsers($email, $password, $nama);
			$this->session->set_flashdata('success_register','Proses Registrasi Berhasil');
			$this->session->set_userdata('email',$email);
			$this->session->set_userdata('nama',$nama);
			$this->session->set_userdata('is_login',TRUE);
      redirect('Dashboard');
		}
		else
		{
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
    $this->form_validation->set_rules('email', 'email','trim|required|min_length[1]|max_length[255]|is_unique[Siswa.email]');
		$this->form_validation->set_rules('password', 'password','trim|required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('nama', 'nama','trim|required|min_length[1]|max_length[255]');
    $this->form_validation->set_rules('nisn', 'nip','trim|required|min_length[1]|max_length[10]|is_unique[Siswa.nisn]');
    $this->form_validation->set_rules('sekolah', 'sekolah','trim|required|min_length[1]|max_length[255]');
		if ($this->form_validation->run() == true)
	   	{
      //Mengambil data masukan pengguna
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$nama = $this->input->post('nama');
      $nisn = $this->input->post('nip');
      $sekolah = $this->input->post('sekolah');
      //Menyimpan data masukan pengguna dan menampilkan pesan berhasil
			$this->Pengguna->addUserSiswa($email, $password, $nama, $nisn, $sekolah);
			$this->Pengguna->addUsers($email, $password, $nama);
      $this->session->set_flashdata('success_register','Proses Registrasi Berhasil');
			$this->session->set_userdata('email',$email);
			$this->session->set_userdata('nama',$nama);
			$this->session->set_userdata('is_login',TRUE);
      redirect('Dashboard');
		}
		else
		{
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
      $this->session->set_flashdata('error','Email & Password salah');
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
    $this->form_validation->set_rules('judulMateri', 'judulMateri','trim|required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('deskripsiPertanyaan', 'deskripsiPertanyaan','trim|required|min_length[1]|max_length[255]');
		if ($this->form_validation->run() == true)
	   	{
      //Mengambil data masukan pengguna
			$judulMateri = $this->input->post('judulMateri');
			$deskripsiPertanyaan = $this->input->post('deskripsiPertanyaan');
			$email = $this->session->userdata('email');
      $idSiswa = $this->Pengguna->getIdByEmailSiswa($email);
      $idGuru = $this->input->post('idGuru');
      $waktuKirim = $this->input->post('waktuKirim');
      //Menyimpan data masukan pengguna dan menampilkan pesan berhasil
			$this->Pertanyaan->addPertanyaan($idGuru, $idSiswa, $deskripsiPertanyaan, $judulMateri, $waktuKirim);
      $this->session->set_flashdata('success_register','Pertanyaan Berhasil Dikirimkan');
      redirect('Dashboard');
		}
		else
		{
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
		$this->form_validation->set_rules('deskripsiJawaban', 'deskripsiJawaban','trim|required|min_length[1]|max_length[255]');
		if ($this->form_validation->run() == true)
	   	{
      //Mengambil data masukan pengguna
			$idPertanyaan = $this->input->post('idPertanyaan');
      $email = $this->session->userdata('email');
      $idGuru = $this->Pengguna->getIdByEmailGuru($email);
      $deskripsiPertanyaan = $this->input->post('deskripsiPertanyaan');
      $waktuKirim = $this->input->post('waktuKirim');
      //Menyimpan data masukan pengguna dan menampilkan pesan berhasil
			$this->Pertanyaan->saveJawaban($idPertanyaan, $idGuru, $deskripsiPertanyaan, $waktuKirim);
      $this->session->set_flashdata('success_register','Jawaban Berhasil Dikirimkan');
      redirect('detailPertanyaan');
		}
		else
		{
      //Data masukan pengguna belum lengkap
			$this->session->set_flashdata('error', validation_errors());
			redirect('detailPertanyaan');
		}
  }

  public function sendKomentar_process()
  {
    //Melakukan validasi data masukan pengguna
		$this->form_validation->set_rules('deskripsiKomentar', 'deskripsiKomentar','trim|required|min_length[1]|max_length[255]');
		if ($this->form_validation->run() == true)
	   	{
      //Mengambil data masukan pengguna
			$idJawaban = $this->input->post('idJawaban');
      $email = $this->session->userdata('email');
      $idGuru = $this->Pengguna->getIdByEmailGuru($email);
      $idGuru = $this->Pengguna->getIdByEmailGuru($email);
      $deskripsiPertanyaan = $this->input->post('deskripsiPertanyaan');
      $waktuKirim = $this->input->post('waktuKirim');
      //Menyimpan data masukan pengguna dan menampilkan pesan berhasil
			$this->Pertanyaan->saveJawaban($idJawaban, $idGuru, $deskripsiPertanyaan, $waktuKirim);
      $this->session->set_flashdata('success_register','Jawaban Berhasil Dikirimkan');
      redirect('detailPertanyaan');
		}
		else
		{
      //Data masukan pengguna belum lengkap
			$this->session->set_flashdata('error', validation_errors());
			redirect('detailPertanyaan');
		}
  }

}