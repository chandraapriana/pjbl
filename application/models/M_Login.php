
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Login extends CI_model {

  public function login($username){
    return $this->db->get_where('users',['username'=>$username])->row_array();
  }

  public function login_siswa($username){
    return $this->db->get_where('kelompok',['username'=>$username])->row_array();
  }

}
