
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Guru extends CI_model {

  public function getId($username){
      return $this->db->get_where('users',['username' => $username])->row_array();
  }

  public function updateProfile($nama,$notelp,$id){
    $this->db->set('nama',$nama);
    $this->db->set('notelp',$notelp);
    $this->db->where('id',$id);
    $this->db->update('users');
  }

  public function changePassword($password,$username){
    $this->db->set('password',$password);
    $this->db->where('username',$username);
    $this->db->update('users');
  }


}
