<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pertanyaan extends CI_Model
{
  protected $table1 = 'Pertanyaan';
  protected $table2 = 'Jawaban';
  protected $table3 = 'Komentar';

  public function __construct()
	{
        parent::__construct();
	}

  //Menampilkan pertanyaan berdasarkan pemilik email
  public function getAllPertanyaan($id)
  {
    return $this->db->get_where(
      $this->table1,
      ["idUsers" => $id]
    )->row();
  }
  
}
