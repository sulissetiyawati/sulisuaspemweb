<?php
class Book extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('kategori_model');
		$this->load->model('book_model');
		$this->load->model('user_model');
		
		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
	}


	// method hapus data buku berdasarkan id
	public function delete($id){
		$this->book_model->delBook($id);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
	}

	public function delKate($id){
		$this->kategori_model->delKategori($id);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/kategori');
	}

	public function delUs($id){
		$this->user_model->delUser($id);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/users');
	}

	// method untuk tambah data buku
	public function insert(){

		// target direktori fileupload
		$target_dir = "c:/xampp/htdocs/books/assets/images/";
		
		// baca nama file upload
		$filename = $_FILES["imgcover"]["name"];

		// menggabungkan target dir dengan nama file
		$target_file = $target_dir . basename($filename);

		// proses upload
		move_uploaded_file($_FILES["imgcover"]["tmp_name"], $target_file);

		// baca data dari form insert buku
		$judul = $_POST['judul'];
		$pengarang = $_POST['pengarang'];
		$penerbit = $_POST['penerbit'];
		$sinopsis = $_POST['sinopsis'];
		$thnterbit = $_POST['thnterbit'];
		$idkategori = $_POST['idkategori'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->book_model->insertBook($judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
	}


	public function insertUser(){
		$fullname = $_POST['fullname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$role = $_POST['role'];
		$this->user_model->insertUser($fullname, $username, $password, $role, $role); 
		redirect('dashboard/users');
	}

	// method untuk edit data buku berdasarkan id
	public function editUser($username){
		$data['fullname'] = $_SESSION['fullname'];
		$data['role'] = $this->user_model->getRole();
		$data['users'] = $this->user_model->getUserProfile($username);
		
		$data['username'] = $data['users']['username'];
		$data['fullname'] = $data['users']['fullname'];
		$data['password'] = $data['users']['password'];

		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/editUser', $data);
        $this->load->view('dashboard/footer');	
	}

	public function updateUs(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$fullname = $_POST['fullname'];
		$role = $_POST['role'];

		$this->user_model->updateUser($username, $password, $fullname, $role);
		redirect('dashboard/users');
	}

	public function editKate($id){
        $data['view_category'] = $this->kategori_model->showKategori($id);

        $data['fullname'] = $_SESSION['fullname'];

        if (empty($data['view_category'])){
            show_404();
        }

        $data['idkategori'] = $data['view_category']['idkategori'];
        $data['kategori'] = $data['view_category']['kategori'];

        $this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/editKategori', $data);
        $this->load->view('dashboard/footer');
    }

	public function insertKate($idkategori){
		$kategori = $_POST['kategori'];
	
		$this->kategori_model->insertKategori($kategori); 
		redirect('dashboard/kategori');
	}

   	public function updateKate(){
   		// baca data dari form insert buku
   		$idkategori = $_POST['idkategori'];
		$kategori = $_POST['kategori'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->kategori_model->updateKategori($idkategori, $kategori);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/kategori');

	}

	public function editBooks($id){
		$data['kategori'] = $this->book_model->getKategori();
		$data['view_book'] = $this->book_model->showBook($id);

		$data['fullname'] = $_SESSION['fullname'];
		if (empty($data['view_book'])){
			show_404();
		}

		$data['idbuku'] = $data['view_book']['idbuku'];
		$data['judul'] = $data['view_book']['judul'];
		$data['pengarang'] = $data['view_book']['pengarang'];
		$data['penerbit'] = $data['view_book']['penerbit'];
		$data['idkategori'] = $data['view_book']['idkategori'];
		$data['imgcover'] = $data['view_book']['imgfile'];
		$data['sinopsis'] = $data['view_book']['sinopsis'];
		$data['thnterbit'] = $data['view_book']['thnterbit'];

		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/editBook', $data);
        $this->load->view('dashboard/footer');	
	}

	// method untuk update data buku
	public function updateBooks(){
		// target direktori fileupload
		$target_dir = "c:/xampp/htdocs/books/assets/images/";
		
		// baca nama file upload
		$filename = $_FILES["imgcover"]["name"];

		// menggabungkan target dir dengan nama file
		$target_file = $target_dir . basename($filename);

		//proses upload
		move_uploaded_file($_FILES["imgcover"]["tmp_name"], $target_file);
		// baca data dari form insert buku
		$idbuku = $_POST['idbuku'];
		$judul = $_POST['judul'];
		$pengarang = $_POST['pengarang'];
		$penerbit = $_POST['penerbit'];
		$sinopsis = $_POST['sinopsis'];
		$thnterbit = $_POST['thnterbit'];
		$idkategori = $_POST['idkategori'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->book_model->updateBook($idbuku, $judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');    


	}

	// method untuk mencari data buku berdasarkan 'key'
	public function findbooks(){
		
		// baca key dari form cari data
		$key = $_POST['key'];

		// ambil session fullname untuk ditampilkan ke header
		$data['fullname'] = $_SESSION['fullname'];

		// panggil method findBook() dari model book_model untuk menjalankan query cari data
		$data['book'] = $this->book_model->findBook($key);

		// tampilkan hasil pencarian di view 'dashboard/books'
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/books', $data);
        $this->load->view('dashboard/footer');
	}

	public function view($id=NULL){
		$data['fullname'] = $_SESSION['fullname'];

			$data['books'] =$this->book_model->showBook($id);
			if (empty($data['books'])) {
				show_404();
			} 
			$data['idbuku'] = $data['books']['idbuku'];

		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/view', $data);
        $this->load->view('dashboard/footer');
	}

	public function viewop($id = NULL){
		$data['fullname'] = $_SESSION['fullname'];
		$data['books'] = $this->book_model->showBook($id);

                if (empty($data['books'])) {
                        show_404();
                }

                $data['idbuku'] = $data['books']['idbuku'];
                
        $this->load->view('operator/header', $data);
        $this->load->view('operator/viewop', $data);
        $this->load->view('operator/footer');
    }





}
?>