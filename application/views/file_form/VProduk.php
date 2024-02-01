<div class="card mb-3">
  <div class="card-header">
    Stok Barang 
  </div>
  <div class="card-body">

<!-- judul (card) -->
<nav class="navbar bg-body-tertiary">
<h5 class="card-title">FORM DATA BARANG</h5>
<div class="container-fluid">
    <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#exampleModal">
            <i class="bi bi-plus-circle"></i> + Tambah
        </button>
        
    <form class="d-flex" role="search" method="post">
      <input class="form-control me-2" name="txt_cari" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-primary" type="submit">Search</button>
    </form>
  </div>
</nav>
    



<div class="container-fluid mt-4">
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createForm" action="<?php echo site_url('Welcome/addDataProduk'); ?>" method="post"
                        onsubmit="event.preventDefault(); handleFormSubmit(this, 'Data berhasil di tambahkan !')">
                        <label for="ProdukID" class="form-label" hidden>ID Produk</label>
                        <input type="hidden" class="form-control" id="ProdukID" name="ProdukID"
                            placeholder="Masukkan ID Produk">
                        <div class="mb-3">
                            <label for="NamaProduk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="NamaProduk" name="NamaProduk"
                                placeholder="Masukkan Nama Produk" required>
                        </div>
                        <div class="mb-3">
                            <label for="Harga" class="form-label">Harga</label>
                            <input type="text" class="form-control" id="Harga" name="Harga"
                                placeholder="Masukkan Harga" required>
                        </div>
                        <div class="mb-3">
                            <label for="Stok" class="form-label">Stok</label>
                            <input type="text" class="form-control" id="Stok" name="Stok"
                                placeholder="Masukkan Stok" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                    <div id="pesan" class="alert" style="display: none;"></div>
                </div>
            </div>
        </div>
    </div>


    <!-- tabel -->
	<div class="table-responsive">
    <table class="table table-bordered table-striped" style="margin-bottom: 20px;">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID Produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stok</th>
                    <th scope="col">TOOLS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($DataProduk)) {
                    $no = 1;
                    foreach ($DataProduk as $ReadDS) {
                ?>
                <tr>
                    <th scope="row"><?php echo $no; ?></th>
                    <td><?php echo $ReadDS->ProdukID; ?></td>
                    <td><?php echo $ReadDS->NamaProduk; ?></td>
                    <td><?php echo $ReadDS->Harga; ?></td>
                    <td><?php echo $ReadDS->Stok; ?></td>
                    <td>
					<button type="button" class="btn btn-primary my-1" data-toggle="modal"
        data-target="#exampleModal_<?php echo $ReadDS->ProdukID; ?>">
    <i class="fas fa-edit"></i> 
</button>

<a href="#" class="btn btn-danger"
   onclick="return confirmDelete('<?php echo $ReadDS->ProdukID; ?>')">
    <i class="fas fa-trash-alt"></i> 
</a>



                        <div class="modal fade" id="exampleModal_<?php echo $ReadDS->ProdukID; ?>" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <!-- Konten modal -->
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Produk</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= site_url('Welcome/updateDataProduk')?>"
                                            onsubmit="event.preventDefault(); handleFormSubmit(this, 'Data berhasil di edit !');"
                                            method="post">
                                            <label for="ProdukID" class="form-label" hidden>ID Produk</label>
                                            <input type="hidden" class="form-control" id="ProdukID" name="ProdukID" value="<?= $ReadDS->ProdukID; ?>">
                                            <div class="mb-3">
                                            <label for="NamaProduk" class="form-label">Nama Produk</label>
                                            <input type="text" class="form-control" id="NamaProduk" name="NamaProduk"
                                            placeholder="Masukkan Nama Produk" value="<?= $ReadDS->NamaProduk; ?>"required>
                                            </div>
                                            <div class="mb-3">
                                            <label for="Harga" class="form-label">Harga</label>
                                            <input type="text" class="form-control" id="Harga" name="Harga"
                                            placeholder="Masukkan Harga" value="<?= $ReadDS->Harga; ?>"required>
                                            </div>
                                            <div class="mb-3">
                                            <label for="Stok" class="form-label">Stok</label>
                                            <input type="text" class="form-control" id="Stok" name="Stok"
                                            placeholder="Masukkan Stok" value="<?= $ReadDS->Stok; ?>"required>
                                            </div>


                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                        <!-- Akhir formulir -->
                                    </div>
                                </div>
                            </div>
                            <!-- Akhir konten modal -->

                        </div>
                        <!-- Akhir Modal Edit -->
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
                    window.location.href = "<?php echo site_url('Welcome/deleteDataProduk/')?>/" +
                    ProdukID;
                }
            });
        }
    });
    return false;
}


function succesModal(msg) {
    Swal.fire({
        title: "Berhasil !",
        text: msg,
        icon: "success",
        showLoaderOnConfirm: true,
    }).then((result) => {
        // Reload the page after the Swal modal is closed
        if (result.isConfirmed || result.dismiss === Swal.DismissReason.close) {
            location.reload();
        }
    });
}

function handleFormSubmit(form, msg) {
    var formData = $(form).serialize();
    console.log(formData);

    $.ajax({
        type: "POST",
        url: $(form).attr("action"),
        data: formData,
        success: function(response) {
            console.log(response);
            // Assuming your server returns a JSON object with a "success" property
            // if (response.success) {
            succesModal(msg);
            // } else {
            //     // Handle the case when the form submission is not successful
            //     // You can display an error message or take other actions
            //     alert("Form submission failed. Please try again.");
            // }
        },
        error: function() {
            // Handle the case when the AJAX request fails
            alert("An error occurred. Please try again later.");
        }
    });

    // Return false to prevent the default form submission
    return false;
}
</script>
