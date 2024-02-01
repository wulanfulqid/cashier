<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

class Welcome extends CI_Controller
{

	public $input;
	public $MSudi;

	function __construct()
	{
		parent::__construct();
		$this->load->model('MSudi');
	}

	public function index()
    {
        // Check Session Login
        if ($this->session->userdata('Login')) {

                $data['content'] = 'beranda'; 
                $this->load->view('file_form/welcome_message', $data);
        } else {
           
            redirect(site_url('Login'));
        }
    }

    public function pelanggan()
    {
        if ($this->session->userdata('Login')) {

        // Memuat model MSudi
            $this->load->model('MSudi');
        // Mengakses data dari model
            $cari=$this->input->post('txt_cari');
            $data['DataPelanggan'] = $this->MSudi->GetData('pelanggan');
            $data['DataPelanggan'] =  $this->MSudi->DataPelanggan($cari)->result();
            $data['content'] = 'file_form/VPelanggan';
            $this->load->view('file_form/welcome_message', $data);
        } else {
        redirect(site_url('Login'));
        } 
    }

    public function penjualan()
    {
        if ($this->session->userdata('Login')) {

            // Memuat model MSudi
            $this->load->model('MSudi');
           // Mengakses data dari model
           $data['DataProduk'] = $this->MSudi->GetData('produk');

           // Mendapatkan data penjualan dari model
           $data['DataPenjualan'] = $this->MSudi->GetData('penjualan');

           // Menampilkan view dengan data
           $data['content'] = 'file_form/VPenjualan';
           $this->load->view('file_form/welcome_message', $data);
        } else {
            redirect(site_url('Login'));
        }
    }

    public function tambah_ke_penjualan()
    {
        // Mengambil data dari formulir POST

        $id_produk = $this->input->post('ProdukID');
        $nama_produk = $this->input->post('NamaProduk');
        $harga = $this->input->post('Harga');
        $quantity = $this->input->post('Stok');

        // Hitung total harga berdasarkan quantity
        $total_harga = $harga * $quantity;

        // Logika tambahkan data ke dalam tabel penjualan (Anda dapat menyimpannya ke dalam database)
        $data_penjualan = array(
            'TanggalPenjualan' => date('Y-m-d H:i:s'), // Gunakan timestamp sesuai kebutuhan Anda
            'Harga' => $total_harga,
            'ProdukID' => $id_produk,
            'quantity' => $quantity
            // Anda mungkin perlu menambahkan kolom lain sesuai dengan struktur tabel penjualan Anda
        );

        // Simpan data penjualan ke dalam database (disesuaikan dengan model dan metode penyimpanan data di database Anda)
        $this->load->model('MSudi'); // Gantilah dengan model Anda
        $this->MSudi->InsertData('penjualan', $data_penjualan);
        $this->MSudi->update_stok_produk($id_produk, $quantity);

        // Redirect kembali ke halaman produk atau halaman yang sesuai
        redirect(site_url('Welcome/penjualan'));
    }


    public function detailPenjualan()
    {
        if ($this->session->userdata('Login')) {

            // Memuat model MSudi
            $this->load->model('MSudi');
            $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
            // Mengakses data dari model
            $cari= $this->input->post('txt_cari');
            $data['DetailPenjualan'] = $this->MSudi->GetData('detailpenjualan');
            $data['DetailPenjualan'] = $this->MSudi->DetailPenjualan($cari)->result();
            $data['DataProduk'] = $this->MSudi->GetData('produk');
            $data['DataPenjualan'] = $this->MSudi->GetData('penjualan');
            $data['content'] = 'file_form/VDPenjualan';
            $this->load->view('file_form/welcome_message', $data);
        } else {
            redirect(site_url('Login'));
        }
    }

