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
    $data["title"] = "DISMA Dashboard";
    $email = $this->session->userdata('email'); 
    $data['List_Pertanyaan'] = $this->Pertanyaan->getAllPertanyaan($email);
    $this->load->view('Dashboard', $data);
  }
}