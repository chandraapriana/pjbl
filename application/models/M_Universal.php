
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Universal extends CI_model {

  public function getAll(){

    return $this->db->query($query)->result_array();
  }

  public function getById($id){

  }

  public function insert($table,$data){
    $this->db->insert($table,$data);
  }

  public function update($pk,$id,$table,$data){
    $this->db->where($pk,$id);
    $this->db->update($table,$data);
  }

  public function delete(){

  }

}
