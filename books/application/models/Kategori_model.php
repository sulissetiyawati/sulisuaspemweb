<?php

class Kategori_model extends CI_Model {

	// method untuk menampilkan kategori buku
	public function showKategori($id = false){
		// membaca semua kategori buku dari tabel 'kategori'
		if ($id == false){
			$query = $this->db->get('kategori');
			return $query->result_array();
		} else {
			// membaca kstegori buku berdasarkan id
			$query = $this->db->get_where('kategori', array("idkategori" => $id));
			return $query->row_array();
		}
	}

	// method untuk hapus kategori buku berdasarkan id
	public function delKategori($id){
		$this->db->delete('kategori', array("idkategori" => $id));
	}

	// method untuk insert kategori buku ke tabel 'kategori'
	public function insertKategori($kategori){
		$data = array("kategori" => $kategori);
		$query = $this->db->insert('kategori', $data);
	}

		// method untuk membaca data kategori buku dari tabel 'kategori'
	public function getKategori(){
		$query = $this->db->get('kategori');
		return $query->result_array();
	}

	public function updateKategori($idkategori, $kategori){
		$data = array(
					"idkategori" => $idkategori,
					"kategori" => $kategori
		);
		$this->db->where('idkategori', $idkategori);
		$this->db->update('kategori', $data);
	}


	// method untuk menghitung jumlah buku berdasarkan idkategori
	public function countByCat($idkategori){
		$query = $this->db->query("SELECT count(*) as jum FROM books WHERE idkategori = '$idkategori'");
		return $query->row()->jum;
	}

}
?>