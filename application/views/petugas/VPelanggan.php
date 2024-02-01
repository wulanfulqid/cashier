
<div class="card">
  <div class="card-header">
    Menu Master
  </div>
  <div class="card-body">

<!-- judul (card) -->
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
  <h5 class="card-title">DATA PELANGGAN</h5>
    <form class="d-flex" role="search" method="post">
      <input class="form-control me-2" name="txt_cari" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-primary" type="submit">Search</button>
    </form>
  </div>
</nav>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createForm" action="<?php echo site_url('PetugasaddDataPelanggan'); ?>" method="post"
                        onsubmit="event.preventDefault(); handleFormSubmit(this, 'Data berhasil di tambahkan !')">
                        <label for="PelangganID" class="form-label" hidden>ID Pelanggan</label>
                        <input type="hidden" class="form-control" id="PelangganID" name="PelangganID"
                            placeholder="Masukkan ID Pelanggan">
                        <div class="mb-3">
                            <label for="NamaPelanggan" class="form-label">Nama Pelanggan</label>
                            <input type="text" class="form-control" id="NamaPelanggan" name="NamaPelanggan"
                                placeholder="Masukkan Nama Pelanggan" required>
                        </div>
                        <div class="mb-3">
                            <label for="Alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="Alamat" name="Alamat"
                                placeholder="Masukkan Alamat" required>
                        </div>
                        <div class="mb-3">
                            <label for="NomorTelepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="NomorTelepon" name="NomorTelepon"
                                placeholder="Masukkan Nomor Telepon" required>
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
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID Pelanggan</th>
                    <th scope="col">Nama Pelanggan</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Nomor Telepon</th>
                    <th scope="col">TOOLS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($DataPelanggan)) {
                    $no = 1;
                    foreach ($DataPelanggan as $ReadDS) {
                ?>
                <tr>
                    <th scope="row"><?php echo $no; ?></th>
                    <td><?php echo $ReadDS->PelangganID; ?></td>
                    <td><?php echo $ReadDS->NamaPelanggan; ?></td>
                    <td><?php echo $ReadDS->Alamat; ?></td>
                    <td><?php echo $ReadDS->NomorTelepon; ?></td>
                    <td>
                        <button type="button" class="btn btn-primary my-1" data-toggle="modal"
                            data-target="#exampleModal_<?php echo $ReadDS->PelangganID; ?>">
                            Edit
                        </button>
                        <a href="#" class="btn btn-danger"
                            onclick="return confirmDelete('<?php echo $ReadDS->PelangganID; ?>')">
                            Hapus
                        </a>


                        <div class="modal fade" id="exampleModal_<?php echo $ReadDS->PelangganID; ?>" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <!-- Konten modal -->
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Pelanggan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
    						<form id="updateForm" action="<?= site_url('PetugasupdatePelanggan/' . $ReadDS->PelangganID) ?>"
        						onsubmit="event.preventDefault(); handleFormSubmit(this, 'Data berhasil di edit !');"
        						method="post">
        					<input type="hidden" class="form-control" id="PelangganID" name="PelangganID" value="<?= $ReadDS->PelangganID; ?>">
        						<!-- Other form inputs -->
        					<div class="mb-3">
           						<label for="NamaPelanggan" class="form-label">Nama Pelanggan</label>
            					<input type="text" class="form-control" id="NamaPelanggan" name="NamaPelanggan" placeholder="Masukkan Nama Pelanggan" value="<?= $ReadDS->NamaPelanggan; ?>" required>
        					</div>
        					<div class="mb-3">
            					<label for="Alamat" class="form-label">Alamat</label>
            					<input type="text" class="form-control" id="Alamat" name="Alamat" placeholder="Masukkan Alamat" value="<?= $ReadDS->Alamat; ?>" required>
        					</div>
        					<div class="mb-3">
            					<label for="NomorTelepon" class="form-label">Nomor Telepon</label>
            					<input type="text" class="form-control" id="NomorTelepon" name="NomorTelepon" placeholder="Masukkan Nomor Telepon" value="<?= $ReadDS->NomorTelepon; ?>" required>
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
function confirmDelete(PelangganID) {
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
                    // Redirect to the delete URL with the correct PelangganID
                    window.location.href = "<?php echo site_url('PetugasdeleteDataPelanggan/')?>/" +
                    PelangganID;
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

function handleFormSubmit2(form, msg) {
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
