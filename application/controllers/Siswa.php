<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {
  public function __construct(){
        parent::__construct();
        // ini_set('memory_limit', '2048');
        if (!$this->session->userdata('username')) {
          redirect('auth/login');
        }
        if ($this->session->userdata('role')=='guru') {
          redirect('guru');
        }
        $this->load->model('M_Login');
        $this->load->model('M_Guru');
        $this->load->model('M_Universal');
        $this->load->model('M_Siswa');
        $this->load->model('M_Project');
      }

	public function index()
	{
    $data['menu']   = "dashboard";
    $data['title']  = "Dashboard";
    $data['user']   = $this->M_Login->login_siswa($this->session->userdata('username'));

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar_siswa',$data);
    $this->load->view('templates/topbar_siswa',$data);
    $this->load->view('siswa/index',$data);
    $this->load->view('templates/footer');
	}

  public function profile(){
    $data['menu']   = "profile";
    $data['title'] = "Profile";
    $data['user'] = $this->M_Login->login_siswa($this->session->userdata('username'));
    $data['guru'] = $this->M_Siswa->getGuru($data['user']['id_project']);
    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar_siswa',$data);
    $this->load->view('templates/topbar_siswa',$data);
    $this->load->view('siswa/profile',$data);
    $this->load->view('templates/footer');
  }

  public function project(){
    $data['menu']   = "project";
    $data['title'] = "Tugas Project";
    $data['user'] = $this->M_Login->login_siswa($this->session->userdata('username'));
    $data['project']  = $this->M_Project->lihatProject($data['user']['id_project']);
    $data['nilai'] = $this->M_Siswa->getNilai($data['user']['id_project'],$data['user']['id']);

    //$data['faseProject'] = $this->M_Siswa->fase($data['user']['id_project']);
    $data['jawabanFase'] = $this->M_Siswa->jawabanFase($data['user']['id_project'],$data['user']['id']);
    $data['faseProjectKel'] = $this->M_Siswa->fase($data['user']['id_project']);

    $evalFase               = $this->M_Project->getEval($data['user']['id']);
    if ($evalFase) {
      $data['evalFase']     = $evalFase;
    }else{
      $data['evalFase']     = "-";
    }



    date_default_timezone_set('Asia/Jakarta');
    $data['today']  = new DateTime();

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar_siswa',$data);
    $this->load->view('templates/topbar_siswa',$data);
    $this->load->view('siswa/project',$data);
    $this->load->view('templates/footer');
  }

  public function pertanyaan_dasar(){
    $data['menu']   = "project";
    $data['title'] = "Pertanyaan Dasar";
    $data['user'] = $this->M_Login->login_siswa($this->session->userdata('username'));
    $data['project'] = $this->M_Siswa->getQuestion($data['user']['id_project'],$this->session->userdata('username'));

    $data['jawaban']=array();
    for ($i=0; $i < count($data['project']) ; $i++) {
        array_push($data['jawaban'],$this->M_Siswa->getAnswer($data['project'][$i]['id']));
        $no = $i+1;
        $this->form_validation->set_rules('jawaban'.$no,"jawaban","required|trim");
    }

    if ($this->form_validation->run()==FALSE) {
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar_siswa',$data);
      $this->load->view('templates/topbar_siswa',$data);
      $this->load->view('siswa/pertanyaan_dasar',$data);
      $this->load->view('templates/footer');
    }else{
      $nilai = 0;
      for ($i=0; $i < count($data['project']) ; $i++) {
        $correctAnswer = $this->M_Siswa->getCorrectAnswer($data['project'][$i]['id']);
        $no = $i + 1;
        $jawabanPG =  $this->input->post('jawaban'.$no);
        if ($jawabanPG == $correctAnswer['id']) {
          $nilai = $nilai + 1;
        }
        $this->M_Siswa->inputJawabanPG($data['user']['id'],$data['project'][$i]['id'],$jawabanPG);
      }

      $nilai = $nilai*100/count($data['project']);
      $this->M_Siswa->inputNilai($data['user']['id_project'],$data['user']['id'],'nilai_pertanyaan_dasar',$nilai);
      $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Sukses Mengisi Pilihan Ganda</div>');
      redirect('siswa/project');
    }
  }

  public function pertanyaan_dasar_selesai(){
    $data['menu']     = "project";
    $data['title']    = "Pertanyaan Dasar";
    $data['user']     = $this->M_Login->login_siswa($this->session->userdata('username'));
    $data['project']  = $this->M_Siswa->getQuestion($data['user']['id_project'],$this->session->userdata('username'));

    $data['jawaban']=array();
    $data['correctAnswer'] = array();
    for ($i=0; $i < count($data['project']) ; $i++) {
        array_push($data['jawaban'],$this->M_Siswa->getAnswer($data['project'][$i]['id']));
        $no = $i+1;
        array_push($data['correctAnswer'],$this->M_Siswa->getCorrectAnswer($data['project'][$i]['id']));

    }

    $data['jawabanKelompokPG'] = $this->M_Siswa->getJawabanPG($data['user']['id']);

      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar_siswa',$data);
      $this->load->view('templates/topbar_siswa',$data);
      $this->load->view('siswa/pertanyaan_dasar_selesai',$data);
      $this->load->view('templates/footer');

  }

  public function fase_project($faseProject){
    $data['menu']   = "project";
    $data['title'] = "Project Fase ".$faseProject;
    $data['user'] = $this->M_Login->login_siswa($this->session->userdata('username'));
    $data['project'] = $this->M_Siswa->getFase($data['user']['id_project'],$faseProject);
    $data['faseProject'] = $faseProject;

    $data['jawabanFase'] = $this->M_Siswa->getJawabanFase($data['user']['id_project'],$data['user']['id'],$faseProject);

    $this->form_validation->set_rules('tugas','Tugas','required|trim');
    // $this->form_validation->set_rules('uploadTugas',"Tugas","required|trim");
    if ($this->form_validation->run()==false) {
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar_siswa',$data);
      $this->load->view('templates/topbar_siswa',$data);
      $this->load->view('siswa/fase_project',$data);
      $this->load->view('templates/footer');
    }else{
      $uploadTugas = $_FILES['uploadTugas']['name'];
      $this->db->set('id_project',$data['user']['id_project']);
      $this->db->set('id_kelompok',$data['user']['id']);
      $this->db->set('fase',$faseProject);
      if ($uploadTugas) {
        $config['allowed_types'] = 'doc|docx|pdf|ppt|pptx|jpg|png|jpeg';
        $config['max_width'] = '5120';
        $config['upload_path'] = './assets/jawaban_fase/'.$faseProject.'/';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('uploadTugas')) {
          $bahan = $this->upload->data('file_name');
          $this->db->set('nama_tugas',$bahan);
          }else {
            echo $this->upload->display_errors();
          }
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date("Y-m-d H:i:s");
        $this->db->set('tanggal',$tanggal);
        $this->db->insert('jawaban_fase');
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Berhasil Mengisi Fase</div>');
        redirect('siswa/project');
      }
    }
  }

  public function delete_jawaban($faseProject){
    $data['user'] = $this->M_Login->login_siswa($this->session->userdata('username'));
    $jawabanFase = $this->M_Siswa->getJawabanFase($data['user']['id_project'],$data['user']['id'],$faseProject);
    unlink(FCPATH . 'assets/jawaban_fase/'.$faseProject.'/'.$jawabanFase['nama_tugas']);
    $this->M_Siswa->deleteJawabanFase($data['user']['id'],$data['user']['id_project'],$faseProject);
    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Berhasil Menghapus Jawaban Fase</div>');
    redirect('siswa/project');
  }

}
