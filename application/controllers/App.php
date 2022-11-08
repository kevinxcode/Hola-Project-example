<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	function __construct() {
		date_default_timezone_set('Asia/Jakarta');
		parent::__construct();
		
	}

	function index(){	
		$username = $this->session->userdata('ex_nik');		
		$data['nik_session'] = $username;
		if(!empty($username))
		{
			$data['list'] = $this->Mdata->get_employee();
			$this->load->view('data/index_header_template', $data);
			$this->load->view('data/home_template', $data);
			$this->load->view('data/index_footer_template', $data);
		} else {
			redirect('login');
		}
	}

	function addEmployee(){
		$nik = $this->input->post('nik', TRUE);
		$name = $this->input->post('name', TRUE);
		$dept = $this->input->post('dept', TRUE);
		$jab = $this->input->post('jab', TRUE);
		$data = array(
			'nik' => $nik,
			'name' => $name,
			'dept' => $dept,
			'jab' => $jab,
		);

		$this->db->insert('hola.tes_employee', $data);
		redirect('app');
	}

	function editEmployee(){
		$id = $this->input->post('id', TRUE);
		$nik = $this->input->post('nik', TRUE);
		$name = $this->input->post('name', TRUE);
		$dept = $this->input->post('dept', TRUE);
		$jab = $this->input->post('jab', TRUE);
		$data = array(
			'nik' => $nik,
			'name' => $name,
			'dept' => $dept,
			'jab' => $jab,
		);

		$this->db->where('id', $id);
		$this->db->update('hola.tes_employee', $data);
		redirect('app');
	}

	function delEmployee($id){
		$this->db->where('id', $id);
		$this->db->delete('hola.tes_employee');
		redirect('app');
	}

	function editEmView(){
		$id = $this->input->post('id', TRUE);
		$list = $this->Mdata->getEditemployee($id);
		?>
		<?php foreach($list as $value): ?>
		<form action="<?php echo prefix_url;?>app/editEmployee" method="POST">
		<input type="hidden" class="form-control" name="id" value="<?php echo $value->id; ?>">
       <div class="form-group">
         <label for="email">NIK:</label>
         <input type="text" class="form-control" name="nik" value="<?php echo $value->nik; ?>">
       </div>

       <div class="form-group">
         <label for="email">Name:</label>
         <input type="text" class="form-control" name="name" value="<?php echo $value->name; ?>">
       </div>

       <div class="form-group">
         <label for="email">Dept:</label>
         <input type="text" class="form-control" name="dept" value="<?php echo $value->dept; ?>">
       </div>

       <div class="form-group">
         <label for="email">Position:</label>
         <input type="text" class="form-control" name="jab" value="<?php echo $value->jab; ?>">
       </div>

       <button type="submit" class="btn btn-default">Submit</button>
      </form>
	  <?php endforeach; ?>
		<?php
	}


	

	


	
}
