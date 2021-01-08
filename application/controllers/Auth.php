<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
  public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_Login');
        $this->load->model('M_Universal');
      }

  public function login(){
    if ($this->session->userdata('username')) {
      redirect($this->session->userdata('role'));
    }
    $data['title'] = "Login";
    $this->load->view('templates/auth_header',$data);
    $this->load->view("auth/landing_page");
    $this->load->view('templates/auth_footer');
  }

  public function registration(){
    if ($this->session->userdata('username')) {
      redirect($this->session->userdata('role'));
    }

    $this->form_validation->set_rules('name',"Name","required|trim");
    $this->form_validation->set_rules('notelp',"NoTelp","required|trim");
    $this->form_validation->set_rules('email',"Email","required|trim|valid_email|is_unique[users.email]",['is_unique' => 'This Email Has Already Registered ']);
    $this->form_validation->set_rules('username',"Username","required|trim|is_unique[users.username]",['is_unique' => 'This Username Has Already Registered ']);
    $this->form_validation->set_rules('password1',"Password","required|trim|min_length[8]|matches[password2]",[
            'matches' =>'password dont match!',
            'min_length'=>'Password to Short!'
            ]);
    $this->form_validation->set_rules('password2',"Password","required|trim|matches[password1]");

    if ($this->form_validation->run()==false) {
      $data['title'] = "Registrasi";
      $this->load->view('templates/auth_header',$data);
      $this->load->view("auth/registration");
      $this->load->view('templates/auth_footer');
    }else{
      $data = [
        'nama'    =>htmlspecialchars($this->input->post('name',true)),
        'email'   =>htmlspecialchars($this->input->post('email',true)),
        'username'=>htmlspecialchars($this->input->post('username',true)),
        'notelp'=>htmlspecialchars($this->input->post('notelp',true)),
        'password'=>password_hash($this->input->post('password1'),PASSWORD_DEFAULT),

      ];

      $this->M_Universal->insert('users',$data);
      $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Success Registration</div>');
      redirect('auth/login_guru');
    }
  }

	public function login_guru(){
    if ($this->session->userdata('username')) {
      redirect($this->session->userdata('role'));
    }
    $this->form_validation->set_rules('username','Username','trim|required');
    $this->form_validation->set_rules('password','Password','trim|required');

    if ($this->form_validation->run()==false) {
      $data['title'] = "Guru Login";
          $this->load->view('templates/auth_header',$data);
          $this->load->view("auth/login_guru");
          $this->load->view('templates/auth_footer');
    }else{
      $email = $this->input->post('username');
      $password = $this->input->post('password');

      $user = $this->M_Login->login($email);

      if ($user) {
        if (password_verify($password,$user['password'])) {
          $data = [
                  'username' => $user['username'],
                  'role' => 'guru'
                  ];
          $this->session->set_userdata($data);
          redirect('guru');
        }else{
          $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong Password</div>');
          redirect('auth/login_guru');
        }
      }else{
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Username Is Not Registered</div>');
        redirect('auth/login_guru');
      }
    }
	}

  public function login_siswa(){
    if ($this->session->userdata('username')) {
      redirect($this->session->userdata('role'));
    }
    $this->form_validation->set_rules('username','Username','trim|required');
    $this->form_validation->set_rules('password','Password','trim|required');

    if ($this->form_validation->run()==false) {
      $data['title'] = "Siswa Login";
      $this->load->view('templates/auth_header',$data);
      $this->load->view("auth/login_siswa");
      $this->load->view('templates/auth_footer');
    }else{
      $username = $this->input->post('username');
      $password = base64_encode($this->input->post('password'));

      $user = $this->M_Login->login_siswa($username);

      if ($user) {
        if ($password == $user['password']) {
          $data = [
                  'username' => $user['username'],
                  'role' => "siswa"
                  ];
          $this->session->set_userdata($data);
          redirect('siswa');
        }else{
          $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong Password (if you forget, contact your teacher)</div>');
          redirect('auth/login_siswa');
        }
      }else{
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Username Is Not Registered (if you forget, contact your teacher)</div>');
        redirect('auth/login_siswa');
      }
    }
	}

  private function _sendEmail($token){
      $config=[
        'protocol'    => 'smtp',
        'smtp_host'   => 'ssl://smtp.googlemail.com',
        'smtp_user'   => 'arifinucuptole@gmail.com',
        'smtp_pass'   => 'arifinucuptole123',
        'smtp_port'   =>  465,
        'mailtype'    => 'html',
        'charset'     => 'urf-8',
        'newline'    => "\r\n"
      ];

      $this->load->library('email',$config);
      $this->email->initialize($config);

      $this->email->from('arifinucuptole@gmail.com','Chandra Muhamad Apriana');
      $this->email->to($this->input->post('email'));

      $this->email->subject('Reset Password');
      $this->email->message('Click this link to reset your password : <a href=" ' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"> Reset Password </a>');


      if ($this->email->send()) {
        return true;
      }else{
        echo $this->email->print_debugger();
        die;
      }
    }

  public function forgotPassword(){

      $this->form_validation->set_rules('email','Email','trim|required|valid_email');

      if ($this->form_validation->run()==false) {
        $data['title'] = "Forgot Password";
        $this->load->view('templates/auth_header',$data);
        $this->load->view("auth/forgot-password");
        $this->load->view('templates/auth_footer');
      }else{
        $email = $this->input->post('email');
        $user = $this->db->get_where('users',['email' => $email])->row_array();

        if ($user) {
          $token = base64_encode(random_bytes(32));
          $user_token = [
            'email' => $email,
            'token' => $token,
            'date' => time()
          ];

          $this->db->insert('user_token',$user_token);
          $this->_sendEmail($token);
          $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Please Cek Email To Reset Password</div>');
          redirect('auth/forgotpassword');

        }else{
          $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email Not Registered</div>');
          redirect('auth/forgotpassword');
        }
      }
  }

  public function resetpassword(){
      $email = $this->input->get('email');
      $token = $this->input->get('token');

      $user = $this->db->get_where('users',['email'=>$email])->row_array();

      if ($user) {
        $user_token = $this->db->get_where('user_token',['token' => $token])->row_array();
        if ($user_token) {
          $this->session->set_userdata('reset_email',$email);
          $this->changePassword();
        }else{
          $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Reset Password Failed Wrong Token</div>');
          redirect('auth');
        }
      }else{
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Reset Password Failed Wrong Email</div>');
        redirect('auth');
      }
    }

    public function changepassword(){
      if (!$this->session->userdata('reset_email')) {
        redirect('auth');
      }
      $this->form_validation->set_rules('password1','Password','trim|required|min_length[3]|matches[password2]');
      $this->form_validation->set_rules('password2','Password','trim|required|min_length[3]|matches[password1]');
      if ($this->form_validation->run()==false) {
        $data['title'] = "Change Password";
        $this->load->view('templates/auth_header',$data);
        $this->load->view("auth/change-password");
        $this->load->view('templates/auth_footer');
      }else{
        $password = password_hash($this->input->post('password1'),PASSWORD_DEFAULT);
        $email = $this->session->userdata('reset_email');
        $this->db->set('password',$password);
        $this->db->where('email',$email);
        $this->db->update('users');

        $this->session->unset_userdata('reset_email');

        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password Has Been Change</div>');
        redirect('auth/login_guru');

      }
    }


  public function logout(){
    $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Success Logout</div>');
    $this->session->unset_userdata('username');
    redirect('auth/login');

  }

}
