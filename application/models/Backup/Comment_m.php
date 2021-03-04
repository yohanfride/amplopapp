<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class comment_m extends My_Model{

	function __construct() {
		parent::__construct();
	}	
	
	function get_comment($id){		
		$sql = "SELECT a.*,b.idgroups,b.username,b.name from comment a join user b on a.iduser = b.id WHERE a.idcomment=$id";
		$res = $this->db->query($sql);
		$r=$res->row();
		$res->free_result();
		return $r;
	}

	function all_comment($id){				
		$sql = "SELECT a.*,b.idgroups,b.username,b.name from comment a join user b on a.iduser = b.id WHERE a.idpost=$id 		
				Order By a.idcomment ASC";
		$res = $this->db->query($sql);
		$r=$res->result();
		$res->free_result();
		return $r;
	}
	
	function all_post($lastid=0,$lim=5){		
		if(empty($lim)) $lim = 5;
		$sql = "SELECT a.*,f.idgroups,f.username,f.name,(SELECT count(*) from comment b where a.idpost = b.idpost) as total_coment
		,(SELECT count(*) from love c where a.idpost = c.idpost and status=1) as total_love
		,(SELECT count(*) from love d where a.idpost = d.idpost and status=0) as total_dislike
		,(SELECT count(*) from bookmark e where a.idpost = e.idpost) as total_bookmark
		from post a join user f on a.iduser = f.id ";
		if(!empty($lastid)){
			$sql.=" WHERE idpost < $lastid";
		}
		$sql.="  GROUP BY a.idpost Order By a.idpost DESC LIMIT $lim";
		$res = $this->db->query($sql);
		$r=$res->result();
		$res->free_result();
		return $r;
	}
		
	function cekcomment($user,$id){
		$res = $this->db->query("SELECT * FROM comment a join user b on a.iduser = b.id WHERE idcomment=$id AND username='$user'");
		$r = $res->num_rows();
		$res->free_result();
		return $r;
	}
		

}

/* End of file admin_model.php */
/* Location: ./application/models/admin_Model.php */
