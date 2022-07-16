<?php
session_start();
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".$password."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			return 1;
		}else{
			return 2;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login_page.php");
	}

	function save_folder(){
		extract($_POST);
		$data = " name ='".$name."' ";
		$data .= ", parent_id ='".$parent_id."' ";
		if(empty($id)){
			$data .= ", user_id ='".$_SESSION['login_id']."' ";
			
			$check = $this->db->query("SELECT * FROM folders where user_id ='".$_SESSION['login_id']."' and name  ='".$name."'")->num_rows;
			if($check > 0){
				return json_encode(array('status'=>2,'msg'=> 'Folder name already exist'));
			}else{
				$save = $this->db->query("INSERT INTO folders set ".$data);
				if($save)
				return json_encode(array('status'=>1));
			}
		}else{
			$check = $this->db->query("SELECT * FROM folders where user_id ='".$_SESSION['login_id']."' and name  ='".$name."' and id !=".$id)->num_rows;
			if($check > 0){
				return json_encode(array('status'=>2,'msg'=> 'Folder name already exist'));
			}else{
				$save = $this->db->query("UPDATE folders set ".$data." where id =".$id);
				if($save)
				return json_encode(array('status'=>1));
			}

		}
	}

	function delete_folder(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM folders where id =".$id);
		if($delete)
			echo 1;
	}
	function delete_file(){
		extract($_POST);
		$delete = $this->db->query("update files set is_deleted= 1 where id = ".$id);
		if($delete){
					return 1;
				}
	}
	function permanently_delete_file(){
		
		extract($_POST);
		$path = $this->db->query("SELECT file_path from files where id=".$id)->fetch_array()['file_path'];
		$delete = $this->db->query("DELETE FROM files where id =".$id);
		if($delete){
					unlink('assets/uploads/'.$path);
					return 1;
				}
	}

	function save_files(){
		extract($_POST);
		if(empty($id)){
		if($_FILES['upload']['tmp_name'] != ''){
					$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['upload']['name'];
					$move = move_uploaded_file($_FILES['upload']['tmp_name'],'assets/uploads/'. $fname);
		
					if($move){
						$file = $_FILES['upload']['name'];
						$file = explode('.',$file);
						$chk = $this->db->query("SELECT * FROM files where SUBSTRING_INDEX(name,' ||',1) = '".$file[0]."' and folder_id = '".$folder_id."' and file_type='".$file[1]."' ");
						if($chk->num_rows > 0){
							$file[0] = $file[0] .' ||'.($chk->num_rows);
						}
						$data = " name = '".$file[0]."' ";
						$data .= ", folder_id = '".$folder_id."' ";
						$data .= ", description = '".$description."' ";
						$data .= ", user_id = '".$_SESSION['login_id']."' ";
						$data .= ", file_type = '".$file[1]."' ";
						$data .= ", file_path = '".$fname."' ";
						if(isset($is_public) && $is_public == 'on')
						$data .= ", is_public = 1 ";
						else
						$data .= ", is_public = 0 ";

						$save = $this->db->query("INSERT INTO files set ".$data);
						if($save)
						return json_encode(array('status'=>1));
		
					}
		
				}
			}else{
						$data = " description = '".$description."' ";
						if(isset($is_public) && $is_public == 'on')
						$data .= ", is_public = 1 ";
						else
						$data .= ", is_public = 0 ";
						$save = $this->db->query("UPDATE files set ".$data. " where id=".$id);
						if($save)
						return json_encode(array('status'=>1));
			}

	}
	function file_rename(){
		extract($_POST);
		$file[0] = $name;
		$file[1] = $type;
		$chk = $this->db->query("SELECT * FROM files where SUBSTRING_INDEX(name,' ||',1) = '".$file[0]."' and folder_id = '".$folder_id."' and file_type='".$file[1]."' and id != ".$id);
		if($chk->num_rows > 0){
			$file[0] = $file[0] .' ||'.($chk->num_rows);
			}
		$save = $this->db->query("UPDATE files set name = '".$name."' where id=".$id);
		if($save){
				return json_encode(array('status'=>1,'new_name'=>$file[0].'.'.$file[1]));
		}
	}
	function restore_file(){
		extract($_POST);
		$save = $this->db->query("UPDATE files set is_deleted = 0  where id=".$id);
		return json_encode(
			['is_valid' => 1,
			'file_restored' => $id]
		);
	}

	function save_user(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		$data .= ", password = '$password' ";
		$is_existed = $this->db->query("select users.id, users.username as text from users where username='$username'  ")->fetch_row();
		
		if(!empty($is_existed)){
		return "existed";
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set ".$data);
		}else{
			$save = $this->db->query("UPDATE users set ".$data." where id = ".$id);
		}
		if($save){
			$registered_user = $this->db->query("select * from users where username='$username' and password = '$password' ")->fetch_row();
			$_SESSION['login_id'] = $registered_user[0];
			$_SESSION['login_name'] = $registered_user[1];
			$_SESSION['login_username'] =$registered_user[2];
			$_SESSION['login_password'] = $registered_user[3];
			return 1;
		}
	}

	public function save_shared_docs(){
		$file_id = $_POST['file_id'];
		if(!empty($_POST['users'])){
			foreach($_POST['users'] as $user){
				$save = $this->db->query( "INSERT INTO `share` ( `user_id`, `file_id`) VALUES ( $user, $file_id  )" );
			}
		}
		return json_encode([
			'is_valid' => 1,
			'data' => $_POST
		]);
	}
	public function get_users(){
		$q = isset($_GET['q']) && $_GET['q'] !== '' ? $_GET['q'] : '----------';
		$current_user =  $_SESSION['login_id'];
		$users = $this->db->query("select users.id, users.username as text from users where id != $current_user and users.username like '$q' ")->fetch_all(MYSQLI_ASSOC);
		return $users;
	}

	public function share_to_all(){
		if(!empty($_POST['file_id'])){
			$file_id = $_POST['file_id'];
			$current_user =  $_SESSION['login_id'];
			$users = $this->db->query("select users.id, users.username as text from users where id != $current_user  ")->fetch_all(MYSQLI_ASSOC);
			foreach($users as $user){
				$user_id = $user['id'];
				$save = $this->db->query( "INSERT INTO `share` ( `user_id`, `file_id`) VALUES ($user_id , $file_id  )" );
			}
			return ['is_valid' => 1, 'file_id' => $file_id];
		}
		return ['is_valid' => 0, 'error' => "something wennt wrong!"];
	}
	// function get_all_users(){
	// 	$user = $this->db->query('select * from users')->fetch_assoc();
	// 	print_r($users);
	// }
}