    public function produk()
    {
        if ($this->session->userdata('Login')) {

        // Memuat model MSudi
            $this->load->model('MSudi');
            $data['users'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        // Mengakses data dari model
            $cari=$this->input->post('txt_cari');
            $data['DataProduk'] = $this->MSudi->GetData('produk');
            $data['DataProduk'] = $this->MSudi->DataProduk($cari)->result();
            $data['content'] = 'file_form/VProduk';
            $this->load->view('file_form/welcome_message', $data);
        } else {
        redirect(site_url('Login'));
        } 
    }

        // Controller Add Data

    public function addDataPelanggan()
    {
        if ($this->session->userdata('Login')) {

            $add['PelangganID'] = $this->input->post('PelangganID');
            $add['NamaPelanggan'] = $this->input->post('NamaPelanggan');
            $add['Alamat'] = $this->input->post('Alamat');
            $add['NomorTelepon'] = $this->input->post('NomorTelepon');
    
            $this->MSudi->AddData('pelanggan', $add);
    
            redirect(site_url('Welcome/pelanggan'));
        } else {
            redirect(site_url('Login'));
        }
    }

    public function addDataPenjualan()
    {
        if ($this->session->userdata('Login')) {

            $add['PenjualanID'] = $this->input->post('PenjualanID');
            $add['TanggalPenjualan'] = $this->input->post('TanggalPenjualan');
            $add['TotalHarga'] = $this->input->post('TotalHarga');
            $add['PelangganID'] = $this->input->post('PelangganID');
    
            $this->MSudi->AddData('penjualan', $add);
    
            redirect(site_url('Welcome/penjualan'));
        } else {
            redirect(site_url('Login'));
        }
    }

    public function addDetailPenjualan()
    {
        if ($this->session->userdata('Login')) {
            $add['DetailID'] = $this->input->post('DetailID');
            $add['PenjualanID'] = $this->input->post('PenjualanID');
            $add['ProdukID'] = $this->input->post('ProdukID');
            $add['JumlahProduk'] = $this->input->post('JumlahProduk');
            $add['Subtotal'] = $this->input->post('Subtotal');

            $this->MSudi->AddData('detailpenjualan', $add);

            redirect(site_url('Welcome/detailPenjualan'));
        } else {
            redirect(site_url('Login'));
        }
}


    public function addDataProduk()
    {
        if ($this->session->userdata('Login')) {
        
            $add['ProdukID'] = $this->input->post('ProdukID');
            $add['NamaProduk'] = $this->input->post('NamaProduk');
            $add['Harga'] = $this->input->post('Harga');
            $add['Stok'] = $this->input->post('Stok');
    
            $this->MSudi->AddData('produk', $add);
    
            redirect(site_url('Welcome/produk'));
        } else {
            redirect(site_url('Login'));
        }
    }


    // Controller Update Data

    public function updatePelanggan()
    {
        if ($this->session->userdata('Login')) {

        $a = $this->input->post('PelangganID');
        $update['NamaPelanggan'] = $this->input->post('NamaPelanggan');
        $update['Alamat'] = $this->input->post('Alamat');
        $update['NomorTelepon'] = $this->input->post('NomorTelepon');

        $this->MSudi->UpdateData('pelanggan', 'PelangganID',  $a, $update);

        redirect(site_url('Welcome/pelanggan'));
        } else {
        redirect(site_url('Login'));
        }
    }

    public function updateDataPenjualan()
    {
        if ($this->session->userdata('Login')) {

        $a = $this->input->post('PenjualanID');
        $update['TanggalPenjualan'] = $this->input->post('TanggalPenjualan');
        $update['TotalHarga'] = $this->input->post('TotalHarga');
        $update['PelangganID'] = $this->input->post('PelangganID');

        $this->MSudi->UpdateData('penjualan', 'PenjualanID', $a, $update);

        redirect(site_url('Welcome/penjualan'));
        } else {
        redirect(site_url('Login'));
        }
    }

    public function updateDataDetailPenjualan()
    {
        if ($this->session->userdata('Login')) {

        $a = $this->input->post('DetailID');
        $update['PejualanID'] = $this->input->post('PejualanID');
        $update['ProdukID'] = $this->input->post('ProdukID');
        $update['JumlahProduk'] = $this->input->post('JumlahProduk');
        $update['Subtotal'] = $this->input->post('Subtotal');

        $this->MSudi->UpdateData('detailpenjualan', 'DetailID', $a, $update);
            
        redirect(site_url('Welcome/detailPenjualan'));
        } else {
        redirect(site_url('Login'));
        }
    }

    public function updateDataProduk()
    {
        if ($this->session->userdata('Login')) {

        $a = $this->input->post('ProdukID');
        $update['NamaProduk'] = $this->input->post('NamaProduk');
        $update['Harga'] = $this->input->post('Harga');
        $update['Stok'] = $this->input->post('Stok');

        $this->MSudi->UpdateData('produk', 'ProdukID', $a, $update);

        redirect(site_url('Welcome/produk'));
        } else {
        redirect(site_url('Login'));
        }
    }


    // Controller Delete Data

    public function deleteDataPelanggan($PelangganID)
    {
        if ($this->session->userdata('Login')) {

            $this->load->model('MSudi');
            $this->MSudi->DeleteData('pelanggan', 'PelangganID', $PelangganID);

        // Redirect ke halaman master setelah penghapusan
            redirect(site_url('Welcome/pelanggan'));
        } else {
            redirect(site_url('Login'));
        }
    }

    public function deleteDataPenjualan($PenjualanID)
    {
        if ($this->session->userdata('Login')) {
        
            $this->load->model('MSudi');
            $this->MSudi->DeleteData('penjualan', 'PenjualanID', $PenjualanID);

        // Redirect ke halaman master setelah penghapusan
            redirect(site_url('Welcome/penjualan'));
        } else {
            redirect(site_url('Login'));
        }
    }

    public function deleteDataDetailPenjualan($DetailID)
    {
        if ($this->session->userdata('Login')) {

            $this->load->model('MSudi');
            $this->MSudi->DeleteData('detailpenjualan', 'DetailID', $DetailID);

        // Redirect ke halaman master setelah penghapusan
            redirect(site_url('Welcome/detailPenjualan'));
        } else {
            redirect(site_url('Login'));
        }
    }

    public function deleteDataProduk($ProdukID)
    {
        if ($this->session->userdata('Login')) {

            $this->load->model('MSudi');
            $this->MSudi->DeleteData('produk', 'ProdukID', $ProdukID);

        // Redirect ke halaman master setelah penghapusan
            redirect(site_url('Welcome/produk'));
        } else {
            redirect(site_url('Login'));
        }
    }

    



}














