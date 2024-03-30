<div class="bg-success pt-10 pb-21"></div>
<div class="container mt-n22 px-6">
    <div class="row">
        <div class="col-12">
            <!-- Page header -->
            <div class="d-flex flex-column justify-content-center align-items-center">
                <div class="mb-2 mb-lg-3 text-center">
                    <i data-feather="home" class="icon-md text-white mb-2"></i>
                    <div>
                        <h3 class="mb-0 text-white">Cek Usul Pensiun ASN</h3>
                        <p class="text-white lead">Masukan Nomor Induk Pegawai untuk cek status usulan.</p>
                    </div>
                </div>
                <?= form_open(base_url('/app/pensiun/cekusul_proses'), ['id' => 'FormCekUsul']) ?>
                <div class="input-group mb-4">
                <span class="input-group-text" id="nip"><i class="bi bi-person-bounding-box fs-3 p-0 m-0"></i></span>
                    <div class="form-floating">
                        <input type="search" name="nip" id="nip" placeholder="Masukan NIP anda disini ..." class="form-control form-control-lg shadow-lg">
                        <label for="nip">Masukan Nomor Induk Pegawai</label>
                    </div>
                    <button class="btn btn-warning btn-lg shadow-lg" type="submit"><i class="bi bi-search me-3"></i>Submit</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    <div class="row my-6">
        <div class="col-sm-10 mx-auto text-center">
            <div id="loadDataAsn"></div>
        </div>
    </div>
</div>