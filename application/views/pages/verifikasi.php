<!-- row  -->
<div class="row mt-6 px-2 px-md-4">
    <div class="col-md-12 col-12">
        <!-- card  -->
        <div class="card p-0">
            <!-- card header  -->
            <div class="card-header bg-white pt-4 d-flex justify-content-between align-items-start">
                <div class="d-flex gap-4">
                    <i data-feather="inbox" class="icon-sm"></i>
                    <h4 class="mb-0">Verifikasi Usulan Pensiun ASN</h4>.
                </div>
                <div>
                    <button class="btn btn-secondary btn-md" onclick="return TabelVerifikasiPesiun.ajax.reload();"><i class="icon-xs" data-feather="refresh-ccw"></i></a>
                </div>
            </div>
            <!-- table  -->
            <div class="table-responsive p-4">
                <div class="alert alert-warning d-flex align-items-start" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-info-circle-fill me-2" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                    </svg>
                    <div>
                        <strong>Perhatian!</strong> <br>
                        Jangan lupa untuk mengarsipkan usulan, jika SK sudah diserahkan atau diterima yang bersangkutan.
                    </div>
                </div>
                <table id="table-verifikasi" class="table table-hover table-nowrap mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-nowrap">Nomor & Tanggal Usul</th>
                            <th>Jenis Usulan</th>
                            <th>Pensiun ASN</th>
                            <th>Usia</th>
                            <th>Status</th>
                            <th class="text-nowrap none">Detail SK</th>
                            <th class="none">Link Berkas Usul</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal ubah status usulan-->
<?= form_open(base_url('/app/verifikasi/ubahstatus'), ['id' => 'FormUbahStatus', 'class' => 'needs-validation', 'data-parsley-validate' => '', 'novalidate' => '']) ?>
<div class="modal fade" id="modalUbahStatusUsul" tabindex="-1" data-bs-backdrop="static" role="dialog" aria-labelledby="modalUbahStatusUsulTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <input type="hidden" name="token">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalUbahStatusUsulTitle"><i class="bi bi-patch-check-fill me-2 text-primary"></i> Verifikasi Usul</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div id="loadProfile"></div>
                <div class="form-floating">
                    <select class="form-select" name="status" id="floatingSelect" aria-label="Floating label select example" required="">
                        <option value="" selected>-- Pilih Status Usulan --</option>
                        <option value="SKPD">SKPD</option>
                        <option value="CETAK_USUL">SKPD CETAK USUL</option>
                        <option value="KIRIM_USUL">SKPD KIRIM USUL</option>
                        <option value="TTD_SK">TANDA TANGAN SK</option>
                        <option value="SELESAI_TMS">TMS</option>
                        <option value="SELESAI_BTL">BTL</option>
                    </select>
                    <label for="floatingSelect">Pilih Status Usul</label>
                </div>
                <div class="form-floating mt-3 d-none field-catatan">
                    <textarea class="form-control" name="catatan" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px"></textarea>
                    <label for="floatingTextarea">Masukan Catatan TMS atau BTL</label>
                </div>
                <div class="row row-cols-2 mt-3 d-none field-sk">
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="nomorsk" id="nomorsk" placeholder="Masukan Nomor SK Pensiun">
                            <label for="nomorsk">Nomor SK</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control tanggal" name="tanggalsk" id="tanggalsk" placeholder="Masukan Tanggal SK Pensiun">
                            <label for="tanggalsk">Tanggal SK</label>
                        </div>
                    </div>
                    <div class="mb-3 d-none" id="tglmeninggal">
                        <div class="form-floating">
                            <input type="text" class="form-control tanggal" data-parsley-excluded="true" name="tglmeninggal" id="tglmeninggal" placeholder="Masukan Tanggal Meninggal">
                            <label for="tglmeninggal">Tanggal Meninggal Dunia</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control tanggal" name="tmt_pensiun" id="tmt_pensiun" placeholder="TMT Pensiun">
                            <label for="tmt_pensiun">TMT Pensiun</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="namakeluarga" id="namakeluarga" placeholder="Masukan Nomor SK Pensiun">
                            <label for="namakeluarga">Nama Keluarga</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <select name="hubkeluarga" id="hubkeluarga" class="form-select">
                                <option value="0">-- Hubungan Keluarga --</option>
                                <option value="YBS">PNS Ybs</option>
                                <option value="SUTRI">SUAMI / ISTRI</option>
                                <option value="ANAK">ANAK</option>
                                <option value="ORTU">ORANG TUA</option>
                            </select>
                            <label for="hubkeluarga">Hubungan Keluarga</label>
                        </div>
                    </div>
                    <div>
                        <div class="form-floating">
                            <input type="text" class="form-control tanggal" name="tgl_lahir_penerima" id="tgl_lahir_penerima" placeholder="TMT Pensiun">
                            <label for="tgl_lahir_penerima">Tanggal Lahir Penerima</label>
                        </div>
                    </div>
                    <div class="w-100 my-2"></div>
                    <div>
                        <div class="form-floating">
                            <textarea class="form-control" name="alamat_pensiun" placeholder="Alamat Pensiun" id="AlamatPensiun" style="height: 100px"></textarea>
                            <label for="AlamatPensiun">Alamat Pensiun</label>
                        </div>
                    </div>
                    <div>
                        <div class="form-floating">
                            <textarea class="form-control" name="note" data-parsley-validate-if-empty placeholder="Tambahkan Catatan" id="floatingTextareaCatatan" style="height: 100px"></textarea>
                            <label for="floatingTextareaCatatan">Tambah Catatan</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-arrow-left me-2"></i> Batal</button>
                <button type="submit" class="btn btn-primary"><i class="bi bi-send me-2"></i> Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<!-- Modal approve usulan-->
