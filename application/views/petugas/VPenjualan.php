<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan</title>
	<link rel="icon" href="assets/img/chasier-image.png" type="image/x-icon">
    <link href="path/to/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-++GahA8Smki4iFbYp0t8h1Z6HPQMGsW11MyeKzTeOT0Mq6sM2xqtx+dGMG1vXa0RdUU5MdJxY6gB65FScg06uQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-OLQ/ceCCD8JZlH2r98v6d4tprZfV0gF3UqUp4lfF/Z9TwIazlL0AtO8Cz3sxsC7+OuNm3biVQp4cjTBFP3hT6Q==" crossorigin="anonymous" />
</head>

<body>


<div class="card">
  <div class="card-header">
    Transaksi
  </div>
  <div class="card-body">

<!-- judul (card) -->
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <h5 class="card-title mx-auto">DATA TRANSAKSI</h5>
  </div>
</nav>


<div class="container-fluid mt-4">

<div class="row">
            <div class="col-md-6">
                <h2 class="text-center">Daftar Produk</h2>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Tambah ke Keranjang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($DataProduk)) {
                            $no = 1;
                            foreach ($DataProduk as $produk) {
                        ?>
                               <tr>
                        <th scope="row"><?php echo $no; ?></th>
                        <td><?php echo $produk->NamaProduk; ?></td>
                        <td><?php echo $produk->Harga; ?></td>
                        <td>
                        <form action="<?php echo site_url('Petugas/tambah_ke_penjualan'); ?>" method="post">
                            <input type="hidden" name="ProdukID" value="<?php echo $produk->ProdukID; ?>">
                            <input type="hidden" name="NamaProduk" value="<?php echo $produk->NamaProduk; ?>">
                            <input type="hidden" name="Harga" value="<?php echo $produk->Harga; ?>">
                            <label for="Stok">Jumlah:</label>
                            <input type="number" name="Stok" value="1" min="1">
                            <button type="submit" class="btn btn-outline-warning">
							<i class="fas fa-shopping-cart"></i>
                            </button>
                        </form>


                        </td>
                    </tr>
                        <?php
                                $no++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-6">
    <h2 class="text-center">Keranjang</h2>
    <table id="keranjangTable" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Produk</th>
        <th scope="col">Jumlah</th>
        <th scope="col">Harga</th>
        <th scope="col">Subtotal</th>              
        <th scope="col">TOOLS</th>   
    </tr>
</thead>
<tbody>
    <?php
    $no = 1;
    $totalBelanja = 0; 

    foreach ($DataPenjualan as $penjualan) {
        $ProdukID = $penjualan->ProdukID;

        $NamaProduk = ''; 
        $Harga = 0; 
        $Quantity = 0; // Tambahkan baris ini

        foreach ($DataProduk as $produk) {
            if ($produk->ProdukID == $ProdukID) {
                $NamaProduk = $produk->NamaProduk;
                $Harga = $produk->Harga;
                break; 
            }
        }

        $subtotalPerProduk = $penjualan->quantity * $Harga;

        echo '<tr>';
        echo '<td>' . $no . '</td>';
        echo '<td>' . $NamaProduk . '</td>';
        echo '<td>' . $penjualan->quantity . '</td>';
        echo '<td>' . number_format($Harga, 2) . '</td>';
        echo '<td>' . number_format($subtotalPerProduk, 2) . '</td>';
        echo '<td>';
        echo '<a href="kurangi_produk.php?produk_id=' . $penjualan->ProdukID . '" class="btn btn-warning"><i class="fas fa-minus"></i></a>';
        echo '</td>';
        echo '</td>';
        echo '</tr>';

        $totalBelanja += $subtotalPerProduk;

        $no++;
    }
    ?>
</tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right"><strong>Total Belanja</strong></td>
                <td><?php echo "Rp. " . number_format($totalBelanja, 2); ?></td>
            </tr>
            <tr>
            <td colspan="5" class="text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPelanggan">
  Lanjutkan
</button>
            </td>
        </tr>
        </tfoot>
    </table>
</div>
    </div>

    <div class="modal fade" id="modalPelanggan" tabindex="-1" role="dialog" aria-labelledby="modalPelangganLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPelangganLabel">Data Pelanggan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Isi form pelanggan di sini -->
        <form action="<?php echo site_url('action/simpan_pelanggan'); ?>" method="post">
          <label for="PelangganID" class="form-label" hidden>ID Pelanggan</label>
          <input type="hidden" class="form-control" id="PelangganID" name="PelangganID" placeholder="Masukkan ID Pelanggan">
          <div class="mb-3">
            <label for="NamaPelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" class="form-control" id="NamaPelanggan" name="NamaPelanggan" placeholder="Masukkan Nama Pelanggan" required>
          </div>
          <div class="mb-3">
            <label for="Alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="Alamat" name="Alamat" placeholder="Masukkan Alamat" required>
          </div>
          <div class="mb-3">
            <label for="NomorTelepon" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control" id="NomorTelepon" name="NomorTelepon" placeholder="Masukkan Nomor Telepon" required>
          </div>
          <button type="submit" class="btn btn-primary">Checkout</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<script>
function confirmDelete(ProdukID) {
    Swal.fire({
        title: "Apakah anda yakin ?",
        text: "Anda ingin menghapus data ini ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, data akan di hapus!",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Berhasil !",
                text: 'Data berhasil di hapus !',
                icon: "success",
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed || result.dismiss === Swal.DismissReason.close) {
                    // Redirect to the delete URL with the correct ProdukID
                    window.location.href = "<?php echo site_url('PetugasdeleteDataProduk/')?>/" +
                    ProdukID;
                }
            });
        }
    });
    return false;
}

    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>