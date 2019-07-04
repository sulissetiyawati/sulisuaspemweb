<?php
class Dashboard extends CI_Controller {

		public function __construct(){
			parent::__construct();

			// cek keberadaan session 'username'	
            
			if (!isset($_SESSION['username'])){
				// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
				redirect('login');
			}
            
		}

		// halaman index dari dashboard -> menampilkan grafik statistik jumlah data buku berdasarkan kategori

        public function index(){

        	// panggil method countByCat() di model book_model untuk menghitung jumlah data buku per kategori untuk ditampilkan di view
        	$data['countBukuTeks'] = $this->book_model->countByCat(1);
        	$data['countMajalah'] = $this->book_model->countByCat('2');
        	$data['countSkripsi'] = $this->book_model->countByCat('3');
        	$data['countThesis'] = $this->book_model->countByCat('4');
        	$data['countDisertasi'] = $this->book_model->countByCat('5');
        	$data['countNovel'] = $this->book_model->countByCat('6');
            $data['countKomik'] = $this->book_model->countByCat('7');
            $data['countCerpen'] = $this->book_model->countByCat('8');
            $data['countFiksi'] = $this->book_model->countByCat('9');
            $data['countKaryaIlmiah'] = $this->book_model->countByCat('10');
            $data['countBiografi'] = $this->book_model->countByCat('11');

        	// baca data session 'fullname' untuk ditampilkan di view
        	$data['fullname'] = $_SESSION['fullname'];

        	// tampilkan view 'dashboard/index'
        	$this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/index');
            $this->load->view('dashboard/footer', $data);
        }

        // method untuk menambah data buku
		public function add(){
			// panggil method getKategori() di model_book untuk membaca data list kategori dari tabel kategori untuk ditampilkan ke view
			$data['kategori'] = $this->book_model->getKategori();

			// menghitung jumlah data buku per kategori untuk ditampilkan di view
            
			$data['countBukuTeks'] = 0;
        	$data['countMajalah'] = 0;
        	$data['countSkripsi'] = 0;
        	$data['countThesis'] = 0;
        	$data['countDisertasi'] = 0;
        	$data['countNovel'] = 0;
            $data['countKomik'] = 0;
            $data['countCerpen'] = 0;
            $data['countFiksi'] = 0;
            $data['countKaryaIlmiah'] = 0;
            $data['countBiografi'] = 0;

            

        	// baca data session 'fullname' untuk ditampilkan di view
        	$data['fullname'] = $_SESSION['fullname'];

        	// tampilkan view 'dashboard/add'
        	$this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/add', $data);
            $this->load->view('dashboard/footer', $data);
        }

        // method untuk menampilkan seluruh data buku
        public function books(){

        	// panggil method showBook() dari book_model untuk membaca seluruh data buku
        	$data['book'] = $this->book_model->showBook();
            $data['totalBuku'] = $this->book_model->hitungJumlah();

      		$data['countBukuTeks'] = 0;
        	$data['countMajalah'] = 0;
        	$data['countSkripsi'] = 0;
        	$data['countThesis'] = 0;
        	$data['countDisertasi'] = 0;
        	$data['countNovel'] = 0;
            $data['countKomik'] = 0;
            $data['countCerpen'] = 0;
            $data['countFiksi'] = 0;
            $data['countKaryaIlmiah'] = 0;
            $data['countBiografi'] = 0;

        	// baca data session 'fullname' untuk ditampilkan di view
        	$data['fullname'] = $_SESSION['fullname'];

        	// tampilkan view 'dashboard/books'
        	$this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/books', $data);
            $this->load->view('dashboard/footer', $data);
        }       

        public function Kategori(){

            // panggil method showBook() dari book_model untuk membaca seluruh data buku
            $data['kategori'] = $this->book_model->getKategori();

            // baca data session 'fullname' untuk ditampilkan di view
            $data['fullname'] = $_SESSION['fullname'];

            // tampilkan view 'dashboard/books'
            $this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/kategori', $data);
            $this->load->view('dashboard/footer', $data);
        } 

        public function Users(){

            // panggil method showBook() dari book_model untuk membaca seluruh data buku
            $data['users'] = $this->user_model->getUser();
            $data['role'] = $this->user_model->getRole();

            // baca data session 'fullname' untuk ditampilkan di view
            $data['fullname'] = $_SESSION['fullname'];

            // tampilkan view 'dashboard/books'
            $this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/users', $data);
            $this->load->view('dashboard/footer', $data);
        } 



        // method untuk proses logout
        public function logout(){
        	// hapus seluruh data session
        	session_destroy();
        	// redirect ke kontroller 'login'
        	redirect('login');
        }
}