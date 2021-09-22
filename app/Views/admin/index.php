<!-- Begin Page Content -->
<div class="container-fluid">
    
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $judul;?></h1>
<div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $tot_barang;?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Peminjaman</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $tot_pinjam;?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-archive fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-12 col-lg-12">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Peminjaman</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas id="peminjamanChart" width="668" height="320" style="display: block; width: 668px; height: 320px;" class="chartjs-render-monitor"></canvas>
                    </div>
                    <hr>
                    Grafik yang didapatkan dari Total Peminjaman barang Setiap Bulan
                    <code>untuk memudahkan dalam menganalisa data</code>.
                </div>
            </div>

        </div>

    </div>
  </div>
</div>
