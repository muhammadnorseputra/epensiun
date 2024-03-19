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
                            <h3 class="mb-0 text-white">Formulir Usul Pensiun ASN</h3>
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

    // Disabled form apabila status sedang di proses
    $disabled = @$detail->is_status === 'BKPSDM' || @$detail->is_status === 'TTD_SK' ? 'disabled' : '';
    ?>
    <div class="row">
        <div class="col-md-12">
            <?php if (@$detail->is_status === 'BKPSDM') : ?>
                <!-- Primary alert -->
                <div class="alert alert-warning d-flex align-items-center mb-8" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-info-circle-fill me-2" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                    </svg>
                    <div>
                        Usulan kamu sedang kami proses, mohon tunggu ya ...
                    </div>
                </div>
            <?php endif; ?>
            <div class="card mb-4">
                <div class="card-header p-6">
                    <ul class="nav nav-pills flex-column flex-sm-row flex-nowrap" id="pills-tab" role="tablist">
                        <li class="flex-sm-fill d-grid nav-item" role="presentation">
                            <button class="nav-link p-4 d-flex gap-3 <?= $step1 ?> text-start" <?= $disabled ?> id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                                <div class="py-2 px-3 bg-white text-primary rounded">1</div>
                                <div>
                                    <h4 class="mb-0 text-warning fw-bold">Pengantar Setup</h4>
                                    <p class="lh-1">Pilih jenis pensiun dan buat pengantar.</p>
                                </div>
                            </button>
                        </li>
                        <li class="flex-sm-fill d-grid nav-item" role="presentation">
                            <button class="nav-link p-4 d-flex gap-3 <?= $step2 ?> text-start" <?= $disabled ?> id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                                <div class="py-2 px-3 bg-white text-primary rounded">2</div>
                                <div>
                                    <h4 class="mb-0 text-warning fw-bold">Profile ASN</h4>
                                    <p class="lh-1">Cari profile ASN yang akan pensiun.</p>
                                </div>
                            </button>
                        </li>
                        <li class="flex-sm-fill d-grid nav-item" role="presentation">
                            <button class="nav-link p-4 d-flex gap-3 <?= $step3 ?> text-start" <?= $disabled ?> id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
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
                                            <input class="form-check-input p-2 cursor-pointer" type="radio" value="<?= $jp->id ?>" name="jenis_pensiun" id="jenis_pensiun_<?= $jp->id ?>" data-parsley-errors-container=".help-block-jp" data-parsley-required-message="Silahkan pilih jenis pensiun terlebih dahulu." <?= $check ?> <?= $disabled ?> required>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <p class="help-block-jp"></p>
                            <div class="form-group mb-4">
                                <label class="form-label fw-bold" for="nomor_usul">Nomor Usul <span class="text-danger ms-1">*</span></label>
                                <input type="text" id="nomor_usul" name="nomor_usul" class="form-control form-control-lg" value="<?= @$detail->nomor ?>" <?= $disabled ?> required="">
                            </div>
                            <div class="mb-4 col-12 col-md-4">
                                <label class="form-label fw-bold" for="nomor_usul">Tanggal Usul <span class="text-danger ms-1">*</span></label>
                                <div class="input-group date">
                                    <span class="input-group-text input-group-addon" id="basic-addon1"><i class="bi bi-calendar2-event"></i></span>
                                    <input type="text" name="tgl_usul" class="tanggal form-control form-control-lg" value="<?= @$detail->tanggal ? @tgl_indo_format($detail->tanggal) : date('d/m/Y') ?>" aria-label="Username" aria-describedby="basic-addon1" data-parsley-errors-container=".help-block-datepicker" <?= $disabled ?> required="">
                                </div>
                                <div class="help-block-datepicker"></div>
                            </div>
                            <button type="button" class="btn btn-lg btn-danger" onclick="window.location.replace('<?= base_url('/app/inbox/usul') ?>')"><i class="bi bi-arrow-bar-left me-2"></i>Batal</button>
                            <button type="submit" class="btn btn-lg btn-primary" <?= $disabled ?>><i class="bi bi-send-check-fill me-2"></i> Simpan & Lanjutkan</button>
                            <?= form_close() ?>
                        </div>
                        <div class="tab-pane fade <?= $is_show_step2 ?> <?= $step2 ?>" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                            <?php if (@$detail->token) : ?>
                                <?php if (@$detail->is_status === 'SKPD') : ?>
                                    <!-- Form Cari NIP -->
                                    <?= form_open(base_url('/app/pensiun/carinip'), ['id' => 'FormCariNip']) ?>
                                    <div class="form-group mb-4 col-12 col-sm-6">
                                        <label for="nip" class="form-label fw-bold">Masukan Nomor Induk Pegawai</label>
                                        <div class="input-group">
                                            <input type="text" name="nip" id="nip" class="form-control form-control-lg shadow-lg">
                                            <button class="btn btn-primary btn-lg shadow-lg" type="submit"><i class="bi bi-search me-2"></i>Cari</button>
                                        </div>
                                    </div>
                                    <?= form_close() ?>
                                <?php endif; ?>

                                <!-- Tampilkan profile ASN berdasarkan NIP -->
                                <div id="loadProfile" class="my-8"></div>

                                <!-- From Save -->
                                <?= form_open(base_url('/app/pensiun/simpanasn'), ['id' => 'FormSaveAsn']) ?>
                                <input type="hidden" name="token" value="<?= @$detail->token ?>">
                                <input type="hidden" name="jns_pensiun" value="<?= @$detail->fid_jenis_usul ?>">
                                <input type="hidden" name="nip">
                                <input type="hidden" name="nama">
                                <input type="hidden" name="gelar_depan">
                                <input type="hidden" name="gelar_belakang">
                                <input type="hidden" name="id_unit_kerja">
                                <input type="hidden" name="nama_golru">
                                <input type="hidden" name="nama_jabatan">
                                <input type="hidden" name="nama_pangkat">
                                <input type="hidden" name="nama_unit_kerja">
                                <input type="hidden" name="alamat">
                                <input type="hidden" name="tgl_lahir">
                                <input type="hidden" name="tmp_lahir">
                                <input type="hidden" name="usia_pensiun">
                                <input type="hidden" name="url_photo">
                                <div class="d-flex justify-content-start align-items-center gap-2">
                                    <a href="<?= base_url('/app/pensiun/buatusul?step=1&nip=' . @$usul->nip . '&token=' . @$detail->token) ?>" class="btn btn-secondary btn-lg"><i class="bi bi-arrow-bar-left"></i> Kembali</a>
                                    <button type="submit" class="btn btn-primary btn-lg" <?= $disabled ?>><i class="bi bi-send-check-fill me-2"></i> Simpan & Lanjutkan</button>
                                </div>
                                <?= form_close() ?>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane fade <?= $is_show_step3 ?> <?= $step3 ?>" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                            <?php if (@$detail->token && @$usul->is_status === 'SKPD') : ?>
                                <div class="row">
                                    <div class="col-md-8">
                                        <ul class="row row-cols-1 row-cols-sm-2 list-unstyled px-3">
                                            <li class="pb-3 ps-0 mb-3 border-bottom">
                                                <div class="fs-sm fw-bold lh-1">NOMOR USUL</div>
                                                <div><?= @$detail->nomor ?></div>
                                            </li>
                                            <li class="pb-3 ps-0 mb-3 border-bottom">
                                                <div class="fs-sm fw-bold lh-1">TANGGAL USUL</div>
                                                <div><?= date_indo(@$detail->tanggal) ?></div>
                                            </li>
                                            <li class="pb-3 ps-0 mb-3 border-bottom">
                                                <div class="fs-sm fw-bold lh-1">NIP</div>
                                                <div><?= @$usul->nip ?></div>
                                            </li>
                                            <li class="pb-3 ps-0 mb-3 border-bottom">
                                                <div class="fs-sm fw-bold lh-1">NAMA</div>
                                                <div><?= @$usul->nama ?></div>
                                            </li>
                                            <li class="pb-3 ps-0 mb-3 border-bottom">
                                                <div class="fs-sm fw-bold lh-1">GELAR DEPAN</div>
                                                <div><?= @$usul->gelar_depan ?></div>
                                            </li>
                                            <li class="pb-3 ps-0 mb-3 border-bottom">
                                                <div class="fs-sm fw-bold lh-1">GELAR BELAKANG</div>
                                                <div><?= @$usul->gelar_belakang ?></div>
                                            </li>
                                            <li class="pb-3 ps-0 mb-3 border-bottom">
                                                <div class="fs-sm fw-bold lh-1">PANGKAT</div>
                                                <div> <?= @$usul->nama_pangkat ?> (<?= @$usul->nama_golru ?>)</div>
                                            </li>
                                            <li class="pb-3 ps-0 mb-3 border-bottom">
                                                <div class="fs-sm fw-bold lh-1">JABATAN</div>
                                                <div><?= @$usul->nama_jabatan ?></div>
                                            </li>
                                            <li class="pb-3 ps-0 mb-3 border-bottom">
                                                <div class="fs-sm fw-bold col-12 lh-1">UNIT KERJA</div>
                                                <div><?= @$usul->nama_unit_kerja ?></div>
                                            </li>
                                            <li class="pb-3 ps-0 mb-3 border-bottom">
                                                <div class="fs-sm fw-bold col-12 lh-1">USIA PENSIUN</div>
                                                <div><?= @$usul->usia_pensiun ?></div>
                                            </li>
                                            <li class="pb-3 ps-0 mb-3 border-bottom">
                                                <div class="fs-sm fw-bold lh-1">TEMPAT TANGGAL LAHIR</div>
                                                <div><?= @$usul->tmp_lahir ?>, <?= @date_indo(@$usul->tgl_lahir) ?></div>
                                            </li>
                                            <li class="pb-3 ps-0 mb-3 border-bottom">
                                                <div class="fs-sm fw-bold lh-1">ALAMAT</div>
                                                <div><?= @$usul->alamat ?></div>
                                            </li>
                                        </ul>
                                        <!-- <div class="avatar avatar-xl mb-8">
                                        <img src="<?= @$usul->url_photo ?>" alt="<?= @$usul->nama ?>" class="rounded-circle"/>
                                    </div> -->
                                        <?= form_open(base_url('/app/pensiun/kirimusulan'), ['id' => 'FormKirimUsulan', 'class' => 'needs-validation was-validated', 'data-parsley-validate' => '', 'novalidate' => '']) ?>
                                        <input type="hidden" name="token" value="<?= @$usul->token ?>">
                                        <input type="hidden" name="jns_pensiun" value="<?= @$detail->fid_jenis_usul ?>">
                                        <input type="hidden" name="nip" value="<?= @$usul->nip ?>">
                                        <!-- Textarea -->
                                        <div class="mb-3">
                                            <label for="textarea-input" class="form-label fw-bold">Tempel Link Eviden <span class="text-danger ms-1">*</span></label>
                                            <textarea class="form-control" id="textarea-input" name="eviden" rows="5" data-parsley-validate="url" <?= $disabled ?> required><?= @$usul->url_berkas ?></textarea>
                                        </div>
                                        <a href="<?= base_url('/app/pensiun/buatusul?step=2&nip=' . @$usul->nip . '&token=' . @$detail->token) ?>" class="btn btn-secondary btn-lg"><i class="bi bi-arrow-bar-left"></i> Kembali</a>
                                        <button type="submit" class="btn btn-success btn-lg float-end" <?= $disabled ?>><i class="bi bi-send-check-fill me-2"></i> Kirim Usulan</button>
                                        <?= form_close() ?>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3>Persyaratan Usulan</h3>
                                            </div>
                                            <div class="card-body">
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius tenetur impedit nostrum, aliquam repellendus natus in maiores. Excepturi nisi non accusamus. Eligendi minus, minima recusandae delectus ipsum similique itaque esse.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (@$detail->token && @$usul->is_status === 'BKPSDM') : ?>
                            <div class="text-center">
                                <img src="<?= base_url('template/assets/images/svg/verify.svg') ?>" class="w-75 w-md-25" alt="Verify Status">
                                <h3 class="mt-8">TAHAP <span class="text-primary">VERIFIKASI BKPSDM</span></h3>
                                <p>Usulan kamu sedang kami proses, mohon tunggu ya 👋🏻</p>
                                <a href="<?= base_url('/app/inbox/usul') ?>" class="btn btn-lg btn-primary"><i class="bi bi-inbox me-2"></i> Inbox usul</a>
                            </div>
                            <?php endif; ?>

                            <?php if (@$detail->token && @$usul->is_status === 'TTD_SK') : ?>
                            <div class="text-center">
                                <img src="<?= base_url('template/assets/images/svg/verify.svg') ?>" class="w-75 w-md-25" alt="Signature Status">
                                <h3 class="mt-8">TAHAP <span class="text-warning">TANDA TANGAN SK</span></h3>
                                <p>Usulan Pensiun dalam tahap TTD SK Oleh Bupati Balangan.</p>
                                <a href="<?= base_url('/app/inbox/usul') ?>" class="btn btn-lg btn-primary"><i class="bi bi-inbox me-2"></i> Inbox usul</a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>