<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #000000;
            text-align: center;
            margin: 8px;
        }
    </style>
</head>

<body>
    <p align="right" style="font-size:10px; color:'#dddddd'">
        Tanggal cetak : <?= date('d-m-Y', strtotime($now)) ?><br>
    </p>

    <p align="center" style="font-size:16px;">
        Form Bukti Pengambilan Barang
    </p>

    <!-- <img src="<?= base_url('/assets/img/logop4.jpg'); ?>" style="height:10px;"> -->

    <p> 
        Bagian Perencanaan, Pengembangan, dan Pemberhentian Pegawai 
    </p>
    <hr>
    <p>
        Data Peminjam<br>
        Nama Lengkap : <?= $nama_depan; ?> <?= $nama_belakang; ?> <br>
        Subbagian : <?= $nm_subbagian; ?>
    </p>
    <table cellpadding="6">
        <tr>
            <th><strong>Barang</strong></th> 
            <th><strong>Jumlah</strong></th>
            <th><strong>Tanggal Pinjam</strong></th>
        </tr>
        <tr>
            <td><?= $nm_barang ?></td>
            <td><?= $jml_pinjam ?></td>
            <td><?= date('d F Y', strtotime($tgl_pinjam)) ?></td>
        </tr>
    </table>
</body>
</html>
