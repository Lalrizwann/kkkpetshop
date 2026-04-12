@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h3 class="fw-bold">Ringkasan Statistik</h3>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-3">
        <div class="card card-custom bg-white p-3">
            <div class="d-flex align-items-center">
                <div class="icon-box bg-primary text-white rounded-3 p-3 me-3">
                    <i class="fas fa-box fa-2x"></i>
                </div>
                <div>
                    <p class="text-muted mb-0">Total Produk</p>
                    <h4 class="fw-bold mb-0">124</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-custom bg-white p-3">
            <div class="d-flex align-items-center">
                <div class="icon-box bg-success text-white rounded-3 p-3 me-3">
                    <i class="fas fa-money-bill-wave fa-2x"></i>
                </div>
                <div>
                    <p class="text-muted mb-0">Pendapatan</p>
                    <h4 class="fw-bold mb-0">Rp 2.4jt</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-custom bg-white p-3">
            <div class="d-flex align-items-center">
                <div class="icon-box bg-warning text-white rounded-3 p-3 me-3">
                    <i class="fas fa-users fa-2x"></i>
                </div>
                <div>
                    <p class="text-muted mb-0">Pelanggan</p>
                    <h4 class="fw-bold mb-0">45</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-custom bg-white p-3">
            <div class="d-flex align-items-center">
                <div class="icon-box bg-danger text-white rounded-3 p-3 me-3">
                    <i class="fas fa-paw fa-2x"></i>
                </div>
                <div>
                    <p class="text-muted mb-0">Antrean Medis</p>
                    <h4 class="fw-bold mb-0">12</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-12">
        <div class="card card-custom p-4">
            <h5 class="fw-bold mb-4">Transaksi Terakhir</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Pelanggan</th>
                            <th>Kategori</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1024</td>
                            <td>Rudi Hermawan</td>
                            <td><span class="badge bg-info">Layanan Medis</span></td>
                            <td>Rp 150.000</td>
                            <td><span class="badge bg-success">Selesai</span></td>
                            <td><button class="btn btn-sm btn-outline-primary">Detail</button></td>
                        </tr>
                        <tr>
                            <td>#1025</td>
                            <td>Susi Similikiti</td>
                            <td><span class="badge bg-secondary">Produk</span></td>
                            <td>Rp 45.000</td>
                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                            <td><button class="btn btn-sm btn-outline-primary">Detail</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection