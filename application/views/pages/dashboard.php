<?php
$stat = json_decode($statistik);
?>
<!-- Container fluid -->
<div class="bg-primary pt-10 pb-21"></div>
<div class="container-fluid mt-n22 px-6">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h3 class="mb-0  text-white">Dahsboard</h3>
                    </div>
                    <?php if($this->session->userdata('level') === 'ADMIN'): ?>
                    <div>
                        <a href="<?= base_url('app/pensiun/buatusul') ?>" class="btn btn-white"><i class="icon-sm me-2" data-feather="plus-circle"></i>Buat Usul Pensiun</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
            <div class="card">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center
                    mb-3">
                        <div>
                            <h4 class="mb-0">Usulan</h4>
                        </div>
                        <div class="icon-shape icon-md bg-light-primary text-primary
                      rounded-2">
                            <i class="bi bi-briefcase fs-4"></i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold"><?= $jumlah_usulan ?></h1>
                        <p class="mb-0">Total usulan telah dibuat.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
            <div class="card ">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center
                    mb-3">
                        <div>
                            <h4 class="mb-0">Approve</h4>
                        </div>
                        <div class="icon-shape icon-md bg-light-primary text-primary
                      rounded-2">
                            <i class="bi bi-list-task fs-4"></i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold"><?= $jumlah_selesai ?></h1>
                        <p class="mb-0">Total Usulan Terbit SK</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
            <div class="card ">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center
                    mb-3">
                        <div>
                            <h4 class="mb-0">Proyeksi Pensiun</h4>
                        </div>
                        <div class="icon-shape icon-md bg-light-primary text-primary
                      rounded-2">
                            <i class="bi bi-people fs-4"></i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold"><?= $stat->proyeksi_pensiun ?></h1>
                        <p class="mb-0">Total ASN Pensiun Tahun <?= date('Y') ?></p>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
            <div class="card ">
                <!-- card body -->
                <div class="card-body">
                    <!-- heading -->
                    <div class="d-flex justify-content-between align-items-center
                    mb-3">
                        <div>
                            <h4 class="mb-0">Proggres</h4>
                        </div>
                        <div class="icon-shape icon-md bg-light-primary text-primary
                      rounded-2">
                            <i class="bi bi-bullseye fs-4"></i>
                        </div>
                    </div>
                    <!-- project number -->
                    <div>
                        <h1 class="fw-bold"><?= $jumlah_selesai ?>/<?= $stat->proyeksi_pensiun ?></h1>
                        <p class="mb-0"><span class="text-success me-2"><?=  number_format(($jumlah_selesai/$stat->proyeksi_pensiun)*100,2) ?>%</span>Completed</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-4">
        <div class="col-md-12">
            <div class="alert alert-primary d-flex justify-content-start gap-3 align-items-start align-items-md-center" role="alert">
                <i data-feather="award" class="icon-md text-primary"></i>
                <div>
                    <span class="fw-bold">Selamat Datang, <?= $this->session->userdata('nama_lengkap'); ?></span> <br>Kamu Pensiun Terhitung Mulai Tanggal <span class="fw-bold"><?= $this->session->userdata('tmtbup'); ?></span> berdasarkan Batas Usia Pensiun.
                </div>
            </div>
        </div>
    </div>
    <?php if($this->session->userdata('level') === 'ADMIN' || $this->session->userdata('level') === 'USER'): ?>
    <!-- row  -->
    <div class="row mb-6">
        <div class="col-xl-5 col-lg-12 col-md-12 col-12 mb-6 mb-xl-0">
            <!-- card  -->
            <div class="card h-100">
                <!-- card body  -->
                <div class="card-body">
                    <div class="d-flex align-items-center
                    justify-content-center">
                        <div>
                            <h4 class="mb-0">Trend Berdasarkan Jenis Pensiun </h4>
                        </div>
                    </div>
                    <!-- chart  -->
                    <div class="mb-8">
                        <div id="perfomanceChart"></div>
                    </div>
                    <!-- icon with content  -->
                    <div class="d-flex align-items-center justify-content-around">
                        <div class="text-center">
                            <i class="icon-sm text-success" data-feather="activity"></i>
                            <h1 class="mt-3  mb-1 fw-bold"><?= $charts['bup'] ?></h1>
                            <p>BUP</p>
                        </div>
                        <div class="text-center">
                            <i class="icon-sm text-warning" data-feather="activity"></i>
                            <h1 class="mt-3  mb-1 fw-bold"><?= $charts['jadu'] ?></h1>
                            <p>JANDA/DUDA</p>
                        </div>
                        <div class="text-center">
                            <i class="icon-sm text-secondary" data-feather="activity"></i>
                            <h1 class="mt-3  mb-1 fw-bold"><?= $charts['aps'] ?></h1>
                            <p>APS</p>
                        </div>
                        <div class="text-center">
                            <i class="icon-sm text-danger" data-feather="activity"></i>
                            <h1 class="mt-3  mb-1 fw-bold"><?= $charts['udzur'] ?></h1>
                            <p>UDZUR</p>
                        </div>
                        <div class="text-center">
                            <i class="icon-sm text-info" data-feather="activity"></i>
                            <h1 class="mt-3  mb-1 fw-bold"><?= $charts['mpp'] ?></h1>
                            <p>MPP</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- card  -->
        <div class="col-xl-7 col-lg-12 col-md-12 col-12">
            <div class="card h-100">
                <!-- card header  -->
                <div class="card-header bg-white py-4">
                    <h4 class="mb-0">Usulan Pensiun Terbit SK</h4>
                </div>

                <div class="card-body pt-0 px-0">
                    <!-- table  -->
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th>Pensiun ASN</th>
                                    <th>Nomor & Tanggal SK</th>
                                    <th>Tanggal Diserahkan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $db = $this->inbox->TopUsulanPensiunByUnkerId();
                                if ($db->num_rows() > 0) :
                                    foreach ($db->result() as $r) :
                                    
                                    $arsip_date = $r->arsip_at !== null ? date_indo(substr($r->arsip_at,0,10)) : '<span class="text-danger bg-light p-2 rounded ">SK Belum diserahkan</span>';
                                ?>
                                        <tr>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <img src="<?= $r->url_photo ?>" alt="<?= $r->nama ?>" class="avatar-md avatar rounded-circle">
                                                    </div>
                                                    <div class="ms-3 lh-1">
                                                        <h5 class=" mb-1"><?= $r->nama ?></h5>
                                                        <p class="mb-0"><?= $r->jenis_pensiun ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle"><span class="fw-bold"><?= $r->nomor_sk ?> </span><br> <?= date_indo($r->tanggal_sk) ?></td>
                                            <td class="align-middle"><?= $arsip_date ?></td>
                                        </tr>
                                    <?php
                                    endforeach;
                                else :
                                    ?>

                                    <tr>
                                        <td colspan="4" class="text-center">
                                            Top Data Usulan SK Telah Terbit Tidak Tersedia
                                        </td>
                                    </tr>
                                <?php
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <div class="text-center">
                        <a href="<?= base_url('/app/inbox/usul') ?>">Lihat Semua Usulan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>