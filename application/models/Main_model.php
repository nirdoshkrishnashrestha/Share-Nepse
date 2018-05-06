<?php 

class Main_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function insert_user($data)
    {
		$query = $this->db->insert("tbl_users",$data);
    }
	
	function login_check($user,$pass)
	{
		$sql = "select * from tbl_users where `username` = '$user' and `password` = '$pass'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
/*	function individual($id)
	{
		$sql = "select * from share_info where `username` = '$user' and `share_name` = 'select share_name from share_name where share_id = $id'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
*/	
	function insert_share($data)
	{
		$this->db->insert("share_info",$data);
	}
	
	
	function get_share()
	{		
		$this->db->where("username",$this->session->userdata('username'));
		$query = $this->db->get("share_info",$data);
		return $query;
	}
	
	function edit_share($id)
	{		
		$this->db->where("share_id",$id);
		$query = $this->db->get("share_info",$data)->row();
		return $query;
	}
	
	function update_share($data,$id)
	{		
		$this->db->where('share_id', $id);
		$this->db->update('share_info', $data);
	}
	
	function get_share_info1()
	{	$user = $this->session->userdata("username");
		$sql = "select * from share_info where username = '$user'";
		$query = $this->db->query($sql);		
		return $query->result();
	}
	
	function get_share_info()
	{	$user = $this->session->userdata("username");
		$sql = "SELECT `share_id`,`username`,`share_name`,`buy_rate`,`num`,`type`,`date`,`entry_date`, SUM(num) as diff_amt, SUM(buy_rate*num) as sum FROM share_info where username = '$user' GROUP BY username,share_name";
		$query = $this->db->query($sql);		
		return $query->result();
	}
	
	function individual($share_name)
	{
		$share_name = str_replace("%20"," ",$share_name);
		$user = $this->session->userdata("username");
		$sql = "select * from share_info where share_name = '$share_name' and username = '$user'";
		$query = $this->db->query($sql);		
		return $query->result();
		
	}
/*    function insert_entry() 
    {
        $this->title   = $_POST['title']; // please read the below note
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->insert('entries', $this);
    }

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }
*/
}

?>