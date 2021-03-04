<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class friend_m extends My_Model{

	function __construct() {
		parent::__construct();
	}	
	
	function get_friendlist($user){
		$sql = "SELECT * from friend where status = 1 AND (username1 = '$user' or username2 = '$user')";
		$res = $this->db->query($sql);
		$r=$res->result();
		$res->free_result();		
		$i=0;
		foreach($r as $d){			
			if(strtolower($d->username1) == strtolower($user)){
				$data[$i++] = $this->frienduser2($user,$d->username2);
			} else{
				$data[$i++] = $this->frienduser1($d->username1,$user);
			}						
		}
		if(empty($data))
			return false;		
		return $data;
		
	}

	function frienduser1($user,$user2){
		$res = $this->db->query("SELECT username,email,name,b.dateadd,birth,picture,gender,status_message,a.dateadd as datefriend FROM friend a join user b on a.username1 = b.username where username2 = '$user2' and username1 = '$user'");
		$r = $res->row();
		$res->free_result();
		return $r;
	}
	
	function frienduser2($user,$user2){
		$res = $this->db->query("SELECT username,email,name,b.dateadd,birth,picture,gender,status_message,a.dateadd as datefriend FROM friend a join user b on a.username2 = b.username where username2 = '$user2' and username1 = '$user'");
		$r = $res->row();
		$res->free_result();
		return $r;
	}
	
	function cekFriend($user,$user2){
		$res = $this->db->query("SELECT * FROM friend where (username2 = '$user2' and username1 = '$user')");
		$r = $res->num_rows();
		$res->free_result();
		return $r;
	}
	
	function delFriend($user,$user2){
		$res = $this->db->query("DELETE FROM friend where (username2 = '$user2' and username1 = '$user')
				or (username2 = '$user' and username1 = '$user2')");		
		return $res;
	}
				
	function get_reqlist($user){
		$sql = "SELECT * from friend where status = 0 AND username2 = '$user'";
		$res = $this->db->query($sql);
		$r=$res->result();
		$res->free_result();		
		foreach($r as $d){
			if($d->username1 == $user){
				$data[] = $this->frienduser2($user,$d->username2);
			} else{
				$data[] = $this->frienduser1($d->username1,$user);
			}			
		}
		return $data;
	}
	
	function get_user($user){
		$sql = "SELECT username,email,name,dateadd,birth,picture,gender,status_message FROM user WHERE username ='$user'";
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
