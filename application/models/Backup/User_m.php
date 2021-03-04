<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class user_m extends My_Model{

	function __construct() {
		parent::__construct();
	}	
	
	function cek_email($email,$id){
		$sql = "SELECT * FROM user WHERE (email='$email' ) AND id <> $id";
		$res = $this->db->query($sql);
		$r=$res->num_rows();
		return $r;
	}
	
	function cek_username($user,$id){
		$sql = "SELECT * FROM user WHERE (username='$user' ) AND id <> $id";
		$res = $this->db->query($sql);
		$r=$res->num_rows();
		return $r;
	}
	
	function cek_pass($pass,$id){
		$sql = "SELECT * FROM user WHERE password='$pass' AND username = '$id'";
		$res = $this->db->query($sql);
		$r=$res->num_rows();
		return $r;
	}
	
	function get_user($user){
		$sql = "SELECT id,username,email,name,dateadd,birth,picture,gender,status_message,picture  
				,(SELECT count(*)  from bookmark a join user b on a.iduser  = b.id where username = '$user') as total_bookmark
				,(SELECT count(*)  from friend where username1 = '$user') as total_following
				,(SELECT count(*)  from friend where username2 = '$user') as total_follower
				FROM user WHERE username ='$user'";
		$res = $this->db->query($sql);
		$r='';
		if ($res->num_rows() > 0) {
            $r = $res->row();
        }else {
        	$r = false;
        }
		return $r;
	}
	
	function get_user_id($id){
		$sql = "SELECT id,username,email,name,dateadd,birth,picture,gender,status_message,picture FROM user WHERE id = $id";
		$res = $this->db->query($sql);
		$r='';
		if ($res->num_rows() > 0) {
            $r = $res->row();
        }else {
        	$r = false;
        }
		return $r;
	}
	
	function get_user_loc($id){
		$sql = "SELECT latitude,longitude FROM user WHERE id = $id";
		$res = $this->db->query($sql);
		$r='';
		if ($res->num_rows() > 0) {
            $r = $res->row();
        }else {
        	$r = false;
        }
		return $r;
	}
}


/* End of file admin_model.php */
/* Location: ./application/models/admin_Model.php */
