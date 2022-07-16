<?php
ob_start();
$action = isset( $_GET['action']) ?  $_GET['action'] :  $_POST['action'];
include 'admin_class.php';
$crud = new Action();

if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'save_folder'){
	$save = $crud->save_folder();
	if($save)
		echo $save;
}
if($action == 'delete_folder'){
	$delete = $crud->delete_folder();
	if($delete)
		echo $delete;
}
if($action == 'delete_file'){
	$delete = $crud->delete_file();
	if($delete)
		echo $delete;
		
}

if($action == 'permanently_delete_file'){
	$delete = $crud->permanently_delete_file();
	if($delete)
		echo $delete;
}
if($action == 'save_files'){
	$save = $crud->save_files();
	if($save)
		echo $save;
}
if($action == 'file_rename'){
	$save = $crud->file_rename();
	if($save)
		echo $save;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}

if($action == 'save_shared'){
	$save = $crud->save_shared_docs();
	echo $save;
}
if($action == 'restore_file'){
	$retore = $crud->restore_file();
	if($retore)
		echo $retore;
}

if($action == 'get_users'){
	$users = $crud->get_users();
	echo json_encode($users);
}

if($action == 'share_to_all'){
	$shares = $crud->share_to_all();
	echo json_encode($shares);
}
