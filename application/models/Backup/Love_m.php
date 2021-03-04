<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class love_m extends My_Model{

	function __construct() {
		parent::__construct();
	}	
	
	function get_lov_post($id,$t=1){		
		$sql = "SELECT count(*) as total from love where idpost = $id  and status=$t";
		$res = $this->db->query($sql);
		$r=$res->row()->total;
		$res->free_result();
		return $r;
	}
	
	function ceklove($user,$id){
		$res = $this->db->query("SELECT a.* FROM love a join user b on a.iduser = b.id WHERE idpost=$id AND username='$user'");
		$r = $res->row();
		$res->free_result();
		return $r;
	}	

}

/* End of file admin_model.php */
/* Location: ./application/models/admin_Model.php */
