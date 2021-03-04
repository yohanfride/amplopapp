<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class group_m extends My_Model{

	function __construct() {
		parent::__construct();
	}	
	
	function get_group($user){
		$sql = "SELECT a.idgroup,a.group,a.dateadd,COUNT(a.idgroup) AS jumlah FROM groups a  join group_member b on a.idgroup = b.idgroup  
				WHERE username ='$user' GROUP BY a.idgroup";
		$res = $this->db->query($sql);
		$r=$res->result();
		$res->free_result();
		return $r;
	}

	
	function get_member_group($id){
		$res = $this->db->query("SELECT a.username,password,email,name,b.status,birth,picture,gender,mydevice,status_message
				FROM group_member a join user b on a.username = b.username WHERE idgroup=$id");
		$r = $res->result();
		$res->free_result();
		return $r;
	}
	
	function cekGroup($user,$group){
		$res = $this->db->query("SELECT * FROM group_member WHERE idgroup=$group AND username='$user'");
		$r = $res->num_rows();
		$res->free_result();
		return $r;
	}
	
	function del($user,$group){
		return  $this->db->query("DELETE  FROM group_member WHERE idgroup=$group AND username='$user'");		
	}

}

/* End of file admin_model.php */
/* Location: ./application/models/admin_Model.php */
