<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Login extends CI_Controller {
	
	public function index()
	{	
		$username = $this->session->userdata('ex_nik');		
		if(!empty($username)){
			redirect('app');
		} else {
			$this->load->view('data/login_template');
		}
	}
	

	function checkLogin(){
		$username = $this->input->post('username', TRUE);
		$check_user = $this->Madminuser->check_user();
		if($check_user==1){
			$get_user = $this->Madminuser->getUser($username);
			foreach($get_user as $dt){
				$nik = $dt->nik;
				$level = $dt->level;
				$iduser = $dt->iduser;
			}
			$usersession = array(
				'ex_nik'  => $nik,
				'ex_level'  => $level,
				'ex_id'  => $iduser,
			);
			$this->session->set_userdata($usersession);
			redirect('app');
		}else{
			echo 'Username 0r password Error';
		}
		
        
    }


	function logout(){
		$this->session->unset_userdata('ex_nik');
		$this->session->unset_userdata('ex_level');
		$this->session->unset_userdata('ex_id');
		redirect('/');
	}

	

	


	
}
