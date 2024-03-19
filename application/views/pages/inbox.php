<div class="container mb-4 pt-4 px-4 px-md-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div>
                <div class="d-flex justify-content-between gap-5">
                    <!-- card -->
                    <div class="card w-100">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="mb-0">Pengantar</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                                    <i class="bi bi-book fs-4"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div>
                                <h1 class="fw-bold"><?= isset($chart['jumlah_pengantar']) ? $chart['jumlah_pengantar'] : 0 ?></h1>
                                <p class="mb-0">Total pengantar telah dibuat.</p>
                            </div>
                        </div>
                    </div>
                    <!-- card -->
                    <div class="card w-100">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="mb-0">Usulan ASN</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                                    <i class="bi bi-person-plus fs-4"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div>
                                <h1 class="fw-bold"><?= isset($chart['jumlah_usul']) ? $chart['jumlah_usul'] : 0 ?></h1>
                                <p class="mb-0">Total asn yang diusulkan.</p>
                            </div>
                        </div>
                    </div>
                    <!-- card -->
                    <div class="card w-100">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="mb-0">Verifikasi</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                                    <i class="bi bi-lock fs-4"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div>
                                <h1 class="fw-bold"><?= isset($chart['jumlah_verify']) ? $chart['jumlah_verify'] : 0 ?></h1>
                                <p class="mb-0">Total Verifikasi BKPSDM.</p>
                            </div>
                        </div>
                    </div>
                    <!-- card -->
                    <div class="card w-100">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4 class="mb-0">Menunggu TTD Bupati</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                                    <i class="bi bi-patch-check fs-4"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div>
                                <h1 class="fw-bold"><?= isset($chart['jumlah_ttd']) ? $chart['jumlah_ttd'] : 0 ?></h1>
                                <p class="mb-0">Total Menunggu TTD Bupati.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row  -->
    <div class="row mt-6 px-2 px-md-2">
        <div class="col-md-12 col-12">
            <!-- card  -->
            <div class="card">
                <!-- card header  -->
                <div class="card-header bg-white py-4 d-flex justify-content-between align-items-start gap-5">
                    <i data-feather="inbox" class="icon-md"></i>
                    <div>
                        <h4 class="mb-0">Inbox Usulan Pensiun ASN</h4>
                        <p class="lead"><?= $this->session->userdata('unker') ?>.</p>
                    </div>
                    <div class="ms-auto">
                        <a href="<?= base_url('app/pensiun/buatusul') ?>" class="btn btn-primary btn-md"><i class="icon-sm me-2" data-feather="plus-circle"></i>Tambah Usul Pensiun</a>
                        <button class="btn btn-secondary btn-md" onclick="return TabelUsulPesiun.ajax.reload();"><i class="icon-xs" data-feather="refresh-ccw"></i></a>
                    </div>
                </div>
                <!-- table  -->
                <div class="table-responsive p-4">
                    <table id="table-inbox" class="table text-nowrap mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Nomor & Tanggal Usul</th>
                                <th>Jenis Usulan</th>
                                <th>Pensiun ASN</th>
                                <th>Usia</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>