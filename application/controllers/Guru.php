<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {
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
      }

	public function index()
	{
    $data['menu']   = "dashboard";
    $data['title']  = "Dashboard";
    $data['user']   = $this->M_Login->login($this->session->userdata('username'));
    $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar',$data);
      $this->load->view('templates/topbar',$data);
      $this->load->view('guru/index',$data);
      $this->load->view('templates/footer');
	}

  public function profile(){
    $data['menu']   = "profile";
    $data['title'] = "Profile";
    $data['user'] = $this->M_Login->login($this->session->userdata('username'));

    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar',$data);
    $this->load->view('templates/topbar',$data);
    $this->load->view('guru/profile',$data);
    $this->load->view('templates/footer');
  }

  public function editprofile(){
    $data['menu']   = "profile";
      $this->form_validation->set_rules('nama',"Name","required|trim");

      if ($this->form_validation->run()==false) {
        $data['title'] = "Edit";
        $data['user'] = $this->M_Login->login($this->session->userdata('username'));
        $this->load->view('templates/header',$data);
          $this->load->view('templates/sidebar',$data);
          $this->load->view('templates/topbar',$data);
          $this->load->view('guru/edit',$data);
          $this->load->view('templates/footer');
      }else{
        $user = $this->M_Guru->getId($this->session->userdata('username'));
        $nama = htmlspecialchars($this->input->post('nama',true));
        $notelp = htmlspecialchars($this->input->post('notelp',true));
        $this->M_Guru->updateProfile($nama,$user['id']);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Profile Has Been Change</div>');
        redirect('guru/profile');

      }
  }

  public function changepassword(){
    $data['menu']   = "password";
    $data['title'] = "Ganti Password";
    $data['user'] = $this->M_Login->login($this->session->userdata('username'));

    $this->form_validation->set_rules('passwordlama','Password','trim|required');
    $this->form_validation->set_rules('password1','Password','trim|required|min_length[3]|matches[password2]');
    $this->form_validation->set_rules('password2','Password','trim|required|min_length[3]|matches[password1]');
      if ($this->form_validation->run()==false) {
        $data['title'] = "Change Password";

        $this->load->view('templates/header',$data);
          $this->load->view('templates/sidebar',$data);
          $this->load->view('templates/topbar',$data);
        $this->load->view("guru/change-password");
        $this->load->view('templates/footer');
      }else{
        $passwordlama = htmlspecialchars($this->input->post('passwordlama',true));

        if (password_verify($passwordlama,$data['user']['password'])) {
            $password = password_hash($this->input->post('password1'),PASSWORD_DEFAULT);
            $username = $this->session->userdata('username');
            $this->M_Guru->changePassword($password,$username);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password Has Been Change</div>');

            redirect('guru/changepassword');

        }else {
          $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Old Password Not Same</div>');
          redirect('guru/changepassword');
        }

      }
  }
}