<div class="modal fade" id="modalApprove" tabindex="-1" data-bs-backdrop="static" data-bs-delay='{"show":0,"hide":150}' role="dialog" aria-labelledby="modalApproveTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <?= form_open_multipart(base_url('/app/verifikasi/approve'), ['id' => 'FormApprove', 'class' => 'needs-validation', 'data-parsley-validate' => '', 'novalidate' => '']) ?>
            <input type="hidden" name="token">
            <input type="hidden" name="nip">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalApproveTitle"><i class="bi bi-check-circle-fill me-2 text-success"></i> Approve Usul</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div id="loadProfile"></div>
                <div id="loadMessage"></div>

                <div class="form-floating">
                    <div class="input-group">
                        <input type="file" name="filesk" class="form-control" id="inputGroupFile01" data-parsley-errors-container=".errorBlock" required>
                        <label class="input-group-text bg-light" for="inputGroupFile01"><i class="bi bi-upload"></i></label>
                    </div>
                    <div class="errorBlock"></div>
                </div>
                <div id="filesk" class="d-none p-2 mb-4 mt-3 w-100 border rounded d-flex justify-content-between align-content-start border border-primary">
                    <div class="d-inline-flex align-content-center justify-content-center  gap-2">
                        <i class="icon-md p-2" data-feather="file-text"></i>
                        <div class="vr h-100"></div>
                        <div>
                            <span class="small">Unduh File SK</span> <br>
                            <a href="#" id="filename-link" target="_blank"><span class="font-monospace py-0 my-0 text-truncate fw-bold text-primary small" id="filename"></span></a>
                        </div>
                    </div>
                    <a href="#" id="filename-link" target="_blank"><i class="icon-md p-2 rounded border" data-feather="download"></i></a>
                </div>
                <div class="form-floating mt-3">
                    <input type="text" class="form-control tanggal-waktu" name="tanggal_approve" id="tanggal_approve" placeholder="Masukan Tanggal Approve" required>
                    <label for="tanggal_approve">Pilih Tanggal & Jam Approve</label>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-arrow-left me-2"></i> Batal</button>
                <button type="submit" class="btn btn-success"><i class="bi bi-hand-thumbs-up-fill me-2"></i> Approve</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- Modal archive usulan-->
<div class="modal fade" id="modelArchive" tabindex="-1" data-bs-backdrop="static" data-bs-delay='{"show":0,"hide":150}' role="dialog" aria-labelledby="modelArchiveTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <?= form_open_multipart(base_url('/app/verifikasi/arsipkan'), ['id' => 'FormArchive', 'class' => 'needs-validation', 'data-parsley-validate' => '', 'novalidate' => '']) ?>
            <input type="hidden" name="token">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modelArchiveTitle"><i class="bi bi-check-circle-fill me-2 text-success"></i> Tanda Terima SK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div id="loadProfile"></div>
                <div class="row row-cols-2">
                    <div>
                        <div class="form-floating">
                            <input type="text" class="form-control" name="tanda_penerima" id="tanda_penerima" placeholder="Masukan Nama Penerima." required>
                            <label for="tanda_penerima">Tanda Penerima</label>
                        </div>
                    </div>
                    <div>

                        <div class="form-floating">
                            <input type="text" class="form-control tanggal-waktu" name="tanggal_archive" id="tanggal_archive" placeholder="Masukan Tanggal archive" required>
                            <label for="tanggal_archive">Pilih tanggal & jam diterima</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-arrow-left me-2"></i> Batal</button>
                <button type="submit" class="btn btn-success"><i class="bi bi-send me-2"></i> Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>