<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

  public function __construct(){
        parent::__construct();

        if (!$this->session->userdata('username')) {
          redirect('auth/login');
        }
        if ($this->session->userdata('role')=='siswa') {
          redirect('siswa');
        }
        $this->load->model('M_Login');
        $this->load->model('M_Guru');
        $this->load->model('M_Universal');
        $this->load->model('M_Project');
        $this->load->model('M_Siswa');
      }

	public function SpecProject()
	{
    $data['menu']   = "buatproject";
    $data['title'] = "Spec Project";
    $data['user'] = $this->M_Login->login($this->session->userdata('username'));

    $this->form_validation->set_rules('judul',"Judul","required|trim");
    if ($this->form_validation->run()==false) {
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('project/spec_project',$data);
      $this->load->view('templates/footer');
    }else{
      $cekProject = $this->M_Project->cekProject($this->input->post('kelas'),$data['user']['id'],$this->input->post('judul'));
      if ($cekProject) {
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Judul Project '.$this->input->post('judul').' Sudah Ada di Kelas '.$this->input->post('kelas').' </div>');
        redirect('project/specproject');
      }else{
        $this->session->set_userdata('banyakSoal',$this->input->post('soalWarmingUp'));
        $this->session->set_userdata('banyakKelompok',$this->input->post('kelompok'));
        $this->session->set_userdata('banyakFase',$this->input->post('fase'));
        $this->session->set_userdata('judul',$this->input->post('judul'));
        $this->session->set_userdata('kelas',$this->input->post('kelas'));
        redirect('project/BuatProject');
      }

    }
	}

  public function BuatProject(){
      $data['menu']   = "buatproject";
      $banyakSoal     = $this->session->userdata('banyakSoal');
      $banyakKelompok = $this->session->userdata('banyakKelompok');
      $banyakFase     = $this->session->userdata('banyakFase');
      $judul          = $this->session->userdata('judul');
      $kelas          = $this->session->userdata('kelas');

    for ($i=1; $i <=$banyakSoal ; $i++) {
      $this->form_validation->set_rules('judulPertanyaan'.$i,"Judul Pertanyaan","required|trim");
      $this->form_validation->set_rules('jawabanA'.$i,"Jawaban A","required|trim");
      $this->form_validation->set_rules('jawabanB'.$i,"Jawaban B","required|trim");
      $this->form_validation->set_rules('jawabanC'.$i,"Jawaban C","required|trim");
      $this->form_validation->set_rules('jawabanD'.$i,"Jawaban D","required|trim");
    }

    for ($i=1; $i <= $banyakKelompok ; $i++) {
      $this->form_validation->set_rules('usernameKel'.$i,"Username","required|trim|is_unique[kelompok.username]",['is_unique' => 'This Username Has Already Registered ']);
      $this->form_validation->set_rules('passwordKel'.$i,"Password","required|trim");
      $this->form_validation->set_rules('anggotaKel'.$i,"Anggota Kelompok","required|trim");
    }

    date_default_timezone_set('Asia/Jakarta');
    $now = new DateTime();
    $next = FALSE;
    if ($this->input->post('tanggalProject1')) {
      for ($i=1; $i <= $banyakFase; $i++) {
        $batasAkhir = new DateTime($_POST['tanggalProject'.strval($i)]);
        if ($now>$batasAkhir) {
          unset($_POST['batasAwal'.strval($i)]);
          unset($_POST['tanggalProject'.strval($i)]);
          $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Waktu Batas Akhir Pengumpulan FASE '.$i.' Tidak Boleh Kurang Dari Hari/Waktu Sekarang</div>');
          $next = FALSE;
          break;
        }else{
          $next = TRUE;
        }
      }
    }

    $arrayBatasAwal = array();
    $arrayBatasAkhir = array();
    if ($next) {
      for ($i=1; $i <= $banyakFase ; $i++) {
        $start  = new DateTime($this->input->post('batasAwal'.$i));
        $end    = new DateTime($this->input->post('tanggalProject'.$i));
        if ($start>$end) {
          unset($_POST['batasAwal'.$i]);
          $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Waktu Batas Awal Melebihi Batas Akhir</div>');
          break;
        }
        array_push($arrayBatasAwal,$_POST['batasAwal'.$i]);
        array_push($arrayBatasAkhir,$_POST['tanggalProject'.$i]);
      }
    }

    if (count($arrayBatasAwal)==$banyakFase) {
      for ($i=0; $i < count($arrayBatasAwal); $i++) {
        for ($j=$i; $j < count($arrayBatasAwal); $j++) {
          if ($i!=$j) {
            if ($arrayBatasAwal[$i]>$arrayBatasAwal[$j]) {
              $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Batas Awal Fase '.strval($i+1).' Melebihi Fase '.strval($j+1).'</div>');
              unset($_POST['batasAwal'.strval($i+1)]);
              break;
            }
          }
        }
      }
    }

    if (count($arrayBatasAkhir)==$banyakFase) {
      for ($i=0; $i < count($arrayBatasAkhir); $i++) {
        for ($j=$i; $j < count($arrayBatasAkhir); $j++) {
          if ($i!=$j) {
            if ($arrayBatasAkhir[$i]>$arrayBatasAkhir[$j]) {
              $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Batas Akhir Fase '.strval($i+1).' Melebihi Fase '.strval($j+1).'</div>');
              unset($_POST['tanggalProject'.strval($i+1)]);
              break;
            }
          }
        }
      }
    }


    for ($i=1; $i <= $banyakFase ; $i++) {
      $this->form_validation->set_rules('instruksiProject'.$i,"Instruksi","required|trim");
      $this->form_validation->set_rules('batasAwal'.$i,"Batas Awal","required|trim");
      $this->form_validation->set_rules('tanggalProject'.$i,"Batas Akhir","required|trim");
    }

    $data['title']          = "Buat Project";
    $data['user']           = $this->M_Login->login($this->session->userdata('username'));
    $data['banyakSoal']     = $banyakSoal;
    $data['banyakKelompok'] = $banyakKelompok;
    $data['banyakFase']     = $banyakFase;
    $data['judul']          = $judul;
    $data['kelas']          = $kelas;



    if ($this->form_validation->run()==false) {

      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('project/buat_project',$data);
      $this->load->view('templates/footer');
    }else{
      $judul = $this->input->post('judul');

      $judulProject = [
                       'id_user'=>$data['user']['id'],
                       'nama_project'=>$judul,
                       'kelas' => $kelas
                     ];
      $this->M_Universal->insert('project',$judulProject);
      $project = $this->db->get_where('project', array('id_user' => $data['user']['id'],'nama_project'=>$judul,'kelas'=>$kelas))->row_array();


      for ($i=1; $i <= $banyakSoal; $i++) {
        $pertanyaanDasar = [
          'id_project' =>$project['id'],
          'pertanyaan' =>$this->input->post('judulPertanyaan'.$i)
        ];
        $this->M_Universal->insert('pertanyaan_dasar',$pertanyaanDasar);

        $pertanyaanDasar =  $this->db->get_where('pertanyaan_dasar', array('id_project' => $project['id'],'pertanyaan'=>$this->input->post('judulPertanyaan'.$i)))->row_array();

        $pgDasar = [
          'id_pertanyaan' => $pertanyaanDasar['id'],
          'pilihan' => 'A',
          'jawaban' => $this->input->post('jawabanA'.$i),
          'correct' => 0
        ];
        $this->M_Universal->insert('pg_dasar',$pgDasar);
        $pgDasar = [
          'id_pertanyaan' => $pertanyaanDasar['id'],
          'pilihan' => 'B',
          'jawaban' => $this->input->post('jawabanB'.$i),
          'correct' => 0
        ];
        $this->M_Universal->insert('pg_dasar',$pgDasar);

        $pgDasar = [
          'id_pertanyaan' => $pertanyaanDasar['id'],
          'pilihan' => 'C',
          'jawaban' => $this->input->post('jawabanC'.$i),
          'correct' => 0
        ];
        $this->M_Universal->insert('pg_dasar',$pgDasar);

        $pgDasar = [
          'id_pertanyaan' => $pertanyaanDasar['id'],
          'pilihan' => 'D',
          'jawaban' => $this->input->post('jawabanD'.$i),
          'correct' => 0
        ];
        $this->M_Universal->insert('pg_dasar',$pgDasar);

        $this->M_Project->updateJawaban($pertanyaanDasar['id'],$this->input->post('correct'));
      }

        for ($i=1; $i <= $banyakKelompok ; $i++) {
          $kelompok = [
            'id_project'=> $project['id'],
            'username' => $this->input->post('usernameKel'.$i),
            // 'password' => $this->input->post('passwordKel'.$i) ,
            'password' => base64_encode($this->input->post('passwordKel'.$i)),
            'anggota' => $this->input->post('anggotaKel'.$i)
          ];
          $this->M_Universal->insert('kelompok',$kelompok);
        }

        for ($i=1; $i <= $banyakFase ; $i++) {
          $uploadBahan = $_FILES['bahanProject'.$i]['name'];
          $this->db->set('id_project',$project['id']);
          $this->db->set('fase',$i);
          $this->db->set('instruksi',$this->input->post('instruksiProject'.$i));
          if ($uploadBahan) {
            $config['allowed_types'] = 'doc|docx|pdf|ppt|pptx|jpg|png|jpeg';
            $config['max_width'] = '5120';
            $config['upload_path'] = './assets/bahan_project/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('bahanProject'.$i)) {
              $bahan = $this->upload->data('file_name');
              $this->db->set('bahan',$bahan);
              }else {
                echo $this->upload->display_errors();
              }
            $this->db->set('startline',$this->input->post('batasAwal'.$i));
            $this->db->set('deadline',$this->input->post('tanggalProject'.$i));
            $this->db->insert('fase_project');
          }
        }

        redirect('project/listkelas');
      }

    }


  public function listKelas(){
    $data['menu']   = "project";
    $data['title'] = "List Kelas";
    $data['user'] = $this->M_Login->login($this->session->userdata('username'));

    $data['listKelas'] = $this->M_Project->listKelas($data['user']['id']);

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('project/list_kelas',$data);
    $this->load->view('templates/footer');
  }

  public function listProject($kelas){
    $data['menu']   = "project";
    $kelas = urldecode($kelas);
    $data['title'] = "List Project";
    $data['user'] = $this->M_Login->login($this->session->userdata('username'));
    $data['project'] = $this->M_Project->getProject($kelas,$data['user']['id']);

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('project/list_project',$data);
    $this->load->view('templates/footer');
  }

  public function deleteProject($idProject){
    $fase = $this->M_Project->getFase($idProject);
    for ($i=0; $i < count($fase); $i++) {
      unlink(FCPATH . 'assets/bahan_project/'.$fase[$i]['bahan']);
    }

    $jawabanFase = $this->M_Project->getJawabanFaseByIdProject($idProject);
    for ($i=0; $i < count($jawabanFase); $i++) {
      unlink(FCPATH . 'assets/jawaban_fase/'.$jawabanFase[$i]['fase']."/".$jawabanFase[$i]['nama_tugas']);
    }

    $this->M_Project->deleteProject($idProject);
    redirect('project/listkelas');
  }

  public function edit_project($idProject){
    $data['menu']           = "project";
    $data['title']          = "Edit Project";
    $data['user']           = $this->M_Login->login($this->session->userdata('username'));
    $data['project']        = $this->M_Project->lihatProject($idProject);
    $data['kelas']          = array('X RPL - 1', 'X RPL - 2','X RPL - 3','X RPL - 4','X RPL - 5','X TKJ - 1', 'X TKJ - 2','X TKJ - 3','X TKJ - 4','X TKJ - 5','XI RPL - 1', 'XI RPL - 2','XI RPL - 3','XI RPL - 4','XI RPL - 5','XI TKJ - 1', 'XI TKJ - 2','XI TKJ - 3','XI TKJ - 4','XI TKJ - 5','XII RPL - 1','XII RPL - 2','XII RPL - 3','XII RPL - 4','XII RPL - 5','XII TKJ - 1', 'XII TKJ - 2','XII TKJ - 3','XII TKJ - 4','XII TKJ - 5');
    $data['pertanyaanDasar']= $this->M_Project->getPertanyaanDasar($idProject);
    $data['banyakSoal']     = count($data['pertanyaanDasar']);

    $data['jawabanPG'] = array();
    for ($i=0; $i < $data['banyakSoal'] ; $i++) {
      array_push($data['jawabanPG'],$this->M_Project->getPGDasar($data['pertanyaanDasar'][$i]['id']));
    }

    $data['kelompok']       = $this->M_Project->getKelompok($idProject);
    $data['banyakKelompok'] = count($data['kelompok']);

    $data['fase']           = $this->M_Project->getFase($idProject);
    $data['banyakFase']     = count($data['fase']);

    $banyakFase = count($data['fase']);

    for ($i=1; $i <=$data['banyakSoal'] ; $i++) {
      $this->form_validation->set_rules('judulPertanyaan'.$i,"Judul Pertanyaan","required|trim");
      $this->form_validation->set_rules('jawabanA'.$i,"Jawaban A","required|trim");
      $this->form_validation->set_rules('jawabanB'.$i,"Jawaban B","required|trim");
      $this->form_validation->set_rules('jawabanC'.$i,"Jawaban C","required|trim");
      $this->form_validation->set_rules('jawabanD'.$i,"Jawaban D","required|trim");
    }

    for ($i=1; $i <=$data['banyakKelompok'] ; $i++) {
      if ($this->input->post('usernameKel'.$i)== $data['kelompok'][$i-1]['username']) {
        $this->form_validation->set_rules('usernameKel'.$i,"Username","required|trim");
      }else{
        $this->form_validation->set_rules('usernameKel'.$i,"Username","required|trim|is_unique[kelompok.username]",['is_unique' => 'This Username Has Already Registered ']);
      }
      $this->form_validation->set_rules('passwordKel'.$i,"Password","required|trim");
      $this->form_validation->set_rules('anggotaKel'.$i,"Anggota Kelompok","required|trim");
    }

    date_default_timezone_set('Asia/Jakarta');
    $now = new DateTime();
    $next = FALSE;
    if ($this->input->post('tanggalProject1')) {
      for ($i=1; $i <= $banyakFase; $i++) {
        $batasAkhir = new DateTime($_POST['tanggalProject'.strval($i)]);
        if ($now>$batasAkhir) {
          unset($_POST['batasAwal'.strval($i)]);
          unset($_POST['tanggalProject'.strval($i)]);
          $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Waktu Batas Akhir Pengumpulan FASE '.$i.' Tidak Boleh Kurang Dari Hari/Waktu Sekarang</div>');
          $next = FALSE;
          break;
        }else{
          $next = TRUE;
        }
      }
    }

    $arrayBatasAwal = array();
    $arrayBatasAkhir = array();
    if ($next) {
      for ($i=1; $i <= $banyakFase ; $i++) {
        $start  = new DateTime($this->input->post('batasAwal'.$i));
        $end    = new DateTime($this->input->post('tanggalProject'.$i));
        if ($start>$end) {
          unset($_POST['batasAwal'.$i]);
          $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Waktu Batas Awal Melebihi Batas Akhir</div>');
          break;
        }
        array_push($arrayBatasAwal,$_POST['batasAwal'.$i]);
        array_push($arrayBatasAkhir,$_POST['tanggalProject'.$i]);
      }
    }

    if (count($arrayBatasAwal)==$banyakFase) {
      for ($i=0; $i < count($arrayBatasAwal); $i++) {
        for ($j=$i; $j < count($arrayBatasAwal); $j++) {
          if ($i!=$j) {
            if ($arrayBatasAwal[$i]>$arrayBatasAwal[$j]) {
              $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Batas Awal Fase '.strval($i+1).' Melebihi Fase '.strval($j+1).'</div>');
              unset($_POST['batasAwal'.strval($i+1)]);
              break;
            }
          }
        }
      }
    }

    if (count($arrayBatasAkhir)==$banyakFase) {
      for ($i=0; $i < count($arrayBatasAkhir); $i++) {
        for ($j=$i; $j < count($arrayBatasAkhir); $j++) {
          if ($i!=$j) {
            if ($arrayBatasAkhir[$i]>$arrayBatasAkhir[$j]) {
              $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Batas Akhir Fase '.strval($i+1).' Melebihi Fase '.strval($j+1).'</div>');
              unset($_POST['tanggalProject'.strval($i+1)]);
              break;
            }
          }
        }
      }
    }

    for ($i=1; $i <= $banyakFase ; $i++) {
      $this->form_validation->set_rules('instruksiProject'.$i,"Instruksi","required|trim");
      $this->form_validation->set_rules('batasAwal'.$i,"Batas Awal","required|trim");
      $this->form_validation->set_rules('tanggalProject'.$i,"Batas Akhir","required|trim");
    }

    if ($this->form_validation->run()==false) {
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('project/edit_project',$data);
      $this->load->view('templates/footer');
    }else{
      $judul = $this->input->post('judul');
      $kelas = $this->input->post('kelas');
      $data = [
                'nama_project'=>$judul,
                'kelas' => $kelas
              ];
      $this->M_Universal->update('id',$idProject,'project',$data);

      $pertanyaanDasar  = $this->M_Project->getPertanyaanDasar($idProject);
      $banyakSoal       = count($pertanyaanDasar);

      for ($i=1; $i <= $banyakSoal; $i++) {
        $data = [
          'pertanyaan' =>$this->input->post('judulPertanyaan'.$i)
        ];
        $this->M_Universal->update('id',$pertanyaanDasar[$i-1]['id'],'pertanyaan_dasar',$data);

        $jawabanPG = array();
        for ($j=0; $j < $banyakSoal ; $j++) {
          array_push($jawabanPG,$this->M_Project->getPGDasar($pertanyaanDasar[$j]['id']));
        }

        $data = [
          'jawaban' => $this->input->post('jawabanA'.$i),
          'correct' => 0
        ];
        $this->M_Universal->update('id',$jawabanPG[$i-1][0]['id'],'pg_dasar',$data);

        $data = [
          'jawaban' => $this->input->post('jawabanB'.$i),
          'correct' => 0
        ];
        $this->M_Universal->update('id',$jawabanPG[$i-1][1]['id'],'pg_dasar',$data);

        $data = [
          'jawaban' => $this->input->post('jawabanC'.$i),
          'correct' => 0
        ];
        $this->M_Universal->update('id',$jawabanPG[$i-1][2]['id'],'pg_dasar',$data);

        $data = [
          'jawaban' => $this->input->post('jawabanD'.$i),
          'correct' => 0
        ];
        $this->M_Universal->update('id',$jawabanPG[$i-1][3]['id'],'pg_dasar',$data);

        $this->M_Project->updateJawaban((int)$pertanyaanDasar[$i-1]['id'],$this->input->post('correct'));
      }

      $kelompok       = $this->M_Project->getKelompok($idProject);
      $banyakKelompok = count($kelompok);

      for ($i=1; $i <= $banyakKelompok ; $i++) {
        $data = [
          'username' => $this->input->post('usernameKel'.$i),
          'password' => base64_encode($this->input->post('passwordKel'.$i)),
          'anggota' => $this->input->post('anggotaKel'.$i)
        ];
        $this->M_Universal->update('id',$kelompok[$i-1]['id'],'kelompok',$data);
      }

      $fase           = $this->M_Project->getFase($idProject);
      $banyakFase     = count($fase);

      for ($i=1; $i <= $banyakFase ; $i++) {
        $uploadBahan = $_FILES['bahanProject'.$i]['name'];
        $this->db->set('instruksi',$this->input->post('instruksiProject'.$i));
        if ($uploadBahan) {
          $config['allowed_types'] = 'doc|docx|pdf|ppt|pptx|jpg|png|jpeg';
          $config['max_width'] = '5120';
          $config['upload_path'] = './assets/bahan_project/';

          $this->load->library('upload', $config);

          if ($this->upload->do_upload('bahanProject'.$i)) {
            $oldBahan = $fase[$i-1]['bahan'];
            unlink(FCPATH . 'assets/bahan_project/'.$oldBahan);

            $bahan = $this->upload->data('file_name');
            $this->db->set('bahan',$bahan);
            }else {
              echo $this->upload->display_errors();
            }
        }
        $this->db->set('startline',$this->input->post('batasAwal'.$i));
        $this->db->set('deadline',$this->input->post('tanggalProject'.$i));
        $this->db->where('id',$fase[$i-1]['id']);
        $this->db->update('fase_project');
      }

      redirect('Project/lihat_project/'.$idProject);

    }
  }

  public function lihat_project($idProject){
    $data['menu']           = "project";
    $data['title']          = "Lihat Project";
    $data['user']           = $this->M_Login->login($this->session->userdata('username'));
    $data['project']        = $this->M_Project->lihatProject($idProject);
    $data['pertanyaanDasar']= $this->M_Project->getPertanyaanDasar($idProject);

    $data['banyakSoal']     = count($data['pertanyaanDasar']);

    $data['jawabanPG'] = array();
    for ($i=0; $i < $data['banyakSoal'] ; $i++) {
      array_push($data['jawabanPG'],$this->M_Project->getPGDasar($data['pertanyaanDasar'][$i]['id']));
    }

    $data['kelompok']       = $this->M_Project->getKelompok($idProject);
    $data['banyakKelompok'] = count($data['kelompok']);

    $data['fase']           = $this->M_Project->getFase($idProject);
    $data['banyakFase']     = count($data['fase']);


    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('project/lihat_project',$data);
    $this->load->view('templates/footer');
  }

  public function kelompok($idProject)
  {
    $data['menu']   = "project";
    $data['user']           = $this->M_Login->login($this->session->userdata('username'));
    $data['project']        = $this->M_Project->lihatProject($idProject);
    $data['title']          = "Kelompok PJBL <br>"."(".$data['project']['nama_project'].")";

    $data['kelompok']       = $this->M_Project->getKelompok($idProject);
    $data['banyakKelompok'] = count($data['kelompok']);


    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('project/kelompok',$data);
    $this->load->view('templates/footer');
  }

  public function jawaban_kelompok($idKelompok){
    $data['menu']           = "project";
    $data['title']          = "Jawaban Kelompok";
    $data['user']           = $this->M_Login->login($this->session->userdata('username'));
    $data['kelompok']       = $this->M_Project->getKelompokById($idKelompok);
    $data['project']        = $this->M_Project->lihatProject($data['kelompok']['id_project']);

    $data['nilaiKelompok']  = $this->M_Project->getNilaiKelompok($idKelompok);
    $data['jawabanFase']    = $this->M_Siswa->jawabanFase($data['kelompok']['id_project'],$idKelompok);
    $data['fase']           = $this->M_Project->getFase($data['kelompok']['id_project']);
    $data['banyakFase']     = count($data['fase']);

    $evalFase               = $this->M_Project->getEval($idKelompok);
    if ($evalFase) {
      $data['evalFase']     = $evalFase;
    }else{
      $data['evalFase']     = "-";
    }

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('project/jawaban_kelompok',$data);
    $this->load->view('templates/footer');
  }

  public function input_nilai_fase($fase,$idKelompok)
  {
    $nilai = $this->input->post('nilaiFase'.$fase);
    $this->M_Project->inputNilaiFase($fase,$idKelompok,$nilai);
    $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Berhasil Mengisi Nilai Fase</div>');
    redirect('project/jawaban_kelompok/'.$idKelompok);
  }

  public function edit_nilai_fase($fase,$idKelompok)
  {
    $nilai = $this->input->post('editNilai'.$fase);
    $this->M_Project->editNilaiFase($fase,$idKelompok,$nilai);
    $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Berhasil Mengubah Nilai Fase</div>');
    redirect('project/jawaban_kelompok/'.$idKelompok);
  }

  public function input_nilai_evaluasi($fase,$idKelompok)
  {
    $nilai = $this->input->post('evaluasiFase'.$fase);
    $this->M_Project->inputEvalFase($fase,$idKelompok,$nilai);
    $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Berhasil Mengisi Evaluasi Fase</div>');
    redirect('project/jawaban_kelompok/'.$idKelompok);
  }

  public function edit_evaluasi_fase($fase,$idKelompok)
  {
    $nilai = $this->input->post('editEvaluasiFase'.$fase);
    $this->M_Project->editEvalFase($fase,$idKelompok,$nilai);
    $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Berhasil Mengubah Evaluasi Fase</div>');
    redirect('project/jawaban_kelompok/'.$idKelompok);
  }


}
