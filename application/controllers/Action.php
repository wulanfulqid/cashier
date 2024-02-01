<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

class Action extends CI_Controller
{
	public function registrasi()
    {
        // Load form validation library
        $this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');

        // Check if the form validation passes
        if ($this->form_validation->run() == FALSE) {
            // If validation fails, redirect back to the registration form
            $this->load->view('Register');
        } else {
            // If validation passes, handle the registration process
            $email = $this->input->post('email');
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT); // Hash the password

            // Save user data to the 'users' table
            $userData = array(
                'email' => $email,
                'password' => $password,
                // Add other fields as needed
            );

            $this->load->model('MSudi');
            $this->MSudi->insert_user($userData);

            // Redirect to a success page or show an appropriate message
            redirect('Login');
        }
    }

    public function logout()
        {
            // Unset session data
            $this->session->unset_userdata('Login');

            // Redirect to 'Login' controller
            redirect(site_url('Login'));
        }

        public function simpan_pelanggan()
        {
            $this->load->model('MSudi');

            $dataPelanggan = array(
                'NamaPelanggan' => $this->input->post('NamaPelanggan'),
                'Alamat' => $this->input->post('Alamat'),
                'NomorTelepon' => $this->input->post('NomorTelepon')
            );

            $pelanggan_id = $this->MSudi->InsertData('pelanggan', $dataPelanggan);

            // Setelah berhasil menyimpan pelanggan, tandai penjualan sebagai 'selesai'
            $this->tandai_penjualan_selesai($pelanggan_id);

            // Redirect atau lakukan operasi lain
            redirect('welcome/penjualan');
        }

        private function tandai_penjualan_selesai($pelanggan_id) {
            // Tandai penjualan sebagai 'selesai' berdasarkan pelanggan_id
            $this->MSudi->update_status_penjualan_selesai($pelanggan_id);
        }

    public function kurangiProduk($produkID) {
        $this->load->model('ProdukModel');
        $produk = $this->ProdukModel->getProdukById($produkID);

        if ($produk) {
            $this->ProdukModel->kurangiStokProduk($produkID, 1);
        }

        redirect(site_url('keranjang'));
    }


    public function export_pdf_detailpenjualan() {
        // Memuat library Dompdf
        $this->load->library('pdf');

    // Mendapatkan data untuk PDF dari model
    $this->load->model('MSudi');
    $data['DetailPenjualan'] = $this->MSudi->getPdfDetailPenjualan();
    $data['DataProduk'] = $this->MSudi->GetData('produk');

    // Memuat view PDF
    $this->pdf->load_view('ExportPdf', $data);
    }
}
