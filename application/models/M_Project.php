
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Project extends CI_model {

  public function login($username){
    return $this->db->get_where('users',['username'=>$username])->row_array();
  }

  public function getIdProject($data){
    return $this->db->get_where('project',['nama_project'=>$data])->row_array();
  }

  public function updateJawaban($idPertanyaan,$pilihan){
    $this->db->set('correct',1);
    $this->db->where('id_pertanyaan',$idPertanyaan);
    $this->db->where('pilihan',$pilihan);
    $this->db->update('pg_dasar');
  }

  public function getProject($kelas,$id_user){
    return $this->db->get_where('project', ['id_user' => $id_user,'kelas'=> $kelas])->result_array();
  }

  public function cekProject($kelas,$id_user,$judul){
    return $this->db->get_where('project', ['id_user' => $id_user,'nama_project'=>$judul,'kelas'=> $kelas])->row_array();
  }

  public function lihatProject($idProject){
    return $this->db->get_where('project', ['id' => $idProject])->row_array();
  }

  public function getPertanyaanDasar($idProject)
  {
    return $this->db->get_where('pertanyaan_dasar', ['id_project' => $idProject])->result_array();
  }

  public function getPGDasar($idPertanyaan)
  {
    return $this->db->get_where('pg_dasar', ['id_pertanyaan' => $idPertanyaan])->result_array();
  }

  public function getKelompok($idProject)
  {
    return $this->db->get_where('kelompok', ['id_project' => $idProject])->result_array();
  }

  public function getFase($idProject)
  {
    return $this->db->get_where('fase_project', ['id_project' => $idProject])->result_array();
  }

  public function getJawabanFaseByIdProject($idProject)
  {
    return $this->db->get_where('jawaban_fase', ['id_project' => $idProject])->result_array();
  }

  public function listKelas($idUser){
    $query = "SELECT kelas, COUNT(DISTINCT kelas) FROM project WHERE id_user = $idUser GROUP BY kelas";
    return $this->db->query($query)->result_array();
  }


  public function deleteProject($idProject){
    $this->db->query("DELETE FROM nilai_kelompok WHERE id_project =$idProject");
    $this->db->query("DELETE FROM jawaban_fase WHERE id_project = $idProject");
    $this->db->query("DELETE FROM fase_project WHERE id_project = $idProject");

    $jawabanKelompokPG = $this->db->query("SELECT * FROM kelompok WHERE id_project = $idProject")->result_array();

    for ($i=0; $i <count($jawabanKelompokPG) ; $i++) {
      $idKelompok = (int)$jawabanKelompokPG[$i]['id'];
      $this->db->query("DELETE FROM jawaban_pg WHERE id_kelompok = $idKelompok");
    }

    $pgDasar = $this->db->query("SELECT * FROM pertanyaan_dasar WHERE id_project = $idProject")->result_array();
    for ($i=0; $i <count($pgDasar) ; $i++) {
      $idPertanyaan = (int)$pgDasar[$i]['id'];
      $this->db->query("DELETE FROM pg_dasar WHERE id_pertanyaan = $idPertanyaan");
    }

    $this->db->query("DELETE FROM kelompok WHERE id_project = $idProject");
    $this->db->query("DELETE FROM pertanyaan_dasar WHERE id_project = $idProject");
    $this->db->query("DELETE FROM project WHERE id = $idProject");

  }

  public function getKelompokById($idKelompok)
  {
    $query = "SELECT * FROM kelompok WHERE id = $idKelompok";
    return $this->db->query($query)->row_array();
  }

  public function getNilaiKelompok($idKelompok)
  {
    $query = "SELECT * FROM nilai_kelompok WHERE id_kelompok = $idKelompok";
    return $this->db->query($query)->row_array();
  }

  public function inputNilaiFase($fase,$idKelompok,$nilai)
  {
    $nilai = (int)$nilai;
    $this->db->set('nilai_fase_'.$fase, $nilai);
    $this->db->where('id_kelompok', $idKelompok);
    $this->db->update('nilai_kelompok');
  }

  public function editNilaiFase($fase,$idKelompok,$nilai)
  {
    $nilai = (int)$nilai;
    $this->db->set('nilai_fase_'.$fase, $nilai);
    $this->db->where('id_kelompok', $idKelompok);
    $this->db->update('nilai_kelompok');
  }

  public function inputEvalFase($fase,$idKelompok,$eval)
  {
    $data = array(
        'fase' => $fase,
        'id_kelompok' => $idKelompok,
        'evaluasi' => $eval
      );

      $this->db->insert('eval_fase', $data);
  }

  public function getEval($idKelompok)
  {
    $query = "SELECT * FROM eval_fase WHERE id_kelompok = $idKelompok";
    return $this->db->query($query)->result_array();
  }

  public function editEvalFase($fase,$idKelompok,$eval)
  {
    $array = array('fase'=>$fase,'id_kelompok'=>$idKelompok);
    $this->db->set('evaluasi', $eval);
    $this->db->where($array);
    
    $this->db->update('eval_fase');
    // $eval = strval($eval);
    // $fase = (int)$fase;
    // $query = "UPDATE eval_fase
    //           SET evaluasi = $eval
    //           WHERE fase = $fase and id_kelompok = $idKelompok";
    // $this->db->query($query);
  }

}
