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

    <p align="center" style="font-size:14px;">
        Laporan Barang Keluar<br>
        Periode dari <?= date('d F', strtotime($mulai)) ?> sampai <?= date('d F', strtotime($akhir)) ?> <br>
        Tahun Anggaran 2021
    </p>
    <hr>
    <!-- <img src="<?= base_url('/assets/img/logop4.jpg'); ?>" style="height:10px;"> -->

    <p> 
        Bagian Perencanaan, Pengembangan, dan Pemberhentian Pegawai
        
    </p>
    <table cellpadding="6">
        <tr>
            <th><strong>No</strong></th>
            <th><strong>Nama Pegawai</strong></th>
            <th><strong>Subbagian</strong></th>
            <th><strong>Nama Barang</strong></th> 
            <th><strong>Tanggal Pinjam</strong></th>
            <th><strong>Jumlah</strong></th>
        </tr>
        <?php $i = 1;?>
        <?php foreach($pinjam as $row): ?>
        <tr>
            <td scope="row"> <?= $i; ?> </td>
            <td><?= $row->nama_depan ?> <?= $row->nama_belakang ?></td>
            <td><?= $row->nm_subbagian ?></td>
            <td><?= $row->nm_barang ?></td>
            <td><?= date('d F Y', strtotime($row->tgl_pinjam)) ?></td>
            <td><?= $row->jml_pinjam ?></td>
        </tr>
        <?php $i++ ?>
        <?php endforeach; ?>
    </table>
</body>
    
    <div style="margin-top: 300px; margin-right:40px;">
        <p align="right"><?= $jabatan; ?>,</p>
    </div>
    
    <div style="margin-top: 300px; padding-right:40px;">

        <p align="right" ><?= $nama_penandatangan; ?><br>
            NIP. <?= $nip; ?>
        </p>

    </div>

    <br>
</html>