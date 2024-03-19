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
                <div class="form-group mb-4 w-100">
                    <div class="input-group">
                        <input type="text" name="nip" id="nip" class="form-control form-control-lg shadow-lg">
                        <button class="btn btn-warning btn-lg shadow-lg" type="submit"><i class="bi bi-search me-2"></i>Submit</button>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    <div class="row my-6">
        <div class="col-sm-7 mx-auto text-center">
            <div id="loadDataAsn"></div>
        </div>
    </div>
</div>