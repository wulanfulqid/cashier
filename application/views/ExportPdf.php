<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Detail Penjualan PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Data Detail Penjualan (PDF)</h2>

    <table>
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">ID Penjualan</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Jumlah Produk</th>
            <th scope="col">Subtotal</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($DetailPenjualan)) {
            $no = 1;
            foreach ($DetailPenjualan as $ReadDS) {
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $ReadDS->PenjualanID; ?></td>
                    <td><?php
                        $productName = '';
                        foreach ($DataProduk as $produk) {
                            if ($produk->ProdukID == $ReadDS->ProdukID) {
                                $productName = $produk->NamaProduk;
                                break;
                            }
                        }
                        echo $productName
                        ?></td>
                    <td><?php echo $ReadDS->JumlahProduk; ?></td>
                    <td><?php echo $ReadDS->Subtotal; ?></td>
                </tr>
                <?php
                $no++;
            }
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
