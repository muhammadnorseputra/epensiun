<div class="bg-primary pt-10 pb-22"></div>
<div class="container mt-n23 pt-4 px-4 px-md-8">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div>
                <div class="d-flex justify-content-between">
                    <div class="mb-2 mb-lg-4 d-flex align-items-start gap-4">
                        <i data-feather="home" class="icon-md text-white"></i>
                        <div>
                            <h3 class="mb-0 text-white">Form Usul Pensiun ASN</h3>
                            <p class="text-white lead">Silahkan isi formulir step by step dibawah ini.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $tab = isset($_GET['step']) ? $_GET['step'] : '1';
    if ($tab === '1') {
        $step1 = 'active';
        $is_active_step1 = true;
        $is_show_step1 = "show";
    } else {
        $is_show_step1 = "";
        $is_active_step1 = false;
        $step1 = '';
    }

    if ($tab === '2') {
        $step2 = 'active';
        $is_active_step2 = true;
        $is_show_step2 = "show";
    } else {
        $is_show_step2 = "";
        $is_active_step2 = false;
        $step2 = '';
    }

    if ($tab === '3') {
        $step3 = 'active';
        $is_active_step3 = true;
        $is_show_step3 = "show";
    } else {
        $is_show_step3 = "";
        $is_active_step3 = false;
        $step3 = '';
    }
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header p-6">
                    <ul class="nav nav-pills flex-column flex-sm-row flex-nowrap" id="pills-tab" role="tablist">
                        <li class="flex-sm-fill d-grid nav-item" role="presentation">
                            <button class="nav-link p-4 d-flex gap-3 <?= $step1 ?> text-start" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                                <div class="py-2 px-3 bg-white text-primary rounded">1</div>
                                <div>
                                    <h4 class="mb-0 text-warning fw-bold">Pengantar Setup</h4>
                                    <p class="lh-1">Pilih jenis pensiun dan buat pengantar.</p>
                                </div>
                            </button>
                        </li>
                        <li class="flex-sm-fill d-grid nav-item" role="presentation">
                            <button class="nav-link p-4 d-flex gap-3 <?= $step2 ?> text-start" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                                <div class="py-2 px-3 bg-white text-primary rounded">2</div>
                                <div>
                                    <h4 class="mb-0 text-warning fw-bold">Profile ASN</h4>
                                    <p class="lh-1">Cari profile ASN yang akan pensiun.</p>
                                </div>
                            </button>
                        </li>
                        <li class="flex-sm-fill d-grid nav-item" role="presentation">
                            <button class="nav-link p-4 d-flex gap-3 <?= $step3 ?> text-start" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                                <div class="py-2 px-3 bg-white text-primary rounded">3</div>
                                <div>
                                    <h4 class="mb-0 text-warning fw-bold">Eviden & Review Usulan</h4>
                                    <p class="lh-1">Upload Eviden & Review Usulan yang telah dibuat.</p>
                                </div>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-8">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade <?= $is_show_step1 ?> <?= $step1 ?>" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                            <?= form_open(base_url('app/pensiun/buatpengantar'), ['id' => 'FormPengantar', 'class' => 'needs-validation was-validated p-sm-12', 'data-parsley-validate' => '', 'novalidate' => '']) ?>
                            <input type="hidden" name="token" value="<?= @$detail->token ?>">
                            <div class="row row-cols-1 row-cols-sm-2 g-3">
                                <?php
                                foreach ($jenis_pensiun->result() as $jp) :
                                    $check = @$detail->fid_jenis_usul === $jp->id ? 'checked' : '';
                                ?>
                                    <div class="col w-sm-25">
                                        <div class="d-grid mb-3">
                                            <button class="btn btn-sm btn-secondary" type="button"><i class="bi bi-journal-text me-2"></i> Lihat Persyaratan</button>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label ms-2" for="jenis_pensiun_<?= $jp->id ?>">
                                                <h1><i class="bi bi-person-badge"></i></h1>
                                                <b><?= $jp->nama ?></b>
                                                <p class="small"><?= $jp->keterangan ?></p>
                                            </label>
                                            <input class="form-check-input p-2 cursor-pointer" type="radio" value="<?= $jp->id ?>" name="jenis_pensiun" id="jenis_pensiun_<?= $jp->id ?>" data-parsley-errors-container=".help-block-jp" data-parsley-required-message="Silahkan pilih jenis pensiun terlebih dahulu." <?= $check ?> required>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <p class="help-block-jp"></p>
                            <div class="form-group mb-4">
                                <label class="form-label fw-bold" for="nomor_usul">Nomor Usul :</label>
                                <input type="text" id="nomor_usul" name="nomor_usul" class="form-control form-control-lg" value="<?= @$detail->nomor ?>" required="">
                            </div>
                            <div class="mb-4 col-12 col-md-4">
                                <label class="form-label fw-bold" for="nomor_usul">Tanggal Usul :</label>
                                <div class="input-group date">
                                    <span class="input-group-text input-group-addon" id="basic-addon1"><i class="bi bi-calendar2-event"></i></span>
                                    <input type="text" name="tgl_usul" class="tanggal form-control form-control-lg" value="<?= @$detail->tanggal ? @tgl_indo_format($detail->tanggal) : date('d-m-Y') ?>" aria-label="Username" aria-describedby="basic-addon1" data-parsley-errors-container=".help-block-datepicker" required="">
                                </div>
                                <div class="help-block-datepicker"></div>
                            </div>
                            <button type="submit" class="btn btn-lg btn-primary"><i class="bi bi-send-check-fill me-2"></i> Simpan & Lanjutkan</button>
                            <?= form_close() ?>
                        </div>
                        <div class="tab-pane fade <?= $is_show_step2 ?> <?= $step2 ?>" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                        <?= form_open(base_url('/app/pensiun/carinip'), ['id' => 'FormCariNip']) ?>
                        <div class="form-group mb-4 col-12 col-sm-6">
                            <label for="nip" class="form-label fw-bold">Masukan Nomor Induk Pegawai</label>
                            <div class="input-group">
                                <input type="text" name="nip" id="nip" class="form-control form-control-lg shadow-lg">
                                <button class="btn btn-primary btn-lg shadow-lg" type="submit"><i class="bi bi-search me-2"></i>Cari</button>
                            </div>
                        </div>
                        <?= form_close() ?>
                        <div id="loadProfile" class="my-8"></div>
                        <a href="<?= base_url('/app/pensiun/buatusul?step=1&token='.@$detail->token) ?>" class="btn btn-secondary btn-lg"><i class="bi bi-arrow-bar-left"></i> Kembali</a>
                        </div>
                        <div class="tab-pane fade <?= $is_show_step3 ?> <?= $step3 ?>" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>