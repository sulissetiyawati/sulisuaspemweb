<?php

class User_model extends CI_Model {

	public function getUser(){
		$query = $this->db->get('users');
		return $query->result_array();
	}

	// method untuk membaca data profile user berdasar username
	public function getUserProfile($username){
		$query = $this->db->get_where('users', array('username' => $username));
		return $query->row_array();
	}

	public function showUserProfile($username = false){
		// membaca semua kategori buku dari tabel 'kategori'
		if ($username == false){
			$query = $this->db->get('users');
			return $query->result_array();
		} else {
			// membaca kstegori buku berdasarkan id
			$query = $this->db->get_where('users', array("users" => $username));
			return $query->row_array();
		}
	}

	public function updateUser($username, $password, $fullname, $role){
		$this->db->where('username', $username);
		$data = array (
			"fullname" => $fullname,
			"username" => $username,
			"password" => $password,
			"role" => $role
			);
		$query = $this->db->update('users', $data);

	}

	public function delUser($id){
		$this->db->delete('users', array("username" => $id));
	}

	// method untuk insert kategori buku ke tabel 'kategori'
	public function insertUser($fullname, $username, $password, $role){
		$data = array(
			"fullname" => $fullname,
			"username" => $username,
			"password" => $password,
			"role" => $role
			);
		$query = $this->db->insert('users', $data);
	}

	public function getRole(){
		$query = $this->db->get('role');
		return $query->result_array();
	}

	public function getFoto(){
	$query = $this->db->get('books');
	return $query->result_array();
	
	$result = mysqli_query($db, $query);
	}
}
?>