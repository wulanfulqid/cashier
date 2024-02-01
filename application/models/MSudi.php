<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSudi extends CI_Model
{
    function AddData($tabel, $data=array())
    {
        $this->db->insert($tabel,$data);
    }

    function UpdateData($tabel,$fieldid,$fieldvalue,$data=array())
    {
        $this->db->where($fieldid,$fieldvalue)->update($tabel,$data);
    }

    function DeleteData($tabel,$fieldid,$fieldvalue)
    {
        $this->db->where($fieldid,$fieldvalue)->delete($tabel);
    }

    function GetData($tabel)
    {
        $query= $this->db->get($tabel);
        return $query->result();
    }
	public function check_credentials($username, $password) {
        $user = $this->db->get_where('users', array('username' => $username))->row();

        if ($user && password_verify($password, $user->password)) {
            return true; // Authentication successful
        }

        return false; // Authentication failed
    }

    function GetDataWhere($tabel,$id,$nilai)
    {
        $this->db->where($id,$nilai);
        $query= $this->db->get($tabel);
        return $query;
    }

	public function GetDataPenjualan()
    {
        $this->db->select('penjualan.*, pelanggan.NamaPelanggan');
        $this->db->from('penjualan');
        $this->db->join('pelanggan', 'penjualan.PelangganID = pelanggan.PelangganID', 'left');
        $query = $this->db->get();
        return $query->result();

    }

    public function GetDataDetailPenjualan()
    {
        
        $this->db->select('detailpenjualan.DetailID, penjualan.TanggalPenjualan, produk.NamaProduk, detailpenjualan.JumlahProduk, detailpenjualan.Subtotal');
        $this->db->from('detailpenjualan');
        $this->db->join('penjualan', 'penjualan.PenjualanID = detailpenjualan.PenjualanID');
        $this->db->join('produk', 'produk.ProdukID = detailpenjualan.ProdukID');
        $query = $this->db->get();
        return $query->result();

    }
    

    function DataPelanggan($cari)
    {
        $query = $this->db->query("Select * From pelanggan where NamaPelanggan  like '%$cari%'");
        return $query;
    }


    function DetailPenjualan($cari)
    {
        $query = $this->db->query("Select * From detailpenjualan where PenjualanID like '%$cari%'");
        return $query;
    }

    function DataProduk($cari)
    {
        $query = $this->db->query("Select * From produk where NamaProduk like '%$cari%'");
        return $query;
    }

	public function InsertData($table, $data)
    {
        // Implementasi logika penyimpanan data di sini
        $this->db->insert($table, $data);
    }

    public function hapus_penjualan_by_pelanggan($pelanggan_id) {
        $this->db->where('PelangganID', $pelanggan_id);
        $this->db->delete('penjualan'); 
    }

	public function get_penjualan_belum_selesai_by_pelanggan($pelanggan_id) {
        $this->db->where('PelangganID', $pelanggan_id);
        $this->db->where('status', 'belum selesai');
        $query = $this->db->get('penjualan');

        return $query->result();
    }

    public function update_status_penjualan($penjualan_id) {
        $this->db->where('PenjualanID', $penjualan_id);
        $this->db->update('penjualan', array('status' => 'selesai'));
    }

    public function update_status_penjualan_selesai($pelanggan_id) {
        $dataPenjualanBelumSelesai = $this->get_penjualan_belum_selesai_by_pelanggan($pelanggan_id);

        foreach ($dataPenjualanBelumSelesai as $penjualan) {
            // Tandai penjualan sebagai 'selesai'
            $this->update_status_penjualan($penjualan->PenjualanID);

            // Pindahkan data penjualan ke tabel detail_penjualan
            $this->pindah_ke_detail_penjualan($penjualan);
        }
    }

    public function pindah_ke_detail_penjualan($penjualan) {
        // Struktur kolom di tabel detail_penjualan harus disesuaikan dengan kebutuhan aplikasi kamu
        $dataDetailPenjualan = array(
            'PenjualanID' => $penjualan->PenjualanID,
            'ProdukID' => $penjualan->ProdukID,
            'JumlahProduk' => $penjualan->quantity,
            'Subtotal' => $penjualan->quantity * $penjualan->Harga
        );

        // Masukkan data ke tabel detail_penjualan
        $this->db->insert('detailpenjualan', $dataDetailPenjualan);

        // Hapus data dari tabel penjualan
        $this->hapus_penjualan($penjualan->PenjualanID);
    }

    public function hapus_penjualan($penjualan_id) {
        $this->db->where('PenjualanID', $penjualan_id);
        $this->db->delete('penjualan');
    }

    public function getProdukInfoById($produkID) {
        // Kueri untuk mendapatkan informasi produk berdasarkan ProdukID
        $this->db->select('*');
        $this->db->from('produk');
        $this->db->where('ProdukID', $produkID);
        $query = $this->db->get();
    
        // Periksa apakah kueri berhasil
        if ($query->num_rows() > 0) {
            return $query->row(); // Mengembalikan satu baris hasil kueri
        } else {
            return null; // Produk tidak ditemukan
        }
    }

    public function getPdfDetailPenjualan() {
        return $this->db->get('detailpenjualan')->result();
    }

    public function update_stok_produk($id_produk, $quantity)
    {
        // Mengambil stok produk saat ini dari database
        $stok_sekarang = $this->db->select('Stok')->where('ProdukID', $id_produk)->get('produk')->row()->Stok;

        // Menghitung stok baru
        $stok_baru = $stok_sekarang - $quantity;

        // Memperbarui stok di database
        $this->db->where('ProdukID', $id_produk)->update('produk', ['Stok' => $stok_baru]);
    }
} 
