<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class bookmark_m extends My_Model{

	function __construct() {
		parent::__construct();
	}	
	
	function get_lov_post($id){		
		$sql = "SELECT count(*) as total from bookmark where idpost = $id ";
		$res = $this->db->query($sql);
		$r=$res->row()->total;
		$res->free_result();
		return $r;
	}
	
	function cekbookmark($user,$id){
		$res = $this->db->query("SELECT a.* FROM bookmark a join user b on a.iduser = b.id WHERE idpost=$id AND username='$user'");
		$r = $res->row();
		$res->free_result();
		return $r;
	}	
	
	function user($id){
		$sql = "SELECT a.*,f.idgroups,f.username,f.name as name_user, f.picture as picture_user,(SELECT count(*) from comment b where a.idpost = b.idpost) as total_coment
		,(SELECT count(*) from love c where a.idpost = c.idpost and status=1) as total_love
		,(SELECT count(*) from love d where a.idpost = d.idpost and status=0) as total_dislike
		,(SELECT count(*) from bookmark e where a.idpost = e.idpost) as total_bookmark
		from post a join user f on a.iduser = f.id join bookmark b on a.idpost = b.idpost WHERE b.iduser=$id";		
		$sql.="  GROUP BY a.idpost Order By a.idpost DESC";
		$res = $this->db->query($sql);
		$r = $res->result();
		$res->free_result();
		return $r;
	}	

}

/* End of file admin_model.php */
/* Location: ./application/models/admin_Model.php */
