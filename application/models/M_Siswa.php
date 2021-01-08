

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Siswa extends CI_model {

  public function getQuestion($idProject,$username){
    return $this->db->query(
    "SELECT *
    FROM kelompok
    INNER JOIN project
    ON kelompok.id_project = project.id
    INNER JOIN pertanyaan_dasar
    ON project.id = pertanyaan_dasar.id_project
    WHERE kelompok.id_project=$idProject and kelompok.username = '$username'")->result_array();
  }

  public function getAnswer($idPertanyaan){
    $idPertanyaan = (int)$idPertanyaan;

    return $this->db->query("SELECT * FROM `pg_dasar` WHERE id_pertanyaan = $idPertanyaan")->result_array();

    // return $this->db->get_where('pg_dasar', ['id_pertanyaan' => $idPertanyaan])->result_array();
  }

  public function getCorrectAnswer($idPertanyaan){
    $idPertanyaan = (int)$idPertanyaan;
    return $this->db->query("SELECT * FROM `pg_dasar` WHERE id_pertanyaan = $idPertanyaan and correct = 1")->row_array();
  }

  public function inputNilai($idProject,$idKelompok,$column,$nilai){
    $data = array(
      'id_project' => $idProject,
      'id_kelompok' => $idKelompok,
      $column => $nilai
    );
    $this->db->insert('nilai_kelompok',$data);
  }

  public function inputJawabanPG($idKelompok,$idPertanyaan,$jawaban){
    $data = array(
      'id_kelompok' => $idKelompok,
      'id_pertanyaan' => $idPertanyaan,
      'id_jawaban_pg' => $jawaban,
    );
    $this->db->insert('jawaban_pg',$data);
  }

  public function getNilai($idProject,$idKelompok){
    return $this->db->get_where('nilai_kelompok',['id_project'=>$idProject,'id_kelompok'=>$idKelompok])->row_array();
  }

  public function countFase($idProject){
    $query = "SELECT COUNT(fase) FROM fase_project WHERE id_project = $idProject";
    $result =  $this->db->query($query)->row_array();
    return $result['COUNT(fase)'];
    // $this->db->where('id_project', $idProject);
    // return $this->db->count_all('fase_project');
  }

  // public function fase($idProject){
  //   $idProject = (int)$idProject;
  //   $query = "SELECT * FROM fase_project WHERE id_project = $idProject";
  //   return $this->db->query($query)->result_array();
  // }
  public function fase($idProject)
  {
    $idProject = (int)$idProject;
    return $this->db->get_where('fase_project',array('id_project'=>$idProject))->result_array();
  }
  public function getFase($idProject,$fase){
    $query = "SELECT * FROM fase_project WHERE id_project = $idProject and fase = $fase";
    return $this->db->query($query)->row_array();
  }

  public function jawabanFase($idProject,$idKelompok){
    $idProject = (int)$idProject;
    $idKelompok = (int)$idKelompok;

    $query = "SELECT * FROM jawaban_fase where id_project = $idProject and id_kelompok = $idKelompok";
    return $this->db->query($query)->result_array();
  }


  public function getJawabanFase($idProject,$idKelompok,$fase){
    $idProject = (int)$idProject;
    $idKelompok = (int)$idKelompok;
    $query = "SELECT * FROM jawaban_fase where id_project = $idProject and id_kelompok = $idKelompok and fase = $fase";
    return $this->db->query($query)->row_array();
  }

  public function deleteJawabanFase($idKelompok,$idProject,$fase)
  {
    $query = "DELETE FROM jawaban_fase WHERE id_project = $idProject and id_kelompok = $idKelompok and fase = $fase";
    $this->db->query($query);
  }

  public function getJawabanPG($idKelompok)
  {
    $query = "SELECT * FROM jawaban_pg WHERE id_kelompok = $idKelompok";
    return $this->db->query($query)->result_array();
  }

  public function getGuru($idProject)
  {
    $guru = $this->db->get_where('project',['id'=>$idProject])->row_array();
    return $this->db->get_where('users',['id'=>$guru['id_user']])->row_array();
  }

}


/*
SELECT *
FROM kelompok
INNER JOIN project
ON kelompok.id_project = project.id
INNER JOIN pertanyaan_dasar
ON project.id = pertanyaan_dasar.id_project
INNER JOIN pg_dasar
ON pertanyaan_dasar.id = pg_dasar.id_pertanyaan WHERE kelompok.id_project=$idProject and kelompok.username = '$username'
*/
