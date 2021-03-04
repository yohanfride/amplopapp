<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class auth_m extends My_Model{

	function __construct() {
		parent::__construct();
	}
	function cek_login($user,$pass){
		$sql = "SELECT username,password,email,a.name,dateadd,status,birth,picture,gender,status_message,b.id as idgroup,b.name as group_name FROM user a join groups b on a.idgroups = b.id WHERE (email='$user' AND password = '$pass' ) OR (username ='$user' AND password = '$pass' )";
		$res = $this->db->query($sql);
		$r='';
		if ($res->num_rows() > 0) {
            $r = $res->row();
        }else {
        	$r = false;
        }
		return $r;
	}
	
	function cek_email($email){
		$sql = "SELECT id FROM user WHERE (email='$email' )";
		$res = $this->db->query($sql);
		$r=$res->num_rows();
		return $r;
	}
	
	function cek_user($user){
		$sql = "SELECT id FROM user WHERE (username ='$user')";
		$res = $this->db->query($sql);
		$r=$res->num_rows();
		return $r;
	}

	
	function get_user_by_mail($email){
		$res = $this->db->query("SELECT username,password,email,name,dateadd,status,birth,picture,status_message FROM user WHERE email='$email'");
		$r = $res->row();
		$res->free_result();
		return $r;
	}

	function get_user($id){
		$res = $this->db->query("SELECT * FROM user WHERE id=$id");
		$r = $res->row();
		$res->free_result();
		return $r;
	}
	
	
	function cek_password($id='', $pass=''){
		$sql="SELECT COUNT(*) AS jumlah FROM user WHERE id=$id AND password='$pass' ";
		$q=$this->db->query($sql);
		$data = $q->row();
		$q->free_result();
		return $data->jumlah;
	}
	
	function cek_reset($email='', $token=''){
		$date = date("Y-m-d H:i:s");
		$sql="SELECT COUNT(*) AS jumlah FROM user WHERE email='$email' AND token='$token' AND token_expired>='$date'";
		$q=$this->db->query($sql);
		$data = $q->row();
		$q->free_result();
		return $data->jumlah;
	}

	function get_last_log($id=''){
		$sql="SELECT * FROM log_admin WHERE idadmin='$id' and status = 0 ORDER BY id DESC";
		$q=$this->db->query($sql);
		$data = $q->row();
		$q->free_result();
		return $data;
	}

	function update_log($id=''){
		$last_log = $this->get_last_log($id);
		if(!empty($last_log)){
			$insert = $this->update('log_admin','id',$last_log->id,array('status'=>1,'keluar'=>date('Y-m-d h:i:s')));
		}
	}

	function insert_log($id=''){
		$this->update_log($id);
		$insert = $this->insert('log_admin',array('idadmin'=>$id));
	}

}

/* End of file admin_model.php */
/* Location: ./application/models/admin_Model.php */
